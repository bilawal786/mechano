<?php

namespace App\Http\Requests\Setting;

use Illuminate\Support\Arr;
use App\Http\Requests\CoreRequest;

class ProfileSetting extends CoreRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'house_no' => 'required|numeric',
            'address_line' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required',
            'country_id' => 'required',
        ];

        if ($this->has('mobile')) {
            $rules = Arr::add($rules, 'mobile', 'required|numeric');
            $rules = Arr::add($rules, 'calling_code', 'required');
        }

        return $rules;
    }

}
