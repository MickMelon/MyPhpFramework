<?php
namespace Framework\App\Data\Models;

class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $created;
    private $lastModified;

    public function __construct($data)
    {
        $this->id = $data->ID;
    }
}