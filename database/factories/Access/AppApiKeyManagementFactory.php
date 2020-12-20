<?php

namespace Database\Factories\Access;

use App\Models\Access\AppApiKeyManagement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AppApiKeyManagementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppApiKeyManagement::class;

    protected static function newFactory()
    {
        return AppApiKeyManagement::new();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'app_key' => Str::random(72),
            'is_active' => false,
            'active_until' => Carbon::now()->addHour(1)->toDateTimeString()
        ];
    }

    public function isActive(bool $active = true)
    {
        return $this->state(fn () => ['is_active' => $active]);
    }

    public function addHours(int $addHours = 1)
    {
        return $this->state(fn () => ['active_until' => Carbon::now()->addHour($addHours)->toDateTimeString()]);
    }
}
