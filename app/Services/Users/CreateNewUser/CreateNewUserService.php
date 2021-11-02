<?php

namespace App\Services\Users\CreateNewUser;

use App\Models\User;
use App\Services\Users\CreateNewUser\Base\CreateNewUserBase as ServiceBase;

class CreateNewUserService extends ServiceBase
{
    public function handle(array $data): User
    {
        $companyExists = $this->companyRepository
            ->companyExists($data['company_id']);

        if (!$companyExists) {
            throw new \Exception("Company is not registred");
        }

        $userEmailExists = $this->userRepository
            ->userEmailExists($data['email']);

        if ($userEmailExists) {
            throw new \Exception("User email alredy registred");
        }

        $data['password'] = bcrypt($data['password']);

        return $this->userRepository->createNewUser($data);
    }
}
