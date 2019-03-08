<?php
namespace Framework\App\Models;

class DataAccess
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function users()
    {
        return $this->userModel;
    }
}