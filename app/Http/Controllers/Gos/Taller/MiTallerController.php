<?php

namespace App\Http\Controllers\Gos\Taller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Gos\Gos_Licencia;
use App\Gos\Gos_Lic_Taller_Usuario;
use App\Gos\Gos_Usuario;
use App\Gos\Gos_Usuario_Rol;
use App\Gos\Gos_Usuario_Perfil;
use App\Gos\Gos_V_Usuarios;
use App\Gos\Gos_Taller;
use App\Gos\Gos_Taller_Facturacion;
use App\Gos\Gos_Taller_Horarios;
use App\Gos\Gos_Taller_Tipo;
use App\Gos\Gos_Region_Colonia;
use App\Gos\Gos_Region_Estado;
use App\Gos\Gos_Region_Localidad;
use App\Gos\Gos_Region_Ciudad;
use App\Gos\Gos_Taller_Descripcion;
use App\Gos\Gos_Taller_Conf_gen;
use App\Gos\Gos_Taller_Conf_Os;
use App\Gos\Gos_Taller_Conf_admin;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Zona_Horaria;
use App\Gos\Gos_Taller_Horas_Habil;
use \Response;

use Session;

class MiTallerController extends Controller
{


public function index(){
  $estados=Gos_Region_Estado::all();
  $ciudades=Gos_Region_Ciudad::all();
  $usuario=Session::get('usr_Data');
  $taller=Gos_Taller::find($usuario->gos_taller_id);
  $factaller=Gos_Taller_Facturacion::find($usuario->gos_taller_id);
  $ciudadsel=Gos_Region_Ciudad::where('gos_region_ciudad_id', $taller->gos_region_ciudad_id)->first();
  $estadosel=Gos_Region_Estado::where('gos_region_estado_id', $ciudadsel->gos_region_estado_id)->first();
  $factaCDselected=Gos_Region_Ciudad::where('gos_region_ciudad_id', $factaller->dir_fiscal_region_ciudad_id)->first();
  $thorarios=Gos_Taller_Horarios::where('gos_taller_id', $taller->gos_taller_id)->get();
  $descripcion=Gos_Taller_Descripcion::find($usuario->gos_taller_id);
  $Listazona_horarias = Gos_Zona_Horaria::all();
  $taller_conf_gen = Gos_Taller_Conf_Gen::where('gos_taller_id', $usuario->gos_taller_id)->first();
  $taller_conf_os = Gos_Taller_Conf_Os::where('gos_taller_id', $usuario->gos_taller_id)->first();
  $taller_conf_admin = Gos_Taller_Conf_Admin::where('gos_taller_id', $usuario->gos_taller_id)->first();
  $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
  $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
  if($taller->taller_lototipo!=null || $taller->taller_lototipo==" "){$logo=Storage::url($taller->taller_lototipo);}
  else{  $logo = '\img\logostalleres\logo.png';}

  $fotos_taller_1 = '\storage\img\taller\fototaller_'.$usuario->gos_taller_id.'_1.png';
  $fotos_taller_2 = '\storage\img\taller\fototaller_'.$usuario->gos_taller_id.'_2.png';
  $fotos_taller_3 = '\storage\img\taller\fototaller_'.$usuario->gos_taller_id.'_3.png';

//$sad = '\storage'.$taller->img1;
  $fotostaller = array(
    "foto1" => $fotos_taller_1,
    "foto2" => $fotos_taller_2,
    "foto3" => $fotos_taller_3
);

    return view('Taller/MiTaller')->with(compact('fotostaller','fotos_taller_1','fotos_taller_2','fotos_taller_3','taller', 'factaller', 'estados', 'ciudades', 'thorarios',  'descripcion',
    'estadosel', 'Listazona_horarias', 'taller_conf_os', 'taller_conf_gen', 'taller_conf_admin', 'taller_conf_ase', 'taller_conf_vehiculo','factaCDselected','logo'
     ));
}


    public function store(Request $request)
    {
        $usuario=Session::get('usr_Data');
        $taller=Gos_Taller::find($usuario->gos_taller_id);
        $thorarios=Gos_Taller_Horarios::where('gos_taller_id', $taller->gos_taller_id)->get();
        $descripcion=Gos_Taller_Descripcion::find($taller->gos_taller_id);
        if ($descripcion!=null) {
            $descripcion->descripcion=$request->Descripción_general;
            $descripcion->save();
        } else {
            $descripcion= new  Gos_Taller_Descripcion();
            $descripcion->gos_taller_id=$taller->gos_taller_id;
            $descripcion->descripcion=$request->Descripción_general;
            $descripcion->save();
        }

        $taller->taller_nomb=$request->TallerNomb;
        $taller->codigo_taller=$request->TallerCod;
        $taller->propietario_nombre=$request->NombrePropietario;
        $taller->propietario_apellidos=$request->PropietarioApellidos;
        $taller->propietario_tel_movil=$request->CelularPropietario;
        $taller->propietario_tel_fijo=$request->TelefonoPropietario;
        $taller->propietario_email=$request->CorreoPropietario;
        $taller->correo_respuestas=$request->CorreoRespuestas;
        $taller->correo_refacciones=$request->CorreoRef;
        $taller->taller_tel_principal=$request->TallerTelefonoPrincipal;
        $taller->taller_direccion=$request->DireccionTaller;
        $taller->taller_colonia=$request->Tallercolonia;
        $taller->taller_municipio=$request->Tallermunicipio;
        $taller->gos_region_ciudad_id=$request->ciudadtaller;
        $taller->save();
         foreach ($thorarios as $horario) {
           $horario->dia_desde=$request->input('diadesde'.$horario->gos_taller_horarios_id);
           $horario->dia_hasta=$request->input('diahasa'.$horario->gos_taller_horarios_id);
           $horario->hora_desde=$request->input('hora_desde'.$horario->gos_taller_horarios_id);
           $horario->hora_hasta=$request->input('hora_hasta'.$horario->gos_taller_horarios_id);
           $horario->save();
         }
         $Mhorarios=$request->lengthhorarios;
         if ($Mhorarios>0) {
            for ($i=1; $i <= $Mhorarios ; $i++) {
             $nhorario= new Gos_Taller_Horarios();

             if($request->input($i.'diadesde')!=null){
              $nhorario->dia_desde=$request->input($i.'diadesde');}
             else{$nhorario->dia_desde='lunes';}

             if($request->input($i.'diahasta')!= null)
             {
               $nhorario->dia_hasta=$request->input($i.'diahasta');
             }else {
               $nhorario->dia_hasta="viernes";
             }

             if ($request->input($i.'horadesde') != null) {
               $nhorario->hora_desde=$request->input($i.'horadesde');
             }else {
               $nhorario->hora_desde="9:00 AM";
             }

             if ($request->input($i.'horahasta') != null) {
               $nhorario->hora_hasta=$request->input($i.'horahasta');
             }else {
                $nhorario->hora_hasta="9:00 PM";
             }

             $nhorario->gos_taller_id=$taller->gos_taller_id;
             $nhorario->save();
            }
         }
         $this->Adaptarhorashabi($taller->gos_taller_id);
        return back()->with('notification', 'Datos actualizados correctamente');
    }
    public function storefacturacion(Request $request)
    {

        $usuario=Session::get('usr_Data');
        $factaller=Gos_Taller_Facturacion::find($usuario->gos_taller_id);

        $factaller->razon_social=$request->razon_social;
        $factaller->rfc=$request->rfc;
        $factaller->tipo_persona=$request->gos_fac_tipo_persona_id;
        $factaller->regimen_fiscal=$request->regimen_fiscal;
        $factaller->email_direccion=$request->email_direccion;
        $factaller->dir_fiscal_cod_postal=$request->dir_fiscal_cod_postal;
        $factaller->dir_fiscal_nro_int=$request->dir_fiscal_nro_int;
        $factaller->dir_fiscal_nro_ext=$request->dir_fiscal_nro_ext;
        $factaller->dir_fiscal_direccion=$request->dir_fiscal_direccion;
        $factaller->dir_fiscal_municipio=$request->Fac_municipio;
        $factaller->dir_fiscal_colonia=$request->Fac_Colonia;
        $factaller->dir_fiscal_region_ciudad_id=$request->gos_region_ciudad_id;
        $factaller->dir_fiscal_cta_pago=$request->cuenta_pago;
        $factaller->indiciaciones_fac=$request->Indicacionesfacturacion;
        //--------------------------------TIMBRADO---------------------------------
        $factaller->sello_clave=$request->selloclave;
        $factaller->sello_numero=$request->sellonumero;
        //dd($request->sellos_certificado,$request->sellos_certisellos_llaveficado);
        if ($request->hasFile('sellos_certificado')) {
          $archivecer = base64_encode(file_get_contents($request->file('sellos_certificado')));
           $factaller->sello_certificado=$archivecer;
          }
        if ($request->hasFile('sellos_llave')) {
          $archivekey = base64_encode(file_get_contents($request->file('sellos_llave')));
          $factaller->sello_llave=$archivekey;
          }


        $factaller->save();
        return back()->with('notification', 'Datos Facturacion actualizados correctamente');
    }

    public function storeconfiguracion(Request $request)
    {
        $usuario=Session::get('usr_Data');
        $taller_conf_gen = Gos_Taller_Conf_gen::find($usuario->gos_taller_id);
        if ($taller_conf_gen==NULL) {$taller_conf_gen=new Gos_Taller_Conf_gen();}
        $taller_conf_gen->gos_taller_id = $usuario->gos_taller_id;
        $taller_conf_gen->gos_zona_horaria_id = $request->gos_zona_horaria_id;
        $taller_conf_gen->pie_pag_notas_remision = $request->pie_pag_notas_remision;
        $taller_conf_gen->pie_pagina_compras = $request->pie_pagina_compras;
        $taller_conf_gen->pie_pagina_hoja_viajera = $request->pie_pagina_hoja_viajera;
        $taller_conf_gen->iva = $request->iva;
        $taller_conf_gen->save();


        $taller_conf_os = Gos_Taller_Conf_Os::find($usuario->gos_taller_id);
        if ($taller_conf_os==NULL) {$taller_conf_os=new Gos_Taller_Conf_Os();}
        $taller_conf_os->gos_taller_id = $usuario->gos_taller_id;

        if ( $request->minimo_fotos=="on") {
            $taller_conf_os->minimo_fotos = 1;
        }else {$taller_conf_os->minimo_fotos = 0;}
        if (  $request->ocultar_riesgo=="on") {
            $taller_conf_os->ocultar_riesgo = 1;
        }else {$taller_conf_os->ocultar_riesgo = 0;}
        if (  $request->ocultar_orden=="on") {
          $taller_conf_os->ocultar_orden =1;
        }else {$taller_conf_os->ocultar_orden = 0;}
        if (  $request->etapa_simultanea=="on") {
          $taller_conf_os->etapa_simultanea =1;
        }else {$taller_conf_os->etapa_simultanea = 0;}
        $taller_conf_os->save();

        $taller_conf_admin = Gos_Taller_Conf_admin::find($usuario->gos_taller_id);
        if ($taller_conf_admin==NULL) {$taller_conf_admin=new Gos_Taller_Conf_admin();}
        $taller_conf_admin->gos_taller_id = $usuario->gos_taller_id;
        $taller_conf_admin->proc_adicional_prod = $request->proc_adicional_prod;
        $taller_conf_admin->costo_adq_mini_venta = $request->costo_adq_mini_venta;
        $taller_conf_admin->iva_preseleccionado = $request->iva_preseleccionado;
        $taller_conf_admin->habilitar_facturacion = $request->habilitar_facturacion;
        $taller_conf_admin->save();

        $taller_conf_ase = Gos_Taller_Conf_ase::find($usuario->gos_taller_id);
        if ($taller_conf_ase==NULL) {$taller_conf_ase=new Gos_Taller_Conf_ase();}
        $taller_conf_ase->gos_taller_id = $usuario->gos_taller_id;
        $taller_conf_ase->nomb_campo_ase = $request->nomb_campo_ase;
        $taller_conf_ase->nomb_campo_poliza = $request->nomb_campo_poliza;
        $taller_conf_ase->nomb_campo_siniestro = $request->nomb_campo_siniestro;
        $taller_conf_ase->nomb_campo_reporte = $request->nomb_campo_reporte;
        $taller_conf_ase->save();

        $taller_conf_vehiculo = Gos_Taller_Conf_vehiculo::find($usuario->gos_taller_id);
          if ($taller_conf_vehiculo==NULL) {$taller_conf_vehiculo=new Gos_Taller_Conf_vehiculo();}
        $taller_conf_vehiculo->gos_taller_id = $usuario->gos_taller_id;
        $taller_conf_vehiculo->nomb_modulo_camp_vehiculo = $request->nomb_modulo_camp_vehiculo;
        $taller_conf_vehiculo->nomb_marca = $request->nomb_marca;
        $taller_conf_vehiculo->nomb_modelo = $request->nomb_modelo;
        $taller_conf_vehiculo->nomb_anio = $request->nomb_anio;
        $taller_conf_vehiculo->nomb_color = $request->nomb_color;
        $taller_conf_vehiculo->nomb_placa = $request->nomb_placa;
        $taller_conf_vehiculo->nomb_economico = $request->nomb_economico;
        $taller_conf_vehiculo->nros_serie_unicos = $request->nros_serie_unicos;
        $taller_conf_vehiculo->ocultar_campos_adicionales = $request->ocultar_campos_adicionales;
        $taller_conf_vehiculo->save();

        return back()->with('notification', 'Datos actualizados correctamente');
    }

    public function cargarDir()
    {
      $usuario=Session::get('usr_Data');
      $fotos_taller_1 = '\storage\img\taller\fototaller_'.$usuario->gos_taller_id.'_1.png';
      $fotos_taller_2 = '\storage\img\taller\fototaller_'.$usuario->gos_taller_id.'_2.png';
      $fotos_taller_3 = '\storage\img\taller\fototaller_'.$usuario->gos_taller_id.'_3.png';

      $fotostaller = array(
        "foto1" => $fotos_taller_1,
        "foto2" => $fotos_taller_2,
        "foto3" => $fotos_taller_3
    );
      return Response::json($fotostaller);
    }

    public function subirImg(Request $request) {

      $usuario=Session::get('usr_Data');
      $taller=Gos_Taller::find($usuario->gos_taller_id);
      $logo =$request->imag;
      $logo = str_replace('data:image/png;base64,', '', $logo);
      $logo = str_replace(' ', '+', $logo);

      if($request->id == 1)
        $taller->img1="img/taller/fototaller_".$taller->gos_taller_id."_".$request->id.".png";
        if($request->id == 2)
          $taller->img2="img/taller/fototaller_".$taller->gos_taller_id."_".$request->id.".png";
          if($request->id == 3)
            $taller->img3="img/taller/fototaller_".$taller->gos_taller_id."_".$request->id.".png";

      Storage::disk('public')->put("img/taller/fototaller_".$taller->gos_taller_id."_".$request->id.".png", base64_decode($logo));
      $taller->save();
  //  return $request->id;
      return("imagen Guardada");
    }



    public function consultarBD(Request $request)//retorna datos para el side menu
    {
      $usuario=Session::get('usr_Data');
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      return(compact('taller_conf_vehiculo'));
    }

    public function LogoTaller(Request $request){
      $usuario=Session::get('usr_Data');
      $taller=Gos_Taller::find($usuario->gos_taller_id);
      $logo =$request->logo;
      $logo = str_replace('data:image/png;base64,', '', $logo);
      $logo = str_replace(' ', '+', $logo);
      $taller->taller_lototipo="img/taller_logotipo/logotaller".$taller->gos_taller_id.".png";
      Storage::disk('public')->put("img/taller_logotipo/logotaller".$taller->gos_taller_id.".png", base64_decode($logo));
      $taller->save();
      return("imagen Guardada");
    }

    public function Adaptarhorashabi($id){
      $horacalc=0;
        $horariosegmen=Gos_Taller_Horas_Habil::where('gos_taller_id', $id)->delete();
         $diadesde=0; $diahasta=0; $cadres="dias : ";
         $thorarios=Gos_Taller_Horarios::where('gos_taller_id', $id)->get();
         $lenthorarios=count($thorarios);
        if ($lenthorarios>0) {
         foreach ($thorarios as $horario) {
                   switch ($horario->dia_desde) {
                               case "Domingo":
                                    $diadesde=1;
                                   break;
                                case "Lunes":
                                     $diadesde=2;
                                    break;
                                case "Martes":
                                    $diadesde=3;
                                    break;
                                case "Miercoles":
                                     $diadesde=4;
                                    break;
                                case "Jueves":
                                    $diadesde=5;
                                    break;
                                case "Viernes":
                                    $diadesde=6;
                                    break;
                                case "Sabado":
                                     $diadesde=7;
                                    break;
                            }
                  switch ($horario->dia_hasta) {
                                case "Domingo":
                                     $diahasta=1;
                                    break;
                                 case "Lunes":
                                      $diahasta=2;
                                     break;
                                 case "Martes":
                                     $diahasta=3;
                                     break;
                                 case "Miercoles":
                                      $diahasta=4;
                                     break;
                                 case "Jueves":
                                     $diahasta=5;
                                     break;
                                 case "Viernes":
                                     $diahasta=6;
                                     break;
                                 case "Sabado":
                                      $diahasta=7;
                                     break;
                             }
                  for ($i=$diadesde; $i <=$diahasta ; $i++) {
                        $horah= new Gos_Taller_Horas_Habil();
                        $horah->gos_taller_id=$id;
                        $horah->dia=$i;
                        $horah->dia_hora_inicio=$horario->hora_desde;
                        $horah->dia_hora_fin=$horario->hora_hasta;
                        $horah->save();
                      }
         }
        $horariosegmen=Gos_Taller_Horas_Habil::where('gos_taller_id', $id)->orderby('dia')->get();

        $len=count($horariosegmen);
                for ($i=0; $i <$len; $i++) {
                          if ($i+1<$len) {
                            $horafin = strtotime($horariosegmen[$i]->dia_hora_fin)/3600;
                            $horaini = strtotime($horariosegmen[$i+1]->dia_hora_inicio)/3600;
                              $horacalc=$horaini-$horafin;
                           if ($horacalc<0) {
                             $horacalc=$horacalc+24;
                           }
                          }
                        $horariosegmen[$i]->horas_muertas=$horacalc;
                        $horariosegmen[$i]->save();
                    }
                    $diasdead=0;$horasdead=0;$horafindia=0;$horainicio=0;
                    $diasdead=((($horariosegmen[$len-1]->dia)-7)*-1);
                    $horasdead=$diasdead*24;
                    $horafindia= strtotime($horariosegmen[$len-1]->dia_hora_fin)/3600;
                    $horafindia=(($horafindia-24)*-1);
                    $horainicio=strtotime($horariosegmen[0]->dia_hora_inicio)/3600;
                    $horainicio=$horainicio+(($horariosegmen[0]->dia-1)*24);
                    $horasdead=$horasdead+$horafindia+$horainicio;
                    $horariosegmen[$len-1]->horas_muertas=$horasdead;
                    $horariosegmen[$len-1]->save();
     }}

        public function eliminarHorario($id)
        {
          Gos_Taller_Horarios::find($id)->delete();
          $usuario=Session::get('usr_Data');
          $taller=Gos_Taller::find($usuario->gos_taller_id);
          $this->Adaptarhorashabi($taller->gos_taller_id);
          return back()->with("notification","Eliminado correctamente");
        }

}// CLASS END
