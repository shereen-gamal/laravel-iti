<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $user = new User();
        $users = $user->all();
        $ids =[];
        foreach($users as $item){
            array_push($ids,$item->id);
        }
        return [
            'title' => ['required', 'min:3','unique:App\Models\Post,title'],
            'description' => ['required', 'min:10'],
            'post_creator'=> ['required', Rule::in($ids),]
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
