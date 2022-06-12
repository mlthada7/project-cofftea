<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2,3)),
            'slug' => $this->faker->slug(mt_rand(2,3)),
            'description' => collect($this->faker->paragraphs(mt_rand(1,1)))->map(fn($p) => "<p>$p</p>")->implode(''),
            // 'meta_title' => $this->faker->sentence(mt_rand(2,3)),
            // 'meta_description' => $this->faker->sentence(mt_rand(2,3)),
            // 'meta_keywords' => $this->faker->sentence(mt_rand(2,3)),
        ];
    }
}
