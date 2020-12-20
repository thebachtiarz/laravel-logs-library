<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use stdClass;

class AppApiKeyManagement extends Model
{
    use HasFactory;

    // protected $primaryKey = 'app_key';

    protected $fillable = ['email', 'app_key', 'is_active', 'active_until', 'last_used'];

    // protected $hidden = ['app_key', 'created_at', 'updated_at'];

    // public function getRouteKeyName()
    // {
    //     return 'app_key';
    // }

    // ? Map Result
    public function simpleResult()
    {
        return [
            'user_email' => $this->email,
            'active' => $this->is_active ? true : false,
            'active_duration' => Carbon::now()->toDateTimeString() <= $this->active_until ? Carbon::parse($this->active_until)->diffForHumans() : 'API KEY has expired',
            'last_active' => !!$this->last_used ? Carbon::parse($this->last_used)->format('d F Y H:i:s') : ""
        ];
    }

    // ? Scope
    public function scopeFindApiKey($query, $apiKey)
    {
        $result = $query->where('app_key', $apiKey)->first();
        return $result;

        // throw (new ModelNotFoundException())->setModel(AppApiKeyManagement::class);
    }
}
