<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 11:02 PM
 */

namespace TodoMVC\Models;
use TodoMVC\Models\Contracts\HasIdContract;
use TodoMVC\Models\Contracts\PersistableContract;
use TodoMVC\Models\Contracts\ResettableContract;

interface ModelInterface extends  HasIdContract {

}