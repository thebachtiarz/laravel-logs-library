<?php

namespace App\Services\Access;

use App\Models\Access\AppApiKeyManagement;
use Illuminate\Support\Carbon;

class AppApiKeyManagementService
{
    protected static string $apiKey;
    protected static int $addHour;
    protected static bool $active;
    protected static bool $touchLastUsed;
    protected static bool $activeManageByDateTime = false;

    protected static object $ApiKeyData;

    // ? Public Method
    public static function get()
    {
        return self::getApiKey();
    }

    public static function getForHeader()
    {
        return self::apiForHeaderUsage();
    }

    // ? Private Method
    private static function getApiKey()
    {
        self::getApiData();
        if (self::$ApiKeyData->count()) return self::$ApiKeyData->simpleResult();
    }

    private static function apiProcessingManagement()
    {
        self::apiKeyActiveManageByDateTime();
        //
        self::apiKeyTouchUsed();
        //
        self::getApiData();
    }

    protected static function apiForHeaderUsage()
    {
        self::apiProcessingManagement();
        if (self::$ApiKeyData->count()) {
            if (self::$ApiKeyData->is_active) {
                return ['active' => true, 'status' => 'valid', 'until' => self::$ApiKeyData->active_until, 'last_used' => self::$ApiKeyData->last_used, 'message' => 'api key is active'];
            } else {
                return ['active' => false, 'status' => 'invalid', 'until' => self::$ApiKeyData->active_until, 'last_used' => self::$ApiKeyData->last_used, 'message' => 'api key is not active or expired'];
            }
        } else {
            return ['active' => false, 'status' => 'error', 'until' => '', 'last_used' => '', 'message' => 'api key is not valid with this app'];
        }
    }

    // ? Protected Method
    protected static function getApiData()
    {
        if (self::$activeManageByDateTime) self::apiKeyActiveManageByDateTime();
        self::$ApiKeyData = AppApiKeyManagement::findApiKey(self::$apiKey);
    }

    protected static function apiKeyActiveManageByDateTime()
    {
        $api = AppApiKeyManagement::findApiKey(self::$apiKey);
        if ($api->count()) {
            // @ It's mean the api key has expired
            if (($api->is_active) && (Carbon::now()->toDateTimeString() > $api->active_until)) {
                $api->update(['is_active' => false]);
            }
        }
    }

    protected static function apiKeyActiveManage()
    {
        $api = AppApiKeyManagement::findApiKey(self::$apiKey);
        if ($api->count()) {
            // @ Update is_active api key
            $api->update(['is_active' => self::$active]);
        }
    }

    protected static function apiKeyAddHours()
    {
        $api = AppApiKeyManagement::findApiKey(self::$apiKey);
        if ($api->count()) {
            if ($api->is_active) {
                // @ Add hour based from active_until remain
                $api->update(['active_until' => Carbon::parse($api->active_until)->addHours(self::$addHour)->toDateTimeString()]);
            } else {
                // @ Add hour based from time now and activate this api key
                $api->update(['active_until' => Carbon::now()->addHours(self::$addHour)->toDateTimeString(), 'is_active' => true]);
            }
        }
    }

    protected static function apiKeyTouchUsed()
    {
        $api = AppApiKeyManagement::findApiKey(self::$apiKey);
        if ($api->count()) {
            // @ Update with touch last_used api key if active
            if ($api->is_active) $api->update(['last_used' => Carbon::now()->toDateTimeString()]);
        }
    }

    // ? Setter Module
    /**
     * Set the value of apiKey
     *
     * @return  self
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;

        return new self;
    }

    /**
     * Set the value of addHour
     *
     * @return  self
     */
    public static function setHours(int $addHour = 1)
    {
        self::$addHour = $addHour;

        self::apiKeyAddHours();

        return new self;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */
    public static function setActive(bool $active = true)
    {
        self::$active = $active;

        self::apiKeyActiveManage();

        return new self;
    }

    /**
     * Set the value of touchLastUsed
     *
     * @return  self
     */
    public static function setUsed($touchLastUsed)
    {
        self::$touchLastUsed = $touchLastUsed;

        return new self;
    }

    /**
     * Set the value of activeManage
     *
     * @return  self
     */
    public static function setActiveManage(bool $activeManageByDateTime = true)
    {
        self::$activeManageByDateTime = $activeManageByDateTime;

        return new self;
    }
}
