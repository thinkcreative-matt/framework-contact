<?php

namespace Thinkcreative\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
            'companyname' => 'required',
            'address' => 'array|nullable',
            'number' => 'numeric|nullable',
            'email' => 'email:rfc|nullable',
            'showform' => 'in:on,0',
            'direction' => 'in:horizontal,vertical|nullable'

        ];
    }

    public function messages() 
    {
        return [
            'showform' => 'Show on the form must be Yes or No.'
        ];
    }
}
