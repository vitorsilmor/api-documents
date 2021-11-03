<?php

namespace App\Services\Documents\CreateNewDocument\Contracts;

use App\Services\Documents\CreateNewDocument\Entities\Document;

interface IDocumentBuilder
{
    public function build(int $user, int $type, array $documentDetails): Document;
}
