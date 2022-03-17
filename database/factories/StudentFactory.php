<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->unique()->randomNumber(5),
            'class' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10']),
            'name' => $this->faker->name,
            'grade' => $this->faker->randomElement(['A+','A', 'A-', 'B+', 'B', 'B-', 'C','D','F']),
        ];
    }
}
