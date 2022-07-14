<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $description = $this->faker->realText(1000);
        return [
            'title'=>$title,
            'slug'=>Str::slug($title),
            'description'=>$description,
            'excerpt'=>Str::words($description,50,'...'),
            'user_id'=>User::inRandomOrder()->first()->id,
            'category_id'=>Category::inRandomOrder()->first()->id
        ];
    }
}
