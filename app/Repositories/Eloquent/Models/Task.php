<?php

namespace TodoMVC\Repositories\Eloquent\Models;

use TodoMVC\Models\TaskInterface;

/**
 * Class Task
 * @package TodoMVC\Models
 */
class Task extends AbstractModel implements TaskInterface
{



    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCheckListId()
    {
        return $this->check_list_id;
    }

    public function setCheckListId($id)
    {
        $this->check_list_id = $id;
    }
}
