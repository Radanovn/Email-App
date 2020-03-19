<?php

namespace App\Http\Requests\Groups;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class composer require maatwebsite/excelAddContactsRequest extends FormRequest
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
            'group' => 'required|integer|exists:groups,id,user_id,'.Auth::user()->id,
            'contacts' => 'required|array',
            'contacts.*' => 'integer|exists:contacts,id,user_id,'.Auth::user()->id
        ];
    }
}
