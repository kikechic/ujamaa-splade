<?php

namespace App\Models;

use App\Enums\MonthsEnum;
use App\Traits\HasUserTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TimesheetPeriodStatusEnum;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimesheetPeriod extends Model
{
    use HasFactory, HasUserTrait, HasUpdaterTrait, HasCompanyTrait, CompanyScopeTrait;

    protected $fillable = [
        'period_year',
        'period_month',
        'status',
    ];

    protected $casts = [
        'period_month' => MonthsEnum::class,
        'status' => TimesheetPeriodStatusEnum::class,
    ];

    public function monthName(): Attribute
    {
        return Attribute::make(function () {
            return $this->period_month?->name;
        });
    }

    public function isOpen(): bool
    {
        return $this->status->value === TimesheetPeriodStatusEnum::open();
    }

    public function isClosed(): bool
    {
        return $this->status->value === TimesheetPeriodStatusEnum::closed();
    }

    public function displayName(): Attribute
    {
        return Attribute::make(fn () => "$this->period_year {$this->period_month?->name}");
    }
}
