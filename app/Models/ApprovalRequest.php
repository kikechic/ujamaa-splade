<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalRequest extends Model
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        HasCompanyTrait,
        CompanyScopeTrait,
        SoftDeletes;

    protected $fillable = [
        'documentable_id',
        'documentable_code',
        'documentable_type',
        'requester_id',
        'approver_id',
        'status',
    ];

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
