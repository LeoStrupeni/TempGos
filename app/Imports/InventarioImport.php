<?php

namespace App\Imports;

use App\Gos\Gos_Producto;
use Maatwebsite\Excel\Concerns\ToModel;

class InventarioImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new Gos_Producto([
            //
        ]);
    }
}
