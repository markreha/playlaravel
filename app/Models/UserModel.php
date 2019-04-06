<?php

namespace App\Models;

// REFACTOR: This should be renamed to CredentialModel
class UserModel implements \JsonSerializable
{
    private $id;
    private $username;
    private $password;

    // BEST PRACTICE: Use a non-default constructor for Object Models
    public function __construct($id, $username, $password)
    {
        $this->id = $id;                    
        $this->username = $username;
        $this->password = $password;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    // BEST PRACTICE: Just implement getter (read-only) accessors for Object Models
    public function getUsername()
    {
        return $this->username;
    }

    // BEST PRACTICE: Just implement getter (read-only) accessors for Object Models
    public function getPassword()
    {
        return $this->password;
    }
}

