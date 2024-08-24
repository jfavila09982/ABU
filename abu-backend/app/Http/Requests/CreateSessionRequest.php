<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSessionRequest extends FormRequest
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
            'setUserName' => 'required|string|max:255',
        ];
    }

     /**
     * Customize the error messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'setUserName.required' => 'The username field is required.',
            'setUserName.string' => 'The username must be a string.',
            'setUserName.max' => 'The username may not be greater than 255 characters.',
        ];
    }




}
