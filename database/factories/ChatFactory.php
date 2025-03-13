<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'visibility' => $this->faker->word(),
            'name' => $this->faker->name(),
            'owner' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'owner_id' => $this->faker->randomNumber(),
        ];
    }
}
