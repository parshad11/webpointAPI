<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AddContractRequest extends FormRequest
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
        'full_name' => 'required|string',
        'email' => 'email',
        'phone' => 'required|unique:web_point_contacts,phone|regex:/^\+977-\d{10}$/',
    ];
}

public function messages()
{
    return [
        'full_name.required' => 'Full name is required',
        'email.email' => 'Email must be a valid email address',
        'phone.required' => 'Phone number is required',
        'phone.unique' => 'This phone number is already used',
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
