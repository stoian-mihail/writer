<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["categoria 1", "categoria 2", "categoria 3"];
        foreach($categories as $category){
            PostCategory::create(["name"=>$category]);
        }
    }
}
