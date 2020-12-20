<?php

namespace App\Services\Factories;

use App\Models\Access\AppApiKeyManagement;

class AppApiKeyFactoryServices
{
    // todo: buat factory untuk api key generator
    protected static int $count = 1;
    protected static int $addHour = 1;
    protected static bool $active = false;
    protected static bool $status = false;
    protected static object $result;

    // ? Public Method
    public static function generate()
    {
        self::runProcess();
        if (self::$status) {
            return self::successResult();
        } else {
            return self::errorResult();
        }
    }

    public static function generateGetResult()
    {
        self::runProcess();
        if (self::$status) {
            return array_merge(self::successResult(), ['data' => self::$result]);
        } else {
            return self::errorResult();
        }
    }

    // ? Private Method
    private static function runProcess()
    {
        try {
            self::$result = AppApiKeyManagement::factory()
                ->count(self::$count)
                ->addHours(self::$addHour)
                ->isActive(self::$active)
                ->create();
            self::$status = true;
        } catch (\Throwable $th) {
            self::$status = false;
        }
    }

    // ? Result Message
    private static function successResult()
    {
        return [
            'is_success' => true,
            'status' => 'success',
            'message' => 'App API KEY successfully generated'
        ];
    }

    private static function errorResult()
    {
        return [
            'is_success' => false,
            'status' => 'error',
            'message' => 'App API KEY failed to generate'
        ];
    }

    // ? Setter Module
    /**
     * Set the value of count
     *
     * @return  self
     */
    public static function setCount($count)
    {
        self::$count = $count;

        return new self;
    }

    /**
     * Set the value of addHour
     *
     * @return  self
     */
    public static function setHours($addHour)
    {
        self::$addHour = $addHour;

        return new self;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */
    public static function setActive($active)
    {
        self::$active = $active;

        return new self;
    }
}
