<?php

namespace TodoMVC\Repositories\Eloquent;

use TodoMVC\Repositories\Contracts;
use TodoMVC\Repositories\Eloquent\Models\User;

class UserRepository extends AbstractRepository implements Contracts\UserRepositoryInterface {
    public function __construct(User $model) {
        parent::__construct($model);
    }
}