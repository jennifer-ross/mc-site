<?php

namespace Database\Factories;

use App\Models\ChatParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChatParticipantFactory extends Factory
{
    protected $model = ChatParticipant::class;

    public function definition(): array
    {
        return [
            'chat_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'role' => $this->faker->word(),
            'joined_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
