<?php

namespace Thinkcreative\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactInformation extends FormRequest
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
            'address' => 'array|nullable'
            'number' => 'numeric|nullable',
            'email' => 'email:rfc|nullable',
            'showform' => 'boolean|nullable',
            'direction' => 'in:horizontal,vertical|nullable'

        ];
    }
}
