<?php

namespace App\Http\Requests;

use App\Rules\TimesheetExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetEntryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'timesheet_period_id' => 'required',
            'timesheet_exists' => [new TimesheetExistsRule],
        ];
    }
}
