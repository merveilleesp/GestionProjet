<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relation many-to-many avec les projets
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
                    ->withPivot('role_id'); // Inclure le rôle de l'utilisateur dans le projet
    }

    // Relation avec les tâches assignées (un utilisateur peut avoir plusieurs tâches)
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    // Relation avec les notifications (un utilisateur peut avoir plusieurs notifications)
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Relation avec les rôles via la table pivot project_user
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'project_user', 'user_id', 'role_id');
    }
}