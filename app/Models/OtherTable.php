<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherTable extends Model
{
    protected $connection = 'second_db';
    protected $table = 'users'; // Nom de la table dans l'autre base
    protected $fillable = ['name', 'email', 'api_key','plan_id', 'sub_plan_id', 'url_dolibarr', 'password']; // Les colonnes modifiables
    //use HasFactory;
}
