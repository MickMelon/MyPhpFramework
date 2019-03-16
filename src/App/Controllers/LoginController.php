<?php
namespace App\Controllers;

use Core\BaseController;
use Core\Results;

class LoginController extends BaseController
{
    /**
     * Shows the login page.
     *
     * @return ViewResult
     */
    public function index()
    {
        return new Results\ViewResult('Login/index');
    }

    public function submit()
    {
        if (isset($this->params['email']) &&
            isset($this->params['password']))
        {
            $success = Identity::login($this->params['email'], $this->params['password']);
            if (!$success)
            {
                $errors[] = 'Invalid email or password.';
                $result = new Results\ViewResult('Login/index');
                $result->assign('errors', $errors);
                return $result;
            }

            return new Results\ViewResult('Login/success');            
        }

        return new Results\InternalRedirectResult('GET', 'login');
    }
}