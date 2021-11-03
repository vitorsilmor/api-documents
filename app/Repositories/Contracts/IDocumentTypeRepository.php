<?php

namespace App\Repositories\Contracts;

use App\Models\DocumentType;

interface IDocumentTypeRepository
{
    public function getDocumentType(string $type): ?DocumentType;
    public function createDocumentType(array $data): DocumentType;
}
