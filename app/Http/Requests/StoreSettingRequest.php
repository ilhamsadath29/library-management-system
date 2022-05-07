<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'lib_name'                      => 'required|string|max:200|unique:settings',
            'lib_address'                   => 'required|string|max:255',
            'lib_contact_number'            => 'required|string|max:30',
            'lib_total_book_issue_day'      => 'required|integer|max:512',
            'lib_one_day_fine'              => 'required|numeric|between:0,99.99',
            'lib_issue_total_book_per_user' => 'required|integer|max:64',
            'lib_currency'                  => 'required|string|max:30',
            'lib_timezone'                  => 'required|string|max:100',
            'status'                        => 'integer|digits_between: 0,9',
        ];
    }
}
