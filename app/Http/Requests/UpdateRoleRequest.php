<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRoleRequest extends Request
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
        // https://laravel.com/docs/5.2/validation#available-validation-rules
        return [
            'name'          => 'required|max:50|unique:roles,name,' . $this->id,
            'display_name'  => 'required',
            'description'   => 'required',
            //'permission'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Required',
            'name.max'              => 'Maximum 50 characters',
            'name.unique'           => 'Already taken',
            'display_name.required' => 'Required',
            'description.required'  => 'Required',
            //'permission.required'   => 'Please make at least 1 selection'
        ];
    }
}