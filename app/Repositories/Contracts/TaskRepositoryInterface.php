<?php

namespace TodoMVC\Repositories\Contracts;

interface TaskRepositoryInterface extends RepositoryInterface {


    public function ownedByCheckList($checklistId);
}