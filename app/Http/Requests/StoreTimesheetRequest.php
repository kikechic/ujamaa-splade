<?php

namespace App\Http\Requests;

use App\Rules\TimesheetExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
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
            'hours' => 'array',
            'donor_ids' => 'array',
            'timesheet_period_id' => 'required',
            'submission_date' => 'required|date_format:Y-m-d',
            'timesheet_exists' => [new TimesheetExistsRule],
        ];
    }
}
