<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
     use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 
        'admin_id', 
        'rescuer_id', 
        'guardian_id', 
        'name', 
        'email', 
        'password', 
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return auth()->check() && auth()->user()->role->name == 'ADMINISTRATOR';
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function rescuer()
    {
        return $this->belongsTo(Rescuer::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        return in_array($this->role->name, $role);
    }
}
