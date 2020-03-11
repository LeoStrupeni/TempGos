<?php
namespace App\Http\Requests\Gos;

use Illuminate\Foundation\Http\FormRequest;

class VehiculosRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gos_cliente_id' => 'required',
            'color_vehiculo' => 'required',
            'placa' => 'required',
            'nro_serie' => 'required',
            'tipo_combustible' => 'required',
            'vehiculo_cilindros' => 'required',
            'nro_motor' => 'required',
            'nro_puertas' => 'required',
            'color_interior' => 'required'
        
        ];
    /**
     * , [
     * 'gos_cliente_id.required' => 'Debe elegir un cliente',
     * 'placa' => 'Debe escribir la placa',
     * 'color_vehiculo' => 'Falta color del vehiculo',
     * 'nro_serie' => 'Falta número de serie',
     * 'tipo_combustible' => 'Falta tipo de combustible',
     * 'vehiculo_cilindros' => 'Falta cilindros',
     * 'nro_motor' => 'Falta número de motor',
     * 'nro_puertas' => 'Falta número de puertas',
     * 'color_interior' => 'Falta color interior'
     *
     * ];
     */
    }
}
