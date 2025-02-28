<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'name',
        'price_monthly',
        'price_yearly',
        'features',
    ];


    protected $casts = [
        'price_monthly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
        'features' => 'array',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
