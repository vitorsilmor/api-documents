<?php

namespace App\Services\Documents\CreateNewDocument\Entities;

use App\Services\Documents\CreateNewDocument\Contracts\IDocument;

class Document implements IDocument
{
    private int $type;
    private int $user;
    private array $documentInfo;

    public function setType(int $type): Document
    {
        $this->type = $type;
        return $this;
    }

    public function setUser(int $user): Document
    {
        $this->user = $user;
        return $this;
    }

    public function setDocumentInfo(array $documentInfo): Document
    {
        $this->documentInfo = $documentInfo;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user,
            'document_type_id' => $this->type,
            'document_json' => json_encode($this->documentInfo)
        ];
    }
}
