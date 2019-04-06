<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\UserModel;
use App\Services\Business\SecurityService;

class Login3Controller extends Controller
{
    public function index(Request $request)
    {
        try
        {            
            // BEST PRACTICE: centralize your rules so you have a consistent architecture and even reuse your rules
            // Validate the Form Data (note will automatically redirect back to Login View if errors)
            $this->validateForm($request);
            
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
                return view('loginPassed3')->with($data);
            }
            else
            {
                return view('loginFailed3');
            }
        }
        catch(ValidationException $e1)
        {
            // NOTE: this exception MUST BE caught before Exception because ValidationException extends from Exception!!!
            // NOTE: you must rethrow this exception in order for Laravel to display your submitted page with errors!!!
            // Catch and rethrow the Data Validation Exception (so we can catch all others in our next exeption catch block)
            throw $e1;
        }
        catch(Exception $e2)
        {
            // Display our Global Exception Handler page
            return view("systemException");
        }
     }

    private function validateForm(Request $request)
    {
        // BEST PRACTICE: centralize your rules so you have a consistent architecture and even reuse your rules
        // BAD PRACTICE: not using a defined Data Validation Framework, putting rules all over your code, doing only on Client Side or Database
        // Setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between:4,10 | Alpha',
                  'password' => 'Required | Between:4,10'];

        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
