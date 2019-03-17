<?php
namespace App\Controllers;

use Core\BaseController;
use Core\Results;

class LoginController extends BaseController
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Shows the login page.
     *
     * @return ViewResult
     */
    public function index()
    {
        return new Results\View('Login/index');
    }

    public function submit()
    {
        if (isset($this->params['email']) &&
            isset($this->params['password']))
        {
            $success = $this->authService->login($this->params['email'], $this->params['password']);
            if (!$success)
            {
                $errors[] = 'Invalid email or password.';
                $result = new Results\View('Login/index');
                $result->assign('errors', $errors);
                return $result;
            }

            return new Results\View('Login/success');            
        }

        return new Results\InternalRedirect('GET', 'login');
    }
}