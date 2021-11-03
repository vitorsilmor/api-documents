<?php

namespace App\Repositories\Contracts;

use App\Repositories\Base\EloquentRepository;
use App\Models\Document;

interface IDocumentRepository
{
    public function createDocument(array $data): Document;
}
