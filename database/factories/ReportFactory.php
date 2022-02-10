<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'title' => $this->faker->text(50),
            'report_link' => $this->faker->url
        ];
    }
}
