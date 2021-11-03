<?php

namespace App\Services\Documents\DocumentParser\Contracts;

use App\Models\Document;

interface IDocumentParserService
{
    public function parse(Document $document): array;
}
