<?php

namespace TodoMVC\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Laravel 5 Extended Generators
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }

        $eloquentBinds = [
            'TodoMVC\Repositories\Contracts\CheckListRepositoryInterface' => 'TodoMVC\Repositories\Eloquent\CheckListRepository',
            'TodoMVC\Repositories\Contracts\TaskRepositoryInterface' => 'TodoMVC\Repositories\Eloquent\TaskRepository',
            'TodoMVC\Repositories\Contracts\UserRepositoryInterface' => 'TodoMVC\Repositories\Eloquent\UserRepository',
            'TodoMVC\Models\UserInterface' => 'TodoMVC\Repositories\Eloquent\Models\User',
            'TodoMVC\Models\CheckListInterface' => 'TodoMVC\Repositories\Eloquent\Models\CheckList',
            'TodoMVC\Models\TaskInterface' => 'TodoMVC\Repositories\Eloquent\Models\Task',
        ];


        foreach($eloquentBinds as $key => $val)
            $this->app->bind($key, $val);



    }
}
