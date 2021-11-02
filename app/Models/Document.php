<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type_id', 'document_json', 'user_id'
    ];

    public function type()
    {
        $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
