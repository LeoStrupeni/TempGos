<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_OS;
use App\Gos\Gos_V_Inicio_Calendario;
use App\Http\Controllers\Controller;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Encuesta;
use App\Gos\Gos_Encuesta_Item;
use App\Gos\Gos_Encuesta_Respuestas;
use App\Gos\Gos_Enc_Preguntas;
use App\Gos\Gos_V_Encuestas;
use App\Gos\Gos_Os_Encuesta_Item;
use App\Gos\Gos_Os_Encuesta;
use App\Gos\Gos_V_Os_Generada;
use Illuminate\Support\Facades\Storage;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Taller;
use App\Gos\Gos_Taller_Conf_vehiculo;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
/**
 * 
 * @author yois
 *
 */
class EncuestasController extends GosControllers
{

    protected $vistaListado = 'Encuesta/ListarEncuesta';

    protected $opcionesEditDataTable = 'Encuesta.OpcionesDataTableEncuestas';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idtaller=Session::get('taller_id');
        $listaEncuesta = Gos_Encuesta::where('gos_taller_id',$idtaller)->get();       
        $listaEncItems = Gos_Encuesta_Item::where('gos_taller_id',$idtaller)->get();
        $listaRespuestas = Gos_Encuesta_Respuestas::all();
        $listaPreguntas = Gos_Enc_Preguntas::where('gos_taller_id',$idtaller)->get();
        $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
        $cuentaEncuestas = Gos_Encuesta::where('gos_taller_id',$idtaller)->count();
        $cuentaPreguntas = Gos_Enc_Preguntas::where('gos_taller_id',$idtaller)->count();
        $usuario=Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $ajax = $this->preparaDataTableAjax($listaPreguntas, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
        return $ajax;
        }
        
        $activePro=('active');
       
        // dd($listaAseguradora);
        $compact = compact('listaRespuestas','listaAseguradora','listaPreguntas','listaEncItems','activePro','cuentaEncuestas','cuentaPreguntas','listaEncuesta','taller_conf_ase','taller_conf_vehiculo');
        return view('Encuesta/ListarEncuesta',$compact);
    }

    public function GetPreguntas()
    {
        $idtaller=Session::get('taller_id');        
        
         $listaEncuesta = Gos_Encuesta::where('gos_taller_id',$idtaller)->get();
         $listaEncItems = Gos_Encuesta_Item::where('gos_taller_id',$idtaller)->get();
         $listaRespuestas = Gos_Encuesta_Respuestas::all();
         $listaPreguntas = Gos_Enc_Preguntas::where('gos_taller_id',$idtaller)->get();
         $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
         $cuentaEncuestas = Gos_Encuesta::where('gos_taller_id',$idtaller)->count();
         $cuentaPreguntas = Gos_Enc_Preguntas::where('gos_taller_id',$idtaller)->count();
         $ajax = $this->preparaDataTableAjax($listaPreguntas, $this->getOpcionesEditDataTable());
            if (null != $ajax) {
            return $ajax;
         }
         $activePro=('active');
         $compact = compact('listaRespuestas','listaAseguradora','listaPreguntas','listaEncItems','activePro','cuentaEncuestas','cuentaPreguntas');
         return view($this->getVistaListado(),$compact);
    }

    public function encuestaos($gos_encuesta_id)
    {  
        $idtaller=Session::get('taller_id');
        $encuesta = Gos_V_Encuestas::find($gos_encuesta_id)->first();
        $aseguradoraID = Gos_Encuesta::where('gos_encuesta_id',$gos_encuesta_id)->get('gos_aseguradora_id');
        $detaseg = Gos_Aseguradora::find($aseguradoraID)->first();
        // dd($detaseg);
        if($encuesta!=null){}

        $encuestaitems = Gos_V_Encuestas::where('gos_encuesta_id',$gos_encuesta_id)->get();
        // dd($encuestaitems);
        $listaitems = Gos_Encuesta_Item::where('gos_encuesta_id',$gos_encuesta_id)->get('gos_encuesta_item_id');
        // $encuestaitems1 = Gos_V_Encuestas::where('gos_encuesta_id',$gos_encuesta_id)->where($listaitems)->get();
        $preguntasenc = DB::select( DB::raw('SELECT  gei.*, gep.pregunta
        FROM gos_encuesta_item gei 
        LEFT JOIN gos_enc_preguntas gep ON gep.gos_enc_preguntas_id = gei.gos_encuesta_pregunta_id
        WHERE gos_encuesta_id = '.$gos_encuesta_id.''));
        
        $compact = compact('encuesta','encuestaitems','preguntasenc','detaseg');
        // return ($detaseg);
        return view('EncuestasVer',$compact);
    }
    //---------------------------------Orden terminada Encuesta-------------------------------
    public function encuestaosterminada($gos_os_id)
    {  
        $idtaller=Session::get('taller_id');
        $OSProceso = DB::select( DB::raw('SELECT *
        FROM gos_v_inicio_calendario
        WHERE  gos_taller_id='.$idtaller.' AND gos_os_id = '.$gos_os_id.''));
        
        $OSarray = $OSProceso[0] ;
        $gos_aseguradora_id = $OSarray->gos_aseguradora_id;
        $gos_os_id =  $OSarray->gos_os_id;
        $numorden = $OSarray->nro_orden_interno;
        // return($gos_aseguradora_id);
        $gos_encuesta_id = Gos_Encuesta::where('gos_aseguradora_id',$gos_aseguradora_id)->get('gos_encuesta_id');
        // dd($gos_encuesta_id[0]->gos_encuesta_id);
        $encuesta = Gos_V_Encuestas::find($gos_encuesta_id)->first();
        
        $detaseg = Gos_Aseguradora::find($gos_aseguradora_id)->first();
        
        // dd($detaseg);
        if($encuesta!=null){} 
        $gos_encuesta_id = $gos_encuesta_id[0]->gos_encuesta_id;
        $preguntasenc = DB::select( DB::raw('SELECT  gei.*, gep.pregunta
        FROM gos_encuesta_item gei 
        LEFT JOIN gos_enc_preguntas gep ON gep.gos_enc_preguntas_id = gei.gos_encuesta_pregunta_id
        WHERE gos_encuesta_id = '.$gos_encuesta_id.''));
            
       
        
        $compact = compact('encuesta','preguntasenc','detaseg','OSProceso','numorden','gos_os_id','gos_aseguradora_id');
        // return ($detaseg);
        return view('EncuestasOS',$compact);
        
    }

    public function EncuestaPDF($gos_os_id)
    {
        $idtaller=Session::get('taller_id');
        $listataller = Gos_Taller::find($idtaller); 
        $OSProceso = DB::select( DB::raw('SELECT *
        FROM gos_v_inicio_calendario
        WHERE  gos_taller_id='.$idtaller.' AND gos_os_id = '.$gos_os_id.''));
        $os = Gos_V_Os_Generada::find($gos_os_id);
        // return($os);
        $OSarray = $OSProceso[0] ;
        $gos_aseguradora_id = $OSarray->gos_aseguradora_id;
        $gos_os_id =  $OSarray->gos_os_id;
        $numorden = $OSarray->nro_orden_interno;
        $gos_encuesta_id = Gos_Encuesta::where('gos_aseguradora_id',$gos_aseguradora_id)->get('gos_encuesta_id');
        $encuesta = Gos_V_Encuestas::find($gos_encuesta_id)->first();        
        $detaseg = Gos_Aseguradora::find($gos_aseguradora_id)->first();
        if($encuesta!=null){} 
        $gos_encuesta_id = $gos_encuesta_id[0]->gos_encuesta_id;
        $preguntasenc = DB::select( DB::raw('SELECT  gei.*, gep.pregunta
        FROM gos_encuesta_item gei 
        LEFT JOIN gos_enc_preguntas gep ON gep.gos_enc_preguntas_id = gei.gos_encuesta_pregunta_id
        WHERE gos_encuesta_id = '.$gos_encuesta_id.''));
            
        $recop = Gos_Os_Encuesta::where('gos_os_id', $gos_os_id)->first();
        $gos_os_encuesta_id = $recop->gos_os_encuesta_id;
        $recopitem = DB::select( DB::raw('SELECT *  FROM  gos_os_encuesta_item goei
        INNER JOIN gos_encuesta_respuestas ger ON goei.gos_encuesta_respuestas_id = ger.gos_encuesta_respuestas_id
        WHERE gos_os_encuesta_id = '.$gos_os_encuesta_id.''));
        $css = public_path().'\gos\css\bootstrap.min.css';
        $logo =public_path().Storage::url($listataller->taller_lototipo);
        $usuario=Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first(); 
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $logoproorder = public_path().'\img\logo.png ';
        $firmacliente =public_path().'\storage\img\firmasOS\Inventario\fce'.$gos_os_id.'.png';
        $compact = compact('encuesta','preguntasenc','detaseg','OSProceso','numorden','gos_os_id','gos_aseguradora_id','recop','recopitem','css','logo','logoproorder','firmacliente','os','taller_conf_ase','taller_conf_vehiculo');
        //  return view('Encuesta.pdf',$compact);
         return PDF::loadView('Encuesta.pdf',$compact)->inline('PDF-Encuesta'.time().'.pdf');
    }

    public function respuestaEncuesta(Request $request)
    {   
        $idtaller=Session::get('taller_id');
        $encuestares = new Gos_Os_Encuesta();
        $encuestares->gos_os_id=$request->gos_os_id;
        $encuestares->fecha_encuesta= date("Y-m-d H:i:s");
        $encuestares->firma_cliente='';        
        $encuestares->gos_aseguradora_id=$request->gos_aseguradora_id;
        $encuestares->gos_taller_id=$idtaller;
        $encuestares->contesto_encuesta=$request->contesto;
        $encuestares->comentario_encuesta=$request->comentario_encuesta;
        $encuestares->save();
        $gos_os_encuesta_id=$encuestares->gos_os_encuesta_id;

        $CVScliente =$request->canvas; // your base64 encoded
        $CVScliente = str_replace('data:image/png;base64,', '', $CVScliente);
        $CVScliente = str_replace(' ', '+', $CVScliente);
        $inventarioV = Gos_Os_Encuesta::where('gos_os_encuesta_id',$gos_os_encuesta_id)->first();
        $id = $request->gos_os_id;
        if ($inventarioV->firma_cliente==NUll) {
          $inventarioV->firma_cliente= "storage/img/firmasOS/Inventario/fce".$id.".png";
          Storage::disk('public')->put("img/firmasOS/Inventario/fce".$id.".png", base64_decode($CVScliente));
        }
        
       $inventarioV->save();
    //    return($inventarioV); 

        $repuestas = $request->check;
        if($repuestas!==null){
            foreach($repuestas as $res){
                $Preguntaitem = Gos_Encuesta_Respuestas::where('gos_encuesta_respuestas_id',$res)->first('pregunta_id');
                $encuestaresitem = new Gos_Os_Encuesta_Item();
                $encuestaresitem->gos_os_encuesta_id=$gos_os_encuesta_id;                
                $encuestaresitem->gos_enc_preguntas_id= $Preguntaitem->pregunta_id;   
                $encuestaresitem->gos_encuesta_respuestas_id=$res;            
                
                $encuestaresitem->save();

            }
        }

        $entregarOS = Gos_OS::find($id);
        $entregarOS->fecha_entregado = date("Y-m-d H:i:s"); 
        $entregarOS->save();
        return redirect('/ordenes-serv/Entregadas');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idtaller=Session::get('taller_id');
        $listaEncItems = Gos_Encuesta_Item::where('gos_taller_id',$idtaller)->get();
        $listaRespuestas = Gos_Encuesta_Respuestas::all();
        $listaPreguntas = Gos_Enc_Preguntas::where('gos_taller_id',$idtaller)->get();
        $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();

        // dd($listaAseguradora);
        $compact = compact('listaRespuestas','listaAseguradora','listaPreguntas','listaEncItems');

        return view('Encuesta/agregarEncuesta',$compact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return($request);
        if($request->tipo_respuesta==1){
            $encuestaitem = new Gos_Encuesta_Respuestas();
            $encuestaitem->tipo_respuestas="Si";       
            $encuestaitem->pregunta_id=$request->pregunta;
            $encuestaitem->save();
            
            $encuestaitem = new Gos_Encuesta_Respuestas();
            $encuestaitem->tipo_respuestas="No";       
            $encuestaitem->pregunta_id=$request->pregunta;
            $encuestaitem->save();
        }
        if($request->tipo_respuesta==2){
            $respuestasVarias = $request->respuesta;
            foreach($respuestasVarias as $respuesta){
                if($respuesta!==null){
                $encuestaitem = new Gos_Encuesta_Respuestas();
                $encuestaitem->tipo_respuestas=$respuesta;       
                $encuestaitem->pregunta_id=$request->pregunta;
                $encuestaitem->save();
                }
            }
        }
       
        
        $idtaller=Session::get('taller_id');
        $preguntas = $request->tipo_respuesta_1;
        $encuesta = new Gos_Encuesta();
        $encuesta->nombre_encuesta=$request->nombre_encuesta;
        $encuesta->descripcion=$request->descripcion_encuesta;
        $encuesta->fecha= date("Y-m-d H:i:s");
        $encuesta->gos_aseguradora_id=$request->Aseguradora;
        $encuesta->gos_taller_id=$idtaller;

        $gos_encuesta_id=$encuesta->gos_encuesta_id;
        $arrayrespuestas=$request->tipo_respuesta_1;

        return  redirect('/gestion-encuestas');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_encuesta_id)
    {
        
        $idtaller=Session::get('taller_id');
        $encuestadata = Gos_Encuesta::where('gos_taller_id',$idtaller)->where('gos_encuesta_id',$gos_encuesta_id)->first();
        $encuestavista = Gos_V_Encuestas::where('gos_taller_id',$idtaller)->where('gos_encuesta_id',$gos_encuesta_id)->get();
        // $listaEncItems = DB::select( DB::raw('SELECT gei.*, gep.pregunta FROM gos_encuesta_item gei 
        // LEFT JOIN gos_enc_preguntas gep ON gep.gos_enc_preguntas_id = gei.gos_encuesta_pregunta_id
        // WHERE gos_os_encuesta_id = '.$gos_os_encuesta_id.''));
            $Itemsenc = DB::table('gos_encuesta_item as gei')
            ->leftJoin('gos_enc_preguntas as gep', 'gei.gos_encuesta_pregunta_id', '=', 'gep.gos_enc_preguntas_id')
            ->select( DB::raw('gei.*, gep.pregunta'))
            ->where('gei.gos_taller_id',$idtaller)
            ->where('gei.gos_encuesta_id',$gos_encuesta_id)
            ->get();

        $listaRespuestas = Gos_Encuesta_Respuestas::all();
        $listaPreguntas = Gos_Enc_Preguntas::where('gos_taller_id',$idtaller)->get();
        $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
        $aseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$encuestadata->gos_aseguradora_id)->first();
        $compact = compact('encuestadata','encuestavista','aseguradora','listaRespuestas','listaAseguradora','listaPreguntas','Itemsenc');
        return view('Encuesta/editarEncuesta',$compact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function GuardarEncuesta(Request $request){
        $idtaller=Session::get('taller_id');
        
        
        $encuesta = new Gos_Encuesta();
        $encuesta->nombre_encuesta=$request->nombre_encuesta;
        $encuesta->descripcion=$request->descripcion_encuesta;
        $encuesta->fecha= date("Y-m-d H:i:s");
        $encuesta->gos_aseguradora_id=$request->Aseguradora;
        $encuesta->gos_taller_id=$idtaller;
        $encuesta->save();
        $gos_encuesta_id=$encuesta->gos_encuesta_id;
        $preguntasVarias = $request->appendQuestions;
        foreach($preguntasVarias as $pregs){
            if($pregs!==null){
            $encuestaitem = new Gos_Encuesta_Item();
            $encuestaitem->gos_encuesta_id=$gos_encuesta_id;                
            $encuestaitem->gos_taller_id=$idtaller;   
            $encuestaitem->gos_encuesta_pregunta_id=$pregs;            
            
            $encuestaitem->save();
            }
        }


        return redirect('/gestion-encuestas');      
    }

    public function BorrarEncuesta($idencuesta){
        
        $itemencuesta = Gos_Encuesta_Item::where('gos_encuesta_id',$idencuesta)->get();
        $encuesta = Gos_Encuesta::find($idencuesta);
        $encuesta->delete();

        return redirect('/gestion-encuestas');
    }

    public function GuardarPregunta(Request $request){
        $idtaller=Session::get('taller_id');
        
        $encuestaitem = new Gos_Enc_Preguntas();
        $encuestaitem->pregunta=$request->name;       
        $encuestaitem->gos_taller_id=$idtaller;
        $encuestaitem->save();
        $idcon=$encuestaitem->gos_enc_preguntas_id;
        return ($idcon);     
    }
    public function EditarPregunta($idpregunta){
             
        $respuestas = Gos_Encuesta_Respuestas::where('pregunta_id',$idpregunta)->get();
        $PreguntaUnica = Gos_Enc_Preguntas::find($idpregunta);       
         $compact = compact('PreguntaUnica','respuestas');
        return ($compact);
        
    }
    public function ActualizarPregunta(Request $request){
        $gos_enc_preguntas_id = $request->gos_enc_preguntas_id;        
        $preguntaitem = Gos_Enc_Preguntas::find($gos_enc_preguntas_id);     
        $preguntaitem->pregunta=$request->pregunta_editar;  
        $preguntaitem->update();
        // $respuestasedit = $request->respuestaid;
        // $respuestasVarias = $request->respuesta;
        // $respuestas = Gos_Encuesta_Respuestas::where('pregunta_id',$idpregunta)->get();
       
        // $name = $request->input('respuestaid');

        return ($request);

            foreach($respuestasedit as $resedit){     
                
                $resedit = Gos_Encuesta_Respuestas::find($resedit);
                // $resedit->tipo_respuestas = $res;
                // $resedit->update();           
                
            }
        

        

         
        // foreach($respuestasVarias as $respuesta){
        //     if($respuesta!==null){
        //         $encuestaitem = new Gos_Encuesta_Respuestas();
        //         $encuestaitem->tipo_respuestas=$respuesta;       
        //         $encuestaitem->pregunta_id=$request->pregunta;
        //         $encuestaitem->update();
        //     }
        // }

        return ($request)   ;   
    }


    public function BorrarPregunta($idpregunta){
        $encuesta = Gos_Enc_Preguntas::find($idpregunta);
        $encuesta->delete();
        return redirect('/gestion-encuestas');
    }

}
