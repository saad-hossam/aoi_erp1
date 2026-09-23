<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $imageNumber = $this->faker->numberBetween(1, 20);
        $imageName = "product_{$imageNumber}.jpg";

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph(5),
            'regular_price' => $this->faker->randomFloat(2, 10, 500),
            'sale_price' => $this->faker->optional()->randomFloat(2, 5, 400),
            'SKU' => strtoupper(Str::random(10)),
            'stock_status' => $this->faker->randomElement(['instock', 'outofstock']),
            'featured' => $this->faker->boolean(30),
            'quantity' => $this->faker->numberBetween(0, 100),
            'image' => $imageName,

            // نخزن الصور كـ array (Laravel هيحولها JSON في DB لو الكاست مضبوط)
            'images' => [
                "product_{$imageNumber}_1.jpg",
                "product_{$imageNumber}_2.jpg",
                "product_{$imageNumber}_3.jpg",
            ],

            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'brand_id' => Brand::inRandomOrder()->first()?->id ?? Brand::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($product) {
            $colors = Color::inRandomOrder()->take(rand(1,3))->pluck('id');
            $product->colors()->attach($colors);

            $sizes = Size::inRandomOrder()->take(rand(1,3))->pluck('id');
            $product->sizes()->attach($sizes);
        });
    }
}
