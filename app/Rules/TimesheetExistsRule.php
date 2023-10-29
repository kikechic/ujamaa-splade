<?php

namespace App\Rules;

use Closure;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Enums\TimesheetStatusEnum;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class TimesheetExistsRule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!data_get($this->data, 'timesheet_period_id')) {
            $fail('A timesheet check can only occur if a timesheet period is specified.');
            return;
        }

        $employee = Employee::query()->where('id', auth()->user()->approval->employee_id)->first();

        if (!$employee) {
            $fail("An employee must be assigned to the current user");
            return;
        }

        $timesheet = Timesheet::query()
            ->where('timesheet_period_id', $this->data['timesheet_period_id'])
            ->where('employee_id', $employee->id)
            ->whereIn('status', [
                TimesheetStatusEnum::open(),
                TimesheetStatusEnum::pending(),
                TimesheetStatusEnum::approved(),
                TimesheetStatusEnum::pending(),
            ])
            ->first();

        if ($timesheet) {
            $fail("A timesheet for this period exists. Check $timesheet->timesheet_number.");
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
}
