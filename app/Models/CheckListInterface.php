<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 7:29 PM
 */

namespace TodoMVC\Models;

interface CheckListInterface extends ModelInterface {

    public function getName();
    public function setName($name);

    public function getUserId();
    public function setUserId($id);


}