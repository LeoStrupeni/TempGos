<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Sprt_Ticket;
use App\Gos\Sprt_Message;
use session;
use Illuminate\Support\Facades\DB;
/**
 *
 * @author yois
 *
 */
class SoporteController extends GosControllers
{
  public function index()
  {
    $ticketList = Sprt_Ticket::all();
    return view("Soporte/SoporteIndex",compact('ticketList'));
  }
  public function agregarTicket(Request $request)
  {

    $validatedData = $request->validate([
        'nombre'  => 'required|max:255',
        'desc' => 'required|max:255',
        'modulo'  => 'required|max:255'
    	],
    $messages = [
    'nombre.required' => 'Inserte el nombre',
    'desc.required' => 'Inserte su descripcion',
    'modulo.required' => 'Inserte el modulo'
  ]);
    if($request->modulo == null) $request->modulo ="Otro";
    $ticket = new Sprt_Ticket;
    $ticket->nombre = $request->nombre;
    $ticket->descripcion = $request->desc;
    $ticket->modulo = $request->modulo;
    $ticket->created_at = date("Y-m-d H:i:s");
    $ticket->gos_taller_id = Session::get('taller_id');
    $user=Session::get('usr_Data');
    $ticket->gos_usuario_id =  $user->gos_usuario_id;

    $ticket->save();

    $message = new Sprt_Message;
    $message->ticket_id = $ticket->id;
    $message->mensaje = $request->com;
    $message->gos_taller_id = Session::get('taller_id');
    $message->created_at = date("Y-m-d H:i:s");
    $user=Session::get('usr_Data');
    $message->gos_usuario_id =  $user->gos_usuario_id;
    $message->archivo = $request->archivo;
    $message->save();



    return back()->with('notification','Se agrego correctamente el ticket');;
  }
  public function mensaje($id)
  {

    $tallerid=Session::get('taller_id');
    $messages = DB::select("select * from sprt_message where ticket_id =".$id." and gos_taller_id=".$tallerid);
    //$ticket = DB::select("select * from  sprt_ticket where id=".$id." and gos_taller_id=".$tallerid);
    $ticket=Sprt_Ticket::where('id',$id)->where('gos_taller_id',$tallerid)->first();

  //  return($tickt);
    return view("Soporte/SoporteMensaje",compact('ticket','messages'));
  }
  public function mensajePost(Request $request)
  {
    $validatedData = $request->validate([
        'mensaje'  => 'required'

    	],
    $messages = [
    'mensaje.required' => 'Inserte el mensaje'
     ]);
    $usr= Session::get('usr_Data');
    $tallerid=Session::get('taller_id');
    $message = new Sprt_Message;
    $message->ticket_id = $request->id;
    $message->mensaje = $request->mensaje;
    $message->gos_taller_id = Session::get('taller_id');
    $message->gos_usuario_name = $usr->nombre_apellidos;
    $message->created_at = date("Y-m-d H:i:s");
    $message->visible = 1;
    $user=Session::get('usr_Data');
    $message->gos_usuario_id =  $user->gos_usuario_id;
    $message->save();

    $messages = DB::select("select * from sprt_message where ticket_id =".$request->id." and gos_taller_id=".$tallerid);

    return back()->with("notification","Comentario agregado");
  }
}
