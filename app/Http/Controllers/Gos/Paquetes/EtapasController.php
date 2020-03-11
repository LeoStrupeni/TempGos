<?php
namespace App\Http\Controllers\Gos\Paquetes;


use Illuminate\Http\Request;
use \Response;
use App\Http\Controllers\Gos\GosControllers;
use GosClases\Etapas;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_Paq_Etapa_Calc_Tiempo;
use App\Gos\Gos_Paq_Etapa_Perdida_Total;
use App\Gos\Gos_Paq_Etapa_Ligada;
use App\Gos\Gos_Paq_Etapa_Pago_Danios;
use App\Gos\Gos_Paq_Etapa_Mensaje;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_V_Min_Aseguradoras;
use App\GosClases\GosUtil;
use App\Gos\Gos_Docventa_Codigo_Sat;

use Session;
/**
 *
 * @author martin
 *
 */
class EtapasController extends GosControllers
{

    //
    private $_listaMensajeWhatsapp = array();

    private $_listaCalculoTiempo = array();

    protected $vistaListado = 'Etapas/ListarEtapas';

    protected $opcionesEditDataTable = 'Etapas.OpcionesEtapasDataTable';

    /**
     *
     * @return the $_listaMensajeWhatsapp
     */
    public function getListaMensajeWhatsapp()
    {
        return $this->_listaMensajeWhatsapp;
    }

    /**
     *
     * @return the $_listaCalculoTiempo
     */
    public function getListaCalculoTiempo()
    {
        return $this->_listaCalculoTiempo;
    }

    /**
     *
     * @param multitype: $_listaMensajeWhatsapp
     */
    public function setListaMensajeWhatsapp($_listaMensajeWhatsapp)
    {
        $this->_listaMensajeWhatsapp = $_listaMensajeWhatsapp;
    }

    /**
     *
     * @param multitype: $_listaCalculoTiempo
     */
    public function setListaCalculoTiempo($_listaCalculoTiempo)
    {
        $this->_listaCalculoTiempo = $_listaCalculoTiempo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $idtaller=Session::get('taller_id');

          $listaAseguradoras = Gos_V_Min_Aseguradoras::where('gos_taller_id', Session::get('taller_id'))->get();
          $listaAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', Session::get('taller_id'))->where('gos_usuario_rol_id', 1)->get();
          $listaEtapas = Gos_Paq_Etapa::where('gos_taller_id',$idtaller)->get();

          $listaEtapasPerdidasTotales = $listaEtapas;
          $listaEtapasLigadas = $listaEtapas;
          $listaEtapasDanios = $listaEtapas;

          $ajax = $this->preparaDataTableAjax($listaEtapas, $this->getOpcionesEditDataTable());
          if (null !== $ajax) {
              return $ajax;
          }
          $compact = compact('listaEtapasPerdidasTotales', 'listaEtapasLigadas', 'listaEtapasDanios', 'listaAsesores', 'listaAseguradoras','listaEtapas');


       

        return view('Etapas/ListarEtapas', $compact);
    }

    /**
     *
     * @param string $criterio
     * @return unknown
     */
    public static function listadoGeneral($criterio = '')
    {
      return Gos_V_Paq_Etapas::where('gos_taller_id', GosUtil::tallerIdActual());
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->guardaJson($request);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::guardaJson()
     */
    protected function guardaJson(Request $request, $id = 0)
    {
        /**
         *
         * @var Ambigous <\GosClases\NULL, \App\Gos\Gos_Paq_Etapa> $etapa
         */
        $etapa = Etapas::guardaEtapa($request);
        if ($etapa) {
            $this->setEntidad_id($etapa->gos_paq_etapa_id);
            $this->guardaDatosRelacionados($request);
        }
        return Response::json($etapa);
    }

    /**
     *
     * {@inheritdoc} guardar datos relacionads
     *               mensajes
     *               calc tiempo
     *               etapas perdidad total
     *               etapas ligadas
     *               etapas pago de daños
     *
     * @see \App\Http\Controllers\Gos\GosControllers::guardaDatosRelacionados()
     */
    protected function guardaDatosRelacionados($request)
    {
        $gos_paq_etapa_id = $this->getEntidad_id();
        // Mensajes Whatsapp
        $datosMensajeWhatsapp = Etapas::guardaMensajesWhatsapp($request, $gos_paq_etapa_id);
        // guardar cacl tiempo
        $datosCalcTiempo = Etapas::guardaCalculoTiempo($request, $gos_paq_etapa_id);
        // etapas ligadas
        $datosEtapasLigadas = Etapas::guardaEtapasLigadas($request, $gos_paq_etapa_id);
        // etapas perdidad total
        $datosEtapaPerdTotal = Etapas::guardaEtapasPerdidaTotal($request, $gos_paq_etapa_id);
        // etapas pago de daños
        $datosEtapasPagoDanios = Etapas::guardaEtapasPagoDanios($request, $gos_paq_etapa_id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Paq_Etapa $Gos_Paq_Etapa
     * @return \Illuminate\Http\Response
     */
    public function show($gos_paq_etapa_id)
    {
        $etapa = Etapas::obtenEtapaDatosPorID($gos_paq_etapa_id);
        return $gos_paq_etapa_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Paq_Etapa $Gos_Paq_Etapa
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_paq_etapa_id)
    {

        $etapa = Etapas::obtenEtapaDatosPorID($gos_paq_etapa_id);
        return $etapa;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Gos\Gos_Paq_Etapa $Gos_Paq_Etapa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Paq_Etapa $Gos_Paq_Etapa)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Paq_Etapa $Gos_Paq_Etapa
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_paq_etapa_id)
    {
        $etapa = Etapas::borra($gos_paq_etapa_id);
        return redirect()->back()->withErrors('Etapa Eliminada');
    }
    public function salvarOrden($gos_paq_etapa_id, $orden_etapa){
        $etapa = Gos_Paq_Etapa::find($gos_paq_etapa_id);
        $etapa->orden_etapa = $orden_etapa;
        $etapa->save();
        return $gos_paq_etapa_id;
    }
    /**
     *
     * @return array
     */
    protected function preparaCrearEditar()
    {
        $compact = Etapas::preparaListas();
        return $compact;
        // return compact('listaMensajeWhatsapp', 'listaCalculoTiempo', 'cant_mensajes', 'cant_calculo', 'listaEtapasPerdidasTotales', 'listaEtapasLigadas', 'listaEtapasDanios', 'listaAsesores', 'listaAseguradoras');
    }
    function agregaretapaget(){
      $listaAseguradoras = Gos_V_Min_Aseguradoras::where('gos_taller_id', Session::get('taller_id'))->get();
      $listaAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', Session::get('taller_id'))->where('gos_usuario_rol_id', 1)->get();
      $listaEtapas = Gos_Paq_Etapa::where('gos_taller_id', Session::get('taller_id'))->get();
      $listaEtapasPerdidasTotales = $listaEtapas;
      $listaEtapasLigadas = $listaEtapas;
      $listaEtapasDanios = $listaEtapas;
      $codigoSat = Gos_Docventa_Codigo_Sat::all();
      $compact = compact('listaAsesores','listaAseguradoras',
          'listaEtapas','listaEtapasPerdidasTotales','listaEtapasLigadas','listaEtapasDanios','codigoSat');
      return view('Etapas/AgregarEtapa', $compact);
    }
     public function agregaretapapost(Request $request){
       $rules =[
          'nomb_etapa'=>'required',
          'descripcion_etapa'=>'required',
          'gos_usuario_tecnico_id'=>'required',
          'tiempo_meta' => 'required',
       ];
     $messages=[
         'nomb_etapa.required'=>'Ingrese el nombre de la etapa',
         'descripcion_etapa.required'=>'Ingrese descripcion',
         'gos_usuario_tecnico_id.required'=>'Seleccione un Tecnico',
         'tiempo_meta.required'=>'Ingrese tiempo meta',
      ];
     $this->validate($request, $rules,$messages);
      $idtaller=Session::get('taller_id');
      $ultimaetapa=Gos_Paq_Etapa::where('gos_taller_id',$idtaller)->orderBy('orden_etapa','desc')->first();
     
     
        //_________________SAVE ETAPA gnrales________________________________
              $etapa=new Gos_Paq_Etapa();
              $etapa->nomb_etapa=$request->nomb_etapa;
              $etapa->gos_taller_id=$idtaller;
              if(isset($ultimaetapa)){
                $etapa->orden_etapa=$ultimaetapa->orden_etapa+1;
              }
              else{
                $etapa->orden_etapa=1;
              }
              $etapa->gos_usuario_tecnico_id=$request->gos_usuario_tecnico_id;
              $etapa->descripcion_etapa=$request->descripcion_etapa;
              $etapa->comision_asesor=$request->comision_asesor;
              $etapa->comision_asesor_tipo=$request->comision_asesor_tipo;
              $etapa->tiempo_meta=$request->tiempo_meta;
              $etapa->minimo_fotos=$request->minimo_fotos;
              $etapa->codigo_sat=$request->codigo_sat;
              $etapa->link=$request->link;
              $etapa->tipo=$request->tipo;

              if ($request->materiales=="on") {
                $etapa->materiales=1;
              }else {  $etapa->materiales=0; }

              if ($request->genera_valor=="on") {
                $etapa->genera_valor=1;
              }else {  $etapa->genera_valor=0; }

              if ($request->complemento=="on") {
                    $etapa->complemento=1;
              }else {  $etapa->complemento=0; }

              if ($request->refacciones=="on") {
                    $etapa->refacciones=1;
              }else {  $etapa->refacciones=0; }

              if ($request->checkperdida=="on") {
                $etapa->perdidatotal=1;
              }else {  $etapa->perdidatotal=0; }

              if ($request->checkpago=="on") {
              $etapa->pagodanios=1;
              }else {  $etapa->pagodanios=0; }

              if ($request->chekligada=="on") {
              $etapa->eligada=1;
              }else {  $etapa->eligada=0; }
              $etapa->save();
              $id=$etapa->gos_paq_etapa_id;
       //_________________Whats AppMessages________________________________
              if ($request->MensajesWSlength>0) {
                for ($i=1; $i <=$request->MensajesWSlength ; $i++) {
                  $mensaje=new Gos_Paq_Etapa_Mensaje();
                  $mensaje->mensaje_nomb=$request->Nmensaje[$i];
                  $mensaje->mensaje_cuerpo=$request->Nmensaje_cuerpo[$i];
                  $mensaje->gos_paq_etapa_id=$id;
                  $mensaje->save();
                }
              }
      //____________________CALC TIEMPO_____________________________________
             if ($request->caltiempolen>0) {
               for ($i=1; $i <= $request->caltiempolen; $i++) {
                  $ctmp=new Gos_Paq_Etapa_Calc_Tiempo();
                  $ctmp->gos_paq_etapa_id=$id;
                  $ctmp->gos_aseguradora_id=$request->NuevoCtiempoAseid[$i];
                  $ctmp->monto=$request->NuevoCtiempoMonto[$i];
                  $ctmp->save();
               }
            }
      //______________________PERDIDATOTAL_____________________________________

             if ($request->perdidalength>0) {
                for ($i=1; $i <=$request->perdidalength ; $i++) {
                  $per=new Gos_Paq_Etapa_Perdida_Total();
                  $per->gos_paq_etapa_id=$id;
                  $per->etapa_perdida_total_id_rel=$request->NPerdiodaEtapa[$i];
                  $per->gos_taller_id=$idtaller;
                  $per->orden=$request->NPerdiodaOrden[$i];
                  $per->save();
                }
             }

      //______________________ELIGADA_____________________________________

            if ($request->ligadalen>0) {
               for ($i=1; $i <=$request->ligadalen ; $i++) {
                 $per=new Gos_Paq_Etapa_Ligada();
                 $per->gos_paq_etapa_id=$id;
                 $per->etapa_ligada_relacionada=$request->NLigadaEtapa[$i];

                 $per->orden=$request->NLigadaOrden[$i];
                 $per->save();
               }
            }
      //______________________PAGODAÑOS_____________________________________

                if ($request->pagolen>0) {
                   for ($i=1; $i <=$request->pagolen ; $i++) {
                     $pd=new Gos_Paq_Etapa_Pago_Danios();
                     $pd->gos_paq_etapa_id=$id;
                     $pd->etapa_pago_danios_id_rel=$request->NPdanosEtapa[$i];
                     $pd->gos_taller_id=$idtaller;
                     $pd->orden=$request->NPdanosOrden[$i];
                     $pd->save();
                   }
                }
       return redirect('gestion-etapas');
    }



    public function editarget($id){
      $gral = Gos_V_Paq_Etapas::find($id);
      $etapa= Gos_Paq_Etapa::find($id);

      $msj = Gos_Paq_Etapa_Mensaje::where('gos_paq_etapa_id', $id)->get();
      $CalcTiempo = Gos_Paq_Etapa_Calc_Tiempo::where('gos_paq_etapa_id', $id)->get();
      $PerdidaTotal = Gos_Paq_Etapa_Perdida_Total::where('gos_paq_etapa_id', $id)->orderBy('orden')->get();
      $ligada = Gos_Paq_Etapa_Ligada::where('gos_paq_etapa_id', $id)->orderBy('orden')->get();
      $Danios = Gos_Paq_Etapa_Pago_Danios::where('gos_paq_etapa_id', $id)->orderBy('orden')->get();
      $listaAseguradoras = Gos_V_Min_Aseguradoras::where('gos_taller_id', Session::get('taller_id'))->get();
      $listaAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', Session::get('taller_id'))->where('gos_usuario_rol_id', 1)->get();
      $listaEtapas = Gos_Paq_Etapa::where('gos_taller_id', Session::get('taller_id'))->get();
      $codigoSat = Gos_Docventa_Codigo_Sat::all();
      $listaEtapasPerdidasTotales = $listaEtapas;
      $listaEtapasLigadas = $listaEtapas;
      $listaEtapasDanios = $listaEtapas;
      $compact = compact('gral','etapa','msj','CalcTiempo','PerdidaTotal','ligada','Danios','listaAsesores','listaAseguradoras',
          'listaEtapas','listaEtapasPerdidasTotales','listaEtapasLigadas','listaEtapasDanios','codigoSat');
      return view('Etapas/EditarEtapa', $compact);
    }



    public function editarpost($id,Request $request){
       //return($request);
       $idtaller=Session::get('taller_id');
       $etapa= Gos_Paq_Etapa::find($id);
       $msj = Gos_Paq_Etapa_Mensaje::where('gos_paq_etapa_id', $id)->get();
       $CalcTiempo = Gos_Paq_Etapa_Calc_Tiempo::where('gos_paq_etapa_id', $id)->get();
       $PerdidaTotal = Gos_Paq_Etapa_Perdida_Total::where('gos_paq_etapa_id', $id)->get();
       $ligada = gos_Paq_Etapa_Ligada::where('gos_paq_etapa_id', $id)->get();
       $Danios = Gos_Paq_Etapa_Pago_Danios::where('gos_paq_etapa_id', $id)->get();

        //_________________SAVE ETAPA gnrales________________________________
        $etapa->nomb_etapa=$request->nomb_etapa;
              $etapa->gos_usuario_tecnico_id=$request->gos_usuario_tecnico_id;
              $etapa->descripcion_etapa=$request->descripcion_etapa;
              $etapa->comision_asesor=$request->comision_asesor;
              $etapa->comision_asesor_tipo=$request->comision_asesor_tipo;
              $etapa->tiempo_meta=$request->tiempo_meta;
              $etapa->minimo_fotos=$request->minimo_fotos;
              $etapa->codigo_sat=$request->codigo_sat;
              $etapa->link=$request->link;
              $etapa->tipo=$request->tipo;
              if ($request->materiales=="on") {
                $etapa->materiales=1;
              }else {  $etapa->materiales=0; }

              if ($request->genera_valor=="on") {
                $etapa->genera_valor=1;
              }else {  $etapa->genera_valor=0; }

              if ($request->complemento=="on") {
                    $etapa->complemento=1;
              }else {  $etapa->complemento=0; }

              if ($request->refacciones=="on") {
                    $etapa->refacciones=1;
              }else {  $etapa->refacciones=0; }

              if ($request->checkperdida=="on") {
                $etapa->perdidatotal=1;
              }else {  $etapa->perdidatotal=0; }

              if ($request->checkpago=="on") {
              $etapa->pagodanios=1;
              }else {  $etapa->pagodanios=0; }

              if ($request->chekligada=="on") {
              $etapa->eligada=1;
              }else {  $etapa->eligada=0; }
              $etapa->save();
       //_________________Whats AppMessages________________________________
          foreach ($msj as $wazaps) {
              $wazaps->mensaje_nomb=$request->mensaje_nomb[$wazaps->gos_paq_etapa_mensaje_id];
              $wazaps->mensaje_cuerpo=$request->mensaje_cuerpo[$wazaps->gos_paq_etapa_mensaje_id];
              $wazaps->save();
              }
              if ($request->MensajesWSlength>0) {
                for ($i=1; $i <=$request->MensajesWSlength ; $i++) {
                  $mensaje=new Gos_Paq_Etapa_Mensaje();
                  $mensaje->mensaje_nomb=$request->Nmensaje[$i];
                  $mensaje->mensaje_cuerpo=$request->Nmensaje_cuerpo[$i];
                  $mensaje->gos_paq_etapa_id=$id;
                  $mensaje->save();
                }
              }
      //____________________CALC TIEMPO_____________________________________
         foreach ($CalcTiempo as $tiempo) {
           $tiempo->gos_aseguradora_id=$request->calculotiemposel[$tiempo->gos_paq_etapa_calc_tiempo_id];
           $tiempo->monto=$request->CtiempoMonto[$tiempo->gos_paq_etapa_calc_tiempo_id];
           $tiempo->save();
           }
             if ($request->caltiempolen>0) {
               for ($i=1; $i <= $request->caltiempolen; $i++) {
                  $ctmp=new Gos_Paq_Etapa_Calc_Tiempo();
                  $ctmp->gos_paq_etapa_id=$id;
                  $ctmp->gos_aseguradora_id=$request->NuevoCtiempoAseid[$i];
                  $ctmp->monto=$request->NuevoCtiempoMonto[$i];
                  $ctmp->save();
               }
            }

      //______________________PERDIDATOTAL_____________________________________
       foreach ($PerdidaTotal as $perdida) {
                $perdida->orden=$request->OrderPerdidatotal[$perdida->gos_paq_etapa_perdida_total_id];
                $perdida->save();
             }
             if ($request->perdidalength>0) {
                for ($i=1; $i <=$request->perdidalength ; $i++) {
                  $per=new Gos_Paq_Etapa_Perdida_Total();
                  $per->gos_paq_etapa_id=$id;
                  $per->etapa_perdida_total_id_rel=$request->NPerdiodaEtapa[$i];
                  $per->gos_taller_id=$idtaller;
                  $per->orden=$request->NPerdiodaOrden[$i];
                  $per->save();
                }
             }

      //______________________ELIGADA_____________________________________
      foreach ($ligada as $lig) {
               $lig->orden=$request->Orderligada[$lig->gos_paq_etapa_ligada_id];
               $lig->save();
            }
            if ($request->ligadalen>0) {
               for ($i=1; $i <=$request->ligadalen ; $i++) {
                 $per=new gos_Paq_Etapa_Ligada();
                 $per->gos_paq_etapa_id=$id;
                 $per->etapa_ligada_relacionada=$request->NLigadaEtapa[$i];

                 $per->orden=$request->NLigadaOrden[$i];
                 $per->save();
               }
            }
      //______________________PAGODAÑOS_____________________________________
      foreach ($Danios as $pagod) {
                   $pagod->orden=$request->OrderPagodaños[$pagod->gos_paq_etapar_pago_danios_id];
                   $pagod->save();
                }
                if ($request->pagolen>0) {
                   for ($i=1; $i <=$request->pagolen ; $i++) {
                     $pd=new Gos_Paq_Etapa_Pago_Danios();
                     $pd->gos_paq_etapa_id=$id;
                     $pd->etapa_pago_danios_id_rel=$request->NPdanosEtapa[$i];
                     $pd->gos_taller_id=$idtaller;
                     $pd->orden=$request->NPdanosOrden[$i];
                     $pd->save();
                   }
                }
     return redirect('gestion-etapas');
    }


    public function eliminarmensaje($id){
      $msj = Gos_Paq_Etapa_Mensaje::find($id);
      $msj->delete();
      return redirect()->back()->withErrors('Mensaje Eliminado');
    }
    public function eliminartiempo($id){
      $CalcTiempo = Gos_Paq_Etapa_Calc_Tiempo::find($id);
      $CalcTiempo->delete();
      return redirect()->back()->withErrors('Calculo de tiempo eliminado');
    }
    public function eliminarperdida($id){
      $PerdidaTotal = Gos_Paq_Etapa_Perdida_Total::find($id);
      $PerdidaTotal->delete();
      return redirect()->back()->withErrors('Etapa Perdida Eliminada');
    }
    public function eliminarligada($id){
      $ligada = gos_Paq_Etapa_Ligada::find($id);
      $ligada->delete();
      return redirect()->back()->withErrors('Etapa Etapa Ligada Eliminada');
    }
    public function eliminardaños($id){
      $Danios = Gos_Paq_Etapa_Pago_Danios::find($id);
      $Danios->delete();
      return redirect()->back()->withErrors('Etapa Pago Daños Eliminada');
    }



}
