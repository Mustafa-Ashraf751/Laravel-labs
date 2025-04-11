<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class PostRequest extends FormRequest
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
        $postId = $this->route('post');

        return [
            'title' => [
                'required',
                'min:3',
                Rule::unique('posts', 'title')->ignore($postId, 'id')
            ],
            'description' => 'required|min:10',
            //To validate that user can't send any thing as id to the database
            'user_id' => 'required|integer|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048'
        ];
    }

    public function messages(): array
    {

        return [
            'title.required' => 'post title is required',
            'title.min' => 'Your post title must be at least 3 characters',
            'title.unique' => 'This title is already exist',
            'description.required' => 'Description is required',
            'description.min' => 'Your post description must be at least 10 characters',
            'user_id.required' => 'Please select a user',
            'user_id.exists' => 'The selected User does not exist',
            'image.image' => 'The file should be image!',
            'image.mimes' => 'Only jpeg,png,gif is allowed',
            'image.max' => 'The file size must be less than 2 mb'
        ];
    }
}
