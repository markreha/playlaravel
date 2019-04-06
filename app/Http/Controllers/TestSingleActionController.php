<?php

namespace App\Http\Controllers;

class TestSingleActionController extends Controller
{
    public function __invoke()
    {
        return "I am a Single Action Controller";
    }
}
