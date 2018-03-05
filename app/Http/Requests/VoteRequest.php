<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Poll;

class VoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $poll = $this->route('poll');
        return $poll && $poll->status == 1 && $this->user()->can('vote', $poll);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vote' => 'required|integer|min:1|max:2'
        ];
    }
}
