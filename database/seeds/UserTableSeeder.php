<?php

use Illuminate\Database\Seeder;
use TodoMVC\User as User;


class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        /* @var $userRepository TodoMVC\Repositories\Contracts\UserRepositoryInterface */
        $userRepository = App::make('TodoMVC\Repositories\Contracts\UserRepositoryInterface');

        $userRepository->deleteAll();

        foreach(range(1,10) as $index)
        {
            /* @var $user TodoMVC\Models\UserInterface */
            $user = $userRepository->newInstance();

            $user->setName(str_replace('.', '_', $faker->name));
            $user->setEmail("user{$index}@example.com");
            $user->setPassword("password{$index}");
            $userRepository->save($user);
        }


    }
}
