<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceDetail>
 */
class ServiceDetailFactory extends Factory
{
    protected $model = ServiceDetail::class;

    public function definition()
    {
        return [
            'service_id' => Service::factory(),
            'service_description' => $this->faker->paragraph,
            'main_image' => $this->faker->imageUrl(),
            'subtitle' => $this->faker->sentence,
            'first_section_image' => $this->faker->imageUrl(),
            'first_section_title' => $this->faker->sentence,
            'second_section_image' => $this->faker->imageUrl(),
            'second_section_title' => $this->faker->sentence,
            'summary_title' => $this->faker->sentence,
            'summary_description' => $this->faker->paragraph,
        ];
    }
}
