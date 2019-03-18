<?php
namespace Core\Factories;

use App\Controllers\HomeController;
use App\Controllers\LoginController;

/**
 * Used to create new controllers.
 */
class ControllerFactory
{
    /**
     * The Service Factory.
     *
     * @var ServiceFactory
     */
    private $serviceFactory;

    /**
     * Initializes a new instance of the ControllerFactory class.
     *
     * @param ServiceFactory $serviceFactory The Service Factory.
     */
    public function __construct(ServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * Creates a new Controller for the given name.
     *
     * @param string $name The name of the controller. (excluding 'Controller')
     * @return object The new controller.
     */
    public function make(string $name)
    {
        switch ($name)
        {
            case 'Home':
                return new HomeController();

            case 'Login':
                return new LoginController($this->serviceFactory->make('Auth'));
        }

        return false;
    }
}