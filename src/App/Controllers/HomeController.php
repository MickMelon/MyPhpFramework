<?php
namespace Framework\App\Controllers;

use Framework\Core\Results;
use Framework\Core\BaseController;
use Framework\App\Data\Repositories\UserRepository;

class HomeController extends BaseController
{
    public function home()
    {
        echo '*home';
        $result = new Results\ViewResult('Pages/home');
        $result->assign('pageTitle', 'Home Page');
        $result->assign('test', 'Just a test');
        return $result;
    }

    public function test()
    {
        echo '*test*';
        $user = $this->dataAccess->users()->getById(1);
        $result = new Results\ViewResult('Pages/test');
        $result->assign('user', $user);
        return $result;
    }

    public function paramstest()
    {
        if (isset($this->params['test'])) echo 'tefgst1';
        $result = new Results\ViewResult('Pages/paramstest');
        $result->assign('test', $this->params['test']);
        return $result;
    }
}