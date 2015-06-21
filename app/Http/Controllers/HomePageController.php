<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-20
 * Time: 8:41 PM
 */

namespace TodoMVC\Http\Controllers;


use Illuminate\Http\Response;

class HomePageController extends Controller {

    public function show() {
        return view('home');
    }
}