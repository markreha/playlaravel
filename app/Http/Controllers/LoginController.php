<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class LoginController extends Controller
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
                return view('loginPassed')->with($data);
            }
            else
            {
                return view('loginFailed');
            }
        }
        catch(Exception $e)
        {
            // BEST PRACTICE: Catch all exceptions, log the exception, and display a common Error Page (or use a Global Exception Handler)
            // Log exception and display Exception View
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
        
}
