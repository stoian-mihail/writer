<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\NewsCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        $this->call(NewsCategorySeeder::class);
        $this->call(PostCategoriesSeeder::class);
        $this->call(ProductCategoriesSeeder::class);

    }
}
