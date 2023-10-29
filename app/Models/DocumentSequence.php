<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentSequence extends Model
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        HasCompanyTrait,
        CompanyScopeTrait,
        SoftDeletes;

    protected $fillable = [
        'prefix',
        'document_code',
        'sequence_number',
    ];

    public function scopeDocumentCode($query, string $value)
    {
        return $query->where('document_code', $value);
    }
}
