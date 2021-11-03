<?php

namespace App\Services\Documents\DocumentParser;

use App\Models\Document;
use App\Services\Documents\DocumentParser\Contracts\IDocumentParserService;

class DocumentParserService implements IDocumentParserService
{
    public function parse(Document $document): array
    {
        return [
            'documentId' => $document->id,
            'userId' => $document->user_id,
            'company' => $document->user->company->name,
            'document' => json_decode($document->document_json)
        ];

        return $document->toArray();
    }
}
