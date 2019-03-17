<?php
namespace App\Data\Repositories\Interfaces;

interface IUserRepository
{
    public function getAll();
    public function getById(int $id);
    public function getByEmail(string $email);
    public function add(User $user);
    public function update(User $user);
    public function remove(User $user);
}