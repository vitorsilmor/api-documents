<?php

namespace App\Repositories;

use App\Repositories\Base\EloquentRepository;
use App\Models\Document;
use App\Repositories\Contracts\IDocumentRepository as Repository;

class DocumentRepository extends EloquentRepository implements Repository
{
    public function createDocument(array $data): Document
    {
        return $this->create($data);
    }
}
