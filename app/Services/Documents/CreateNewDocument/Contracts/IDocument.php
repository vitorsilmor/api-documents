<?php

namespace App\Services\Documents\CreateNewDocument\Contracts;

interface IDocument
{
    public function setType(int $type): IDocument;
    public function setUser(int $user): IDocument;
    public function setDocumentInfo(array $documentInfo): IDocument;
    public function toArray(): array;
}
