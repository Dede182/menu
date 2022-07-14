<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['IT News','Sport',"Food and Drinks",'Travel'];
        foreach($categories as $category){
            Category::factory()->create([
                'title'=>$category,
                'slug'=>Str::slug($category),
                "user_id"=>User::inRandomOrder()->first()->id
            ]);
        }
    }
}
