<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InventarioImport;
use App\Imports\VehiculosImport;

/**
 *
 * @author enzo
 *        
 */
class ExcelController extends Controller
{

    /**
     * Exporta plantila para carga de inventario desde excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function plantillaInventarioExcel()
    {
        $pathtoFile = public_path() . '/excel/' . 'Plantilla_Alta_Inventario.xlsx';
        return response()->download($pathtoFile);
    }

    /**
     * Exporta plantila para carga de vehiculos desde excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function plantillaVehiculosExcel()
    {
        $pathtoFile = public_path() . '/excel/' . 'Plantilla_Alta_Vehiculos.xlsx';
        return response()->download($pathtoFile);
    }

    /**
     * Importa inventario desde archivo excel
     *
     * @param Request $request            
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importaInventarioExcel(Request $request)
    {
        $file = $request->file('ArchivoInventario');
        Excel::import(new InventarioImport(), $file);
        return back();
    }

    /**
     * Importa vehiculos desde archivo excel
     *
     * @param Request $request            
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importaVechiculosExcel(Request $request)
    {
        $file = $request->file('ArchivoVehiculos');
        // $clientes = $request->gos_cliente_id;
        // FALTAN ENVIAR CLIENTE A LA IMPORTANCION
        Excel::import(new VehiculosImport(), $file);
        
        return back();
    }
}
