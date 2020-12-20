<?php

namespace Database\Factories\Auth;

use App\Models\Auth\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserStatus::class;

    protected static function newFactory()
    {
        return UserStatus::new();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 'user'
        ];
    }
}
