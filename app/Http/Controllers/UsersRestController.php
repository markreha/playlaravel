<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\DTO;
use App\Services\Business\SecurityService;
use App\Services\Utility\MyLogger2;

class UsersRestController extends Controller
{
    public function index()
    {
        try
        {
            // Call Service to get all users
            $service = new SecurityService();
            $users = $service->getAllUsers();
    
            // Create a DTO
            $dto = new DTO(0, "OK", $users);
    
            // Serialize the DTO to JSON
            $json = json_encode($users);
    
            // Return JSON back to caller
            return $json;            
        }
        catch(Exception $e1)
        {
            // Log exception
            MyLogger2::error("Exception: ", array("message" => $e1->getMessage()));
            
            // Return an error back to the user in the DTO
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }            
    }

    public function show($id)
    {
        try
        {
            // Call Service to get a users
            $service = new SecurityService();
            $user = $service->getUser($id);
    
            // Create a DTO
            if($user == null)
                $dto = new DTO(-1, "User Not Found", "");
            else
                $dto = new DTO(0, "OK", $user);
    
            // Serialize DTO to JSON
            $json = json_encode($dto);
    
            // Return JSON back to caller
            return $json;
        }
        catch(Exception $e1)
        {
            // Log exception
            MyLogger2::error("Exception: ", array("message" => $e1->getMessage()));
            
            // Return an error back to the user in the DTO
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
}
