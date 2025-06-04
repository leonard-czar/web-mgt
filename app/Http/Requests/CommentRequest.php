<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'content' => 'required|string|min:1|max:1000',
            'project_id' => 'required|exists:projects,id',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Comment content is required.',
            'content.min' => 'Comment cannot be empty.',
            'content.max' => 'Comment cannot exceed 1000 characters.',
            'project_id.required' => 'Project ID is required.',
            'project_id.exists' => 'Selected project does not exist.',
        ];
    }

    public function prepareForValidation()
    {
        // Add employee_id from authenticated user
        $this->merge([
            'user_id' => Auth::id(),
        ]);
    }
}
