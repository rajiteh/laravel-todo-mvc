<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 7:29 PM
 */

namespace TodoMVC\Models;




interface TaskInterface extends ModelInterface {

    public function getTitle();
    public function setTitle($title);

    public function getDescription();
    public function setDescription($name);
    
    public function getCheckListId();
    public function setCheckListId($id);

    public function getDone();
    public function setDone($done);


}