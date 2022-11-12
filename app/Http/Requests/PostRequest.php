<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'               => 'required',
            'description'         => 'required',
            'photos.*'            => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }

    public function failedValidation( $validator)
    {
        return response()->json([
            'status'       => 400,
            'msg'          => 'validation error',
            'data'         => $validator->errors()->first(),
          ]);
       
    }
}
