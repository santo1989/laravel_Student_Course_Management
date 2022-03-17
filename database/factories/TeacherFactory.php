<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teacher_id' => $this->faker->unique()->randomNumber(5), 
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone'=> $this->faker->phoneNumber,
            'address'=> $this->faker->address,
            'image'=> $this->faker->imageUrl(300,300),
        ];
    }
}
