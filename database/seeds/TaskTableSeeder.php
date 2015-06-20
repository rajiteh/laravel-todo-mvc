<?php

use Illuminate\Database\Seeder;
use TodoMVC\CheckList as CheckList;
use TodoMVC\Task as Task;

class TaskTableSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\Lorem($faker));

        /* @var $checklistRepository TodoMVC\Repositories\Contracts\CheckListRepositoryInterface */
        $checklistRepository = App::make('TodoMVC\Repositories\Contracts\CheckListRepositoryInterface');

        /* @var $taskRepository TodoMVC\Repositories\Contracts\TaskRepositoryInterface */
        $taskRepository = App::make('TodoMVC\Repositories\Contracts\TaskRepositoryInterface');


        $taskRepository->deleteAll();

        /* @var $checklist TodoMVC\Models\CheckListInterface */
        foreach ($checklistRepository->all() as $checklist) {
            foreach(range(1,10) as $index)
            {
                /* @var $task TodoMVC\Models\TaskInterface */
                $task = $taskRepository->newInstance();

                $task->setCheckListId($checklist->getId());
                $task->setTitle($faker->sentence(4));
                $task->setDescription($faker->sentence(10));
                $taskRepository->save($task);
            }
        }
    }
}
