<?php

namespace TodoMVC\Repositories\Eloquent\Models;

use TodoMVC\Models\CheckListInterface;


class CheckList extends AbstractModel implements CheckListInterface
{


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($id)
    {
        $this->user_id = $id;
    }

}
