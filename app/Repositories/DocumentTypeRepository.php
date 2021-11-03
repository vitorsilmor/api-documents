<?php

namespace App\Repositories;

use App\Models\DocumentType;
use App\Repositories\Base\EloquentRepository;
use App\Repositories\Contracts\IDocumentTypeRepository;

class DocumentTypeRepository extends EloquentRepository implements IDocumentTypeRepository
{
    public function getDocumentType(string $type): ?DocumentType
    {
        $documentType = $this->getOneWhere([
            'name' => $type
        ]);

        if (!isset($documentType->id))
            return null;

        return $documentType;
    }

    public function createDocumentType(array $data): DocumentType
    {
        return $this->create($data);
    }
}
