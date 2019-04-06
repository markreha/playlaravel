<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function test()
    {
        return "Hello World From My Test Controller";
    }

    public function test2()
    {
        return view('helloworld');
    }

    public function missingMethod($parameters = array())
    {
        return "Missing method from Implicit Controller";
    }
}
