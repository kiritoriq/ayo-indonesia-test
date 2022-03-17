<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Keygen\Keygen;
use App\Models\UsersRoles;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'deleted_at',
    ];

    public function roles() {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
