<?php

namespace Database\Seeders;

use App\Services\Factories\AppApiKeyFactoryServices;
use Illuminate\Database\Seeder;

class ApiKeyMngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newApiKeyCount = 5;
        $newApiKeyHours = 2;
        $newApiKeyActive = true;

        AppApiKeyFactoryServices::setCount($newApiKeyCount)->setHours($newApiKeyHours)->setActive($newApiKeyActive)->generateGetResult();
    }
}
