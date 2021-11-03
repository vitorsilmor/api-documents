<?php

namespace App\Services\Documents\CreateNewDocument\Base;

use App\Repositories\DocumentRepository;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\UserRepository;
use App\Services\Documents\CreateNewDocument\Builders\DocumentBuilder;
use App\Services\Documents\CreateNewDocument\Contracts\ICreateNewDocumentService;
use App\Services\Documents\DocumentParser\DocumentParserService;

abstract class CreateNewDocumentBase implements ICreateNewDocumentService
{
    protected UserRepository $userRepository;
    protected DocumentBuilder $documentBuilder;
    protected DocumentTypeRepository $documentTypeRepository;
    protected DocumentRepository $documentRepository;
    protected DocumentParserService $documentParserService;

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

    public function setUserRepository($userRepository): ICreateNewDocumentService
    {
        $this->userRepository = $userRepository;
        return $this;
    }

    public function setDocumentParserService($documentParserService): ICreateNewDocumentService
    {
        $this->documentParserService = $documentParserService;
        return $this;
    }
}
