<?php

namespace App\Models;

use Laravel\Paddle\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    const METHOD_VISA = 'VISA';
    const METHOD_ORANGE_MONEY = 'OrangeMoney';
    const METHOD_MVOLA = 'Mvola';

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    protected $fillable = [
        'user_id',
        'plan_id',
        'subscription_id',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
        'cardholder_name',
        'currency',
        'amount_local'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
