<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Gos\Gos_V_Usuarios;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function index()
    {
    return view('/Autenticacion/restablecer');
    }

   protected function store(Request $request){
      $usr_mail=$request->email;
      $usuario=Gos_V_Usuarios::where('email', $usr_mail)->first();
        if($usuario!=null){
          $temppass=$this->generateRandomString(8);
          $body="Pro OrderSu Contraseña Temporal es:".$temppass."Gracias. Atentamente el equipo de Pro Order";
          return redirect('/')->with('alert', 'Contraseña Temporal Enviada');
        }
       return back()->with('alert', 'Usuario No Registrado');
   }

   public   function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
         }
         return $randomString;
     }


}
