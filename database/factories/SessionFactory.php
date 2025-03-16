<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->word(),
            'payload' => $this->faker->word(),
            'last_activity' => $this->faker->unixTime(),
            'last_interaction' => $this->faker->unixTime(),
            'user_id' => User::factory(),
        ];
    }
}
