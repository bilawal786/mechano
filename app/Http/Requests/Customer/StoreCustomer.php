<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\CoreRequest;

class StoreCustomer extends CoreRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required',
            'calling_code' => 'required_with:mobile'
        ];
    }

}
