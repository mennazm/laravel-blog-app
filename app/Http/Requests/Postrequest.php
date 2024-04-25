<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Post;

class Postrequest extends FormRequest
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
            'title' => [
                'required',
                 Rule::unique('posts')->ignore($this ->post),
                'min:3'
            ],
            'body' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,png|max:2048'
        ];
    }

    public function messages(): array
{
    return [
        'title.required' => ' title field is required',
        'body.required' => ' body field is required',
    ];
}
}
