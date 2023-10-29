<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Approval extends Model
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        HasCompanyTrait,
        CompanyScopeTrait,
        SoftDeletes;

    protected $fillable = [
        'approver_id',
        'approval_user_id',
        'substitute_id',
        'employee_id',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function substitute(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function approvalUser(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
