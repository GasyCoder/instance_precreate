<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Paddle\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    use Billable;
    protected $with = ['profile'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'email',
        'password',
        'email_verified_at',
        'is_active',
        'google_id',
        'otp',
        'otp_expires_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean'
        ];
    }

    public function activePlan()
    {
        return $this->subscriptions()
            ->whereIn('status', [Subscription::STATUS_ACTIVE, Subscription::STATUS_TRIAL])
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>', now());
            })
            ->with('plan') // Inclure le plan associé
            ->latest()
            ->first()
            ->plan ?? null;
    }


    public function entreprises()
    {
        return $this->hasMany(Entreprise::class);
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function activeSubscription()
    {
        return $this->subscriptions()
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhere('status', 'trial');
            })
            ->whereDate('end_date', '>=', now())
            ->first();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function canCreateInstance()
    {
        // Récupérer l'abonnement actif (trial ou payant)
        $activeSubscription = $this->subscriptions()
            ->whereIn('status', ['active', 'trial'])
            ->latest()
            ->first();

        if (!$activeSubscription) {
            return false;
        }

        // Compter les instances selon le type d'abonnement
        $instanceCount = $this->instances()
            ->whereHas('subscription', function($query) use ($activeSubscription) {
                $query->where('id', $activeSubscription->id);
            })->count();

        // Si c'est un abonnement payant, vérifier la limite du plan
        if ($activeSubscription->status === 'active') {
            return $instanceCount < ($activeSubscription->plan->instance_limit ?? 1);
        }

        // Si c'est un essai, limiter à 1 instance
        if ($activeSubscription->status === 'trial') {
            return $instanceCount < 1;
        }

        return false;
    }

    public function remainingInstances()
    {
        $activeSubscription = $this->subscriptions()
            ->whereIn('status', ['active', 'trial'])
            ->latest()
            ->first();

        if (!$activeSubscription) {
            return 0;
        }

        $instanceCount = $this->instances()
            ->whereHas('subscription', function($query) use ($activeSubscription) {
                $query->where('id', $activeSubscription->id);
            })->count();

        if ($activeSubscription->status === 'active') {
            return max(0, ($activeSubscription->plan->instance_limit ?? 1) - $instanceCount);
        }

        return $activeSubscription->status === 'trial' ? max(0, 1 - $instanceCount) : 0;
    }


    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';

        if (count($names) >= 2) {
            // Prendre la première lettre du premier et du dernier mot
            $initials = strtoupper(substr($names[0], 0, 1) . substr($names[count($names)-1], 0, 1));
        } else {
            // Si un seul mot, prendre les deux premières lettres
            $initials = strtoupper(substr($this->name, 0, 2));
        }

        return $initials;
    }

    public function hasUsedFreeTrial()
    {
        return $this->instances()
            ->whereHas('subscription', function($query) {
                $query->whereHas('plan', function($q) {
                    $q->where('is_free', true);
                });
            })
            ->exists();
    }

    public function hasReachedTrialLimit()
    {
        return $this->instances()
            ->whereHas('subscription', function($query) {
                $query->where('status', Subscription::STATUS_TRIAL);
            })
            ->count() >= 1;
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path);
        }

        // Si l'utilisateur a un profil avec un prénom
        $name = $this->profile?->fname ?? $this->name ?? $this->email;

        // Paramètres de l'avatar
        $params = [
            'name' => urlencode($name),
            'size' => 200,         // Taille en pixels
            'background' => '4A90E2', // Couleur d'arrière-plan (bleu primaire)
            'color' => 'ffffff',   // Couleur du texte (blanc)
            'bold' => true,        // Texte en gras
            'rounded' => true,     // Avatar rond
        ];

        // Construction de l'URL
        $queryString = http_build_query($params);
        return "https://ui-avatars.com/api/?{$queryString}";
    }

}
