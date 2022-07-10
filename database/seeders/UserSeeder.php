<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()
            ->create([
                'name'=>'Mihail Stoian',
                'email' => 'stoian.mihail.alexandru@gmail.com',
            ]);

            User::factory()
            ->create([
                'name'=>'Administrator',
                'email' => 'mihailsoare2007@yahoo.com',
            ]);


    }
}
