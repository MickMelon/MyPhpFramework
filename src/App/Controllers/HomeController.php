<?php
namespace App\Controllers;

use Core\Results;
use Core\BaseController;

use Core\Util\Identity;
use Core\Util\Session;

use App\Data\Repositories\UserRepository;

/**
 * Undocumented class
 */
class HomeController extends BaseController
{
    /**
     * Displays the home page.
     *
     * @return IActionResult
     */
    public function home()
    {
        echo '*home';
        $result = new Results\ViewResult('Pages/home');
        $result->assign('pageTitle', 'Home Page');
        $result->assign('test', 'Just a test');
        return $result;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test()
    {
        echo '*test*';
        $user = $this->dataAccess->users()->getById(1);
        $result = new Results\ViewResult('Pages/test');
        $result->assign('user', $user);
        return $result;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function paramstest()
    {
        if (isset($this->params['test'])) echo 'tefgst1';
        $result = new Results\ViewResult('Pages/paramstest');
        $result->assign('test', $this->params['test']);
        return $result;
    }

    public function lol()
    {
        Session::set('user', 1);
        if (Identity::isLoggedIn())
        {
            return new Results\TextResult('Yes');
        }
        else
        {
            return new Results\TextResult('No');
        }
    }
}