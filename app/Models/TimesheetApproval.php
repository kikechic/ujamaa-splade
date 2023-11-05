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

class TimesheetApproval extends Model
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        // HasCompanyTrait,
        // CompanyScopeTrait,
        SoftDeletes;

    protected $fillable = [
        'approval_date',
        'timesheet_id',
    ];

    public function timesheet(): BelongsTo
    {
        return $this->belongsTo(Timesheet::class)->withDefault();
    }
}
