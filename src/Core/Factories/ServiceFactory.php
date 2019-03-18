<?php
namespace Core\Factories;

use App\Services\AuthService;

/**
 * Used to create the services.
 */
class ServiceFactory
{
    /**
     * The Repository Factory.
     *
     * @var RepositoryFactory
     */
    private $repositoryFactory;

    /**
     * Initializes a new instance of the ServiceFactory class.
     *
     * @param RepositoryFactory $repositoryFactory The Repository Factory.
     */
    public function __construct(RepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
    }

    /**
     * Makes a Service for the given name.
     *
     * @param string $name The name of the service (excluding the word 'Service')
     * @return object The Service.
     */
    public function make(string $name)
    {
        switch ($name)
        {
            case 'Auth':
                return new AuthService($this->repositoryFactory->make('User'));
        }

        return false;
    }
}