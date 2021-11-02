<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Base\EloquentRepository;
use App\Repositories\Contracts\IUserRepository as Repository;

class UserRepository extends EloquentRepository implements Repository
{
    public function createNewUser(array $data): User
    {
        return $this->create($data);
    }

    public function findUser(int $id): User
    {
        return $this->get($id);
    }

    public function userEmailExists(string $email): bool
    {
        $user = $this->getOneWhere([
            'email' => $email
        ]);

        if (!isset($user->id))
            return false;

        return true;
    }
}
