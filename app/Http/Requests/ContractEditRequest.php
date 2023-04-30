<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContractEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:web_point_contacts,id',
            'full_name' => 'string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+977-\d{10}$/|unique:web_point_contacts,phone,'.$this->request->get('id'),
        ];
    }
    
    public function messages()
    {
        return [
            'id.required' => 'Contact id is required',
            'id.exists' => 'Contact id is invalid',
            'full_name.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Phone number must be a valid Nepal phone number (+977-XXXXXXXXXX)',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        $errorsList = (new ValidationException($validator))->errors();
        $counter = 0;
        foreach($errorsList as $key => $errorList) {
            $data[$counter]['target_element'] = $key;
            $data[$counter]['error_message'] = $errorList[0];
            $counter ++;
        }
        $errors = ['status' => 'error',
            'data' => $data,
            'statusCode' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY];

        throw new HttpResponseException(response()->json($errors
            , JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
