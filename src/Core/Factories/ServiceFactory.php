<?php
namespace Core\Factories;

use App\Services\AuthService;

class ServiceFactory
{
    private $repositoryFactory;

    public function __construct(RepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
    }

    public function make(string $name)
    {
        switch ($name)
        {
            case 'Auth':
                return new AuthService($this->repositoryFactory->make('User'));
        }
    }
}