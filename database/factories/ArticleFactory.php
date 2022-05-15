<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            // 'content' => '<p>'. implode('</p><p>',$this->faker->paragraphs(mt_rand(2,5))).'</p>',
            'content' => collect($this->faker->paragraphs(mt_rand(2,5)))
                        ->map(function ($p) {
                            return "<p>$p</p>";
                        })
                        ->implode(''),
            'image' => $this->faker->imageUrl(200,200),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
