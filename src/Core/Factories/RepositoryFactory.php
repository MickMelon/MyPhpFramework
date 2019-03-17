<?php
namespace Core\Factories;

use Core\PdoDatabase;
use App\Data\Repositories\UserRepository;

class RepositoryFactory
{
    private $database;

    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }

    public function make(string $name)
    {
        switch ($name)
        {
            case 'User':
                return new UserRepository($this->database);
        }
    }
}