<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 7:37 PM
 */

namespace TodoMVC\Models\Contracts;

interface HasIdContract {

    public function setId($id);
    public function getId();

}