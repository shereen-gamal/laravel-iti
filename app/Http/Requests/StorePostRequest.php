<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:3','unique:App\Models\Post,title'],
            'description' => ['required', 'min:10'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is a requird field',
            'title.min' => 'Title min length is 3 chars',
            'title.unique' => 'Title is already exist',
            'description.required' => 'description is a requird field',
            'description.min' => 'description min length is 10 chars'
        ];
    }
}
