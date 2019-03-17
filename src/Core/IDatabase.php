<?php
namespace Core;

interface IDatabase
{
    public function query(string $queryString, array $params = array());
}