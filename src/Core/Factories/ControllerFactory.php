<?php
namespace Core\Factories;

use App\Controllers\HomeController;
use App\Controllers\LoginController;

/**
 * Used to create new controllers.
 */
class ControllerFactory
{
    private $serviceFactory;

    public function __construct(ServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    public function make(string $name)
    {
        switch ($name)
        {
            case 'Home':
                return new HomeController();

            case 'Login':
                return new LoginController($this->serviceFactory->make('Auth'));
        }
    }
}