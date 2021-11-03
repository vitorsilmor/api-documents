<?php

namespace App\Services\Documents\CreateNewDocument\Base;

use App\Repositories\DocumentRepository;
use App\Repositories\DocumentTypeRepository;
use App\Services\Documents\CreateNewDocument\Builders\DocumentBuilder;
use App\Services\Documents\CreateNewDocument\Contracts\ICreateNewDocumentService;

abstract class CreateNewDocumentBase implements ICreateNewDocumentService
{
    protected DocumentBuilder $documentBuilder;
    protected DocumentTypeRepository $documentTypeRepository;
    protected DocumentRepository $documentRepository;

    public function setDocumentBuilder($documentBuilder): ICreateNewDocumentService
    {
        $this->documentBuilder = $documentBuilder;
        return $this;
    }

    public function setDocumentTypeRepository($documentTypeRepository): ICreateNewDocumentService
    {
        $this->documentTypeRepository = $documentTypeRepository;
        return $this;
    }

    public function setDocumentRepository($documentRepository): ICreateNewDocumentService
    {
        $this->documentRepository = $documentRepository;
        return $this;
    }
}
