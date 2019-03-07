<?php
namespace Framework\App\Controllers;

use Framework\Core\Results;
use Framework\App\Models;

class HomeController 
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new Models\UserModel();
    }

    public function home()
    {
        $result = new Results\ViewResult('Pages/home');
        $result->assign('pageTitle', 'Home Page');
        $result->assign('test', 'Just a test');
        return $result;
    }

    public function test()
    {
        $users = $this->userModel->getAllUsers();
        $result = new Results\ViewResult('Pages/test');
        $result->assign('users', $users);
        return $result;
    }
}