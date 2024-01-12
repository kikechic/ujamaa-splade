<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasOfficeTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use App\Enums\TimesheetStatusEnum;
use App\Traits\HasDepartmentTrait;
use App\Traits\HasDesignationTrait;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        HasDepartmentTrait,
        HasDesignationTrait,
        HasOfficeTrait,
        HasCompanyTrait,
        CompanyScopeTrait,
        PowerJoins,
        SoftDeletes;

    protected $fillable = [
        'timesheet_period_id',
        'submission_date',
        'timesheet_number',
        'office_id',
        'employee_id',
        'designation_id',
        'department_id',
        'submission_date',
        'status',
    ];

    protected $casts = [
        'status' => TimesheetStatusEnum::class,
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

    public function timesheetPeriod(): BelongsTo
    {
        return $this->belongsTo(TimesheetPeriod::class)->withDefault();
    }

    public function timesheetEntries(): HasMany
    {
        return $this->hasMany(TimesheetEntry::class);
    }

    public function timesheetComments(): HasMany
    {
        return $this->hasMany(TimesheetComment::class);
    }

    public function timesheetApproval(): HasOne
    {
        return $this->hasOne(TimesheetApproval::class)->withDefault();
    }

    public function approvalRequest(): HasOne
    {
        return $this->hasOne(ApprovalRequest::class)->withDefault();
    }

    public function isOpen(): bool
    {
        return $this->status->value === TimesheetStatusEnum::open();
    }

    public function isPending(): bool
    {
        return $this->status->value === TimesheetStatusEnum::pending();
    }

    public function isApproved(): bool
    {
        return $this->status->value === TimesheetStatusEnum::approved();
    }

    public function isRejected(): bool
    {
        return $this->status->value === TimesheetStatusEnum::rejected();
    }

    public function isPosted(): bool
    {
        return $this->status->value === TimesheetStatusEnum::posted();
    }
}
