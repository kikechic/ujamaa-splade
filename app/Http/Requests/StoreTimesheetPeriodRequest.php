<?php

namespace App\Http\Requests;

use App\Rules\TimesheetPeriodExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetPeriodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'period_year' => 'required|date_format:Y',
            'period_month' => 'required|between:1,12',
            'status' => 'required',
            'timesheet_period_exists' => [new TimesheetPeriodExistsRule],
        ];
    }
}
