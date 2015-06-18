<?php

use Illuminate\Database\Seeder;
use TodoMVC\CheckList as CheckList;
use TodoMVC\Task as Task;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
        CheckList::truncate();

        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\Lorem($faker));

        foreach (CheckList::all() as $checklist) {
            foreach(range(1,10) as $index)
            {
                Task::create([
                    'check_list_id' => $checklist->id,
                    'title' => $faker->sentence(4),
                    'description' => $faker->sentence(10)
                ]);
            }
        }
    }
}
