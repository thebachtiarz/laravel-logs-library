<?php

namespace Database\Seeders;

use App\Services\Factories\UserFactoryServices;
use Illuminate\Database\Seeder;

class UserFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return UserFactoryServices::setCount(100)->setActive()->generate();
    }
}
