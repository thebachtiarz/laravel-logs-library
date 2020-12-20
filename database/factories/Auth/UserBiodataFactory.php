<?php

namespace Database\Factories\Auth;

use App\Models\Auth\UserBiodata;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserBiodataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserBiodata::class;

    protected static function newFactory()
    {
        return UserBiodata::new();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
