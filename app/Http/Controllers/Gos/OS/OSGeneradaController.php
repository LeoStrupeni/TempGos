<?php
namespace App\Http\Controllers\Gos\OS;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosControllers;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_Os_Generada;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_V_Os_Items;
use App\Gos\Gos_OS_Anticipo;
use App\Gos\Gos_OS_Tipo_O;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_OS_Riesgo;
use App\Gos\Gos_V_Clientes_Vehiculos;
use App\Gos\Gos_V_Aseguradoras_;
use App\Gos\Gos_Ot;
use App\Gos\Gos_Metodo_Pago;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_Paq_Servicio;
use App\Gos\Gos_Paquete;
use App\Gos\Gos_Producto;
use App\Gos\Gos_V_Inventario_Interno;
use App\Gos\Gos_Producto_Externo;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Medidor_Gas;
use App\Gos\Gos_Vehiculo_Tipo;
use App\Gos\Gos_Vehiculo_Inventario_Doc;
use App\Gos\Gos_Os_Imagen_Cliente;
use App\Gos\Gos_Os_Imagen_Interna;
use App\Gos\Gos_Vehiculo_Inventario;
use GosClases\ItemsOS;
use GosClases\GosDataTable;
use App\Gos\Gos_Sistema_Parametro;
use App\Gos\Gos_V_Os_Refaccion;
use App\Gos\Gos_Os_Refaccion_Estatus;
use App\Gos\Gos_OS_Refaccion;
use App\Gos\Gos_V_Os_Mensajes;
use App\Gos\Gos_Os_Mensajes;
use GosClases\GosSistema;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use phpDocumentor\Reflection\Types\Integer;
use App\GosClases\GosUtil;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_V_Os_Etapas;
use App\Gos\Gos_Paq_Etapa_Mensaje;
use App\Gos\Gos_Proveedor;
use App\Gos\Gos_Pres;
use App\Gos\Gos_Pres_Item;
use App\Gos\Gos_Pres_Concepto;
use App\Gos\Gos_Producto_Ubicacion;
use App\Gos\Gos_V_Inventario_Vehiculo;
use App\Gos\Gos_V_Inventario_Vehiculo_Parte;
use App\Gos\Gos_V_Lic_Paq_Etapas;
use App\Gos\Gos_V_Lic_Paq_Servicio;
use App\Gos\Gos_V_Usuarios;
use App\Gos\Gos_Os_Producto_Externo;
use App\Gos\Gos_V_Os_Producto_Externo;
use App\Gos\Gos_Taller;
use App\Gos\Gos_Os_Orden_Finalizadas;
use Session;
use App\Gos\Gos_Taller_Conf_Os;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_Paq_Etapa_Pago_Danios;
use App\Gos\Gos_Paq_Etapa_Perdida_Total;
use App\Gos\Gos_Nota_Remision;
use App\Gos\Gos_Os_Refaccion_Comentarios;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Aseguradora;
use App\Gos\Qualitas_Repositorio_Archivos;
use App\Gos\Gos_Usuario_Tecnico_Comision;

/**
 *
 * @author leo + yois
 *
 */
class OSGeneradaController extends GosControllers
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($gos_os_id)
    {
        $user=Session::get('usr_Data');
        $idtaller=Session::get('taller_id');
        $os = Gos_V_Os_Generada::find($gos_os_id);
        $row_number = DB::select( DB::raw('SELECT *,(SELECT  SUM(IFNULL(precio_etapa,0)*if(IFNULL(cantidad,0)=0,1,cantidad))  + IFNULL(SUM(precio_materiales*if(IFNULL(cantidad,0)=0,1,cantidad)),0)
            FROM gos_os_item
            WHERE gos_os_id = '.$gos_os_id.') as precio_final
        FROM gos_v_inicio_calendario
       WHERE  gos_taller_id='.$idtaller.' AND gos_os_id = '.$gos_os_id.'
       ORDER BY nro_orden_interno ASC
       '));
        $number = $row_number[0]->nro_orden_interno;
        $precio_total = $row_number[0]->precio_final;
        $listaEtapasA = ItemsOS::listaEtapasOS($gos_os_id);//Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->get();
        $listaEtapasAA = ItemsOS::listaEtapasOSActivasAdmin($gos_os_id);//Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->get();
        $listaEtapasAO = ItemsOS::listaEtapasOSActivasOper($gos_os_id);//Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->get();

        if($listaEtapasAA->count()>0){
            $listaEtapas =$listaEtapasAA;
            $listaEtapasS = $listaEtapasAO;
        }
        else if($listaEtapasAO->count()>0){
            $listaEtapas = $listaEtapasAA;
            $listaEtapasS = $listaEtapasAO;
        }
        else{
            $listaEtapas = ItemsOS::listaEtapasOSActivas($gos_os_id);//Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->get();
            $listaEtapasS = $listaEtapas;
        }
        $calctotal=Gos_Os_Item::where('gos_os_id',$gos_os_id)->get();
        $totaletapas=0.00;
        foreach ($calctotal as $etapa) {
           $totaletapas=$etapa->precio_etapa+$etapa->precio_materiales+$totaletapas;
       }
       $totaletapas=($totaletapas*isset($etapa->descuento)? $etapa->descuento:0)/100;
        $listaInteriores = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Interiores'],['gos_os_id', $gos_os_id]])->get();
        $listaExteriores = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Exteriores'],['gos_os_id', $gos_os_id]])->get();
        $listaMotores = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Motor'],['gos_os_id', $gos_os_id]])->get();
        $listaCajuela = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Cajuela'],['gos_os_id', $gos_os_id]])->get();
        $listaMedidorGas = Gos_Vehiculo_Medidor_Gas::all();
        $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();
        $inventario = Gos_V_Inventario_Vehiculo::where('gos_os_id', $gos_os_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $user->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $user->gos_taller_id)->first();
        $usuario = $user['gos_usuario_id'];
        $listaImgInternas = $this->listaImgInternas($gos_os_id);
        $listaImgCliente = $this->listaImgCliente($gos_os_id);
        $listaDocumentos = $this->listaDocumentos($gos_os_id);
        $gos_taller=Gos_Taller::where('gos_taller_id', $idtaller)->get();
        $taller=Gos_Taller::where('gos_taller_id', $idtaller)->first();
        $listaProveedor=Gos_Proveedor::where('gos_taller_id', $idtaller)->get();
        $listaProductos=Gos_V_Inventario_Interno::select('gos_producto_id','gos_taller_id','codigo','nomb_producto','descripcion','cantidad')->where('gos_taller_id', $idtaller)->where('cantidad','>',0)->get();
        $listaProductosExternos=Gos_Producto_Externo::where('gos_taller_id', $idtaller)->get();
        $listaTecnicos = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id',2)->get();
        $listaAdmin = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id',1)->get();
        $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$idtaller)->get();
        $listaubicaiones=Gos_Producto_Ubicacion::where('gos_taller_id',$idtaller)->get();
        //-----datos pres
        $refacciones= Gos_V_OS_Refaccion::where('gos_os_id',$gos_os_id)->get();
        $cadprovref=""; $countrefaccionesC=0;
        foreach ($refacciones as $ref) {
        $cadprovref=$cadprovref.",".$ref->proveedor;
        if ($ref->gos_os_refaccion_estatus_id>8 ||$ref->gos_os_refaccion_estatus_id==5) {$countrefaccionesC=$countrefaccionesC+1;}
        }
        $inprov=explode(",",$cadprovref);
        $listaprovconrefac=Gos_Proveedor::where('gos_taller_id', $idtaller)->wherein('gos_proveedor_id',$inprov)->get();
        $estatusrefaccionescanceladas=Gos_Os_Refaccion_Estatus::where('estatus_refaccion','like','%Cancelado%')->get();
        $listaServicios = Gos_V_Lic_Paq_Servicio::where('gos_taller_id',Session::get('taller_id'))->orWhere('gos_taller_id', 0)->get();
        $listaPaquetes = Gos_Paquete::where('gos_taller_id',Session::get('taller_id'))->get();
        $infopaquete = Gos_Paquete::where('gos_taller_id',Session::get('taller_id'))->first();
        $listaServicios2 = Gos_Paq_Servicio::where('gos_taller_id',Session::get('taller_id'))->get();
        $subtotal=0;
        $fechahoy = date("Y-m-d");
        $countpres=0;
        $equipodetrabajo=Gos_V_Usuarios::where('gos_taller_id',$idtaller)->get();
        $comentariosrefaccion=DB::select( DB::raw('select *from (SELECT * FROM gos_os_mensaje where gos_os_id='.$gos_os_id.' and de="ref" AND (gos_usuario_envio = '.$user->gos_usuario_id.' or gos_usuario_id = '.$user->gos_usuario_id.'  or gos_usuario_envio = 0)) AS F GROUP BY cuerpo'));
        $conf_taller_os=Gos_Taller_Conf_Os::find($idtaller);
        $countrefaccionesR=Gos_V_Os_Refaccion::where('gos_os_id',$gos_os_id)->where('gos_os_refaccion_estatus','Recibido')->orwhere('gos_os_id',$gos_os_id)->where('gos_os_refaccion_estatus','Entregado')->count();
        $countrefacciones=Gos_V_Os_Refaccion::where('gos_os_id',$gos_os_id)->count();
        $countservicios=Gos_V_Os_Items::where('gos_os_id',$gos_os_id)->where('gos_paq_servicio_id','>', 0)->count();
        $countserviciosFin=Gos_V_Os_Items::where('gos_os_id',$gos_os_id)->where('gos_paq_servicio_id','>', 0)->where('estado_etapa','F')->count();
        $countproductoint=Gos_V_Os_Items::where('gos_os_id',$gos_os_id)->where('gos_producto_id','>', 0)->count();
        $countproductoext=Gos_V_Os_Producto_Externo::where('gos_os_id',$gos_os_id)->where('gos_os_producto_externo_id','>', 0)->count();
        $countImgInternas = $this->listaImgInternas($gos_os_id)->count();;
        $countImgCliente = $this->listaImgCliente($gos_os_id)->count();;
        $countDocumentos = $this->listaDocumentos($gos_os_id)->count();;
        $listaEtapasPropiasTaller = Gos_V_Paq_Etapas::where('gos_taller_id',$idtaller)->get();
        $pres=Gos_Pres::where('gos_pres_os_id',$gos_os_id)->first();
        $itemspres="";
        if($pres!=null){
          $itemspres=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
          foreach ($itemspres as $item){
              $countpres+=1;
          $subtotal=$subtotal+$item->precio_servicio+$item->precio_pintura+$item->precio_refacciones;
          }
        }

        //-----mensajes------equipo

        $mensajesequipo = Gos_V_Os_Mensajes::where('gos_os_id',$gos_os_id)->where('de','taller')->where('para','taller')->groupBy('fecha')->groupBy('cuerpo')->get();
        //-----mensajes------cliente
        $mensajecliente = Gos_V_Os_Mensajes::where('gos_os_id',$gos_os_id)->where('visble',1)->groupBy('fecha')->groupBy('cuerpo')->get();

        $archiveqlts="ND";
      /*  if (preg_match("/alit/i", $os->empresa)) {
          $archiveqlts=Qualitas_Repositorio_Archivos::where('gos_os_id',$os->gos_os_id)->get();
          $countDocumentos = count($archiveqlts);
        }
        */
        $compact = array();
        // traer items de orden de servicio
        $compact = compact('precio_total','number','os', 'listaEtapas', 'listaEtapasS','listaInteriores', 'listaExteriores', 'listaMotores', 'listaCajuela', 'listaMedidorGas',
       'listaTipoVehiculo', 'listaImgInternas', 'listaImgCliente','listaDocumentos','listaProveedor','listaConceptos','pres','itemspres','listaubicaiones',
       'listaProductos', 'listaProductosExternos','listaTecnicos','fechahoy','listaPaquetes','listaServicios','listaTecnicos', 'listaEtapasA',
       'inventario','listaAdmin', 'usuario','countpres','countrefacciones','countrefaccionesC','countrefaccionesR','countservicios','countserviciosFin',
       'countproductoint','countproductoext','totaletapas','countImgCliente','countImgInternas','countDocumentos','gos_taller','taller','infopaquete','estatusrefaccionescanceladas',
       'listaEtapasPropiasTaller','user','refacciones','equipodetrabajo','comentariosrefaccion','taller_conf_ase','taller_conf_vehiculo','conf_taller_os','archiveqlts',
        'listaprovconrefac','mensajesequipo','mensajecliente');

        return view('/OS/Generada/EditarOSGeneradaplano', $compact);
        //     Validacion ver OS qualitas o nomal
      /*
        if (preg_match("/alit/i", $os->empresa)) {
             return view('/Qualitas/VerOSqualitas', $compact);
            } else {
            return view('/OS/Generada/EditarOSGeneradaplano', $compact);
          }
      */
    }
    public function comentarioExtra(Request $request){

        $fechahoy = date("Y-m-d h:i:s");
        $para  = '';
        if($request->visibleCliente == 'on'){
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
            $mensaje->fecha = $fechahoy;
            $mensaje->asunto = 'Mensaje Taller';
            $mensaje->prioridad = $request->Prioridad;
            $mensaje->visble = $check;
            $mensaje->gos_usuario_envio = null;
            $mensaje->gos_usuario_id = $request->gos_usuario_id;
            $mensaje->cuerpo = $request->mensaje;
            $mensaje->gos_os_id = $request->gos_os_id;
            $mensaje->leido = 0;
            $mensaje->save();
        }
        if($request->gos_usuario_envio!==null){

            $arrequipoTr = $request->gos_usuario_envio;
            foreach($arrequipoTr as $equipoid){


                $mensaje = new Gos_Os_Mensajes();
                $mensaje->timestamps = false;
                $mensaje->de = "taller";
                $mensaje->para = $para;
                $mensaje->fecha = $fechahoy;
                $mensaje->asunto = 'Mensaje Taller';
                $mensaje->prioridad = $request->Prioridad;
                $mensaje->visble = $check;
                $mensaje->gos_usuario_envio = $equipoid;
                $mensaje->gos_usuario_id = $request->gos_usuario_id;
                $mensaje->cuerpo = $request->mensaje;
                $mensaje->gos_os_id = $request->gos_os_id;
                $mensaje->leido = 0;
                $mensaje->save();

            }
        }
        //MAILTO_______________________________________________
        if ($request->checkmailcomentarioos=="on") {
          $idtaller=Session::get('taller_id');
          $os=Gos_V_Os::find($request->gos_os_id);
          $user=Gos_V_Usuarios::find($request->gos_usuario_id);
          $taller = Gos_Taller::where('gos_taller_id',$idtaller)->get();
          if($request->gos_usuario_envio!=null){    $usrslen=count($request->gos_usuario_envio);
          if($usrslen>0){
            foreach ($request->gos_usuario_envio as $idusrenv) {
                 $usr=Gos_V_Usuarios::find($idusrenv);
                 $details = [
                     'title' => 'Mensaje De Equipo De Trabajo',
                     'body' =>$request->mensaje,
                     'envio' =>$user,
                     'taller' =>  $taller,
                     'os' => $os,
                 ];
              \Mail::to($usr->email)->send(new \App\Mail\MailComentarioOS($details));
            }
          }}
          if ($request->os_envio_email!=null) {
            $arrOtros=explode(',',$request->os_envio_email);
            $arotroslen=count($arrOtros);
            foreach ($arrOtros as $otroreceptor) {
              $mail=trim($otroreceptor);
              $details = [
                  'title' => 'Mensaje De Equipo De Trabajo',
                  'body' =>$request->mensaje,
                  'envio' =>$user,
                  'taller' =>  $taller,
                  'os' => $os,
              ];
              \Mail::to($mail)->send(new \App\Mail\MailComentarioOS($details));
            }
          }
        }//CONMAIL__
        return back();
    }



    /**
     * funcion publica que devuelve lista en formto json de Imagenes internas
     *
     * @return unknown
     */
    public function refrescaImgInternas($gos_os_id)
    {
        return Response::json($this->listaImgInternas($gos_os_id));
    }

    /**
     * funcion publica que devuelve lista en formto json de Imagenes Cliente
     *
     * @return unknown
     */
    public function refrescaImgCliente($gos_os_id)
    {
        return Response::json($this->listaImgCliente($gos_os_id));
    }

    /**
     * funcion publica que devuelve lista en formto json de documentos
     *
     * @return unknown
     */
    public function refrescaDocumentos($gos_os_id)
    {
        //
    }

    /**
     * devuelve listado de imagenes internas
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaImgInternas($gos_os_id)
    {
        return Gos_Os_Imagen_Interna::where('gos_os_id', $gos_os_id)->get();
    }

    /**
     * devuelve listado de imagenes Cliente
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaImgCliente($gos_os_id)
    {
        return Gos_Os_Imagen_Cliente::where('gos_os_id', $gos_os_id)->get();
    }

    /**
     * devuelve listado de imagenes Cliente
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    protected function listaDocumentos($gos_os_id)
    {
        $inventario = Gos_Vehiculo_Inventario::select('gos_vehiculo_inventario_id')->where('gos_os_id', $gos_os_id)->first();

        return Gos_Vehiculo_Inventario_Doc::where('gos_vehiculo_inventario_id', $inventario->gos_vehiculo_inventario_id)->get();
    }

    public function destroyDoc($gos_vehiculo_inventario_doc_id)
    {
        $documento = Gos_Vehiculo_Inventario_Doc::find($gos_vehiculo_inventario_doc_id);
        $documento->delete();
        return Response::json($documento);
    }

    public function destroyImgCliente($gos_os_imagen_cliente_id)
    {
        $imgCliente = Gos_Os_Imagen_Cliente::find($gos_os_imagen_cliente_id);
        $imgCliente->delete();
        return Response::json($imgCliente);
    }

    public function destroyImgInterna($gos_os_imagen_interna_id)
    {
        $imgInterna = Gos_Os_Imagen_Interna::find($gos_os_imagen_interna_id);
        $imgInterna->delete();
        return Response::json($imgInterna);
    }

    /**
     * Funciones de guardado Imagenes y Documentos
     */
    public function imgEtapa($id){
        $idtaller=Session::get('taller_id');
        $cant_minima = Gos_Taller_Conf_Os::where('gos_taller_id', $idtaller)->get();
        $cantFotos = $cant_minima[0]->minimo_fotos;
        if($cantFotos == 1){
            $ff =  DB::select( DB::raw("SELECT COUNT(minimo_fotos) as minimo_fotos
            FROM gos_v_os_items
            WHERE gos_os_id = '".$id."' AND estado_etapa = 'A'
            ORDER BY nro_orden_interno ASC"));

            return $ff[0]->minimo_fotos;
        }
        else{
            return 10;
        }
    }
    public function guardarImgCliente($id, Request $request)
    {
      $coleccionIMG=Gos_Os_Imagen_Cliente::where('gos_os_id',$id)->get();
      if (count($coleccionIMG)<30) {
        $ff =  DB::select( DB::raw("SELECT gos_paq_etapa_id
        FROM gos_v_os_items
        WHERE gos_os_id = '".$id."' AND estado_etapa = 'A'"));
        $imgClienteType = $request->type;
        $imgCliente = $request->imagen;  // your base64 encoded
        $imgCliente = str_replace('data:'.$imgClienteType.';base64,', '', $imgCliente);
        $imgCliente = str_replace(' ', '+', $imgCliente);
        $fotos = $ff[0]->gos_paq_etapa_id;
        $name = $id.'_'.rand().'.jpg';

        Storage::disk('public')->put("VehiculoCliente/".$name, base64_decode($imgCliente));

        $imagenCliente = new Gos_Os_Imagen_Cliente(['gos_os_id' => $id,
                                                    'imagen_cliente' => $name,
                                                    'gos_paq_etapa_id' => $fotos
                                                    ]);
        $imagenCliente->save();
        return Response::json($imagenCliente);
      }
    }

    // -------------Descargar Imagenes --------------------------
    public function descargarImgCliente($id){
      try {
        $coleccionIMG=Gos_Os_Imagen_Cliente::where('gos_os_id',$id)->get();
        $zip_file = time().".zip";
        $zip = new \ZipArchive();
        if(count($coleccionIMG) > 0){
          foreach ($coleccionIMG as $value ) {
               $rutaactual=$value->imagen_cliente;
               $zip->open($zip_file, \ZipArchive::CREATE);
               $zip->addFile(public_path()."/storage/VehiculoCliente/".$rutaactual, $rutaactual);
               $zip->close();
          }
          return Response::download($zip_file);
        }
        else {
          return redirect()->back()->with('notification','No existen imagenes guardadas');
        }
      } catch (\Exception $e) {
        //cacha la excepcion cuando existe imagenes pero no estan en el directorio
          return redirect()->back()->with('notification','Ups ocurrió un error');
      }
}
    //-------------------------------------------------------------
    public function descargarImgInterna($id){
      try {
        $coleccionIMG=Gos_Os_Imagen_Interna::where('gos_os_id',$id)->get();
        $zip_file = time()."-int".".zip";
        $zip = new \ZipArchive();
        if(count($coleccionIMG) > 0){
          foreach ($coleccionIMG as $value ) {
               $rutaactual=$value->imagen_interna;
               $zip->open($zip_file, \ZipArchive::CREATE);
               $zip->addFile(public_path()."/storage/VehiculoInterna/".$rutaactual, $rutaactual);
               $zip->close();
          }
          return Response::download($zip_file);
        }
        else {
          return redirect()->back()->with('notification','No existen imagenes guardadas');
        }
      } catch (\Exception $e) {
        //cacha la excepcion cuando existe imagenes pero no estan en el directorio
          return redirect()->back()->with('notification','Ups ocurrió un error');
      }
}

    public function guardarImgInterna($id, Request $request)
    {
      // return $request;
      $coleccionIMG=Gos_Os_Imagen_Interna::where('gos_os_id',$id)->get();
      if(count($coleccionIMG)<50){
        $imgInternaType = $request->type;
        $imgInterna = $request->imagen;  // your base64 encoded
        $imgInterna = str_replace('data:'.$imgInternaType.';base64,', '', $imgInterna);
        $imgInterna = str_replace(' ', '+', $imgInterna);

        $name = $id.'_'.rand().'.jpg';

        Storage::disk('public')->put("VehiculoInterna/".$name, base64_decode($imgInterna));

        $imagenInterna = new Gos_Os_Imagen_Interna(['gos_os_id' => $id,
                                                    'imagen_interna' => $name
                                                    ]);
        $imagenInterna->save();

        return Response::json($imagenInterna);
      }
    }

    public function guardarDocumento($id, Request $request)
    {
        $inventario = Gos_Vehiculo_Inventario::select('gos_vehiculo_inventario_id')->where('gos_os_id', $id)->first();
        $gvii = $inventario->gos_vehiculo_inventario_id;
        $cnt = Gos_Vehiculo_Inventario_Doc::select('documento')->where('gos_vehiculo_inventario_id',$gvii)->get();
        $len2 = count($cnt);
        $len=count($request->cargaArchivo);
         if ($len2 < 10) {
           if (($len2 + $len) < 11) {
             foreach($request['cargaArchivo'] as $archivo){
                 $carpeta_destino = GosSistema::carpetaDocumentos();
                 $ruta = $archivo->storeAs($carpeta_destino,time()."-".$archivo->getClientOriginalName());
                 $documento = null;
                 $documento = new Gos_Vehiculo_Inventario_Doc([
                     'gos_vehiculo_inventario_id' => $inventario->gos_vehiculo_inventario_id,
                     'documento' => basename($ruta)
                 ]);
                 $documento->save();
             }
             return redirect()->back();
           }
           else {
             return redirect()->back()->with('notification','Intenta subir menos archivos.');
           }
         }
         else {
           return redirect()->back()->with('notification','Has superado el limite de archivos.');
         }


    }




    public function chartEtapas($gos_os_id)
    {
        //$listaEtapasChart = Gos_Os_Item::where('gos_os_id', $gos_os_id)->get();
        $listaEtapasChart = ItemsOS::listaEtapasOS($gos_os_id);//Gos_V_Os_Etapas::where('gos_os_id', $gos_os_id)->get();

        // $array = [
        // 'data' => [20, 30],
        // 'labels' => ['Completado', 'En Proceso'],
        // ];

        // $compact = array($listaEtapasChart,$array);

        return Response::json($listaEtapasChart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /* YOIS */

    /**
     *
     * @param unknown $gos_os_id
     * @return \GosClases\unknown|\GosClases\NULL
     */
    public function listaEtapasOS($gos_os_id)
    {
        /**
         * <th>id</th>
         * <th>Nombre</th>
         * <th>Descripcion</th>
         * <th>Asesor</th>
         * <th>Precio</th>
         * <th>Materiales</th>
         * <th>Tiempo</th>
         */
        $listado = ItemsOS::listaEtapasOS($gos_os_id);
        $vistaBotones = '';
        return GosDataTable::preparaDataTableAjax($listado, $vistaBotones);
    }

    /**
     *
     * @param unknown $request
     * @return unknown
     */
    public function editaItemOs($request)
    {
        $datos = array();
        return response()->json($datos);
    }
    public function editarItemPrecio(Request $request)
    {
        $premateint=0;
        $itemidetapa=0;
        $preetapint=$request->preetapint;
        $itemidetapa=$request->itemidetapa;
        $premateint=$request->premateint;
        $itemidetapamate=$request->itemidetapamate;
        // return $request;
        // return count( $preetapint);
        if($itemidetapa!=0){
            for($i = 0; $i < count( $preetapint); $i++){


                $precioetap = $preetapint[$i] ;
                $gos_os_item_id= $itemidetapa[$i];
                $gos = Gos_Os_Item::find($gos_os_item_id);
                if ($gos) {
                    $gos->precio_etapa = $precioetap;
                    $compact = compact('gos_os_item_id','precioetap','gos');
                    // return $compact;
                    $gos->save();
                }
            }
        }
        if($premateint!=0){
            for($i = 0; $i < count( $premateint); $i++){


                $preciomat = $premateint[$i] ;
                $gos_os_item_id= $itemidetapamate[$i];
                $gos = Gos_Os_Item::find($gos_os_item_id);
                if ($gos) {
                    $gos->precio_materiales = $preciomat;
                    $compact = compact('gos_os_item_id','preciomat','gos');
                    // return $compact;
                    $gos->save();
                }
            }
        }

        $gos_os_item_id= $request->itemetapaid_edit;
        $precio_etapa= $request->DTE_Field_precio_etapa;
        $precio_materiales= $request->DTE_Field_precio_materiales;
        $gos = Gos_Os_Item::find($gos_os_item_id);
        if($precio_etapa!=null){
            if ($gos) {
                $gos->precio_etapa = $precio_etapa;
                $gos->save();
            }
        }
        if($precio_materiales!=null){
            if ($gos) {
                $gos->precio_materiales = $precio_materiales;
                $gos->save();
            }
        }
        // $osid = Gos_Os_Item::find($request->itemidetapa[0]);
        // $ido =  $osid->gos_os_id;
        // $total=0;$porcentaje=0;$cantidad=0;$ppitem=0;
        // $itemsOS=Gos_Os_Item::where('gos_os_id',$ido)->where('gos_paq_servicio_id','>',0)->where('gos_usuario_tecnico_id','>',0)->get();
        // foreach ($itemsOS as $itemS) {
        //     $params=Gos_Usuario_Tecnico_Comision::where('gos_usuario_id',$itemS->gos_usuario_tecnico_id)->first();
        //     if ($params->tipo_comision=="PORCIENTO") {
        //     $porcentaje=$params->monto_comision;
        //     $total=$itemS->precio_etapa;
        //     $total=($total*$porcentaje)/100;
        //     $itemS->comision_asesor=$total;
        //     $itemS->precio_mo=$total;
        //     $itemS->save();
        //     }
        //     if ($params->tipo_comision=="PESOS") {
        //     if ($itemS->precio_mo==0 ||$itemS->precio_mo==""||$itemS->precio_mo==NULL) {
        //         $total=$params->monto_comision;
        //         $itemS->comision_asesor=$total;
        //         $itemS->precio_mo=$total;
        //         $itemS->save();
        //     }
        //     }
        // }
        return back();
    }

    /**
     * Actualiza los datos de un asesor
     *
     * @param unknown $request
     * @return unknown
     */
    public function actualizaAsesor($request)
    {
        //
        $gos_usuario_asesor_id = $request->gos_usuario_asesor_id;
        $gos_os_item_id = $request->gos_os_item_id;
        //
        return Response::json(ItemsOS::actualizaAsesor($gos_os_item_id, $gos_usuario_asesor_id));
    }

    /**
     * Actualiza el precio de la etapa
     *
     * @param unknown $request
     * @return unknown
     */
    public function actualizaPrecioEtapa($request)
    {
        //
        $precio_etapa = $request->precio_etapa;
        $gos_os_item_id = $request->gos_os_item_id;
        //
        return Response::json(ItemsOS::actualizaPrecioEtapa($gos_os_item_id, $precio_etapa));
    }

    /**
     * Actualiza el precio de materiales
     *
     * @param unknown $request
     * @return unknown
     */
    public function actualizaPrecioMateriales($request)
    {
        //
        $precio_materiales = $request->precio_materiales;
        $gos_os_item_id = $request->gos_os_item_id;
        //
        return Response::json(ItemsOS::actualizaPrecioMateriales($gos_os_item_id, $precio_materiales));
    }
    public function actualizaFechaOS(Request $request)
    {

        $fechaPromesa = date("Y-m-d H:i:s",strtotime($request->fechaPromesa));
        $gos_os_id = $request->gos_os_id;
        $gos = Gos_OS::find($gos_os_id);
         if ($gos) {
             $gos->fecha_promesa_os = $fechaPromesa;
             $gos->save();
         }

        return $fechaPromesa;
    }

    public function cancelarOS($id)
    {
        $gos_os_id = $id;
        $gos = Gos_OS::find($gos_os_id);
        $now = new \DateTime();
        $now->format('Y-m-d H:i:s');
        $gos->fecha_cancelado = $now;
        $gos->save();
        return 1;
    }

    public function borrarOS($id)
    {
        $gos_os_id = $id;
        $gos = Gos_OS::find($gos_os_id);
        $now = new \DateTime();
        $now->format('Y-m-d H:i:s');
        $gos->fecha_borrado = $now;
        $gos->save();
        return 1;
    }


    public function regresarCanceladaOS($id)
    {
        $gos_os_id = $id;
        $gos = Gos_OS::find($gos_os_id);
        $gos->fecha_cancelado = NULL;
        $gos->fecha_borrado = NULL;
        $gos->save();
        return 1;
    }

    public function mandarHisOS($id)
    {
        $gos_os_id = $id;
        $gos = Gos_OS::find($gos_os_id);
        $now = new \DateTime();
        $now->format('Y-m-d H:i:s');
        $gos->fecha_historico = $now;
        $gos->save();
        return 1;
    }



    public function borrarFecha($id)
    {
        $gos_os_id = $id;
        $gos = Gos_OS::find($gos_os_id);
        $gos->fecha_terminado = NULL;
        $gos->save();
        return redirect()->back();
    }

    public function entregar($id){
        $fechaentrega = date("Y-m-d H:i:s");

        $gos = Gos_OS::find($id);
         if ($gos) {
             $gos->fecha_entregado = $fechaentrega;
             $gos->save();
         }

        return $fechaentrega;
    }

    public function finalizarEtapa(Request $request)
    {

        $fecha_terminado = date("Y-m-d H:i:s",strtotime($request->fecha_entrega));
        $gos_os_id = $request->gos_os_id;
        $gos = Gos_OS::find($gos_os_id);
         if ($gos) {
             $gos->fecha_terminado = $fecha_terminado;
             $gos->save();
         }

        return $request;
    }

    public function finalizarEtapaDashboard(Request $request, $data)
    {

        $total=0;$porcentaje=0;$cantidad=0;$ppitem=0;
        $porc="PORCIENTO"; $prec="PESOS";
        $ositmid=$request->OSitemid;
        $ppitem=$request->inputPoP;
        $cantidad=$request->Cantidad;
        $actiontype=$request->PorcCant;

        $idtaller=Session::get('taller_id');
        $valores = explode(',',$data);
        $gos_os_item_id = $valores[0];
        $fechaE = $valores[1];
        $fecha_terminado = date("Y-m-d H:i:s",strtotime($fechaE));
        $gositem = Gos_Os_Item::find($gos_os_item_id);
        $gos = Gos_OS::find($gositem->gos_os_id);
        $gos_os_id=$gos->gos_os_id;

        $operativAct =  Gos_Os_Item::
         join('gos_paq_etapa', 'gos_os_item.gos_paq_etapa_id', '=', 'gos_paq_etapa.gos_paq_etapa_id')
        ->where('gos_os_item.gos_os_id', $gos_os_id)
        ->where('gos_os_item.gos_taller_id', $idtaller)
        ->where('gos_paq_etapa.tipo', 2)
        ->where('gos_os_item.estado_etapa', 'A')
        ->select('gos_os_item.*')
        ->first();





         if ($gositem) {
             $operativAct->estado_etapa = 'F';
             $gos_item_eta=$operativAct->orden_etapa + 1;
             $gosc = Gos_Os_Item::where('gos_os_id',$gos_os_id)->where('orden_etapa',$gos_item_eta)->first();

            if($gosc){
                $gosc->estado_etapa = 'A';
                if ($actiontype=="%") {
                   $porcentaje=$request->inputPoP;
                   $total=$gosc->precio_etapa;
                   $total=($total*$porcentaje)/100;

               }
               if ($actiontype=="$") {
                     $total=($ppitem)*($cantidad);
               }
               if ($actiontype==null) {
                     $total=($ppitem)*($cantidad);
               }
                $gosc->comision_asesor=$total;
                $gosc->precio_mo=$total;
                $gosc->comision_asesor_tipo=$porc;
                $gosc->gos_usuario_tecnico_id=$request->Tecnico;
                $now = new \DateTime();
                $now->format('Y-m-d H:i:s');
                $gosc->fecha_inicio_et = $now;
                $gosc->save();
                $operativAct->fecha_cierre_et = $fecha_terminado;
                $operativAct->save();
                return 1;
            }
            else{
                return 3;
            }
         }
         else{
             return 2;
         }
    }

    public function inventarioExtOS($gos_os_id){
        $listaServicios = Gos_V_Os_Producto_Externo::where('gos_os_id',$gos_os_id)->where('gos_os_producto_externo_id','>', 0)->get();
        $opcionesEditDataTable3 = 'OS.Inventario.OpcionesInventarioExtOS';

        $ajax = $this->preparaDataTableAjax($listaServicios, $opcionesEditDataTable3);
        if (null != $ajax) {
            return $ajax;
        }
    }
    public function inventarioIntOS($gos_os_id){
        $listaServicios = Gos_V_Os_Items::where('gos_os_id',$gos_os_id)->where('gos_producto_id','>', 0)->get();
        $opcionesEditDataTable3 = 'OS.Items.OpcionesItemsDatatable';

        $ajax = $this->preparaDataTableAjax($listaServicios, $opcionesEditDataTable3);
        if (null != $ajax) {
            return $ajax;
        }
    }
    public function clientesMensajes($gos_os_id){
        $listaServicios = Gos_V_Os_Mensajes::where('gos_os_id',$gos_os_id)->where('visble',1)->get();
        $opcionesEditDataTable3 = 'OS.Items.OpcionesItemsDatatable';

        $ajax = $this->preparaDataTableAjax($listaServicios, '');
        if (null != $ajax) {
            return $ajax;
        }
    }
    public function equiposMensajes($gos_os_id){
        $listaServicios = Gos_V_Os_Mensajes::select('gos_taller_id','gos_os_id','prioridad','fecha', 'nombre','cuerpo')->distinct()
                                            ->where('gos_os_id',$gos_os_id)->where('de','taller')->where('para','taller')->get();
        $opcionesEditDataTable3 = 'OS.Items.OpcionesItemsDatatable';

        $ajax = $this->preparaDataTableAjax($listaServicios, '');
        if (null != $ajax) {
            return $ajax;
        }
    }
    public function Mensajeborrar($gos_os_mensaje_id){
        $msm = Gos_Os_Mensajes::find($gos_os_mensaje_id);
        $fecha = $msm->fecha;
        $gos_os_id = $msm->gos_os_id;
        $cuerpo = $msm->cuerpo;
        $mensajes = Gos_Os_Mensajes::where('gos_os_id',$gos_os_id)->where('fecha',$fecha)->where('cuerpo',$cuerpo)->get();
        foreach ($mensajes as $ms){
            $mensaje = Gos_Os_Mensajes::find($ms->gos_os_mensaje_id);
            $mensaje->delete();
        }
        return  $mensajes;
    }


    public function etapasFinalizadasModal($gos_os_id){
        $ordenFinalizadasNA =  Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos_os_id)->where('estado_etapa','NA')->count();
        if($ordenFinalizadasNA == 0){
            $ordenFinalizadasA =  Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos_os_id)->where('estado_etapa','A')->count();
            if($ordenFinalizadasA == 0){
                $fecha_entregado =  Gos_V_Os::where('gos_os_id',$gos_os_id)->where('fecha_terminado','!=',0)->count();
                if($fecha_entregado== 0){
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{

                return 0;
            }
        }
    }
    public function siguienteEtapa(Request $request){

      $gos_os_item = $request->gos_os_item;
      $idtaller=Session::get('taller_id');
      $gos = Gos_V_Os_Items::find($gos_os_item);
      $min = $gos->gos_os_id;
      $ff =  DB::select( DB::raw("SELECT minimo_fotos, gos_paq_etapa_id, nombre
      FROM gos_v_os_items
      WHERE gos_os_id = '".$min."' AND estado_etapa = 'A'
     "));
      if( $ff[0]->nombre == "Transito 3 Pte reingreso"){
        $gos_os = Gos_OS::find($min);
        $gos_os->fecha_ingreso_v_os = date("Y-m-d H:i:s");
        $gos_os->gos_os_estado_exp_id = 1;
        $gos_os->save();
      }

        $cant_minima = Gos_Taller_Conf_Os::where('gos_taller_id', $idtaller)->get();
        $cantFotos = $cant_minima[0]->minimo_fotos;
        $etapaActiva = $ff[0]->gos_paq_etapa_id;
        $fotos = Gos_Os_Imagen_Cliente::where('gos_os_id',$min)->where('gos_paq_etapa_id', $etapaActiva)->count();
        if($cantFotos == 1){
            if($fotos >= $ff[0]->minimo_fotos  ){
                $gos_mensaje_id = $request->gos_mensaje_id;
                $fechaInicio = date("Y-m-d H:i:s",strtotime($request->tiempo_inicio));
                $fechaFinal = date("Y-m-d H:i:s",strtotime($request->tiempo_final));
                $usuario_id = Session::get('usr_Data');

                $usuario = $usuario_id['gos_usuario_id'];
                $gos = Gos_Os_Item::find($gos_os_item);
                if ($gos) {
                    // $gos->fecha_inicio_et = $fechaInicio;
                    $gos->fecha_cierre_et = $fechaFinal;
                    $gos->estado_etapa = 'F';
                    $gos->save();
                }

                if($gos_mensaje_id){
                    $mensajePaq = Gos_Paq_Etapa_Mensaje::where('gos_paq_etapa_mensaje_id',$gos_mensaje_id)->first();
                    $mensaje = new Gos_Os_Mensajes();
                    $mensaje->timestamps = false;
                    $mensaje->de = "taller";
                    $mensaje->para = "cliente";
                    $mensaje->fecha = $fechaFinal;
                    $mensaje->asunto = $mensajePaq->mensaje_nomb;
                    $mensaje->cuerpo = $mensajePaq->mensaje_cuerpo;
                    $mensaje->gos_os_id = $gos->gos_os_id;
                    $mensaje->leido = 0;
                    $mensaje->prioridad = 0;
                    $mensaje->visble = 1;
                    $mensaje->gos_usuario_envio = 0;
                    $mensaje->gos_usuario_id = $usuario;
                    $mensaje->save();
                }


                $ordenFinalizadasNA =  Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos->gos_os_id)->where('estado_etapa','NA')->count();
                if($ordenFinalizadasNA == 0){
                    $ordenFinalizadasA =  Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos->gos_os_id)->where('estado_etapa','A')->count();
                    if($ordenFinalizadasA == 0){
                        return 1;
                    }
                    else{

                        return 0;
                    }
                }
                else{
                    $gos_etapa = $request->gos_etapa_id;
                    $etapa = Gos_Os_Item::find($gos_etapa);
                    if ($etapa) {
                        $etapa->fecha_inicio_et = $fechaFinal;
                        $etapa->estado_etapa = 'A';
                        $etapa->save();

                        //______BGN ACTIVAR ETAPA SIMULTANEA APC_____________________________________________________
                        if ($request->checketasimultanea=="on") {
                          if($request->etasimultanea>0){
                              $etasim=Gos_Os_Item::find($request->etasimultanea);
                              if ($etasim!=null) {
                                  $etaFin = Gos_Os_Item::where('gos_os_id',$min)->where('estado_etapa','A')->get();
                                  for($i=0; $i < count($etaFin); $i++){
                                      $tipo = Gos_Paq_Etapa::find($etaFin[$i]->gos_paq_etapa_id);
                                      if( $tipo->tipo == 2){
                                          $etapaFinalizada = Gos_Os_Item::find($etaFin[$i]->gos_os_item_id);
                                          $etapaFinalizada->estado_etapa = 'F';
                                          $etapaFinalizada->fecha_inicio_et = $request->tiempo_final;
                                          $etapaFinalizada->save();
                                      }
                                  }
                                  $etasim->estado_etapa="A";
                                  $etasim->fecha_inicio_et = $request->tiempo_final;
                                  $etasim->save();

                              }
                          }
                        }
                        //_____ETAPA SIMULTANEA END __________________________________________________________________


                    }
                    return 0;
                }
            }
            else{
                return 2;
            }
        }
        else{
            $gos_mensaje_id = $request->gos_mensaje_id;
            $fechaInicio = date("Y-m-d H:i:s",strtotime($request->tiempo_inicio));
            $fechaFinal = date("Y-m-d H:i:s",strtotime($request->tiempo_final));
            $usuario_id = Session::get('usr_Data');

            $usuario = $usuario_id['gos_usuario_id'];
            $gos = Gos_Os_Item::find($gos_os_item);
            if ($gos) {
                // $gos->fecha_inicio_et = $fechaInicio;
                $gos->fecha_cierre_et = $fechaFinal;
                $gos->estado_etapa = 'F';
                $gos->save();
            }

            if($gos_mensaje_id){
                $mensajePaq = Gos_Paq_Etapa_Mensaje::where('gos_paq_etapa_mensaje_id',$gos_mensaje_id)->first();
                $mensaje = new Gos_Os_Mensajes();
                $mensaje->timestamps = false;
                $mensaje->de = "taller";
                $mensaje->para = "cliente";
                $mensaje->fecha = $fechaFinal;
                $mensaje->asunto = $mensajePaq->mensaje_nomb;
                $mensaje->cuerpo = $mensajePaq->mensaje_cuerpo;
                $mensaje->gos_os_id = $gos->gos_os_id;
                $mensaje->leido = 0;
                $mensaje->prioridad = 0;
                $mensaje->visble = 1;
                $mensaje->gos_usuario_envio = 0;
                $mensaje->gos_usuario_id = $usuario;
                $mensaje->save();
            }


            $ordenFinalizadasNA =  Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos->gos_os_id)->where('estado_etapa','NA')->count();
            if($ordenFinalizadasNA == 0){
                $ordenFinalizadasA =  Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos->gos_os_id)->where('estado_etapa','A')->count();
                if($ordenFinalizadasA == 0){
                    return 1;
                }
                else{

                    return 0;
                }
            }
            else{
                $gos_etapa = $request->gos_etapa_id;
                $etapa = Gos_Os_Item::find($gos_etapa);
                if ($etapa) {
                    $etapa->fecha_inicio_et = $fechaFinal;
                    $etapa->estado_etapa = 'A';
                    $etapa->save();
                    //______BGN ACTIVAR ETAPA SIMULTANEA APC_____________________________________________________
                    if ($request->checketasimultanea=="on") {
                      if($request->etasimultanea>0){
                          $etasim=Gos_Os_Item::find($request->etasimultanea);
                          if ($etasim!=null) {
                              $etaFin = Gos_Os_Item::where('gos_os_id',$min)->where('estado_etapa','A')->get();
                              for($i=0; $i < count($etaFin); $i++){
                                  $tipo = Gos_Paq_Etapa::find($etaFin[$i]->gos_paq_etapa_id);
                                  if( $tipo->tipo == 2){
                                      $etapaFinalizada = Gos_Os_Item::find($etaFin[$i]->gos_os_item_id);
                                      $etapaFinalizada->estado_etapa = 'F';
                                      $etapaFinalizada->fecha_inicio_et = $request->tiempo_final;
                                      $etapaFinalizada->save();
                                  }
                              }
                              $etasim->estado_etapa="A";
                              $etasim->fecha_inicio_et = $request->tiempo_final;
                              $etasim->save();

                          }
                      }
                    }
                    //_____ETAPA SIMULTANEA END __________________________________________________________________

                }
                return 0;
            }
        }




    }
    /* YOIS */
    public function desactivarEtapa(Request $request){

        $gos = Gos_Os_Item::find($request->gos_os_item);
        if ($gos) {
            $gos->estado_etapa = 'NA';
            $gos->save();
        }
        return $request->gos_os_item;
    }
    public function getdatatablerefacciones($id){
    $refacciones=Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
    $opcionesEditDataTable2='.OS.Refacciones.OpcionesDataTable';
    $ajax = $this->preparaDataTableAjax($refacciones,$opcionesEditDataTable2);
    return($ajax);
    return($refacciones);
    }
    public function getDataTableProductoExterno($id){
         $productoExterno = Gos_V_Os_Producto_Externo::where('gos_os_id',$id)->get();
         $opcionesEditDataTable3 = 'OS.Inventario.OpcionesInventarioExtOS';
         $ajax = $this->preparaDataTableAjax($productoExterno, $opcionesEditDataTable3);
         if (null != $ajax) {
             return $ajax;
         }
    }

    public function deleteProductoExternoOS($id)
    {

        $producto = Gos_Os_Producto_Externo::find($id);
        $gos_producto_id = $producto->gos_producto_id;
        $proo = Gos_Producto_Externo::find($gos_producto_id);
        $proo->Cantidad =  $proo->Cantidad +  $producto->cantidad;
        $proo->save();
        $producto->delete();
        return Response::json($producto);
    }
    public function mensajeActivo($id){
        $mensaje = Gos_Paq_Etapa_Mensaje::find($id);
        return $mensaje->mensaje_cuerpo;
    }

    public function setProductoExternoOS(Request $request){
        $gos_producto_id = $request->gos_producto_id;

        $osProducto = Gos_Os_Producto_Externo::where([
                                                    ['gos_producto_id',$gos_producto_id],
                                                    ['gos_usuario_id',$request->gos_tecnico_id],
                                                    ['gos_os_id',$request->gos_os_id]
                                                    ])
                                                ->first();

        $producto = new Gos_Os_Producto_Externo();
        $fechaInicio = date("Y-m-d H:i:s");
        $existProducto = Gos_Producto_Externo::find($gos_producto_id);
        if($existProducto->Cantidad < $request->gos_producto_cantidad){
            return 0 ;
        }
        else if(isset($osProducto)){
            $sumaCantidad = $osProducto->cantidad + $request->gos_producto_cantidad;

            Gos_Os_Producto_Externo::where([
                                        ['gos_producto_id',$gos_producto_id],
                                        ['gos_usuario_id',$request->gos_tecnico_id],
                                        ['gos_os_id',$request->gos_os_id]
                                        ])
                                    ->update(['cantidad' => $sumaCantidad,
                                              'precio_venta'=> $request->precio_venta,
                                              'costo'=> $request->costo
                                            ]);
            $restante = $existProducto->Cantidad - $request->gos_producto_cantidad;
            $existProducto->Cantidad = $restante;
            $existProducto->save();
            return 1 ;
        }
        else{
            $producto->gos_os_id = $request->gos_os_id;
            $producto->gos_producto_id = $gos_producto_id;
            $producto->gos_usuario_id = $request->gos_tecnico_id;
            $producto->fecha = $fechaInicio;
            $producto->cantidad = $request->gos_producto_cantidad;
            $producto->precio_venta = $request->precio_venta;
            $producto->costo = $request->costo;
            $producto->save();
            $restante = $existProducto->Cantidad - $request->gos_producto_cantidad;
            $existProducto->Cantidad =  $restante;
            $existProducto->save();
            return 1 ;
        }


    }
    public function mensajeLista($id){
        $etapa_id = Gos_Os_Item::find($id);
        $etapa = $etapa_id->gos_paq_etapa_id;
        $userData['data'] = Gos_Paq_Etapa_Mensaje::where('gos_paq_etapa_id',$etapa)->get();
        echo json_encode($userData);
        exit;
    }
    public function tipoEtapa($id){
        $etapa_id = Gos_Os_Item::find($id);
        $etapa = $etapa_id->gos_paq_etapa_id;
        $userData['data'] = Gos_Paq_Etapa::where('gos_paq_etapa_id',$etapa)->get();
        echo json_encode($userData);
        exit;
    }
    public function fechaEtapaActiva($id){
        $etapa = Gos_Os_Item::find($id);
        $fecha_inicio =  $etapa->fecha_inicio_et;
        $fecha_fin =  $etapa->fecha_cierre_et;
        return compact('fecha_inicio', 'fecha_fin');
    }
    public function perdidapago($id){
        $ret=array();
        $etapa = Gos_Os_Item::find($id);
        $etaref=Gos_Paq_Etapa::find($etapa->gos_paq_etapa_id);
        $ret=[$etaref,$etapa];
        return $ret;
    }

    public function perdidatotal(Request $request){

    $fechahoy = date("Y-m-d h:i:s");
    $orden=0;$idetapaactiva=0; $Netapaactiva="A";
    $idtaller=Session::get('taller_id');
    $osid=$request->OSID;
    $OSTIPOC=Gos_OS::find($osid);
    $OSTIPOC->gos_os_tipo_o_id=4;
    $OSTIPOC->save();
    $ActItems=Gos_Os_Item::where('gos_os_id',$osid)->get();
        foreach ($ActItems as $item) {
          if ($item->estado_etapa=="NA") {
            $item->delete();
          }
          if ($item->estado_etapa=="A") {
          $item->estado_etapa="F";
          if ($request->Ativeitemidperdida==$item->gos_os_item_id) {
                $idetapaactiva=$item->gos_paq_etapa_id;
          }
          $orden=$item->orden_etapa;
          $item->save();
          }
          $orden=$orden+1;
        }
    $etapasAÑADIR=$request->Etapas;
      $etapasPerdida=Gos_Paq_Etapa_Perdida_Total::where('gos_paq_etapa_id',$idetapaactiva)->orderBy('orden')->get();
    foreach ($etapasPerdida as $newItem) {
          $norden=$orden+$newItem->orden;
         $etapadereferencia=Gos_Paq_Etapa::where('gos_paq_etapa_id',$newItem->etapa_perdida_total_id_rel)->first();
            $OSITM= new Gos_Os_Item();
            $OSITM->gos_os_id=$osid;
            $OSITM->gos_paq_etapa_id=$etapadereferencia->gos_paq_etapa_id;
            $OSITM->gos_usuario_asesor_id=$etapadereferencia->gos_usuario_tecnico_id;
            $OSITM->tiempo_meta=$etapadereferencia->tiempo_meta;
            if ($etapadereferencia->minimo_fotos>0) {
            $OSITM->minimo_fotos=$etapadereferencia->minimo_fotos;
            }
            else {
                $OSITM->minimo_fotos=0;
            }
            $OSITM->gos_paq_servicio_id=0;
            $OSITM->gos_taller_id=$idtaller;
            $OSITM->orden_etapa=$norden;
            $OSITM->estado_etapa=$Netapaactiva;
            $OSITM->fecha_inicio_et=$fechahoy;
            $OSITM->save();
            $Netapaactiva="NA";
     }
     $refacciones=Gos_Os_Refaccion::where('gos_os_id',$osid)->get();
     foreach ($refacciones as $refaccion) {
       $refaccion->gos_os_refaccion_estatus_id=17;
       $refaccion->fecha_cancelado=$fechahoy;
       $refaccion->save();
     }
    return redirect('/orden-servicio-generada/'.$osid);
    }

    public function pagodaños(Request $request){

      $fechahoy = date("Y-m-d h:i:s");
      $orden=0;  $idetapaactiva=0; $Netapaactiva="A";
      $idtaller=Session::get('taller_id');
      $osid=$request->OSID;
      $OSTIPOC=Gos_OS::find($osid);
      $OSTIPOC->gos_os_tipo_o_id=5;
      $OSTIPOC->save();
      $ActItems=Gos_Os_Item::where('gos_os_id',$osid)->get();
          foreach ($ActItems as $item) {
            if ($item->estado_etapa=="NA") {
              $item->delete();
            }
            if ($item->estado_etapa=="A") {
            $item->estado_etapa="F";
            if ($request->Ativeitemidpago==$item->gos_os_item_id) {
                  $idetapaactiva=$item->gos_paq_etapa_id;
            }
            $orden=$item->orden_etapa;
            $item->save();
            }
            $orden=$orden+1;
          }
      $etapasAÑADIR=$request->Etapas;
        $etapaspagod=Gos_Paq_Etapa_Pago_Danios::where('gos_paq_etapa_id',$idetapaactiva)->orderBy('orden')->get();
      foreach ($etapaspagod as $newItem) {
              $norden=$orden+$newItem->orden;
              $etapadereferencia=Gos_Paq_Etapa::where('gos_paq_etapa_id',$newItem->etapa_pago_danios_id_rel)->first();
              $OSITM= new Gos_Os_Item();
              $OSITM->gos_os_id=$osid;
              $OSITM->gos_paq_etapa_id=$etapadereferencia->gos_paq_etapa_id;
              $OSITM->gos_usuario_asesor_id=$etapadereferencia->gos_usuario_tecnico_id;
              $OSITM->tiempo_meta=$etapadereferencia->tiempo_meta;
              if ($etapadereferencia->minimo_fotos>0) {
              $OSITM->minimo_fotos=$etapadereferencia->minimo_fotos;
              }
              else {
                  $OSITM->minimo_fotos=0;
              }
              $OSITM->gos_paq_servicio_id=0;
              $OSITM->gos_taller_id=$idtaller;
              $OSITM->orden_etapa=$norden;
              $OSITM->estado_etapa=$Netapaactiva;
                $OSITM->fecha_inicio_et=$fechahoy;
              $OSITM->save();
              $Netapaactiva="NA";
       }
       $refacciones=Gos_Os_Refaccion::where('gos_os_id',$osid)->get();
       foreach ($refacciones as $refaccion) {
         $refaccion->gos_os_refaccion_estatus_id=18;
         $refaccion->fecha_cancelado=$fechahoy;
         $refaccion->save();
       }
      return redirect('/orden-servicio-generada/'.$osid);
    }
    public function ordenEtapaOS($id, $newId){
        $etapa = Gos_Os_Item::find($id);
        $datos = array(
            'orden_etapa'=>$newId
        );
        $etapa->update($datos);
        return $etapa;
    }
}
