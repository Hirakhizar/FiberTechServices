<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceKeyPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceKeyPoint>
 */
class ServiceKeyPointFactory extends Factory
{
    protected $model = ServiceKeyPoint::class;

    public function definition()
    {
        return [
            'service_id' => Service::factory(),
            'key_points' => $this->faker->sentence,
        ];
    }
}
