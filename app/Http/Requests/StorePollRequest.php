<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePollRequest extends FormRequest
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
            'title' => 'required',
            'description' => '',
            'button_one' => 'required',
            'button_two' => 'required',
            'answer' => 'nullable|in:1,2',
            'status' => '',
            'img' => 'required|image'
        ];
    }
}
