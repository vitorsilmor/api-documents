<?php

namespace App\Providers;

use App\Models\Document as ModelsDocument;
use App\Models\DocumentType;
use App\Models\User;
use App\Repositories\DocumentRepository;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\UserRepository;
use App\Services\Documents\CreateNewDocument\Builders\DocumentBuilder;
use App\Services\Documents\CreateNewDocument\Contracts\ICreateNewDocumentService;
use App\Services\Documents\CreateNewDocument\CreateNewDocumentService;
use App\Services\Documents\CreateNewDocument\Entities\Document;
use App\Services\Documents\DocumentParser\DocumentParserService;
use Illuminate\Support\ServiceProvider;

class CreateDocumentProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ICreateNewDocumentService::class, function ($app) {
            $builder = new DocumentBuilder(new Document);
            $documentTypeRepository = new DocumentTypeRepository(new DocumentType());
            $documentRepository = new DocumentRepository(new ModelsDocument());
            $userRepository = new UserRepository(new User());
            $documetParserService = new DocumentParserService();

            $service = new CreateNewDocumentService();

            $service->setDocumentBuilder($builder)
                ->setDocumentRepository($documentRepository)
                ->setDocumentTypeRepository($documentTypeRepository)
                ->setUserRepository($userRepository)
                ->setDocumentParserService($documetParserService);

            return $service;
        });
    }
}
