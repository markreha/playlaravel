<?php

namespace App\Services\Data;

use \PDO;
use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use PDOException;

// BAD PRACTICE: This class really should be a User DAO!
class SecurityDAO
{
    private $db = NULL;

    // BEST PRACTICE: Do not create Database Connections in a DAO (so you can support Atomic Database Transactions)
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByUser(UserModel $user)
    {
        Log::info("Entering SecurityDAO.findByUser()");
        
        try
        {
            // Select username and password and see if this row exists
            $name = $user->getUsername();
            $pw = $user->getPassword();
            $stmt = $this->db->prepare('SELECT ID, USERNAME, PASSWORD FROM users WHERE USERNAME = :username AND PASSWORD = :password');
            $stmt->bindParam(':username', $name);
            $stmt->bindParam(':password', $pw);
            $stmt->execute();

            // See if user existed and return true if found else return false if not found
            // BAD PRACTICE: This is a business rules in our DAO!
            if ($stmt->rowCount() == 1)
            {
                Log::info("Exit SecurityDAO.findByUser() with true");
                return true;
            }
            else
            {
                Log::info("Exit SecurityDAO.findByUser() with false");
                return false;
            }
        }
        catch (PDOException $e)
        {
            // BEST PRACTICE: Catch all exceptions (do not swallow exceptions), log the exception, do not throw technology specific exceptions, and throw a custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    public function findByUserID($id)
    {
        try
        {
            // Select by User ID
            $stmt = $this->db->prepare('SELECT ID, USERNAME, PASSWORD FROM users WHERE ID = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // See if user existed and return true if found else return false if not found
            if ($stmt->rowCount() == 0)
            {
                return null;
            }
            else
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new UserModel($row["ID"], $row["USERNAME"], $row["PASSWORD"]);
                return $user;
            }
         }
        catch (PDOException $e)
        {
            // BEST PRACTICE: Catch all exceptions (do not swallow exceptions), log the exception, do not throw technology specific exceptions, and throw a custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    public function findAllUsers()
    {
        try
        {
            // Select all users
            $stmt = $this->db->prepare('SELECT ID, USERNAME, PASSWORD FROM users');
            $stmt->execute();

            // Return an array of UserModels
            if ($stmt->rowCount() == 0)
            {
                return array();
            }
            else
            {
                $index = 0;
                $users = array();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $user = new UserModel($row["ID"], $row["USERNAME"], $row["PASSWORD"]);
                    $users[$index++] = $user;
                }
                return $users;
            }
        }
        catch (PDOException $e)
        {
            // BEST PRACTICE: Catch all exceptions (do not swallow exceptions), log the exception, do not throw technology specific exceptions, and throw a custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}