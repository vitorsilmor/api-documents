<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface IUserRepository
{
    public function createNewUser(array $data): User;
    public function findUser(int $id): User;
    public function userEmailExists(string $email): bool;
}
