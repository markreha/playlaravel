<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;

class WhatsMyNameController extends Controller
{
    public function index(Request $request)
    {
         // Usage of path method
        $path = $request->path();
        echo "Path Method: ".$path;
        echo '<br>';

        // Usage of is method
        $method = $request->isMethod('get') ? "GET" : "POST";
        echo "GET or POST Method: ".$method;
        echo '<br>';

        // Usage of url method
        $url = $request->url();
        echo "URL method:".$url;
        echo '<br>';

        // Display the Form Data
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        echo "Your name is: " . $firstName . " " . $lastName;
        echo '<br>';

        // Render a response View and pass the Form Data to it
        $data = ['firstName' => $firstName, 'lastName' => $lastName];
        return view('thatswhoiam')->with($data);
     }
}
