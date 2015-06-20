<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 7:29 PM
 */

namespace TodoMVC\Models;




interface UserInterface extends ModelInterface {

    public function getName();
    public function setName($name);

    public function getEmail();
    public function setEmail($email);
    
    public function setPassword($password);
    public function validatePassword($password);


}