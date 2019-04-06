<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RestClientController extends Controller
{
    public function index(Request $request)
    {
        // Call Rest API
        $serviceURL = "http://localhost:8888/playlaravel2/";
        $api = "usersrest";
        $param = "";
        $uri = $api . "/" . $param;
        try
        {
            // Make REST call
            $client = new Client(['base_uri' => $serviceURL]);
            $response = $client->request('GET', $uri);   
            
            // Return JSON or Error
            if($response->getStatusCode() == 200)
                return $response->getBody();
            else
                return "There was an error: " . $response->getStatusCode();
        }
        catch(ClientException $e)
        {
            // Return an error
            return "There was an exception: " . $e->getMessage();
        }
     }
}
