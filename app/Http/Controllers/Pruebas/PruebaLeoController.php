<?php
namespace App\Http\Controllers\Pruebas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Vehiculo_Marca;
use App\http\Controllers\Gos\ProductosController;

class PruebaLeoController extends Controller
{
    public function apiPrueba(Request $request)
    {
        $products = ProductosController::listadoGeneral();
        return $products;
    }
}
