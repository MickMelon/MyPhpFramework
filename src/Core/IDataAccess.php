<?php
namespace Core;

interface IDataAccess
{
    public static function getInstance();
    public function users();
}