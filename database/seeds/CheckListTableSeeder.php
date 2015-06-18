<?php

use Illuminate\Database\Seeder;
use TodoMVC\User as User;
use TodoMVC\CheckList as CheckList;

class CheckListTableSeeder extends Seeder
{
    public function run()
    {

        CheckList::truncate();

        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\Lorem($faker));

        foreach (User::all() as $user) {
            foreach(range(1,10) as $index)
            {
                CheckList::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence(3)
                ]);
            }
        }

    }
}
