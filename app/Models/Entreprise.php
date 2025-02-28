<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'nif',
        'ville',
        'pays',
        'phone',
        'adresse',
        'employees_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }

    public function getPaysNomAttribute()
    {
        return $this->pays === 0 ? 'Madagascar' : 'France';
    }
}
