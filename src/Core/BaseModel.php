<?php
namespace Framework\Core;

use PDO;

abstract class BaseModel
{
    public function database() 
    {
        return Database::getInstance();
    }
}