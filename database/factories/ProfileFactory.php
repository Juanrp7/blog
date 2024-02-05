<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $profession = $this->faker->unique()->word(10);
        return [
            'photo' => 'profile/'.$this->faker->image('public/storage/profile',640, 480, null, false),
            'profession' => $profession,
            'about' => $this->faker->realText(100),
            'twitter' => $this->faker->text(100),
            'linkedin' => $this->faker->text(100),
            'facebook' => $this->faker->text(100),
            'user_id' => User::all()->random()->id
        ];
    }
}
