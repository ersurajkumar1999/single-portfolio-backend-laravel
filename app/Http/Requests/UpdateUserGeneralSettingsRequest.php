<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserGeneralSettingsRequest extends FormRequest
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
            'header_title' => 'required|string|max:255',
            'header_description' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            // 'nav_items' => 'required|json',
            'employment_type' => 'nullable|in:Full-time,Part-time,Self-employed,Freelance,Internship,Trainee',
            // 'is_freelancer' => 'required|boolean',
            'hourly_rate_min' => 'nullable|numeric|min:0',
            'hourly_rate_max' => 'nullable|numeric|min:0|gte:hourly_rate_min',
            'currency_type' => 'required|string|max:3',
            'contact_title' => 'required|string|max:255',
            'contact_description' => 'required|string|max:255',
            'number1' => 'required|string|max:20',
            'number2' => 'nullable|string|max:20',
            'email1' => 'required|string|email|max:255',
            'email2' => 'nullable|string|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'copyright_description' => 'required|string',
            'theme_color' => 'required|string|max:50',
        ];
    }

    // Custom messages for validation errors (optional)
    public function messages()
    {
        return [
            'header_title.required' => 'The header title field is required.',
            'header_description.required' => 'The header description field is required.',
            'banner_image.image' => 'The banner image must be an image.',
            'banner_image.mimes' => 'The banner image must be a file of type: jpeg, png, jpg.',
            'banner_image.max' => 'The banner image may not be greater than 10240 kilobytes.',
            'nav_items.required' => 'The nav items field is required.',
            'nav_items.json' => 'The nav items field must be a valid JSON string.',
            'employment_type.in' => 'The selected employment type is invalid.',
            'is_freelancer.required' => 'The is freelancer field is required.',
            'hourly_rate_min.numeric' => 'The hourly rate min must be a number.',
            'hourly_rate_max.numeric' => 'The hourly rate max must be a number.',
            'hourly_rate_max.gte' => 'The hourly rate max must be greater than or equal to the hourly rate min.',
            'currency_type.required' => 'The currency type field is required.',
            'contact_title.required' => 'The contact title field is required.',
            'contact_description.required' => 'The contact description field is required.',
            'number1.required' => 'The number 1 field is required.',
            'email1.required' => 'The email 1 field is required.',
            'email1.email' => 'The email 1 must be a valid email address.',
            'address.required' => 'The address field is required.',
            'city.required' => 'The city field is required.',
            'state.required' => 'The state field is required.',
            'country.required' => 'The country field is required.',
            'copyright_description.required' => 'The copyright description field is required.',
            'theme_color.required' => 'The theme color field is required.',
        ];
    }
}
