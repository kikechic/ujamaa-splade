<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveTimesheetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'approval_date' => 'nullable|required_if:approve,1|date_format:Y-m-d',
            'approve' => 'nullable',
            'reject' => 'nullable',
            'return' => 'nullable',
            'comment' => 'nullable|required_if:return,1|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required_if' => 'The :attribute field is required when returning a timesheet.',
            'approval_date.required_if' => 'The :attribute field is required when approving a timesheet.',
        ];
    }
}
