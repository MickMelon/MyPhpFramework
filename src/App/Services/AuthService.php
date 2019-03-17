<?php
namespace App\Services;

use Core\Util\Session;
use App\Data\Repositories\Interfaces\IUserRepository;

class AuthService
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password)
    {
        $user = $this->userRepository->getByEmail($email);
        if ($user && Password::verify($password, $user->Password))
        {
            Session::set('User', $user);
            return true;
        }

        return false;
    }

    public function register(string $firstName, string $lastName, string $gender, string $email,
        string $password, string $cmgRating, string $handicap, string $created, string $lastModified)
    {
        $existingUser = $this->userRepository->getbyEmail($email);
        if (!$existingUser)
        {
            $user = new User(-1, $firstName, $lastName, $gender, $email, $password, $cmgRating,
                $handicap, $created, $lastModified);

            $this->userRepository->add($user);
            return true;
        }

        return false;
    }

    public function isLoggedIn()
    {
        return Session::exists('User');
    }
}