<?php

namespace Tests\Feature\Services\Users\CreateNewUserService;

use App\Models\Document;
use App\Models\DocumentType;
use App\Repositories\DocumentRepository;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\UserRepository;
use App\Services\Documents\CreateNewDocument\Builders\DocumentBuilder;
use App\Services\Documents\CreateNewDocument\CreateNewDocumentService;
use App\Services\Documents\CreateNewDocument\Entities\Document as EntitiesDocument;
use App\Services\Documents\DocumentParser\DocumentParserService;
use Mockery;
use Tests\TestCase;

class CreateNewDocumentServiceTest extends TestCase
{
    public function testShouldReturnANewDocument()
    {
        $documentType = new DocumentType();
        $documentType->id = 1;
        $documentType->name = "test";

        $document = new Document();
        $document->user_id = "1";
        $document->document_type_id = '1';
        $document->document_json = [
            'id' => '455456',
            'name' => 'John Doe',
            'birthday' => '1992-12-10',
            'mother_name' => 'Anna Doe',
            'father_name' => 'Georgie Doe'
        ];

        $dataToCreateDocument = [
            'user_id' => $document->user_id,
            'document_type' => $document->document_type_id,
            'document_details' => $document->document_json
        ];

        $mockedDocumentTypeRepository = $this->getMockedDocumentTypeRepository(
            $dataToCreateDocument,
            $documentType
        );

        $mockedDocumentRepository = $this->getMockedDocumentRepository(
            $document
        );

        $mockedUserRepository = $this->getMockedUserRepository();
        $mockedDocumentParser = $this->getMockedDocumentParserService();

        $documentBuilder = $this->getDocumentBuilder();

        $service = new CreateNewDocumentService();
        $service->setDocumentBuilder($documentBuilder)
            ->setDocumentTypeRepository($mockedDocumentTypeRepository)
            ->setDocumentRepository($mockedDocumentRepository)
            ->setUserRepository($mockedUserRepository)
            ->setDocumentParserService($mockedDocumentParser);

        $document = $service->handle($dataToCreateDocument);

        $this->assertIsArray($document);
    }

    private function getMockedDocumentParserService()
    {
        $mockedDocumentTypeRepository = (object) Mockery::instanceMock(DocumentParserService::class);
        $mockedDocumentTypeRepository
            ->shouldReceive('parse')
            ->andReturn([
                'documentId' => 1,
                'userId' => 1,
                'company' => 'test',
                'document' => [
                    'owner' => 'John Doe',
                    'number' => '123456'
                ]
            ]);

        return $mockedDocumentTypeRepository;
    }

    private function getMockedDocumentTypeRepository($dataToCreateDocument, $documentType = null)
    {
        $mockedDocumentTypeRepository = (object) Mockery::instanceMock(DocumentTypeRepository::class);
        $mockedDocumentTypeRepository
            ->shouldReceive('getDocumentType')
            ->andReturn($documentType);

        return $mockedDocumentTypeRepository;
    }

    private function getDocumentBuilder()
    {
        return new DocumentBuilder(
            new EntitiesDocument
        );
    }


    private function getMockedDocumentRepository($createdDocument)
    {
        $mockedDocumentRepository = (object) Mockery::instanceMock(DocumentRepository::class);
        $mockedDocumentRepository
            ->shouldReceive('createDocument')
            ->andReturn($createdDocument);

        return $mockedDocumentRepository;
    }

    private function getMockedUserRepository()
    {
        $mockedUserRepository = (object) Mockery::instanceMock(UserRepository::class);
        $mockedUserRepository
            ->shouldReceive('getAuthenticatedUserId')
            ->andReturn(1);

        return $mockedUserRepository;
    }
}
