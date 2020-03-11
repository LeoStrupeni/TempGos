<?php
namespace App\Imports;

use App\Gos\Gos_Vehiculo;
use Maatwebsite\Excel\Concerns\ToModel;

/**
 *
 * @author yois
 *        
 */
class VehiculosImport implements ToModel
{

    /**
     * ESTABA ARMADO POR ENZO
     *
     * {@inheritdoc}
     *
     * @see \Maatwebsite\Excel\Concerns\ToModel::model()
     */
    public function model(array $row)
    {
        return new Gos_Vehiculo([
            'gos_cliente_id' => $row[0],
            'gos_vehiculo_modelo_id' => $row[1],
            'anio_vehiculo' => $row[2],
            'color' => $row[3],
            'placa' => $row[4],
            'economico' => $row[5],
            'nro_serie' => $row[6],
            'nro_motor' => $row[7],
            'vehiculo_cilindros' => $row[8],
            'cilindraje' => $row[9],
            'pasajeros' => $row[10],
            'tipo_combustible' => $row[11]
        
        ]);
    }
}
