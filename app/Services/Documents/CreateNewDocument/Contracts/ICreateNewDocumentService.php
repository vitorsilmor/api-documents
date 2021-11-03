<?php

namespace App\Services\Documents\CreateNewDocument\Contracts;

use App\Models\Document;

interface ICreateNewDocumentService
{
    public function handle(array $data): array;
    public function setDocumentBuilder($documentBuilder): ICreateNewDocumentService;
    public function setDocumentTypeRepository($documentTypeRepository): ICreateNewDocumentService;
    public function setDocumentRepository($documentRepository): ICreateNewDocumentService;
    public function setUserRepository($userRepository): ICreateNewDocumentService;
    public function setDocumentParserService($documentParserService): ICreateNewDocumentService;
}
