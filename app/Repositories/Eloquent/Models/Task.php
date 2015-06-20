<?php

namespace TodoMVC\Repositories\Eloquent\Models;

use TodoMVC\Models\TaskInterface;

/**
 * Class Task
 * @package TodoMVC\Models
 */
class Task extends AbstractModel implements TaskInterface
{
    /**
     * @var array
     */
    public static $rules = array(
        'name'                  => 'required',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|alpha_num|min:8|confirmed',
        'password_confirmation' => 'required|alpha_num|min:8',
    );


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
