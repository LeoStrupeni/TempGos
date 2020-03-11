<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use GosClases\ReporteEncuestaOS;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Encuesta;
use App\Gos\Gos_Encuesta_Item;
use App\Gos\Gos_Encuesta_Respuestas;
use App\Gos\Gos_Enc_Preguntas;
use App\Gos\Gos_V_Encuestas;
use App\Gos\Gos_Os_Encuesta_Item;
use App\Gos\Gos_Os_Encuesta;
use App\Gos\Gos_V_Os_Generada;



class ReporteEncuestaOSController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $aid = null;

      $idtaller=Session::get('taller_id');
      $listaAseguradoras=DB::select("SELECT * FROM gos_encuesta ge
      LEFT JOIN gos_aseguradora ga ON ga.gos_aseguradora_id =  ge.gos_aseguradora_id
      WHERE ge.gos_taller_id =".$idtaller."");

      $encuesta = DB::select( DB::raw('SELECT *  FROM   gos_v_os gvo
      INNER JOIN gos_os_encuesta goe ON goe.gos_os_id =  gvo.gos_os_id
        WHERE gvo.gos_taller_id = '.$idtaller.''));

        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();

      $compact = compact('listaAseguradoras','encuesta','taller_conf_vehiculo','taller_conf_ase','aid');
      // dd($compactFinal);
      // dd($this->getVistaListado());
      return view('/Reportes/ReporteEncuestaOS',$compact);
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

      $validatedData = $request->validate([
          'gos_aseguradora_id'  => 'required'

      	],
      $messages = [
      'gos_aseguradora_id.required' => 'Seleccione la aseguradora'
       ]);

      $f = explode(" - ",$request->rangoFechas);
      $start = date('Y-m-d',strtotime(date('Y-m-d', strtotime($f[0]))));
      $end = date('Y-m-d',strtotime(date('Y-m-d', strtotime($f[1]))));

      $idtaller=Session::get('taller_id');
      $listaAseguradoras=DB::select("SELECT * FROM gos_encuesta ge
      LEFT JOIN gos_aseguradora ga ON ga.gos_aseguradora_id =  ge.gos_aseguradora_id
      WHERE ge.gos_taller_id =".$idtaller."");
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();


      $encuesta = DB::select("SELECT *  FROM   gos_v_os gvo
      INNER JOIN gos_os_encuesta goe ON goe.gos_os_id =  gvo.gos_os_id
        WHERE gvo.gos_taller_id = ".$idtaller." and goe.gos_aseguradora_id = ".$request->gos_aseguradora_id."
        and (fecha_encuesta between '".$start."' and '".$end."' )");

        $aid = ["id" => $request->gos_aseguradora_id];
        $aid2=$request->gos_aseguradora_id;
        $encuestatip = Gos_Encuesta::where('gos_aseguradora_id',$aid2)->first();
        
        // if($encuestatip==null){
        //   return view('/Reportes/ReporteEncuestaOS');
        // }

        $encuesta_id= $encuestatip->gos_encuesta_id;
        $encuesta_item = Gos_Encuesta_Item::where('gos_encuesta_id',$encuesta_id)->get();        

        $compact = compact('listaAseguradoras','encuesta','aid','aid2','encuesta_item','taller_conf_vehiculo','taller_conf_ase','start','end');
        // return($compact);
        // dd($compactFinal);
        // dd($this->getVistaListado());
        return view('/Reportes/ReporteEncuestaOS',$compact);
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
    public function pregunta()
    {

    }
    /*
    public function chart($id)
    {
      $data = DB::select("SELECT pregunta,tipo_respuestas, COUNT(*) as count
      FROM(
        SELECT goe.gos_os_id, goe.gos_aseguradora_id,goei.gos_os_encuesta_id,pregunta,tipo_respuestas
        FROM gos_os_encuesta goe
        LEFT JOIN gos_os_encuesta_item goei ON goe.gos_os_encuesta_id = goei.gos_os_encuesta_id
        LEFT JOIN gos_enc_preguntas gep ON goei.gos_enc_preguntas_id = gep.gos_enc_preguntas_id
        LEFT JOIN gos_encuesta_respuestas ger ON goei.gos_encuesta_respuestas_id = ger.gos_encuesta_respuestas_id
        WHERE contesto_encuesta > 0) AS F
        WHERE gos_aseguradora_id =".$id."
        GROUP BY pregunta,tipo_respuestas
        ORDER BY pregunta");
        return $data;
        //return Response::json($data);
      }
      */
      public function chart($id,$fechainc,$fechafin)
      {
        //  $compact= compact('id','fechainc','fechafin');
        // return($compact);
        $idtaller=Session::get('taller_id');
        $encuestaOS = Gos_Os_Encuesta::where('gos_aseguradora_id',$id)->where('gos_taller_id',$idtaller)->get();
        $encuesta = Gos_Encuesta::where('gos_aseguradora_id',$id)->first();
        if($encuesta==null){
          $contestadas = DB::select("SELECT *,COUNT(*) AS total
          FROM gos_os_encuesta 
          WHERE gos_taller_id = ".$idtaller." 
          GROUP BY contesto_encuesta ");
          $filtro=0;
            $compact = compact('contestadas','filtro');
          
        }
        else{
            $encuesta_id= $encuesta->gos_encuesta_id;
            $encuesta_item = Gos_Encuesta_Item::where('gos_encuesta_id',$encuesta_id)->get();
            $categories = array();
            foreach($encuesta_item as $item){
              // $pregencuest = Gos_V_Encuestas::where('gos_encuesta_id',$encuesta_id)->where('gos_enc_preguntas_id',$item->gos_encuesta_pregunta_id)->get();
              $pregencuest = DB::select("SELECT  * FROM gos_v_encuestas gve
              LEFT JOIN (
                  SELECT gos_os_id,gos_os_encuesta_id,pregunta_id as preg_id,gos_encuesta_respuestas_id as res_id,tipo_respuestas as t_res, COUNT(*) as count
                  FROM(SELECT goe.gos_os_encuesta_id,goe.gos_os_id, goe.fecha_encuesta, goe.gos_aseguradora_id,goe.gos_taller_id,goe.contesto_encuesta,ger.pregunta_id,ger.gos_encuesta_respuestas_id,ger.tipo_respuestas 
                      FROM gos_os_encuesta goe 
                      LEFT JOIN gos_os_encuesta_item goei ON goei.gos_os_encuesta_id =  goe.gos_os_encuesta_id
                      LEFT JOIN gos_encuesta_respuestas ger ON goei.gos_encuesta_respuestas_id =  ger.gos_encuesta_respuestas_id
                      WHERE goe.gos_aseguradora_id = ".$id." AND goe.gos_taller_id=".$idtaller." AND (fecha_encuesta between '".$fechainc."' AND '".$fechafin."' ))AS P
              GROUP BY gos_encuesta_respuestas_id) AS ms ON  gve.gos_encuesta_respuestas_id = ms.res_id	
              WHERE gve.gos_encuesta_id = ".$encuesta_id." AND gve.gos_enc_preguntas_id=".$item->gos_encuesta_pregunta_id."");
              $categories[] = $pregencuest;
            }
            // return($categories);
            // $pregencuest = DB::select("SELECT * 
            // FROM gos_encuesta_item gei
            // LEFT JOIN gos_enc_preguntas gep ON gep.gos_enc_preguntas_id =  gei.gos_encuesta_pregunta_id
            // WHERE gei.gos_encuesta_id = ".$encuesta_id."");   

            $contestadas = DB::select("SELECT *,COUNT(*) AS total
            FROM gos_os_encuesta 
            WHERE gos_aseguradora_id = ".$id." AND gos_taller_id = ".$idtaller." AND fecha_encuesta between '".$fechainc."' AND '".$fechafin."'
            GROUP BY contesto_encuesta ");
            $filtro=1;
              $compact = compact('contestadas','categories','encuesta_item','filtro');
        }
        return $compact;
          //return Response::json($data);
      }


}
