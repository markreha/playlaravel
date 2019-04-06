<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Models\UserModel;
use App\Services\Business\SecurityService;

class Login2Controller extends Controller
{
    public function index(Request $request)
    {
        try
        {
            // Get the posted Form Data
            $username = $request->input('username');
            $password = $request->input('password');
 
            // Save posted Form Data in User Object Model
            $user = new UserModel(-1, $username, $password);

            // Call Security Business Service
            $service = new SecurityService();
            $status = $service->login($user);

            // Render a failed or success response View and pass the User Mdoel to it
            if($status)
            {
                $data = ['model' => $user];
                return view('loginPassed2')->with($data);
            }
            else
            {
                return view('loginFailed2');
            }
        }
        catch(Exception $e2)
        {
            // Display our Global Exception Handler page
            return view("systemException");
        }
     }
}
