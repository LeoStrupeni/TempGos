<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\DB;
use App\Gos\Gos_V_Os_Etapas;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_OS_Tipo_O;
use App\Gos\Gos_V_Aseguradoras_;
class ReporteEtapasEnProcesoController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idtaller=Session::get('taller_id');
        $usuario=Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $listaAsegurados = DB::select( DB::raw("
        SELECT nombre, IFNULL(countNA,0) countNA,IFNULL(countF,0) countF,IFNULL(countA,0) countA
        FROM gos_v_os_etapas g

        LEFT JOIN  (SELECT nombre as nombreNA, estado_etapa, count(*) countNA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'NA' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) NA ON g.nombre = NA.nombreNA

                  LEFT JOIN (
                SELECT nombre as nombreF, estado_etapa, count(*) countF
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'F' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) AS F ON g.nombre = F.nombreF
                LEFT JOIN (
                SELECT nombre as nombreA, estado_etapa, count(*) countA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'A' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) AS A ON g.nombre = A.nombreA
                 WHERE gos_taller_id = ".$idtaller."
                 GROUP BY nombre
                 ORDER BY orden_etapa ASC
                 "));
                 $listaAseguradoras = Gos_V_Aseguradoras_::where('gos_taller_id',Session::get('taller_id'))->get();
                 $listaTipoOrden = Gos_OS_Tipo_O::all();
                 $listaDanios = Gos_OS_Tipo_Danio::all();
                 $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',Session::get('taller_id'))->get();

                 $asegg = "";
                 $tord = "";
                 $tdanio ="";
                 $et = "";

        // $listaAsegurados = Gos_V_Os_Etapas::where(self::condIdTaller())->get();

        return view('/Reportes/ReporteEtapasEnProceso',compact('asegg','tord','tdanio','et','listaAsegurados','taller_conf_ase','taller_conf_vehiculo','listaTipoOrden','listaDanios','listaEtapas','listaAseguradoras'));
    }
    /*
    aseguradora_id: null,
tipo_orden: null,
tipo_dano: null,
etapas: null,*/
    public function filtros(Request $request)
    {


       if($request->aseguradora_id == null)$request->aseguradora_id=0;
       if($request->tipo_orden== null)$request->tipo_orden=0;
       if($request->tipo_dano==null)$request->tipo_dano=0;
       if($request->etapas==null)$request->etapas='';

       $asegg = $request->aseguradora_id;
       $tord = $request->tipo_orden;
       $tdanio =$request->tipo_dano;
       $et = $request->etapas;

      $idtaller=Session::get('taller_id');
      $usuario=Session::get('usr_Data');
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();

      $query ="
      SELECT go.gos_aseguradora_id,nombre, IFNULL(countNA,0) countNA,IFNULL(countF,0) countF,IFNULL(countA,0) countA
        FROM gos_v_os_etapas g
		LEFT JOIN gos_os go ON go.gos_os_id = g.gos_os_id
        LEFT JOIN  (SELECT nombre as nombreNA, estado_etapa, count(*) countNA
                FROM gos_v_os_etapas
                WHERE ";
                if($request->aseguradora_id != null)
                {
                    $query.="gos_aseguradora_id =".$request->aseguradora_id." and ";
                }
                

                $query.="estado_etapa = 'NA' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) NA ON g.nombre = NA.nombreNA

                  LEFT JOIN (
                SELECT nombre as nombreF, estado_etapa, count(*) countF
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'F' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS F ON g.nombre = F.nombreF
                LEFT JOIN (
                SELECT nombre as nombreA, estado_etapa, count(*) countA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'A' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS A ON g.nombre = A.nombreA
                  WHERE ";

                if($request->aseguradora_id != null)
                {
                    $query.="go.gos_aseguradora_id =".$request->aseguradora_id." and ";
                }
                if($request->tipo_orden != null)
                {

                    $query.="go.gos_os_tipo_o_id =".$request->tipo_orden." and ";
                }
                if($request->tipo_dano != null)
                {

                    $query.="go.gos_os_tipo_danio_id =".$request->tipo_dano." and ";
                }
                if($request->etapas != null)
                {
                    $query.="  g.nombre ='".$request->etapas."' and ";
                }








                $query.="g.gos_taller_id = ".$idtaller."
                 GROUP BY nombre
                 ORDER BY orden_etapa ASC";

                // return dd($query);

      $listaAsegurados = DB::select( DB::raw($query));
               $listaAseguradoras = Gos_V_Aseguradoras_::where('gos_taller_id',Session::get('taller_id'))->get();
               $listaTipoOrden = Gos_OS_Tipo_O::all();
               $listaDanios = Gos_OS_Tipo_Danio::all();
               $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',Session::get('taller_id'))->get();

      // $listaAsegurados = Gos_V_Os_Etapas::where(self::condIdTaller())->get();

      return view('/Reportes/ReporteEtapasEnProceso',compact('asegg','tord','tdanio','et','listaAsegurados','taller_conf_ase','taller_conf_vehiculo','listaTipoOrden','listaDanios','listaEtapas','listaAseguradoras'));
    }
    public function aseguradora($id)
    {
      $idtaller=Session::get('taller_id');
      $listaAsegurados = DB::select( DB::raw("
      SELECT go.gos_aseguradora_id,nombre, IFNULL(countNA,0) countNA,IFNULL(countF,0) countF,IFNULL(countA,0) countA
        FROM gos_v_os_etapas g
		LEFT JOIN gos_os go ON go.gos_os_id = g.gos_os_id
        LEFT JOIN  (SELECT nombre as nombreNA, estado_etapa, count(*) countNA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'NA' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) NA ON g.nombre = NA.nombreNA

                  LEFT JOIN (
                SELECT nombre as nombreF, estado_etapa, count(*) countF
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'F' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS F ON g.nombre = F.nombreF
                LEFT JOIN (
                SELECT nombre as nombreA, estado_etapa, count(*) countA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'A' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS A ON g.nombre = A.nombreA
                 WHERE g.gos_taller_id =".$idtaller." and go.gos_aseguradora_id =".$id."
                 GROUP BY nombre
                 ORDER BY orden_etapa ASC
               "));
      return   $listaAsegurados;
    }
    public function danio($id)
    {
      $idtaller=Session::get('taller_id');
      $listaAsegurados = DB::select( DB::raw("
      SELECT go.gos_aseguradora_id,nombre, IFNULL(countNA,0) countNA,IFNULL(countF,0) countF,IFNULL(countA,0) countA
        FROM gos_v_os_etapas g
		LEFT JOIN gos_os go ON go.gos_os_id = g.gos_os_id
        LEFT JOIN  (SELECT nombre as nombreNA, estado_etapa, count(*) countNA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'NA' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) NA ON g.nombre = NA.nombreNA

                  LEFT JOIN (
                SELECT nombre as nombreF, estado_etapa, count(*) countF
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'F' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS F ON g.nombre = F.nombreF
                LEFT JOIN (
                SELECT nombre as nombreA, estado_etapa, count(*) countA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'A' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS A ON g.nombre = A.nombreA
                 WHERE g.gos_taller_id = ".$idtaller." and go.gos_os_tipo_danio_id =".$id."
                 GROUP BY nombre
                 ORDER BY orden_etapa ASC
               "));
      return   $listaAsegurados;
    }
    public function orden($id)
    {
      $idtaller=Session::get('taller_id');
      $listaAsegurados = DB::select( DB::raw("
      SELECT go.gos_aseguradora_id,nombre, IFNULL(countNA,0) countNA,IFNULL(countF,0) countF,IFNULL(countA,0) countA
        FROM gos_v_os_etapas g
		LEFT JOIN gos_os go ON go.gos_os_id = g.gos_os_id
        LEFT JOIN  (SELECT nombre as nombreNA, estado_etapa, count(*) countNA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'NA' AND gos_taller_id = ".$idtaller."
                GROUP BY nombre) NA ON g.nombre = NA.nombreNA

                  LEFT JOIN (
                SELECT nombre as nombreF, estado_etapa, count(*) countF
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'F' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS F ON g.nombre = F.nombreF
                LEFT JOIN (
                SELECT nombre as nombreA, estado_etapa, count(*) countA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'A' AND gos_taller_id =".$idtaller."
                GROUP BY nombre) AS A ON g.nombre = A.nombreA
                 WHERE g.gos_taller_id =".$idtaller." and go.gos_os_tipo_o_id =".$id."
                 GROUP BY nombre
                 ORDER BY orden_etapa ASC
               "));
      return   $listaAsegurados;
    }

    public function etapas($id)
    {
      $idtaller=Session::get('taller_id');
      $listaAsegurados = DB::select( DB::raw("
      SELECT go.gos_aseguradora_id,nombre, IFNULL(countNA,0) countNA,IFNULL(countF,0) countF,IFNULL(countA,0) countA
        FROM gos_v_os_etapas g
		LEFT JOIN gos_os go ON go.gos_os_id = g.gos_os_id
        LEFT JOIN  (SELECT nombre as nombreNA, estado_etapa, count(*) countNA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'NA' AND gos_taller_id =1
                GROUP BY nombre) NA ON g.nombre = NA.nombreNA

                  LEFT JOIN (
                SELECT nombre as nombreF, estado_etapa, count(*) countF
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'F' AND gos_taller_id =1
                GROUP BY nombre) AS F ON g.nombre = F.nombreF
                LEFT JOIN (
                SELECT nombre as nombreA, estado_etapa, count(*) countA
                FROM gos_v_os_etapas
                WHERE estado_etapa = 'A' AND gos_taller_id =1
                GROUP BY nombre) AS A ON g.nombre = A.nombreA
                 WHERE g.gos_taller_id = ".$idtaller." and g.nombre ='".$id."'
                 GROUP BY nombre
                 ORDER BY orden_etapa ASC
               "));
      return    $listaAsegurados;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
