<?php

namespace App\Services\Factories;

use App\Models\Auth\User;

class UserFactoryServices
{
    protected static int $newUserCount = 1;
    protected static bool $isActive = false;
    protected static object $newUserGenerated;
    protected static bool $status = false;

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
            return array_merge(self::successResult(), ['data' => self::$newUserGenerated]);
        } else {
            return self::errorResult();
        }
    }

    // ? Private Method
    private static function runProcess()
    {
        try {
            self::$newUserGenerated = User::factory()
                ->count(self::$newUserCount)
                ->isActive(self::$isActive)
                ->hasUserBio()
                ->hasUserStat()
                ->create();
            self::$status = true;
        } catch (\Throwable $th) {
            self::$status = false;
            return $th->getMessage();
        }
    }

    // ? Result Message
    private static function successResult()
    {
        return [
            'is_success' => true,
            'status' => 'success',
            'message' => 'User successfully generated'
        ];
    }

    private static function errorResult()
    {
        return [
            'is_success' => false,
            'status' => 'error',
            'message' => 'User failed to generate'
        ];
    }

    // ? Setter Module
    /**
     * Set the value of newUserCount
     *
     * @return  self
     */
    public static function setCount($newUserCount)
    {
        self::$newUserCount = $newUserCount;

        return new self;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */
    public static function setActive(bool $active = true)
    {
        self::$isActive = $active;

        return new self;
    }
}
