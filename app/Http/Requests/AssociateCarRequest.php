<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssociateCarRequest extends FormRequest
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
        $driver_id = $this->request->get('driver_id');
        return [
            'driver_id' => 'required|integer',
            'car_id' => 'required|integer|unique_for:drivers,id,'. $driver_id ,
        ];
    }

    public function messages()
    {
        return [
            'driver_id.required' => 'driver_id is required!',
            'car_id.required' => 'car_id is required!',
            'car_id.unique_for' => 'car_id is unique for another driver!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 422));
    }
}
