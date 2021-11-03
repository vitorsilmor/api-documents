<?php

namespace App\Services\Documents\CreateNewDocument\Builders;

use App\Services\Documents\CreateNewDocument\Contracts\IDocumentBuilder;
use App\Services\Documents\CreateNewDocument\Entities\Document;

class DocumentBuilder implements IDocumentBuilder
{
    private Document $documentEntity;

    public function __construct(Document $document)
    {
        $this->documentEntity = $document;
    }

    public function build(int $user, int $type, array $documentDetails): Document
    {
        return $this->documentEntity
            ->setUser($user)
            ->setType($type)
            ->setDocumentInfo($documentDetails);
    }
}
