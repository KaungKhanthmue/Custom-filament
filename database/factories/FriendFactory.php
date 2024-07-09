<?php

namespace Database\Factories;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Friend::class;

    public function definition(): array
    {
        $users = User::all();

        $userOne = $users->random();
        $userTwo = $users->where('id', '!=', $userOne->id)->random();

        return [
            'user_one_id' => $userOne->id,
            'user_two_id' => $userTwo->id,
            'status' => 'pending',
        ];
    }
}