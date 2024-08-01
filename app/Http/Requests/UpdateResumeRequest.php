<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'resume' => 'nullable|file|mimes:pdf|max:20480', // Allow PDF files up to 20MB
            'description' => 'required|string',
            'summary_heading' => 'required|string|max:255',
            'summary_title' => 'required|string|max:255',
            'summary_content' => 'required|string',
            'education_heading' => 'required|string|max:255',
            'experience_heading' => 'required|string|max:255',
        ];
    }
}
