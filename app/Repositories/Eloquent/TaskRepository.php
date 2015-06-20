<?php

namespace TodoMVC\Repositories\Eloquent;

use TodoMVC\Repositories\Contracts;
use TodoMVC\Repositories\Eloquent\Models\Task;

class TaskRepository extends AbstractRepository implements Contracts\TaskRepositoryInterface {
    public function __construct(Task $model) {
        parent::__construct($model);
    }

    public function ownedByCheckList($checklistId)
    {
        return $this->model->where('check_list_id', $checklistId)->get()->all();
    }

}