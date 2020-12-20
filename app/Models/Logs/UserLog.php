<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'log_code', 'log_type', 'log_message'];

    // ? Relation
    public function user()
    {
        return $this->belongsTo(\App\Models\Auth\User::class);
    }

    public function logmanagement()
    {
        return $this->belongsTo(\App\Models\Logs\LogManagement::class);
    }
}
