<?php
namespace GosClases;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use Yajra\DataTables\EloquentDataTable;

/**
 * Clase con funciones para el datatble
 *
 * @author yois
 *        
 */
class GosDataTable extends GosData
{

    protected $opcionesEditDataTable = '';

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
     * @return the $opcionesEditDataTable
     */
    public function getOpcionesEditDataTable()
    {
        return $this->opcionesEditDataTable;
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
     * @return the $vistaEdicion
     */
    public function getVistaEdicion()
    {
        return $this->vistaEdicion;
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
     * @param string $vistaListado            
     */
    public function setVistaListado($vistaListado)
    {
        $this->vistaListado = $vistaListado;
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
     * Devuelve data preparado para DataTable
     *
     * @param unknown $listado            
     * @param string $vistaBotones            
     * @param string $columnaOpciones            
     * @return unknown|NULL
     */
    public static function preparaDataTableAjax($listado, $vistaBotones, $columnaOpciones = 'Opciones', $opciones_editor)
    {
        //
        if (isset($opciones_editor)) {
            $json = datatables()->of($listado)
                ->with('options', $opciones_editor)
                ->addColumn($columnaOpciones, $vistaBotones)
                ->rawColumns([
                $columnaOpciones
            ])
                ->addIndexColumn()
                ->make(true);
        } else {
            $json = datatables()->of($listado)
                ->addColumn($columnaOpciones, $vistaBotones)
                ->rawColumns([
                $columnaOpciones
            ])
                ->addIndexColumn()
                ->make(true);
        }
        return $json;
    }
}

