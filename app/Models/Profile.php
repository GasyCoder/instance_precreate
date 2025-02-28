<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'civilite',
        'telephone',
        'adresse',
        'ville',
        'pays',
        'zipcode',
        'bio',
        'birthdate',
        'birthlocation',
        'is_public'
    ];

    protected $dates = [
        'birthdate',
        'deleted_at'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'is_public' => 'boolean'
    ];

    // Accesseurs
    public function getFullNameAttribute()
    {
        return ucfirst($this->fname) . ' ' . ucfirst($this->lname);
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeSearchByName($query, $search)
    {
        return $query->where('fname', 'LIKE', "%{$search}%")
                    ->orWhere('lname', 'LIKE', "%{$search}%");
    }

    // Validation rules
    public static function rules($id = null)
    {
        return [
            'fname' => 'required|string|max:50',
            'lname' => 'nullable|string|max:50',
            'civilite' => 'nullable',
            'telephone' => 'nullable|string|max:20|unique:profiles,telephone,' . $id,
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:10',
            'bio' => 'nullable|string',
            'birthdate' => 'nullable|date|before:today',
            'birthlocation' => 'nullable|string',
            'is_public' => 'boolean'
        ];
    }

    public function isComplete(): bool
    {
        return !empty($this->fname)
            && !empty($this->lname)
            && !empty($this->telephone);
    }
}
