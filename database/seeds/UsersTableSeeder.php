<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 1)->create([
            "name" => "Danis Yogaswara",
            "email" => "danistutorial@gmail.com"
        ]);
        factory(\App\User::class, 1)->create([
            "name" => "Taufiq",
            "email" => "taufik@gmail.com"
        ]);
    }
}
