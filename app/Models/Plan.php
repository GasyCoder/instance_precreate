<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price_monthly',
        'price_yearly',
        'price_local',
        'instance_limit',
        'duration_days',
        'is_free',
        'is_default',
        'features',
    ];

    protected $casts = [
        'price_monthly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
        'price_local' => 'decimal:2',
        'instance_limit' => 'integer',
        'duration_days' => 'integer',
        'is_free' => 'boolean',
        'is_default' => 'boolean',
        'features' => 'array',
    ];

    public function getDiscountedYearlyPriceAttribute()
    {
        if ($this->price_yearly <= $this->price_monthly * 12 * 0.9) {
            return $this->price_yearly;
        }
        return $this->price_monthly * 12 * 0.9;
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($plan) {
            if ($plan->is_default) {
                self::where('is_default', true)
                    ->where('id', '!=', $plan->id)
                    ->update(['is_default' => false]);
            }
        });

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function hasSubPlans(): bool
    {
        return $this->has_sub_plans;
    }

    public function subPlans()
    {
        return $this->hasMany(SubPlan::class);
    }

    // Méthode helper pour vérifier si un utilisateur a une souscription active pour ce plan
    public function hasActiveSubscription(User $user)
    {
        return $this->subscriptions()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>', now());
            })
            ->exists();
    }
}
