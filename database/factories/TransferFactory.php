<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        return [
            'user_from' => User::find($this->faker->unique()->randomElement($users)),
            'user_to' => User::find($this->faker->unique()->randomElement($users)),
            'amount' => random_int(1,100000000),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
