<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/log', function () {
        $setLog = \App\Services\Logs\UserLogServices::setUserId(request('userid'))
            ->setLogCode(request('logcode'))
            ->setLogType(request('logtype'))
            ->setLogMessage(request('logmessage'))
            ->processGetResult();
        return response()->json($setLog, $setLog['is_success'] ? 201 : 202);
    });
});

Route::group(['prefix' => 'factory'], function () {
    Route::post('/user', function () {
        $setUser = \App\Services\Factories\UserFactoryServices::setCount(request('count'))
            ->setActive(request('active'))
            ->generate();
        return response()->json($setUser, $setUser['is_success'] ? 201 : 202);
    });
    Route::post('/logmng', function () {
        $newLog = \App\Services\Factories\LogMngFactoryServices::setNametype(request('nametype'))
            ->setAltcode(request('altcode'))
            ->setDescription(request('description'))
            ->saveLog();
        return response()->json($newLog, $newLog['is_success'] ? 201 : 202);
    });
});
