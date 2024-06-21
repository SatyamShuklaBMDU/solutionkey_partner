<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|string',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Task name is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
        ];
    }
}
