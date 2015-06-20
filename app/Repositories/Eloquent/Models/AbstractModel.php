<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-19
 * Time: 8:59 PM
 */

namespace TodoMVC\Repositories\Eloquent\Models;


use Illuminate\Database\Eloquent\Model;
use TodoMVC\Models\ModelInterface;

abstract class AbstractModel extends Model implements ModelInterface {


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

}