<?php

namespace App\Http\Middleware;

use App\Services\Access\AppApiKeyManagementService;
use Closure;
use Illuminate\Http\Request;

class ApiKeyApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header(env('X_API_KEY_NAME'))) {
            // ?: check into database, if key is exist then request can next
            $checkApiKey = AppApiKeyManagementService::setApiKey($request->header(env('X_API_KEY_NAME')))->getForHeader();
            if ($checkApiKey['active']) return $next($request);
            else return response()->json($checkApiKey['message'], 403);
        }
        abort(403, 'You need an API KEY');
    }
}
