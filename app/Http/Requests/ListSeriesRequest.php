<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ListSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idUser' => 'required',
            'idSerie' => 'required',
            'temporada' => 'required',
            'epsAssistidos' => 'required',
            'epsTotais' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
{
    return [
        'epsAssistidos.required' => 'Watched Episodes is required',
        'epsTotais.required'  => 'Total Eps is required',
    ];
}
}
