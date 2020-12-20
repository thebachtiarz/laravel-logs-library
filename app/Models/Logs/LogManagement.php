<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogManagement extends Model
{
    use HasFactory;

    protected $fillable = ['name_type', 'alt_code', 'description'];

    // ? Relation
    public function userlog()
    {
        return $this->hasMany(\App\Models\Logs\UserLog::class, 'log_code');
    }
}
