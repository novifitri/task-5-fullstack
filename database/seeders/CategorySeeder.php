<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = [
            [
                "name" => "Cooking",  
                "user_id" => 1,        
            ],
            [
                "name" => "Desain",
                "user_id" => 2,  
            ],
        ];
        Category::insert($categories);
    }
}
