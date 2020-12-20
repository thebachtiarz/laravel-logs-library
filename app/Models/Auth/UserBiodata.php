<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBiodata extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'picture'];

    // ? Relation
    public function user()
    {
        return $this->belongsTo(\App\Models\Auth\User::class);
    }
}
