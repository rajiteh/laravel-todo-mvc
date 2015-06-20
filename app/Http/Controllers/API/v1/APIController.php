<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-19
 * Time: 10:36 PM
 */

namespace TodoMVC\Http\Controllers\API\v1;


use TodoMVC\Http\Controllers\Controller;

abstract class APIController extends Controller {

    protected static $responseLayout = [
        "code" => "",
        "message" => "",
        "paging" => "",
    ];
}
