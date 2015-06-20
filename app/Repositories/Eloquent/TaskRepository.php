<?php

namespace TodoMVC\Repositories\Eloquent;

use TodoMVC\Repositories\Contracts;
use TodoMVC\Repositories\Eloquent\Models\Task;

class TaskRepository extends AbstractRepository implements Contracts\TaskRepositoryInterface {
    public function __construct(Task $model) {
        parent::__construct($model);
    }
}