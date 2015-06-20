<?php

namespace TodoMVC\Repositories\Eloquent;

use TodoMVC\Repositories\Contracts;
use TodoMVC\Repositories\Eloquent\Models\CheckList;

class CheckListRepository extends AbstractRepository implements Contracts\CheckListRepositoryInterface {

    public function __construct(CheckList $model) {
        parent::__construct($model);
    }
}