<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    const STATUS_TRIAL = 'trial';
    const STATUS_ACTIVE = 'active';
    const STATUS_EXPIRED = 'expired';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'sub_plan_id',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relations existantes...

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function subPlan()
    {
        return $this->belongsTo(SubPlan::class, 'sub_plan_id');
    }

    public function instance()
    {
        return $this->hasOne(Instance::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Méthodes améliorées
    public function isTrialPeriod()
    {
        return $this->status === self::STATUS_TRIAL && $this->end_date->isFuture();
    }

    public function canUpgrade()
    {
        return $this->isTrialPeriod() && $this->end_date->isFuture();
    }

    public function canChangePlan()
    {
        return $this->status === self::STATUS_ACTIVE && !$this->hasRecentlyChanged();
    }

    public function hasRecentlyChanged()
    {
        return $this->updated_at && $this->updated_at->addDays(30)->isFuture();
    }

    public function daysUntilChangeAllowed()
    {
        if (!$this->hasRecentlyChanged()) {
            return 0;
        }
        return now()->diffInDays($this->updated_at->addDays(30));
    }

    public function remainingTrialDays()
    {
        return $this->isTrialPeriod() ? now()->diffInDays($this->end_date) : 0;
    }

    /**
     * Déterminer si l'abonnement est annuel
     */
    public function getIsAnnualAttribute()
    {
        return $this->attributes['is_annual'] ?? false; // Lire la valeur stockée ou par défaut false
    }
    public static function hasEverUsedTrial($userId)
    {
        return static::where('user_id', $userId)
            ->where(function($query) {
                $query->where('status', self::STATUS_TRIAL)
                    ->orWhere(function($q) {
                        $q->where('status', self::STATUS_ACTIVE)
                            ->whereHas('plan', function($p) {
                                $p->where('is_free', false);
                            });
                    });
            })
            ->exists();
    }

    public static function hasActiveTrial($userId)
    {
        return static::where('user_id', $userId)
            ->where('status', self::STATUS_TRIAL)
            ->where('end_date', '>', now())
            ->exists();
    }
}
