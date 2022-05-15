<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
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
            ProductCategory::create(["name"=>$category]);
        }

    }
}
