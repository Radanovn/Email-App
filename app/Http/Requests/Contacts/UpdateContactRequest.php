<?php

namespace App\Http\Requests\Contacts;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:contacts,email,'. $this->route('contact')->id .',id,user_id,'.Auth::user()->id
        ];
    }
}
