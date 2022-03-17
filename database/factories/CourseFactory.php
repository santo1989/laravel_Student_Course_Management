<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'course_code' => $this->faker->unique()->randomNumber(5),
            'course_type' => $this->faker->randomElement(['Core','Elective']),
            'course_duration' => $this->faker->randomElement(['0.5','0.75','1','1.5','1.75','2','3','4']),
            'course_fee' => $this->faker->randomElement(['0','1000','2000','3000','4000','5000','6000','7000','8000','9000','10000']),
        ];
    }
}
