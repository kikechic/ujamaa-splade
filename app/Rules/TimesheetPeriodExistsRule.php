<?php

namespace App\Rules;

use Closure;
use App\Models\TimesheetPeriod;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class TimesheetPeriodExistsRule implements DataAwareRule, ValidationRule
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
        $timesheetPeriod = TimesheetPeriod::query()
            ->where('period_year', $this->data['period_year'])
            ->where('period_month', $this->data['period_month'])
            ->first();

        if ($timesheetPeriod) {
            $fail("This timesheet period already exists.");
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
