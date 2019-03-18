<?php
namespace Core\Factories;

use Core\PdoDatabase;
use App\Data\Repositories\UserRepository;

/**
 * Used to create new Repositories.
 */
class RepositoryFactory
{
    /**
     * The Database that all repositories are dependant on.
     *
     * @var PdoDatabase
     */
    private $database;

    /**
     * Initializes a new instance of the RepositoryFactory class.
     *
     * @param PdoDatabase $database The PdoDatabase.
     */
    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }

    /**
     * Creates a new Repository for the given name.
     *
     * @param string $name The name of the repository (excluding 'Repository')
     * @return object The new repository.
     */
    public function make(string $name)
    {
        switch ($name)
        {
            case 'User':
                return new UserRepository($this->database);
        }

        return false;
    }
}