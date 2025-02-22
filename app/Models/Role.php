<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    // Relation avec les utilisateurs via la table pivot
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}