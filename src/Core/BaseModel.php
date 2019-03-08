<?php
namespace Framework\Core;

use PDO;

abstract class BaseModel
{
    public function query($query, $params = array()) 
    {
        return Database::query($query, $params);
    }
}