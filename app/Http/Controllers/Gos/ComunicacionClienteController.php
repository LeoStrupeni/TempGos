<?php

namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_OS;
use App\Gos\Gos_V_Os_Generada;
use App\Gos\Gos_V_Os_Items;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_Os_Mensajes;
use App\Gos\Gos_V_Os_Mensajes;
use App\Gos\Gos_Vehiculo_Tipo;
use App\Gos\Gos_Os_Imagen_Cliente;
use App\Gos\Gos_Os_Imagen_Interna;
use App\Gos\Gos_Vehiculo_Inventario;
use App\Gos\Gos_Vehiculo_Inventario_Doc;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_Taller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Session;


class ComunicacionClienteController extends Controller
{

  public function seguimiento($token)
  {

    $valOS=Gos_OS::where('gos_os_token_seguimiento',$token)->first();

    if($valOS!=null){
        $gos_os_id=$valOS->gos_os_id;
        $idtaller=$valOS->gos_taller_id;
      $porcentajeavance=0;
      $os = Gos_V_Os_Generada::find($gos_os_id);
      $row_number = DB::select( DB::raw('SELECT *
      FROM gos_v_inicio_calendario
     WHERE  gos_taller_id='.$idtaller.' AND gos_os_id = '.$gos_os_id.'
     ORDER BY nro_orden_interno DESC
     '));
      $number = $row_number[0]->nro_orden_interno;
      $tallerid = $row_number[0]->gos_taller_id;
      $taller=Gos_Taller::where('gos_taller_id', $tallerid)->first();
      $logo =($taller->taller_lototipo);
      $listaEtapas = Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->orderByRaw('orden_etapa ASC')->get();
      $listaEtapasA = Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->orderByRaw('orden_etapa ASC')->get();
      $calctotal=Gos_Os_Item::where('gos_os_id',$gos_os_id)->get();
      $totaletapas=0.00;
      $countetapas= Gos_Os_Item::where('gos_os_id',$gos_os_id)->where('gos_paq_etapa_id','>',0)->count();
      $countetapasF= Gos_Os_Item::where('gos_os_id',$gos_os_id)->where('gos_paq_etapa_id','>',0)->where('estado_etapa','=','F')->count();
      $porcentajeavance=($countetapasF/$countetapas * 100);
      $porcentajeavance1= number_format((int)$porcentajeavance, 0, '.', '');
      $porcentajeavance2= round($porcentajeavance / 10) * 10;
      foreach ($calctotal as $etapa) {
         $totaletapas=$etapa->precio_etapa+$totaletapas;
      }
      $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();
      $listaImgCliente =  Gos_Os_Imagen_Cliente::where('gos_os_id',$gos_os_id)->get();
      $mensajes = Gos_V_Os_Mensajes::where('gos_os_id',$gos_os_id)->where('visble','=',1)->groupBy('fecha')->groupBy('cuerpo')->orderByRaw('gos_os_mensaje_id DESC')->get();
      // return($logo);
      $compact = array();
      // traer items de orden de servicio
      $compact = compact('os', 'listaEtapas','listaEtapasA','calctotal', 'listaTipoVehiculo','listaImgCliente','mensajes','totaletapas','countetapas','countetapasF','porcentajeavance','porcentajeavance1','porcentajeavance2','number','logo');

      return view('LigaSeguimiento', $compact);
    }

   return("Token Incorrecto");
  }

  public function Mensaje($token,Request $request){
    $valOS=Gos_OS::where('gos_os_token_seguimiento',$token)->first();
      if($valOS!=null){
        $gos_os_id=$valOS->gos_os_id;
        $hoy = date("Y-m-d H:i:s");
        $os = Gos_V_Os_Generada::find($gos_os_id);
        $nombrecl=$os->nombre." ".$os->apellidos;
        $mensaje= new Gos_Os_Mensajes();
        $mensaje->de="cliente";
        $mensaje->para="taller";
        $mensaje->fecha=$hoy;
        $mensaje->asunto="Mensaje";
        $mensaje->cuerpo=$request->comentarios;
        $mensaje->gos_os_id=$gos_os_id;
        $mensaje->gos_usuario_id=$os->gos_cliente_id;
        $mensaje->visble=1;
        $mensaje->leido=0;
        $mensaje->prioridad=0;
        $mensaje->save();
        return back();
    }
  }

  public function reenviarliga(Request $request){



        $hoy = date("Y-m-d H:i:s");

        $mensaje= new Gos_Os_Mensajes();
        $mensaje->de="taller";
        $mensaje->para="cliente";
        $mensaje->fecha=$hoy;
        $mensaje->asunto="Reenviar liga de seguimiento";
        $mensaje->cuerpo=$request->cuerpo_liga;
        $mensaje->gos_os_id=$request->idos_liga;
        $mensaje->gos_usuario_id=$request->userid;
        $mensaje->visble=1;
        $mensaje->leido=0;
        $mensaje->prioridad=0;
        $mensaje->gos_usuario_id=0;
        $mensaje->save();
        // return back();
        return($mensaje);

  }

  protected function revisarmensajes()
  {
      $usuario_id = Session::get('usr_Data');
      $usuario = $usuario_id['gos_usuario_id'];
      $idtaller=Session::get('taller_id');

      $os = DB::select( DB::raw("SELECT *
      FROM gos_v_os_mensajes
      WHERE gos_taller_id = ".$idtaller." AND leido != 2  AND (gos_usuario_envio = ".$usuario." OR de = 'cliente') AND leido != 2
      ORDER BY fecha DESC
     "));
      // $os = Gos_V_Os_Mensajes::where('gos_taller_id',$idtaller)->where('leido','!=',2)->where('para','taller')->get();
      //$os = Gos_V_Os_Mensajes::where('gos_taller_id',$idtaller)->where('gos_usuario_envio',$usuario)->orWhere('gos_usuario_envio', 0)->where('para','taller')->where('leido',0)->get();
      return ($os);
  }

  protected function mensajes($gos_os_mensaje_id)
  {
      // $os = Gos_V_Os_Mensajes::where('gos_taller_id',Session::get('taller_id'))->get();
      $idtaller=Session::get('taller_id');
      $usuario_id = Session::get('usr_Data');
      $usuario = $usuario_id['gos_usuario_id'];
      $listaAdmin = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id',1)->get();
      $os = Gos_V_Os_Mensajes::where('gos_os_mensaje_id',$gos_os_mensaje_id)->first();
      $mensaje = Gos_Os_Mensajes::find($gos_os_mensaje_id);
      $mensaje->timestamps = false;
      $mensaje->leido = 1;
      $mensaje->save();

      $compact = compact('listaAdmin','os','usuario');
      // dd($compact);
      return ($compact);
  }

  protected function send(Request $request)
  {
    $hoy = date("Y-m-d H:i:s");
      $usuario_id = Session::get('usr_Data');

      $mensaje = Gos_Os_Mensajes::find($request->gos_os_mensaje_id);
      $mensaje->leido = 2;
      $mensaje->save();

      $usuario = $usuario_id['gos_usuario_id'];
      $gos_mensaje_id = $request->gos_mensaje_id;

        $para  = '';
        if($request->visibleCliente1 == 'on'){
            $check =  1;
            $para = 'cliente';
        }
        else{
            $check =  0;
            $para = 'taller';
        }
      if($request->gos_usuario_envio==null){
        $mensaje = new Gos_Os_Mensajes();
        $mensaje->timestamps = false;
        $mensaje->de = "taller";
        $mensaje->para = $para;
        $mensaje->fecha = $hoy;
        $mensaje->asunto =  "Comentario Taller";
        $mensaje->cuerpo=$request->comentarios;
        $mensaje->gos_os_id = $request->gos_os_id;
        $mensaje->leido = 0;
        $mensaje->prioridad = $request->Prioridad;
        $mensaje->gos_usuario_id = $request->usuario;
        $mensaje->visble = $check;
        $mensaje->gos_usuario_envio = $request->gos_usuario_envio;
          $mensaje->save();
      }

      if($request->gos_usuario_envio!==null){

        $arrequipoTr = $request->gos_usuario_envio;
        foreach($arrequipoTr as $equipoid){


            $mensaje = new Gos_Os_Mensajes();
            $mensaje->timestamps = false;
            $mensaje->de = "taller";
            $mensaje->para = $para;
            $mensaje->fecha = $hoy;
            $mensaje->asunto =  "Comentario Taller";
            $mensaje->cuerpo=$request->comentarios;
            $mensaje->gos_os_id = $request->gos_os_id;
            $mensaje->leido = 0;
            $mensaje->prioridad = $request->Prioridad;
            $mensaje->gos_usuario_id = $request->usuario;
            $mensaje->visble = $check;
            $mensaje->gos_usuario_envio = $equipoid;
            // return ($request->usuario);
            $mensaje->save();


          }
      }

      return $gos_mensaje_id ;
        // $os = Gos_V_Os_Mensajes::where('gos_taller_id',Session::get('taller_id'))->where('leido',0)->get();

        // return Response::json($os);

      // // dd($request);
      // return $this->guardaJson($request);
  }
  protected function mensajeres($idmens){
      
      $mensaje = Gos_Os_Mensajes::find($idmens);
      $mensaje->leido = 2;
      $mensaje->save();
      return $mensaje;
  }
}
