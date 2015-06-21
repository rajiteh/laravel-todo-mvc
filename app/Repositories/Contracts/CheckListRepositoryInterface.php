<?php

namespace TodoMVC\Repositories\Contracts;

interface CheckListRepositoryInterface extends RepositoryInterface {

    public function  ownedByUser($userId);
}