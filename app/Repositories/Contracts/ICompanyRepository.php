<?php

namespace App\Repositories\Contracts;

interface ICompanyRepository
{
    public function companyExists(int $id): bool;
}
