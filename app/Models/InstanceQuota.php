<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstanceQuota extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'url',
        'password',
        'api_key',
        'statut'
    ];
}
