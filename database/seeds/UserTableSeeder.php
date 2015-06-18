<?php

use Illuminate\Database\Seeder;
use TodoMVC\User as User;


class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        User::truncate();

        foreach(range(1,10) as $index)
        {
            User::create([
                'name' => str_replace('.', '_', $faker->name),
                'email' => "user{$index}@example.com",
                'password' => "password{$index}"
            ]);
        }


    }
}
