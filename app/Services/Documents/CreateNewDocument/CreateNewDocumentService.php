<?php

namespace App\Services\Documents\CreateNewDocument;

use App\Models\Document;
use App\Services\Documents\CreateNewDocument\Base\CreateNewDocumentBase;

class CreateNewDocumentService extends CreateNewDocumentBase
{
    public function handle(array $data): Document
    {
        $documentType = $this->documentTypeRepository->getDocumentType(
            $data['document_type']
        );

        if (is_null($documentType)) {
            $documentType = $this->documentTypeRepository->createDocumentType([
                'name' => $data['document_type']
            ]);
        }

        $documentBuilded = $this->documentBuilder->build(
            $data['user_id'],
            $documentType->id,
            $data['document_details']
        );

        return $this->documentRepository->createDocument(
            $documentBuilded->toArray()
        );
    }
}
