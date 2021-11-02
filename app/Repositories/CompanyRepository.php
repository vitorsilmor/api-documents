<?php

namespace App\Repositories;

use App\Repositories\Base\EloquentRepository;
use App\Repositories\Contracts\ICompanyRepository as Repository;

class CompanyRepository extends EloquentRepository implements Repository
{
    public function companyExists(int $id): bool
    {
        $company = $this->get($id);

        if (!isset($company->id))
            return false;

        return true;
    }
}
