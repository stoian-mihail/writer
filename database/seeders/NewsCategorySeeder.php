<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = ['Aparitii editoriale', 'Lansari de carte'];
        foreach($news as $new){
            NewsCategory::create(['name'=>$new]);
        }
    }
}
