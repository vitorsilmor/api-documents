<?php

namespace App\Services\Documents\CreateNewDocument\Contracts;

use App\Models\Document;

interface ICreateNewDocumentService
{
    public function handle(array $data): Document;
    public function setDocumentBuilder($documentBuilder): ICreateNewDocumentService;
    public function setDocumentTypeRepository($documentTypeRepository): ICreateNewDocumentService;
    public function setDocumentRepository($documentRepository): ICreateNewDocumentService;
}
