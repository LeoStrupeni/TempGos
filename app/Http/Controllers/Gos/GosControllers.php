<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Session;

// Modelo Vechiulo
use App\Gos\Gos_Color;
// Modelos Vehiculos
use App\Gos\Gos_V_Vehiculos;
use App\Gos\Gos_Vehiculo;
use App\Gos\Gos_Vehiculo_Cilindro;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Vehiculo_Modelo;
use App\Gos\Gos_Vehiculo_Nro_Puertas;
use App\Gos\Gos_Vehiculo_Tipo_Comb;
// Regiones
use App\Gos\Gos_V_Min_Municipios;
use App\Gos\Gos_Region_Localidad;
use App\Gos\Gos_Region_Colonia;
use App\Gos\Gos_Region_Ciudad;
use App\Gos\Gos_V_Min_Colonias;
// Cliente
use App\Gos\Gos_Cliente;
use App\Gos\Gos_V_Clientes;
use App\Gos\Gos_V_Min_Clientes;
use App\Gos\Gos_Cliente_Factura;
use App\Gos\Gos_Cliente_Cond_Credito;
use App\Gos\Gos_V_Clientes_Vehiculos;
use App\Gos\Gos_V_Clientes_;
use App\Gos\Gos_Fac_Tipo_Persona;
use App\Gos\Gos_Region_Estado;

/**
 *
 * @author yois
 *        
 */
class GosControllers extends Controller

{

    /**
     *
     * @var integer
     */
    private $_entidad_id = 0;

    /**
     * objeto modelo de BD
     *
     * @var Model
     */
    private $entidad;

    private $_nomb_id = '';

    /**
     *
     * @var string archivo blade con lista
     */
    protected $vistaListado = '';

    /**
     *
     * @var string archivo para edicion
     */
    protected $vistaEdicion = '';

    /**
     *
     * @var string archivo blade con opciones del data table
     */
    protected $opcionesEditDataTable = '';

    /**
     *
     * @return the $vistaEdicion
     */
    public function getVistaEdicion()
    {
        return $this->vistaEdicion;
    }

    /**
     *
     * @param string $vistaEdicion            
     */
    public function setVistaEdicion($vistaEdicion)
    {
        $this->vistaEdicion = $vistaEdicion;
    }

    /**
     *
     * @return the $opcionesEditDataTable
     */
    public function getOpcionesEditDataTable()
    {
        return $this->opcionesEditDataTable;
    }

    /**
     *
     * @param string $opcionesEditDataTable            
     */
    public function setOpcionesEditDataTable($opcionesEditDataTable)
    {
        $this->opcionesEditDataTable = $opcionesEditDataTable;
    }

    /**
     *
     * @return the $modelntidad
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     *
     * @param \Illuminate\Database\Eloquent\Model $modelntidad            
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    }

    /**
     *
     * @return the $_nomb_id
     */
    public function getNomb_id()
    {
        return $this->_nomb_id;
    }

    /**
     *
     * @return the $vistaListado
     */
    public function getVistaListado()
    {
        return $this->vistaListado;
    }

    /**
     *
     * @param string $_nomb_id            
     */
    public function setNomb_id($_nomb_id)
    {
        $this->_nomb_id = $_nomb_id;
    }

    /**
     *
     * @param string $vistaListado            
     */
    public function setVistaListado($vistaListado)
    {
        $this->vistaListado = $vistaListado;
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        // Traer informacion de clase modelo
        return 0;
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoFiltrado($id)
    {
        // Traer informacion de clase modelo
        return 0;
    }

    /**
     *
     * @return integer
     */
    public static function tallerIdActual()
    {
        // Obtener el id de la informacion de la SESSION DEL TALLER ACTUAL
        return Session::get('taller_id');
    }

    /**
     *
     * @param Request $request            
     */
    protected function preparaDatos(Request $request)
    {
        //
    }

    /**
     *
     * @param Request $request            
     * @return boolean
     */
    protected function validaDatos(Request $request)
    {
        return true;
    }

    /**
     *
     * @return number
     */
    public function getEntidad_id()
    {
        return $this->_entidad_id;
    }

    /**
     *
     * @param Integer $value            
     */
    public function setEntidad_id($value)
    {
        $this->_entidad_id = $value;
    }

    /**
     *
     * @return array
     */
    protected function preparaCrearEditar()
    {
        $gos_taller_id = self::tallerIdActual();
        return compact('gos_taller_id');
    }

    /**
     *
     * @param \Illuminate\Database\Eloquent\Collection $lista            
     * @param number $draw            
     * @return string
     */
    protected function preparaDatosDataTable($lista, $draw = 1)
    {
        $draw = 0;
        $recordsTotal = $lista->count();
        $recordsFiltered = $recordsTotal;
        // Armado respuesa Json para DataTable
        $respuestaJson = "{
        \"draw\": $draw,
        \"recordsTotal\": $recordsTotal,
        \"recordsFiltered\": $recordsFiltered";
        // Agregar registros al DataTable
        if ($recordsTotal > 0) {
            $respuestaJson .= ",\"data\": " . $lista->toJson(); // Se convierte a Json con la funcion toJson de Eloquent//
        } else {
            $respuestaJson .= ",\"data\": {}";
        }
        // }
        // Cierre de Json
        $respuestaJson .= "}";
        return $respuestaJson;
    }

    /**
     *
     * @param unknown $listaDatos            
     * @param unknown $vistaBotones            
     * @param string $columnaOpciones            
     * @return unknown|NULL
     */
    protected function preparaDataTableAjax($listaDatos, $vistaBotones = '', $columnaOpciones = 'Opciones')
    {
        //
        if (request()->ajax()) {
            return datatables()->of($listaDatos)
                ->addColumn($columnaOpciones, $vistaBotones)
                ->rawColumns([
                $columnaOpciones
            ])
                ->addIndexColumn()
                ->make(true);
        } else
            return null;
    }

    /**
     * convierte fecha a formato MySQL
     *
     * @param unknown $fechaOriginal            
     * @return string
     */
    protected function convierteFechaHaciaMySQLFormat($fechaOriginal)
    {
        // $date = str_replace('/', '-', $fechaOriginal);
        // $fechaFormatoMysql = date("Y-m-d", strtotime($date));
        // return $fechaFormatoMysql;
        return date("Y-m-d", strtotime($fechaOriginal));
    }

    /**
     * convierte fecha desde formato MySQL
     *
     * @param string $fechaOriginal            
     */
    protected function convierteFechaDesdeMySQLFormat($fechaOriginal)
    {
        return date("m/d/Y", strtotime($fechaOriginal));
    }

    /**
     *
     * @return string[]|number[]
     */
    protected static function condIdTaller()
    {
        return [
            [
                'gos_taller_id',
                '=',
                self::tallerIdActual()
            ]
        ];
    }

    /**
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return string
     */
    protected function guardaJson(Request $vechiculo, $id = 0)
    {
        return '';
    }

    /**
     *
     * @return array
     */
    protected function obtenSelectsVehiculo()
    {
        // Selects Vehiculos Relacionados

        $idtaller=Session::get('taller_id');
        $listaModelos = Gos_Vehiculo_Modelo::all();
        $listaMarcas = Gos_Vehiculo_Marca::where('gos_taller_id', $idtaller)->get();
        $listaCilindros = Gos_Vehiculo_Cilindro::all();
        $tiposCombustubles = Gos_Vehiculo_Tipo_Comb::all();
        $listaPuertas = Gos_Vehiculo_Nro_Puertas::all();
        $listatTiposVechiculos = Gos_Vehiculo_Nro_Puertas::all();
        // Select Colores
        $colores = Gos_Color::all();
        $coloresInterior = $colores;
        $coloresVehiculo = $colores;
        //
        return compact('listaPuertas', 'listaMarcas', 'listaModelos', 'tiposCombustubles', 'listaCilindros', 'coloresVehiculo', 'coloresInterior');
    }

    /**
     *
     * @return array
     */
    protected function obtenListaSelectRegiones()
    {
        $listaMunicipios = Gos_V_Min_Municipios::all();
        $listaLocalidades = Gos_Region_Localidad::all();
        $listaColonias = Gos_Region_Colonia::all();
        $listaEstados = Gos_Region_Estado::all();
        $listaCiudades = Gos_Region_Ciudad::all();
        return compact('listaMunicipios', 'listaLocalidades', 'listaColonias', 'listaEstados','listaCiudades');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaLocalidades()
    {
        return Gos_Region_Localidad::all();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaTipoPersonaFactura()
    {
        return Gos_Fac_Tipo_Persona::all();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaPuertas()
    {
        return Gos_Vehiculo_Nro_Puertas::all();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaClientes()
    {
        return ClientesController::listaMinClientes();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaTiposCombustibles()
    {
        return Gos_Vehiculo_Tipo_Comb::all();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listadoCilindros()
    {
        return Gos_Vehiculo_Cilindro::all();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaMarcas()
    {
        return Gos_Vehiculo_Marca::all();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaModelos()
    {
        // Selects relacionados
        return Gos_Vehiculo_Modelo::all();
    }

    /**
     *
     * @param unknown $relacion_id            
     * @return NULL[]|number[]
     */
    protected function datosCondCredito($request)
    {
        $relacion_id = $this->getEntidad_id();
        $datos = [
            'relacion_id' => $relacion_id,
            'dias_credito' => $request->dias_credito,
            'monto_maximo_credito' => $request->monto_maximo_credito,
            'nro_cta_cliente' => $request->nro_cta_cliente
        ];
        return $datos;
    }

    /**
     *
     * @param unknown $request            
     * @param string $fac_cliente            
     * @param string $req_autorizacion            
     * @return number[]|NULL[]
     */
    protected function datosFacturacion($request, $fac_cliente = false, $req_autorizacion = false)
    {
        $relacion_id = $this->getEntidad_id();
        $datos1 = array();
        $datos2 = array();
        //
        $gos_fac_region_ciudad_id = isset($request->gos_fac_region_ciudad_id) ? $request->gos_fac_region_ciudad_id : 0;
        $gos_fac_tipo_persona_id = isset($request->gos_fac_tipo_persona_id) ? $request->gos_fac_tipo_persona_id : 0;
        //
        $datos = [
            'relacion_id' => $relacion_id,
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'email_factura' => $request->email_factura,
            'calle_nro_fac' => $request->calle_nro_fac,
            'nro_exterior_fac' => $request->nro_exterior_fac,
            'nro_interior_fac' => $request->nro_interior_fac,
            'cp_fac' => $request->cp_fac,
            'gos_fac_region_ciudad_id' => $gos_fac_region_ciudad_id,
            'cliente_fac_municipio' => $request->cliente_fac_municipio,
            'cliente_fac_localidad' => $request->cliente_fac_localidad,
            'gos_fac_tipo_persona_id' => $gos_fac_tipo_persona_id,
            'indicaciones' => $request->indicaciones
        ];
        //
        if ($fac_cliente) {
            $datos1 = [
                'habilita_facturacion_cliente' => $request->habilita_facturacion_cliente == 'on' ? '1' : '0'
            ];
        }
        //
        if ($req_autorizacion) {
            $datos2 = [
                'requiere_autorizacion' => $request->requiere_autorizacion == 'on' ? '1' : '0'
            ];
        }
        
        return array_merge($datos, $datos1, $datos2);
    }  
    protected function datosFacturacionAseg($request, $fac_cliente = false, $req_autorizacion = false)
    {
        $relacion_id = $this->getEntidad_id();
        $datos1 = array();
        $datos2 = array();
        //
        $gos_fac_region_ciudad_id = isset($request->gos_fac_region_ciudad_id) ? $request->gos_fac_region_ciudad_id : 0;
        $gos_fac_tipo_persona_id = isset($request->gos_fac_tipo_persona_id) ? $request->gos_fac_tipo_persona_id : 0;
        //
        $datos = [
            'relacion_id' => $relacion_id,
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'email_factura' => $request->email_factura,
            'calle_nro_fac' => $request->calle_nro_fac,
            'nro_exterior_fac' => $request->nro_exterior_fac,
            'nro_interior_fac' => $request->nro_interior_fac,
            'cp_fac' => $request->cp_fac,
            'ase_fac_gos_region_ciudad_id' => $gos_fac_region_ciudad_id,
            'ase_fac_municipio' => $request->ase_fac_municipio,
            'ase_fac_localidad' => $request->ase_fac_localidad,
            'gos_fac_tipo_persona_id' => $gos_fac_tipo_persona_id,
            'indicaciones' => $request->indicaciones
        ];
        //
        if ($fac_cliente) {
            $datos1 = [
                'habilita_facturacion_cliente' => $request->habilita_facturacion_cliente == 'on' ? '1' : '0'
            ];
        }
        //
        if ($req_autorizacion) {
            $datos2 = [
                'requiere_autorizacion' => $request->requiere_autorizacion == 'on' ? '1' : '0'
            ];
        }
        
        return array_merge($datos, $datos1, $datos2);
    }

    /**
     * Entidad que incluyen datos de facturacion y datos de creditos
     * Ejemplo
     * Cliente
     * ASeguradora
     * Ect
     */
    /**
     *
     * @param unknown $request            
     */
    protected function guardaDatosRelacionados($request)
    {
        // si hay id
        $this->guardaDatosFacturacion($request);
        $this->guardaCondCredito($request);
    }

    /**
     *
     * @param unknown $request            
     */
    protected function guardaDatosFacturacion($request)
    {
        //
    }

    /**
     *
     * @param unknown $request            
     */
    protected function guardaCondCredito($request)
    {
        //
    }

    /**
     *
     * @param unknown $nombTabla            
     * @param unknown $nombID            
     * @param unknown $valorID            
     * @param unknown $datos            
     */
    public static function updateData($nombTabla, $nombID, $valorID, $datos)
    {
        DB::table($nombTabla)->where($idnç, $valorID)->update($datos);
    }

    /**
     *
     * @param Request $request            
     * @return \App\Gos\Gos_Vehiculo
     */
    protected function preparaDatosVehiculo(Request $request)
    {
        $gos_cliente_id = $this->getEntidad_id();
        $datos = [
            'gos_cliente_id' => $gos_cliente_id,
            'gos_vehiculo_modelo_id' => $request->gos_producto_marca_id,
            'anio_vehiculo' => $request->anio_vehiculo,
            'color_interior' => $request->color_interior,
            'placa' => $request->placa,
            'economico' => $request->economico,
            'nro_serie' => $request->nro_serie,
            'tipo_combustible' => $request->tipo_combustible,
            'vehiculo_cilindros' => $request->vehiculo_cilindros,
            'observaciones' => $request->observaciones,
            'cilindraje' => $request->cilindraje,
            'nro_motor' => $request->nro_motor,
            'anexo' => $request->anexo,
            'nro_puertas' => $request->nro_puertas,
            'pasajeros' => $request->pasajeros,
            'color_interior' => $request->color_interior,
            'aduana' => $request->aduana,
            'fecha_importacion' => $request->fecha_importacion,
            'gos_vehiculo_tipo_id' => $request->gos_vehiculo_tipo_id
        
        ];
        return new Gos_Vehiculo($datos);
    }

    /**
     * deveulve los datos de la entidad principal
     *
     * @param unknown $request            
     * @return array
     */
    protected function datosEntidad($request)
    {
        return array();
    }

    /**
     * devuelve fecha y hora actual
     *
     * @return string
     */
    protected static function ahoraFormatoMySQL()
    {
        
        // fecha y hora actual
        return date("Y-m-d H:i:s");
    }
}
