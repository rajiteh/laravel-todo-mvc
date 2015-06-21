<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 11:02 PM
 */

namespace TodoMVC\Models;
use Illuminate\Contracts\Support\Arrayable;
use TodoMVC\Models\Contracts\HasIdContract;

interface ModelInterface extends  HasIdContract, Arrayable {

}