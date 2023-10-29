<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasOfficeTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use App\Traits\HasDepartmentTrait;
use App\Traits\HasDesignationTrait;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
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
        'employee_number',
        'first_name',
        'middle_name',
        'last_name',
        'department_id',
        'designation_id',
        'office_id',
        'start_date',
        'inactive_date',
        'status',
        'email',
    ];

    public function displayName(): Attribute
    {
        return Attribute::make(fn () => "$this->employee_number ~ $this->first_name $this->middle_name $this->last_name");
    }

    public function fullName(): Attribute
    {
        return Attribute::make(fn () => "$this->first_name $this->middle_name $this->last_name");
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }
}
