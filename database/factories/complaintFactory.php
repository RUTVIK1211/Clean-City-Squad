<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class complaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => UserFactory::new(),
            'area_id' => $this->faker->integer(),
            'address_line_1' => $this->faker->text(50),
            'address_line_2' => $this->faker->text(50),
            'description' => $this->faker->text(50),
            'status' => $this->faker->integer(),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'complaint_type_id'=> $this->faker->integer()
        ];
    }
}
