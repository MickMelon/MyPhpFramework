<?php
namespace Framework\App\Controllers;

use Framework\Core\Results;
use Framework\App\Models\DataAccess;

class HomeController 
{
    private $dataAccess;

    public function __construct(DataAccess $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

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
}