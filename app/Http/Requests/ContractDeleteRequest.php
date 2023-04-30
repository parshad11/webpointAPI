<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContractDeleteRequest extends FormRequest
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
            'id' => 'required|exists:mysql.web_point_contacts,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Contract id is required',
            'id.exists' => 'Contract id is invalid',
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
