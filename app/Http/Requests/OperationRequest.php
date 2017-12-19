<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Operation;

class OperationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'operation'=>'bail|required|max:10|unique:operations',
                    'description'=>'bail|required|max:60',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'operation'=>'bail|required|max:10|unique:operations,operation,'.$this->route('operation').',id',
                    'description'=>'bail|required|max:60',
                ];
            }
            default:break;
        }
        return Operation::$rules;
    }
    public function messages()
    {
        return [
            'operation.required' => 'Introduzca el campo operación.',
            'operation.max' => 'La operación debe tener máximo 10 carácteres.',
            'operation.unique' => 'No se puede repetir la operación.',
            'description.required' => 'Introduzca el campo descripción de la operación.',
            'descriptionc.max' => 'La descripción de la operación debe tener máximo 60 carácteres.',
        ];
    }
    public function response(array $errors)
    {
        return redirect()->back()->withInput()->withErrors($errors);
    }
}
