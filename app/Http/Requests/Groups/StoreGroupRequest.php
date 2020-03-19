<?php

namespace App\Http\Requests\Groups;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'contacts' => 'nullable|array',
            'contacts.*' => 'integer|exists:contacts,id,user_id,'.Auth::user()->id
        ];
    }
}
