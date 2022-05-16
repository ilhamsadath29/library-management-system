<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'site_id' => 'required|exists:settings,id',
            'name'    => [
                'required', 'string','max:255', 
                Rule::unique("categories", "name")->where(
                    function ($query) {
                        return $query->where(
                            [
                                ["site_id", "=", $this->site_id],
                            ]
                        );
                    }
                )->ignore($this->id)
            ],
            'status' => 'integer|digits_between: 0,9',
        ];
    }
}
