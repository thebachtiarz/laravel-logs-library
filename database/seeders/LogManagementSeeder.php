<?php

namespace Database\Seeders;

use App\Services\Factories\LogMngFactoryServices;
use Illuminate\Database\Seeder;

class LogManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logData = [
            ['name_type' => 'register', 'alt_code' => '10100', 'description' => 'A new user has been registered'],
            ['name_type' => 'register', 'alt_code' => '10110', 'description' => 'A user has activated an account'],
            ['name_type' => 'login', 'alt_code' => '10500', 'description' => 'The user is signed in to account'],
            ['name_type' => 'logout', 'alt_code' => '10600', 'description' => 'The user is signed out from account'],
            ['name_type' => 'payment', 'alt_code' => '50200', 'description' => 'Payment using a paypal account'],
            ['name_type' => 'payment', 'alt_code' => '50210', 'description' => 'Payment using a master card account'],
            ['name_type' => 'payment', 'alt_code' => '50220', 'description' => 'Payment using a bit coin account'],
        ];

        for ($i = 0; $i < count($logData); $i++) {
            LogMngFactoryServices::setNametype($logData[$i]['name_type'])
                ->setAltcode($logData[$i]['alt_code'])
                ->setDescription($logData[$i]['description'])
                ->saveLog();
        }
    }
}
