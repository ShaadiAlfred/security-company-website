<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public static $picturesPath = 'profile-pictures/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Role relationship
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Role');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role->id === Role::whereName('Admin')->first()->id;
    }

    /**
     * Check if user is moderator
     */
    public function isModerator(): bool
    {
        return $this->role->id === Role::whereName('Moderator')->first()->id;
    }

    /**
     * Get attendance sent by this user
     */
    public function attendance()
    {
        return $this->hasMany('\App\Models\Attendance', 'submitted_by');
    }

    public function getPicturePath(): string
    {
        return 'storage/' . static::$picturesPath . $this->picture;
    }
}
