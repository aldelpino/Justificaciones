<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            //
            'asignatura' => 'required',
            'tipoInasistencia' => 'required',
            'motivo' => 'required',
            'subioArchivo' => 'required',
            'comentario' => 'required|min:30|max:200',
        ];
    }
    public function messages()
{
    return [
        'asignatura.required' => 'Debes mencionar asignatura',
        'tipoInasistencia.required' => 'Debes marcar si faltaste a prueba o no',
        'motivo.required' => 'Debes indicar un motivo',
        'subioArchivo.required' => 'Debes adjuntar una imagen',
        'comentario.required' => 'Debes comentar enter 30 y 500 caracteres',
    ];
}
}
