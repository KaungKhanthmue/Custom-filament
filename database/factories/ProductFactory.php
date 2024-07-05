<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
        return [
            "name" => fake()->name,
            "description" => fake()->sentence, 
            "category_id" => fake()->randomElement($categories)->id,
            "brand_id" => fake()->randomElement($brands)->id,
            "price"  => $this->faker->numberBetween($min=1000, $max=10000),
        ];
    }
}