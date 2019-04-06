<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\UserModel;
use App\Services\Business\SecurityService;
use App\Services\Utility\MyLogger2;

class Login5Controller extends Controller
{
     public function index(Request $request)
    {
        MyLogger2::info("Entering Login5Controller.index()");

        try
        {
            // Get the posted Form Data
            $username = $request->input('username');
            $password = $request->input('password');
            MyLogger2::info("  Parameters: ", array("username" => $username, "password" => $password));

           // Validate the Form Data (note will automatically redirect back to Login View if errors)
            $this->validateForm($request);

            // Save posted Form Data in User Object Model
            $user = new UserModel(-1, $username, $password);

            // Call Security Business Service
            $service = new SecurityService();
            $status = $service->login($user);

            // Render a failed or success response View and pass the User Mdoel to it
            if($status)
            {
                MyLogger2::info("Exit Login5Controller.index() with login passed");
                $Data = ['model' => $user];
                return view('loginPassed5')->with($Data);
            }
            else
            {
                MyLogger2::info("Exit Login5Controller.index() with login failed");
                return view('loginFailed5');
            }
        }
        catch(ValidationException $e1)
        {
            // Catch and rethrow the Data Validation Exception (so we can catch all others in next catch block)
            throw $e1;
        }
        catch(Exception $e2)
        {
            // Log exception
            MyLogger2::error("Exception: ", array("message" => $e2->getMessage()));

            // Display our Global Exception Handler page
            return view("systemException");
        }
     }

    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between:4,10 | Alpha',
                  'password' => 'Required | Between:4,10'];

        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
