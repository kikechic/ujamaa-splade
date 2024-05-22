<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'employee_number' => 'required|max:255',
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'department_id' => 'required',
            'designation_id' => 'nullable',
            'office_id' => 'nullable',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:inactive_date',
            'inactive_date' => 'nullable|required_if:status,0|date_format:Y-m-d',
            'status' => 'required',
            'email' => 'nullable|email',
        ];
    }
}
