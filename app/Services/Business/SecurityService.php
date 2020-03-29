<?php

namespace App\Services\Business;

use \PDO;
use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Data\SecurityDAO;

class SecurityService
{
    // REFACTOR: This should be renamed to authenticate()
    public function login(UserModel $user)
    {
        Log::info("Entering SecurityService.login()");
        
        // BEST PRACTICE: Externalize your application configuration
        // Get credentials for accessing the database
        // REFACTOR: The initialization code is repeated in all the business methods
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        // BEST  PRACTICE: Do not create Database Connections in a DAO (so you can support Atomic Database Transactions)
        // Create connection
        $db= new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create a Security Service DAO with this connection and try to find the passwed in User.
        $service = new SecurityDAO($db);
        $flag = $service->findByUser($user);
        
        // In PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        
        // Return the finder results
        Log::info("Exit SecurityService.login() with " . $flag);
        return $flag;
     }

    public function getUser($id)
    {
        // Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");

        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $service = new SecurityDAO($conn);
        return $service->findByUserID($id);
    }

    public function getAllUsers()
    {
        // Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");

        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $service = new SecurityDAO($conn);
        return $service->findAllUsers();
    }
}
