<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikeProduct>
 */
class LikeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $product = Product::all();
        return [
            "user_id" => fake()->randomElement($users)->id, 
            "product_id" => fake()->randomElement($product)->id,
        ];
    }
}