<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'content' => $this->faker->word(),
            'attachment_id' => $this->faker->randomNumber(),
            'is_hidden' => $this->faker->boolean(),
            'is_deleted' => $this->faker->boolean(),
            'is_edited' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'chat_id' => Chat::factory(),
            'sender_id' => User::factory(),
        ];
    }
}
