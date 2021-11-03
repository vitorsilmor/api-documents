<?php

namespace App\Services\Documents\CreateNewDocument;

use App\Models\Document;
use App\Services\Documents\CreateNewDocument\Base\CreateNewDocumentBase;

class CreateNewDocumentService extends CreateNewDocumentBase
{
    public function handle(array $data): array
    {
        $documentType = $this->documentTypeRepository->getDocumentType(
            $data['document_type']
        );

        if (is_null($documentType)) {
            $documentType = $this->documentTypeRepository->createDocumentType([
                'name' => $data['document_type']
            ]);
        }

        $userId = $this->userRepository->getAuthenticatedUserId();

        $documentBuilded = $this->documentBuilder->build(
            $userId,
            $documentType->id,
            $data['document_details']
        );

        $document = $this->documentRepository->createDocument(
            $documentBuilded->toArray()
        );

        return $this->documentParserService
            ->parse($document);
    }
}
