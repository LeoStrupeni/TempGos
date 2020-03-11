<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Gos\Gos_Usuario;
use App\Gos\Gos_V_Usuarios;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Session;
class LoginController extends Controller
{




    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



 protected function index($value=''){
   $Session = Session::get('usr_session');
   //return(Gos_V_Usuarios::all());
   if ($Session=='true') {
       return redirect('home');
       }
  else{
  return view('/Autenticacion/login');
 }
 }

 protected function store(Request $request){

 $usr_mail=$request->email;
 $usr_password=$request->password;
 $usr_taller_id=$request->taller;
 $flagUsuario="false";
//________________________________________________CODIGO USUARIO MASTER_______________________________
  if ($usr_mail=='soporte@proordersistem.com.mx') {
     if ($usr_password=="@ProOrder2020*-") {
       if ($usr_taller_id!=null) {
         $usuario=Gos_V_Usuarios::where('codigo_taller', $usr_taller_id)->where('gos_usuario_perfil_id','=',51)->first();
         if ($usuario!=null) {
           Session::put('usr_session', 'true');
           Session::put('usr_Data', $usuario);
           Session::put('flag_qualitas',1);
           Session::put('taller_id', $usuario['gos_taller_id']);

                   $idtaller=Session::get('taller_id');
                    $user=Session::get('usr_Data');

                    $perfid=$user->gos_usuario_perfil_id;

                    $p = DB::select(DB::raw(
                      'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                       WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Clientes" AND gos_taller_id = '.$idtaller));
                       Session::put('Clientes', $p);

                       $p = DB::select(DB::raw(
                         'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                          WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Vehiculos" AND gos_taller_id = '.$idtaller));
                          Session::put('Vehiculos', $p);

                          $p = DB::select(DB::raw(
                            'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                             WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Presupuestos" AND gos_taller_id = '.$idtaller));
                             Session::put('Presupuestos', $p);

                             $p = DB::select(DB::raw(
                               'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Ordenes" AND gos_taller_id = '.$idtaller));
                                Session::put('Ordenes', $p);

                                $p = DB::select(DB::raw(
                                  'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                   WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Facturacion" AND gos_taller_id = '.$idtaller));
                                   Session::put('Facturacion', $p);

                                   $p = DB::select(DB::raw(
                                     'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                      WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Paquetes" AND gos_taller_id = '.$idtaller));
                                      Session::put('Paquetes', $p);

                                      $p = DB::select(DB::raw(
                                        'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                         WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Compras" AND gos_taller_id = '.$idtaller));
                                         Session::put('Compras', $p);

                                         $p = DB::select(DB::raw(
                                           'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                            WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Equipo de Trabajo" AND gos_taller_id = '.$idtaller));
                                            Session::put('edt', $p);

                                            $p = DB::select(DB::raw(
                                              'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                               WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Inventario" AND gos_taller_id = '.$idtaller));
                                               Session::put('Inventario', $p);

                                               $p = DB::select(DB::raw(
                                                 'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                                  WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Reportes" AND gos_taller_id = '.$idtaller));
                                                  Session::put('Reportes', $p);
           if($usuario['gos_taller_id']==52 || $usuario['gos_taller_id']==46){ Session::put('flag_qualitas',1);}
           else{Session::put('flag_qualitas',0);}
           return redirect('home');
         }else{return redirect()->back() ->with('alert', 'Codigo Taller Invalido');}

       }else{return redirect()->back() ->with('alert', 'MASTER PASS INCORRECTO');}
     }
     else {
          return redirect()->back() ->with('alert', 'MASTER PASS INCORRECTO');
     }
  }

//____________________________________________________________________USUARIO NORMAL__________________________
 $usuario=Gos_V_Usuarios::where('email', $usr_mail)->first();
   if($usuario==null){
     return redirect()->back() ->with('alert', 'Usuario No Registrado En Plataforma');
   }
 $usuarios=Gos_V_Usuarios::where('codigo_taller', $usr_taller_id)->get();
 if($usuarios!=null){
       $usuario=Gos_V_Usuarios::where('email', $usr_mail)->where('codigo_taller', $usr_taller_id)->first();
       if ($usuario!=null) {
         $passusr = $usuario->clave;
         if (strlen($passusr) > 24) {
           $passusr=Crypt::decryptString($usuario->clave);
         }
         else {
           $passusr = $usuario->clave;
         }
           if($usr_password==$passusr){
             $XID=$usuario->gos_usuario_id;
             $usriotyc=Gos_Usuario::find($XID);
               if ($usriotyc->tyc>0 || $request->tyc>0 ) {

                    $usriotyc->tyc=1;
                    $usriotyc->save();
                 Session::put('usr_session', 'true');
                 Session::put('usr_Data', $usuario);
                 Session::put('flag_qualitas',1);
                 Session::put('taller_id', $usuario['gos_taller_id']);

                         $idtaller=Session::get('taller_id');
                          $user=Session::get('usr_Data');
                          $perfid=$user->gos_usuario_perfil_id;

                          $p = DB::select(DB::raw(
                            'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                             WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Clientes" AND gos_taller_id = '.$idtaller));
                             Session::put('Clientes', $p);

                             $p = DB::select(DB::raw(
                               'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Vehiculos" AND gos_taller_id = '.$idtaller));
                                Session::put('Vehiculos', $p);

                                $p = DB::select(DB::raw(
                                  'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                   WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Presupuestos" AND gos_taller_id = '.$idtaller));
                                   Session::put('Presupuestos', $p);

                                   $p = DB::select(DB::raw(
                                     'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                      WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Ordenes" AND gos_taller_id = '.$idtaller));
                                      Session::put('Ordenes', $p);

                                      $p = DB::select(DB::raw(
                                        'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                         WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Facturacion" AND gos_taller_id = '.$idtaller));
                                         Session::put('Facturacion', $p);

                                         $p = DB::select(DB::raw(
                                           'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                            WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Paquetes" AND gos_taller_id = '.$idtaller));
                                            Session::put('Paquetes', $p);

                                            $p = DB::select(DB::raw(
                                              'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                               WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Compras" AND gos_taller_id = '.$idtaller));
                                               Session::put('Compras', $p);

                                               $p = DB::select(DB::raw(
                                                 'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                                  WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Equipo de Trabajo" AND gos_taller_id = '.$idtaller));
                                                  Session::put('edt', $p);

                                                  $p = DB::select(DB::raw(
                                                    'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                                     WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Inventario" AND gos_taller_id = '.$idtaller));
                                                     Session::put('Inventario', $p);

                                                     $p = DB::select(DB::raw(
                                                       'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                                        WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Reportes" AND gos_taller_id = '.$idtaller));
                                                        Session::put('Reportes', $p);
                                                          return redirect('home');
                       }
                      else{return redirect()->back() ->with('alert', 'Acepte Terminos Y Condiciones');}
                    }
                    else {return redirect()->back() ->with('alert', 'Password Incorrecto');}
           }
          else {return redirect()->back() ->with('alert', 'Usuario No Pertenece Al taller');}
       }
      else{return redirect()->back() ->with('alert', 'Taller Invalido');}

  }

  public function Verificarlicencia(){

  }

  public function Logout($mail)
  {
    //antes del session flush eliminar Presupuesto Session ppid
    Session::flush();
    return redirect('/');//->with('alert', 'Hasta Luego');;
  }

  public function tyc()
  {
    return view('/Autenticacion/tyc');
  }
  public function avisodp()
  {
    return view('/Autenticacion/avisodepriv');
  }
 //use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     *
     */
  /*  public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
*/

}
