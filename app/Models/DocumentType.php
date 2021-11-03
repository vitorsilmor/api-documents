<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function documents()
    {
        $this->hasMany(Document::class, 'document_type_id');
    }
}
