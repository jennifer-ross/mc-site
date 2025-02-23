<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserBlocks;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserBlocksFactory extends Factory
{
    protected $model = UserBlocks::class;

    public function definition(): array
    {
        return [
            'from_date' => Carbon::now(),
            'to_date' => Carbon::now(),
            'reason' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'blocked_by' => User::factory(),
            'user_id' => User::factory(),
        ];
    }
}
