<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all();
        $brands = Brand::all();
        $users = User::all();
        return [
            "name" => fake()->name,
            "description" => 'test', 
            "category_id" => fake()->randomElement($categories)->id,
            "brand_id" => fake()->randomElement($brands)->id,
            "user_id" => fake()->randomElement($users)->id, 
            "price"  => $this->faker->numberBetween($min=1000, $max=10000),
        ];
    }
}