<?php

use Illuminate\Database\Seeder;

class CheckListTableSeeder extends Seeder
{
    public function run()
    {



        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\Lorem($faker));

        /* @var $userRepository TodoMVC\Repositories\Contracts\UserRepositoryInterface */
        $userRepository = App::make('TodoMVC\Repositories\Contracts\UserRepositoryInterface');

        /* @var $checklistRepository TodoMVC\Repositories\Contracts\CheckListRepositoryInterface */
        $checklistRepository = App::make('TodoMVC\Repositories\Contracts\CheckListRepositoryInterface');

        $checklistRepository->deleteAll();

        /* @var $user TodoMVC\Models\UserInterface */
        foreach ($userRepository->all() as $user) {
            foreach(range(1,10) as $index)
            {
                /* @var $checklist TodoMVC\Models\CheckListInterface */
                $checklist = $checklistRepository->newInstance();
                $checklist->setUserId($user->getId());
                $checklist->setName($faker->sentence(3));
                $checklistRepository->save($checklist);
            }
        }

    }
}
