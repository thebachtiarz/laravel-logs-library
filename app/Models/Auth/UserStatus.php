<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];

    // ? Relation
    public function user()
    {
        return $this->belongsTo(\App\Models\Auth\User::class);
    }
}
