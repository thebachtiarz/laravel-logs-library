<?php

namespace App\Services\Factories;

use App\Models\Logs\LogManagement;

class LogMngFactoryServices
{
    protected static string $nametype;
    protected static string $altcode = '';
    protected static string $description;
    protected static bool $status = false;

    // ? Public Method
    public static function saveLog()
    {
        self::runProcess();
        if (self::$status) {
            return array_merge(self::successResult(), ['data' => self::generateLogData()]);
        } else {
            return self::errorResult();
        }
    }

    // ? Private Method
    private static function runProcess()
    {
        self::saveProcess();
    }

    private static function saveProcess()
    {
        try {
            LogManagement::create(self::generateLogData());
            self::$status = true;
        } catch (\Throwable $th) {
            self::$status = false;
        }
    }

    // ? Result Generate
    private static function generateLogData()
    {
        return [
            'name_type' => self::$nametype,
            'alt_code' => self::$altcode,
            'description' => self::$description
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
     * Set the value of nametype
     *
     * @return  self
     */
    public static function setNametype($nametype)
    {
        self::$nametype = $nametype;

        return new self;
    }

    /**
     * Set the value of altcode
     *
     * @return  self
     */
    public static function setAltcode($altcode)
    {
        self::$altcode = $altcode;

        return new self;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public static function setDescription($description)
    {
        self::$description = $description;

        return new self;
    }
}
