<?php

namespace App\Models\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'is_active',
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

    // ? Relation

    public function userbio()
    {
        return $this->hasMany(\App\Models\Auth\UserBiodata::class, 'user_id');
    }

    public function userbiolatest()
    {
        return $this->hasMany(\App\Models\Auth\UserBiodata::class, 'user_id')->latest()->first();
    }

    public function userstat()
    {
        return $this->hasOne(\App\Models\Auth\UserStatus::class, 'user_id');
    }

    public function userlog()
    {
        return $this->hasMany(\App\Models\Logs\UserLog::class, 'user_id');
    }
}
