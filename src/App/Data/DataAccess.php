<?php
namespace Framework\App\Data;

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