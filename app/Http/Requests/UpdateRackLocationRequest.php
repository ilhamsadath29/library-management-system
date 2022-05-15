<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRackLocationRequest extends FormRequest
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
            'site_id'     => 'required|exists:settings,id',
            'name'        => 'required|string|max:255|unique:App\Models\RackLocation,name,site_id',
            'status'      => 'integer|digits_between: 0,9',
        ];
    }
}
