<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosSistemaParametrosController;
use session;
use App\Gos\Gos_EquipoTrabajo;
use App\Gos\Gos_Usuario_Seg_Comision;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_V_Usuarios_Perfiles;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_Usuario_Admin_Ase_Comision;
use App\Gos\Gos_Permiso;
use App\Gos\Gos_Permiso_Item;
use App\Gos\Gos_Usuario_Perfil;
use Illuminate\Support\Facades\DB;

/**
 *
 * @author yois
 *
 */
class PermisosController extends GosControllers
{
    protected $vistaListado = 'Permisos/ListarPermisos';

    protected $opcionesEditDataTable = 'Permisos.OpcionesPermisosDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaUsuarios = self::listadoGeneral();
        $compact = array_merge($this->preparaCrearEditar(), compact('listaUsuarios'));

        $ajax = $this->preparaDataTableAjax($listaUsuarios, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), $compact);
    }


    public function listarIndex()
    {
      $idtaller=Session::get('taller_id');
      $perfiles =DB::select('SELECT  * FROM  gos_usuario_perfil up inner join gos_v_equipo_trabajo et on up.gos_usuario_perfil_id = et.gos_usuario_perfil_id where gos_taller_id = '.$idtaller.' and email is not null group by nomb_perfil');//Gos_Usuario_Perfil::where('gos_usuario_rol_id',1)->get();
      $arraypermisos = array();

      // $tipoDePermiso=Gos_Permiso::where('gos_taller_id',$idtaller)->get();

      return view("Permisos/listarIndex",compact('perfiles','arraypermisos'));
    }

    public function editarPerfil($id)
    {
      $idtaller=Session::get('taller_id');
      //validacion para que no aparesca el error si todavia no se crean los permisos_add
      $val = DB::select('select * from gos_permiso where gos_usuario_perfil_id='.$id.' and gos_taller_id='.$idtaller);
      //if($val-> = null)
      if( $val != null){

       $user=Session::get('usr_Data');
       $perfid=$id;

              $clientes = DB::select(DB::raw(
                'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                 WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Clientes" AND gos_taller_id = '.$idtaller));

                 $vehiculos = DB::select(DB::raw(
                   'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                    WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Vehiculos" AND gos_taller_id = '.$idtaller));

                    $presupuestos = DB::select(DB::raw(
                      'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                       WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Presupuestos" AND gos_taller_id = '.$idtaller));

                       $ordenes = DB::select(DB::raw(
                         'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                          WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Ordenes" AND gos_taller_id = '.$idtaller));

                          $facturacion = DB::select(DB::raw(
                            'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                             WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Facturacion" AND gos_taller_id = '.$idtaller));

                             $paquetes = DB::select(DB::raw(
                               'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Paquetes" AND gos_taller_id = '.$idtaller));

                                $compras = DB::select(DB::raw(
                                  'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                   WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Compras" AND gos_taller_id = '.$idtaller));

                                   $equipodetrabajo = DB::select(DB::raw(
                                     'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                      WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Equipo de Trabajo" AND gos_taller_id = '.$idtaller));

                                      $inventario = DB::select(DB::raw(
                                        'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                         WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Inventario" AND gos_taller_id = '.$idtaller));

                                         $reportes = DB::select(DB::raw(
                                           'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                            WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Reportes" AND gos_taller_id = '.$idtaller));

                $perfiles =DB::select('SELECT  * FROM  gos_usuario_perfil up inner join gos_v_equipo_trabajo et on up.gos_usuario_perfil_id = et.gos_usuario_perfil_id where gos_taller_id = '.$idtaller.' and email is not null group by nomb_perfil');
                $test=$id; //cambiar luego el nombre de testid por $perfilID;
       return view("Permisos/EditarPermisos",compact('clientes','vehiculos','presupuestos','ordenes','facturacion','paquetes','compras','equipodetrabajo','inventario','reportes','perfiles','test'));
     }
     else{

       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Clientes";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();




       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Vehiculos";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();




       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Presupuestos";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();




       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Ordenes";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();





       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Facturacion";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();




       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Paquetes";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();




       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Compras";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();



       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Equipo de Trabajo";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();



       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Inventario";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar= 0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();




       $permiso = new Gos_Permiso;
       $permiso->gos_usuario_perfil_id = $id;
       $permiso->tipo_permiso ="Reportes";
       $permiso->gos_taller_id=Session::get('taller_id');
       $permiso->save();

       $permiso_item = new Gos_Permiso_Item;
       $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
       $permiso_item->agregar =0;
       $permiso_item->editar=  0;
       $permiso_item->ver= 1;
       $permiso_item->eliminar=0;
       $permiso_item->save();

       $user=Session::get('usr_Data');
       $perfid=$id;

              $clientes = DB::select(DB::raw(
                'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                 WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Clientes" AND gos_taller_id = '.$idtaller));

                 $vehiculos = DB::select(DB::raw(
                   'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                    WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Vehiculos" AND gos_taller_id = '.$idtaller));

                    $presupuestos = DB::select(DB::raw(
                      'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                       WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Presupuestos" AND gos_taller_id = '.$idtaller));

                       $ordenes = DB::select(DB::raw(
                         'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                          WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Ordenes" AND gos_taller_id = '.$idtaller));

                          $facturacion = DB::select(DB::raw(
                            'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                             WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Facturacion" AND gos_taller_id = '.$idtaller));

                             $paquetes = DB::select(DB::raw(
                               'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Paquetes" AND gos_taller_id = '.$idtaller));

                                $compras = DB::select(DB::raw(
                                  'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                   WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Compras" AND gos_taller_id = '.$idtaller));

                                   $equipodetrabajo = DB::select(DB::raw(
                                     'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                      WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Equipo de Trabajo" AND gos_taller_id = '.$idtaller));

                                      $inventario = DB::select(DB::raw(
                                        'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                         WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Inventario" AND gos_taller_id = '.$idtaller));

                                         $reportes = DB::select(DB::raw(
                                           'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
                                            WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "Reportes" AND gos_taller_id = '.$idtaller));

                $perfiles =DB::select('SELECT  * FROM  gos_usuario_perfil up inner join gos_v_equipo_trabajo et on up.gos_usuario_perfil_id = et.gos_usuario_perfil_id where gos_taller_id = '.$idtaller.' and email is not null group by nomb_perfil');
                $test=$id; //cambiar luego el nombre de testid por $perfilID;

       return view("Permisos/EditarPermisos",compact('clientes','vehiculos','presupuestos','ordenes','facturacion','paquetes','compras','equipodetrabajo','inventario','reportes','perfiles','test'));
     }
    }

    public function editarPermisosPost(Request $request)
    {

      $idtaller=Session::get('taller_id');
      $list = array();
      $tpermiso=$request->perfilId;
      $permisos=Gos_Permiso::where('gos_taller_id',$idtaller)->where('gos_usuario_perfil_id',$tpermiso)->get();

       foreach ($permisos as $permiso) {
         $item=Gos_Permiso_Item::where('gos_permiso_id',$permiso->gos_permiso_id)->first();
         array_push($list, $item);
       }



       //Clientes

       if($request->agregarClientes == null)
       $request->agregarClientes=0;
       if($request->editarClientes == null)
       $request->editarClientes=0;
       if($request->verClientes == null)
       $request->verClientes=0;
       if($request->eliminarClientes == null)
       $request->eliminarClientes=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarClientes.',editar='.$request->editarClientes.',ver='.$request->verClientes.',eliminar='.$request->eliminarClientes.' where gos_permiso_item_id ='.$list[0]->gos_permiso_item_id);


       //VEhiculos

       if($request->agregarVehiculos == null)
       $request->agregarVehiculos=0;
       if($request->editarVehiculos == null)
       $request->editarVehiculos=0;
       if($request->verVehiculos == null)
       $request->verVehiculos=0;
       if($request->eliminarVehiculos == null)
       $request->eliminarVehiculos=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarVehiculos.',editar='.$request->editarVehiculos.',ver='.$request->verVehiculos.',eliminar='.$request->eliminarVehiculos.' where gos_permiso_item_id ='.$list[1]->gos_permiso_item_id);





       //Presupuestos

       if($request->agregarCot == null)
       $request->agregarCot=0;
       if($request->editarCot == null)
       $request->editarCot=0;
       if($request->verCot == null)
       $request->verCot=0;
       if($request->eliminarCot == null)
       $request->eliminarCot=0;


       DB::update('update gos_permiso_item set agregar='.$request->agregarCot.',editar='.$request->editarCot.',ver='.$request->verCot.',eliminar='.$request->eliminarCot.' where gos_permiso_item_id ='.$list[2]->gos_permiso_item_id);





       //Ordenes

       if($request->agregarOrd == null)
       $request->agregarOrd=0;
       if($request->editarOrd == null)
       $request->editarOrd=0;
       if($request->verOrd == null)
       $request->verOrd=0;
       if($request->eliminarOrd == null)
       $request->eliminarOrd=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarOrd.',editar='.$request->editarOrd.',ver='.$request->verOrd.',eliminar='.$request->eliminarOrd.' where gos_permiso_item_id ='.$list[3]->gos_permiso_item_id);



       //Facturacion

       if($request->agregarFacturas == null)
       $request->agregarFacturas=0;
       if($request->editarFacturas == null)
       $request->editarFacturas=0;
       if($request->verFacturas == null)
       $request->verFacturas=0;
       if($request->eliminarFacturas == null)
       $request->eliminarFacturas=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarFacturas.',editar='.$request->editarFacturas.',ver='.$request->verFacturas.',eliminar='.$request->eliminarFacturas.' where gos_permiso_item_id ='.$list[4]->gos_permiso_item_id);





       //Paquetes

       if($request->agregarPaquetes == null)
       $request->agregarPaquetes=0;
       if($request->editarPaquetes == null)
       $request->editarPaquetes=0;
       if($request->verPaquetes == null)
       $request->verPaquetes=0;
       if($request->eliminarPaquetes == null)
       $request->eliminarPaquetes=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarPaquetes.',editar='.$request->editarPaquetes.',ver='.$request->verPaquetes.',eliminar='.$request->eliminarPaquetes.' where gos_permiso_item_id ='.$list[5]->gos_permiso_item_id);







       //Compras

       if($request->agregarCompras == null)
       $request->agregarCompras=0;
       if($request->editarCompras == null)
       $request->editarCompras=0;
       if($request->verCompras == null)
       $request->verCompras=0;
       if($request->eliminarCompras == null)
       $request->eliminarCompras=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarCompras.',editar='.$request->editarCompras.',ver='.$request->verCompras.',eliminar='.$request->eliminarCompras.' where gos_permiso_item_id ='.$list[6]->gos_permiso_item_id);







       //Equipo de Trabajo

       if($request->agregarEdt == null)
       $request->agregarEdt=0;
       if($request->editarEdt == null)
       $request->editarEdt=0;
       if($request->verEdt == null)
       $request->verEdt=0;
       if($request->eliminarEdt == null)
       $request->eliminarEdt=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarEdt.',editar='.$request->editarEdt.',ver='.$request->verEdt.',eliminar='.$request->eliminarEdt.' where gos_permiso_item_id ='.$list[7]->gos_permiso_item_id);









       //Inventario

       if($request->agregarInv == null)
       $request->agregarInv=0;
       if($request->editarInv == null)
       $request->editarInv=0;
       if($request->verInv == null)
       $request->verInv=0;
       if($request->eliminarInv == null)
       $request->eliminarInv=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarInv.',editar='.$request->editarInv.',ver='.$request->verInv.',eliminar='.$request->eliminarInv.' where gos_permiso_item_id ='.$list[8]->gos_permiso_item_id);









       //Reportes

       if($request->agregarRep == null)
       $request->agregarRep=0;
       if($request->editarRep == null)
       $request->editarRep=0;
       if($request->verRep == null)
       $request->verRep=0;
       if($request->eliminarRep == null)
       $request->eliminarRep=0;



       DB::update('update gos_permiso_item set agregar='.$request->agregarRep.',editar='.$request->editarRep.',ver='.$request->verRep.',eliminar='.$request->eliminarRep.' where gos_permiso_item_id ='.$list[9]->gos_permiso_item_id);



       $perfiles =DB::select('SELECT  * FROM  gos_usuario_perfil up inner join gos_v_equipo_trabajo et on up.gos_usuario_perfil_id = et.gos_usuario_perfil_id where gos_taller_id = '.$idtaller.' and email is not null group by nomb_perfil');

       return  view("Permisos/listarIndex",compact('perfiles'));;

    }

 public function ListarPermisos()
 {

   $idtaller=Session::get('taller_id');
  $perfiles =DB::select('SELECT  * FROM  gos_usuario_perfil up inner join gos_v_equipo_trabajo et on up.gos_usuario_perfil_id = et.gos_usuario_perfil_id where gos_taller_id = '.$idtaller.' and email is not null group by nomb_perfil');
   $arraypermisos = array();

   $tipoDePermiso=Gos_Permiso::where('gos_taller_id',$idtaller)->get();

   return view("Permisos/listar_permisos",compact('perfiles','arraypermisos'));
 }

 public function postSelectPermisos(Request $request){
   $arraypermisos = array();
   $idtaller=Session::get('taller_id');
   $user=Session::get('usr_Data');
   $perfid= $request->selectPermisos;
   $tipoDePermiso=Gos_Permiso::where('gos_usuario_perfil_id',$perfid)->get();
   $perfid= $request->selectPermisos;

   foreach ($tipoDePermiso as $Tpermiso) {
          $tipopermisothis = DB::select(DB::raw(
            'SELECT * FROM gos_permiso gp INNER JOIN gos_permiso_item gpi ON gpi.gos_permiso_id = gp.gos_permiso_id
             WHERE gos_usuario_perfil_id ='.$perfid.' AND tipo_permiso = "'.$Tpermiso->tipo_permiso.'"  AND gos_taller_id = '.$idtaller));
      array_push($arraypermisos,$tipopermisothis);
      }
      $perfiles =DB::select('SELECT  * FROM  gos_usuario_perfil up inner join gos_v_equipo_trabajo et on up.gos_usuario_perfil_id = et.gos_usuario_perfil_id where gos_taller_id = '.$idtaller.' and email is not null group by nomb_perfil');

//   foreach ($arraypermisos as $array) {dd($array[0]);  }

   return view("Permisos/listar_permisos",compact('arraypermisos','perfiles'));;
 }
 public function postAddPermisos(Request $request)
 {

   //anadir validacion redirecciona con un mensaje si el permiso ya esta creado
   $idtaller=Session::get('taller_id');
   //validacion para que no aparesca el error si todavia no se crean los permisos_add
   $val = DB::select('select * from gos_permiso where gos_usuario_perfil_id='.$request->selectPermisos.' and gos_taller_id='.$idtaller);

   if( $val != null){
     return redirect('/permisos')->with('notification','El perfil ya existe no se guardo nada. Lo tienes que editar para que se reflejen los cambios.');;
   }
   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Clientes";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarClientes;
   $permiso_item->editar=  $request->editarClientes;
   $permiso_item->ver= $request->verClientes;
   $permiso_item->eliminar=$request->eliminarClientes;
   $permiso_item->save();




   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Vehiculos";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarVehiculos;
   $permiso_item->editar=  $request->editarVehiculos;
   $permiso_item->ver= $request->verVehiculos;
   $permiso_item->eliminar=$request->eliminarVehiculos;
   $permiso_item->save();




   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Presupuestos";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarCot;
   $permiso_item->editar=  $request->editarCot;
   $permiso_item->ver= $request->verCot;
   $permiso_item->eliminar=$request->eliminarCot;
   $permiso_item->save();




   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Ordenes";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarOrd;
   $permiso_item->editar=  $request->editarOrd;
   $permiso_item->ver= $request->verOrd;
   $permiso_item->eliminar=$request->eliminarOrd;
   $permiso_item->save();





   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Facturacion";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarFacturas;
   $permiso_item->editar=  $request->editarFacturas;
   $permiso_item->ver= $request->verFacturas;
   $permiso_item->eliminar=$request->eliminarFacturas;
   $permiso_item->save();




   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Paquetes";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarPaquetes;
   $permiso_item->editar=  $request->editarPaquetes;
   $permiso_item->ver= $request->verPaquetes;
   $permiso_item->eliminar=$request->eliminarPaquetes;
   $permiso_item->save();




   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Compras";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarCompras;
   $permiso_item->editar=  $request->editarCompras;
   $permiso_item->ver= $request->verCompras;
   $permiso_item->eliminar=$request->eliminarCompras;
   $permiso_item->save();



   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Equipo de Trabajo";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarEdt;
   $permiso_item->editar=  $request->editarEdt;
   $permiso_item->ver= $request->verEdt;
   $permiso_item->eliminar=$request->eliminarEdt;
   $permiso_item->save();



   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Inventario";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarInv;
   $permiso_item->editar=  $request->editarInv;
   $permiso_item->ver= $request->verInv;
   $permiso_item->eliminar=$request->eliminarInv;
   $permiso_item->save();




   $permiso = new Gos_Permiso;
   $permiso->gos_usuario_perfil_id = $request->selectPermisos;
   $permiso->tipo_permiso ="Reportes";
   $permiso->gos_taller_id=Session::get('taller_id');
   $permiso->save();

   $permiso_item = new Gos_Permiso_Item;
   $permiso_item->gos_permiso_id = $permiso->gos_permiso_id;
   $permiso_item->agregar =$request->agregarRep;
   $permiso_item->editar=  $request->editarRep;
   $permiso_item->ver= $request->verRep;
   $permiso_item->eliminar=$request->eliminarRep;
   $permiso_item->save();

   return back();
 }


    /**
     *
     * @param string $criterio
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Equipo_Trabajo::where(self::condIdTaller())->get();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $listaPerfilesAdmin = self::listaPerfilAdmin();
        $listaPerfilesTecnicos = $this->listaPerfilTecnico();

        $listaAseguradora = AseguradorasController::listaMinAseguradoras();
        $listaEtapas = Gos_Paq_Etapa::all();

        $compact = compact('listaPerfilesAdmin','listaPerfilesTecnicos','listaAseguradora','listaEtapas');
        return $compact;
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
    //  return $request->gos_usuario_perfil_id;

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
    public function destroy($usuario_id, $gos_usuario_rol_id)
    {
        //
    }

    protected function validaDatos(Request $request)
    {
        /**
         *
         * @var string $nombre
         */
        $nombre = $request->get('Usuario');
        $reglas = [
            'nombre' => 'required'
        ];
        $mensajes = [
            'nombre.required' => 'Falta el nombre'
        ];

        return $this->validate($request, $reglas, $mensajes);
        //
    }

    /**
     * deveulve lista de perfiles con sus roles
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaPerfilAdmin()
    {
        $rolAdmin = 1; //self::rolAdmin();
        return \App\Gos\Gos_V_Usuarios_Perfiles::all()->where('gos_usuario_rol_id', $rolAdmin);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listaPerfilTecnico()

    {
        $rolTecnico = 2;//self::rolTecnico();
        return \App\Gos\Gos_V_Usuarios_Perfiles::all()->where('gos_usuario_rol_id', $rolTecnico);
    }

    /**
     * devuelve el id de rol de administrador
     */
    public static function rolAdmin()
    {
        $rolAdmin = GosSistemaParametrosController::valorEntero('rol_admin');
    }

    /**
     * devuelve el id de rol de tenico
     */
    public static function rolTecnico()
    {
        $rolAdmin = GosSistemaParametrosController::valorEntero('rol_tecnico');
    }
}
