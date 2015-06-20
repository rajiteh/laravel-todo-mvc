<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-19
 * Time: 9:25 PM
 */

namespace TodoMVC\Utils;


interface PageableInterface {

    public function setPage($page);
    public function getPage();

    public function setPerPage($perPage);
    public function getPerPage();

}