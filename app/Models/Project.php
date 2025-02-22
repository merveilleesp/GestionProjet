<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'status'];

    // Relation many-to-many avec les utilisateurs
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('role_id');
    }

    // Relation avec les tâches
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}