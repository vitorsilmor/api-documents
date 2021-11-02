<?php

namespace App\Services\Users\CreateNewUser\Base;

use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;

class CreateNewUserBase
{
    protected UserRepository $userRepository;
    protected CompanyRepository $companyRepository;

    public function setUserRepository(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        return $this;
    }

    public function setCompanyRepository(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        return $this;
    }
}
