<?php

namespace App\Services\Logs;

use App\Models\Auth\User;
use App\Models\Logs\LogManagement;
use App\Models\Logs\UserLog;

class UserLogServices
{
    protected static int $userid;
    protected static int $logcode;
    protected static string $logtype;
    protected static string $logmessage;
    protected static array $logGenerate;
    protected static bool $logresult = false;

    protected static object $userData;
    protected static object $logsData;

    // ? Public Method
    public static function process()
    {
        self::logProcessing();
        if (self::$logresult) {
            return self::successResult();
        } else {
            return self::errorResult();
        }
    }

    public static function processGetResult()
    {
        self::logProcessing();
        if (self::$logresult) {
            return array_merge(self::successResult(), ['result' => self::$logGenerate]);
        } else {
            return self::errorResult();
        }
    }

    // ? Private Method
    private static function logProcessing()
    {
        $user = self::userCheck();
        $logs = self::logMngCheck();
        if ($user && $logs) {
            self::logGenerate();
            self::logSaving();
        }
    }

    private static function logSaving()
    {
        try {
            UserLog::create([
                'user_id' => self::$userid,
                'log_code' => self::$logcode,
                'log_type' => self::$logtype,
                'log_message' => self::$logmessage
            ]);
            self::$logresult = true;
        } catch (\Throwable $th) {
            self::$logresult = false;
        }
    }

    // ?@ User check by id
    private static function userCheck()
    {
        $user = User::find(self::$userid);
        if (!!$user) {
            self::$userData = $user;
            return true;
        }
        return false;
    }

    // ?@ Log Management check by code
    private static function logMngCheck()
    {
        $logs = LogManagement::find(self::$logcode);
        if (!!$logs) {
            self::$logsData = $logs;
            return true;
        }
        return false;
    }

    // ?@ Generate log result by user
    private static function logGenerate()
    {
        self::$logGenerate = [
            'user' => self::$userData->userbiolatest()->name,
            'log_code' => self::$logsData->name_type,
            'log_type' => self::$logtype,
            'log_message' => self::$logmessage
        ];
    }

    // ? Result Message
    private static function successResult()
    {
        return [
            'is_success' => true,
            'status' => 'success',
            'message' => 'Log successfully saved'
        ];
    }

    private static function errorResult()
    {
        return [
            'is_success' => false,
            'status' => 'error',
            'message' => 'Log failed to save'
        ];
    }

    // ? Setter Module
    /**
     * Set the value of userid
     *
     * @return  self
     */
    public static function setUserId($userid)
    {
        self::$userid = $userid;

        return new self;
    }

    /**
     * Set the value of logtype
     *
     * @return  self
     */
    public static function setLogType($logtype)
    {
        self::$logtype = $logtype;

        return new self;
    }

    /**
     * Set the value of logcode
     *
     * @return  self
     */
    public static function setLogCode($logcode)
    {
        self::$logcode = $logcode;

        return new self;
    }

    /**
     * Set the value of logmessage
     *
     * @return  self
     */
    public static function setLogMessage($logmessage)
    {
        self::$logmessage = $logmessage;

        return new self;
    }
}
