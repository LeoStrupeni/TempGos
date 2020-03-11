<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */



  Route::get('/LigaSeguimiento/{token}', 'Gos\ComunicacionClienteController@seguimiento');
  Route::get('/LigaSeguimiento/{token}', 'Gos\ComunicacionClienteController@seguimiento');
  Route::Post('/LigaSeguimiento/{token}', 'Gos\ComunicacionClienteController@Mensaje');


Route::resource('/', 'Auth\LoginController');
Route::get('/Logout/{mail}/session', 'Auth\LoginController@Logout');
Route::get('/terminosycondiciones', 'Auth\LoginController@tyc');
Route::get('/avisodeprivasidad', 'Auth\LoginController@avisodp');
Route::resource('/RecuperarClave', 'Auth\ForgotPasswordController');
/*---------------------------------------------DECLARA TODAS TUS RUTAS DEBAJO DE ESTA LINEA ES EL ROUTE GROUP DE AUTENTICACION DE USUARIO ----------------------------------------------*/
Route::group(['middleware' => 'GosPAuth'],function () {

Route::resource('/home', 'Gos\HomeController');
Route::get('/ordenes-servicio-calendario/{fecha}', 'Gos\HomeController@preparaDataTableCalendario');
Route::get('/ordenes-servicio-etapas/{nombre}', 'Gos\HomeController@preparaDataTableOrdenes');
Route::get('/gestion-taller/consultar/{id}','Gos\HomeController@consultarBD');
Route::get('/ordenes-servicio-tecnivo/{nomtec}/{idser}/servicio', 'Gos\HomeController@preparaDataTableervicio');



//_____________________________________________________________Encuesta OS_____________________________________________________________
Route::resource('/gestion-encuestas', 'Gos\EncuestasController');
Route::get('/Encuesta/{id}', 'Gos\EncuestasController@encuestaos');
Route::get('/Orden-terminada/{id}/Encuesta', 'Gos\EncuestasController@encuestaosterminada');
Route::get('/Orden-entregada/pdf/encuesta/{id}', 'Gos\EncuestasController@EncuestaPDF');
Route::post('/Orden-terminada/Encuesta/respuestaEncuesta', 'Gos\EncuestasController@respuestaEncuesta');
Route::post('/Orden-terminada/Encuesta/canvas', 'Gos\EncuestasController@Canvas');
Route::get('/agregarEncuesta', 'Gos\EncuestasController@create');
Route::post('/agregarEncuesta/guardar', 'Gos\EncuestasController@store');
Route::post('/agregarEncuesta/guardarpregunta', 'Gos\EncuestasController@GuardarPregunta');
Route::post('/agregarEncuesta/generarencuesta', 'Gos\EncuestasController@GuardarEncuesta');
Route::get('/gestion-encuesta/{id}/borrar', 'Gos\EncuestasController@BorrarEncuesta');
Route::get('/gestion-preguntas', 'Gos\EncuestasController@GetPreguntas');
Route::get('/gestion-preguntas/{id}/edit', 'Gos\EncuestasController@EditarPregunta');
Route::post('/gestion-preguntas/actualizar', 'Gos\EncuestasController@ActualizarPregunta');
Route::get('/gestion-preguntas/{id}/borrar', 'Gos\EncuestasController@BorrarPregunta');
Route::get('/gestion-encuestas/{id}/Editar', 'Gos\EncuestasController@edit');
// Route::post('/gestion-encuestas/{id}/Editar', 'Gos\EncuestasController@update');

//_____________________________________________________________PRESUPUESTOS_____________________________________________________


Route::resource('/ListarPresupuestos', 'Gos\PresupuestosController');
Route::get('/ListarPresupuestos/{status}/carpeta', 'Gos\PresupuestosController@carpetas');
Route::get('/Presupuestos/Agregar', 'Gos\PresupuestosController@AgregarPresupuesto');
Route::post('/Presupuestos/Agregar', 'Gos\PresupuestosController@CrearPresupuesto');
Route::get('/Presupuestos/{id}/Imprimir', 'Gos\PresupuestosController@ImpPresupuesto');
Route::get('/Presupuestos/{id}/Imprimir/HV', 'Gos\PresupuestosController@ImpPresupuestoHV');
Route::get('/Presupuestos/{id}/Ver', 'Gos\PresupuestosController@VerPresupuesto');
Route::get('/Presupuestos/{id}/Editar', 'Gos\PresupuestosController@MostrarEditarPresupuesto');
Route::post('/Presupuestos/{id}/Editar', 'Gos\PresupuestosController@EditarPresupuesto');
Route::get('/Presupuestos/{id}/Borrar', 'Gos\PresupuestosController@BorrarPresupuesto');
Route::get('/Presupuestos/{presid}/Unir/', 'Gos\PresupuestosController@UnirPresupuesto');
Route::post('/Presupuestos/crearyUnir', 'Gos\PresupuestosController@CrearYUnirPresupuesto');
Route::get('/Presupuestos/{id}/Procesar', 'Gos\PresupuestosController@ProcesarPresupuesto');
Route::post('/Presupuesto/Agregar/NuevoConcepto', 'Gos\PresupuestosController@AgregaConcepto');



Route::get('/ListarPresupuestos/datatable', 'Gos\PresupuestosController@DataTablePresupuestos');
Route::get('/ListarPresupuestos/datatable/clientes', 'Gos\PresupuestosController@Dtclientesvehiculo');
Route::post('/presupuestos-items/agregaitem', 'Gos\PresupuestosController@agregaItem');
//_____________________________________________________________PRESUPUESTOS QUALITAS______________________________________________________________________

Route::get('/BandejaQualitas', 'Gos\QualitasController@asignadoqualitas');
Route::post('/BandejaQualitas/getReporte', 'Gos\QualitasController@WSgetReporte');
Route::post('/AsignadasQualitas/Agregar', 'Gos\QualitasController@asigget');
Route::post('/AsignadasQualitas/Agregar/FinalizarOS', 'Gos\QualitasController@finalizarOS');
Route::get('/Presupuestos/Qualitas/{osid}', 'Gos\QualitasController@AgregarPresQualitasGET');
Route::post('/Presupuestos/Qualitas/{osid}', 'Gos\QualitasController@AgregarPresQualitasPost');
Route::post('/Presupuestos/Qualitas/{osid}/Editar', 'Gos\QualitasController@EditarPresQualitasPost');
Route::get('/Presupuestos/Qualitas/{osid}/enviarval/{val}', 'Gos\QualitasController@WSEnviarValuacion');
Route::post('/osgenqlts/{osid}/subirFiles', 'Gos\QualitasController@SubirFiles');//APC PRUEBA
//_________________________________________________________QUALITAS________________________________________________________________________________________
 /**
   * Ordenes Asignadas Qualitas
   */

  // Route::get('/AsignadasQualitas', function () {
  //   return view('/OS/Qualitas/ListarOsAsignadas');
  // });

Route::resource('/gestion-facturas', 'Gos\FacturacionController');
Route::get('/gestion-factura/nuevaFactura/{id}', 'Gos\FacturacionController@nuevafactura');
Route::post('/gestion-factura/agregar/NuevaFactura', 'Gos\FacturacionController@agregarNuevaFactura');
Route::get('/gestion-factura/nuevaRemision/{id}', 'Gos\FacturacionController@nuevaNotaRemision');
Route::get('/gestion-factura/ventaMostrador', 'Gos\FacturacionController@nuevaVentaMostrador');
Route::post('/gestion-factura/agregar/NotaRemision', 'Gos\FacturacionController@agregarNotaRemision');
Route::get('/gestion-factura/delete/NotaRemision/{id}', 'Gos\FacturacionController@eliminarNotaRemision');
Route::get('/gestion-factura/ver/NotaRemision/{id}', 'Gos\FacturacionController@editarNotaRemision');
Route::get('/gestion-factura/ver/NotaRemision/{id}', 'Gos\FacturacionController@editarNotaRemision');
Route::get('/gestion-factura/pdf/NotaRemision/{id}', 'Gos\FacturacionController@ImpNotaRemision');
Route::get('/gestion-factura/pdf/Factura/{id}', 'Gos\FacturacionController@ImpFactura');
Route::get('/gestion-factura/pdf/XML/{id}', 'Gos\FacturacionController@ImpXML');
Route::get('/gestion-factura/pdf/XMLCancelada/{id}', 'Gos\FacturacionController@ImpXMLCancelado');
Route::get('/gestion-factura/enviarhistorico/{id}', 'Gos\FacturacionController@SendHistorico');
Route::get('/gestion-factura/Recuperarhistorico/{id}', 'Gos\FacturacionController@regresarHistorico');
Route::get('/editar-cliente/{id}/{oID}', 'Gos\FacturacionController@editarcliente');
Route::post('/editar-cliente/{id}/{oID}', 'Gos\FacturacionController@guardarcliente');
Route::get('/editar-aseguradora/{id}/{oID}', 'Gos\FacturacionController@editaraseguradora');
Route::post('/editar-aseguradora/{id}/{oID}', 'Gos\FacturacionController@guardaraseguradora');
Route::post('/pagos-multiples', 'Gos\FacturacionController@pagosMultiples');



Route::get('/lista-clientes-vehiculos', 'Gos\OS\OSController@listaClientesVehiculos')->name('/lista-clientes-vehiculos.index');


Route::resource('/gestion-clientes', 'Gos\ClientesController');
Route::get('/gestion-clientes-ciudad/{id}', 'Gos\ClientesController@ciudadLista')->name('/get-ciudadLista');
Route::get('/datos-clientes-vehiculos', 'Gos\ClientesController@deveulveListaClientesVehiculos');

Route::post('etapa-paquete-tecnico', 'Gos\Paquetes\PaquetesItemsController@TecnicoServicio');

Route::resource('/gestion-vehiculos', 'Gos\VehiculosController');
Route::get('/gestion-vehiculos-clientes/{id}', 'Gos\VehiculosController@vehiculosClientes');
Route::resource('/vehiculos-marcas', 'Gos\VehiculosMarcasController');
Route::resource('/vehiculos-modelos', 'Gos\VehiculosModelosController');
Route::resource('/vehiculos-colores', 'Gos\VehiculosColoresController');
Route::get('/vehiculos-color/{id}/eliminar', 'Gos\VehiculosColoresController@eliminar');
Route::get('/datos-marcas-vehiclos', 'Pruebas\PruebaAjaxController@datosMarcaVehiculos')->name('/get-datosMarcaVehiculos');
Route::get('/gestion-vehiculos-modelo/{id}', 'Gos\VehiculosController@modeloLista')->name('/get-modeloMarca');
/**
 * Taller
 */
// Route::resource('/taller-config-os', 'Gos\Taller\TallerConfigOSController');

/**
 * PROVEEDORES
 */
Route::resource('/gestion-proveedores', 'Gos\ProveedoresController');
Route::post('/ProveedorCargaRapida', 'Gos\ProveedoresController@cargaRapida');

/**
 * Equipo de trabajo
 */
Route::resource('/gestion-equipo-trabajo', 'Gos\EquipoTrabajoController');
Route::get('/gestion-equipo-trabajo/delete/{id}', 'Gos\EquipoTrabajoController@destroy');
Route::post('/gestion-equipo-trabajo/store', 'Gos\EquipoTrabajoController@store');
Route::get('/gestion-equipo-trabajo/delete/{id}', 'Gos\EquipoTrabajoController@destroy');
/**
 * Permisos
 */



//Route::get('/permisos', 'Gos\PermisosController@ListarPermisos');
Route::post('/permisos_post', 'Gos\PermisosController@postSelectPermisos');
Route::post('/permisos_add', 'Gos\PermisosController@postAddPermisos');

Route::get('/permisos', 'Gos\PermisosController@listarIndex');
Route::get('/permisos/editar/{id}/perfil', 'Gos\PermisosController@editarPerfil');
Route::post('/editarPermisosPost', 'Gos\PermisosController@editarPermisosPost');


/**
 * TOT
 * Martin
 */

Route::resource('/gestion-otrotaller', 'Gos\OtroTallerController');
/**
 * Comentario email
 */
Route::get('/ComentarioEmail', function () {
    return view('/ComentarioEmail/ComentarioEmail');
});


Route::get('/mensajes/{id}', 'Gos\ComunicacionClienteController@mensajes');
Route::get('/revisar-mensajes','Gos\ComunicacionClienteController@revisarmensajes');
Route::post('/enviar-mensajes','Gos\ComunicacionClienteController@send');
Route::get('/marcar-mensaje/{idmens}','Gos\ComunicacionClienteController@mensajeres');
Route::post('/reenviar-mensajes-ligaseg','Gos\ComunicacionClienteController@reenviarliga');


        Route::resource('/gestion-servicios', 'Gos\Paquetes\ServiciosController');
        Route::get('/gestion-servicios/delete/{id}', 'Gos\Paquetes\ServiciosController@destroy');
        Route::post('/gestion-servicios/store', 'Gos\Paquetes\ServiciosController@store');
        Route::get('/orden-servicio/{id}/{oID}', 'Gos\Paquetes\ServiciosController@salvarOrden');
        /**
         * Etapas
         */
        Route::resource('/gestion-etapas', 'Gos\Paquetes\EtapasController');
        Route::get('/gestion-etap/agregar', 'Gos\Paquetes\EtapasController@agregaretapaget');
        Route::post('/gestion-etap/agregar', 'Gos\Paquetes\EtapasController@agregaretapapost');
        Route::get('/gestion-etap/{id}/eliminar', 'Gos\Paquetes\EtapasController@destroy');
        Route::get('/gestion-etap/{id}/editar', 'Gos\Paquetes\EtapasController@editarget');
        Route::post('/gestion-etap/{id}/editar', 'Gos\Paquetes\EtapasController@editarpost');
        Route::get('/gestion-etap/{id}/eliminarmensaje', 'Gos\Paquetes\EtapasController@eliminarmensaje');
        Route::get('/gestion-etap/{id}/eliminartiempo', 'Gos\Paquetes\EtapasController@eliminartiempo');
        Route::get('/gestion-etap/{id}/eliminarperdida', 'Gos\Paquetes\EtapasController@eliminarperdida');
        Route::get('/gestion-etap/{id}/eliminarligada', 'Gos\Paquetes\EtapasController@eliminarligada');
        Route::get('/gestion-etap/{id}/eliminardaños', 'Gos\Paquetes\EtapasController@eliminardaños');

        Route::get('/orden-etapas/{id}/{oID}', 'Gos\Paquetes\EtapasController@salvarOrden');

        /**
         * Paquetes
         */
        Route::resource('/gestion-paquetes', 'Gos\Paquetes\PaquetesController');
        Route::resource('/gestion-paquetes-items', 'Gos\Paquetes\PaquetesItemsController');
        Route::get('/orden-paquetes-etapas/{id}/{oID}', 'Gos\Paquetes\PaquetesItemsController@salvarOrden');
        // Fin Gos\Paquetes\

        Route::resource('/gestion-taller', 'Gos\Taller\MiTallerController');
        Route::post('/gestion-taller/logotaller', 'Gos\Taller\MiTallerController@LogoTaller');
        Route::post('/gestion-taller/facturacion', 'Gos\Taller\MiTallerController@storefacturacion');
        Route::post('/gestion-taller/configuracion', 'Gos\Taller\MiTallerController@storeconfiguracion');
        Route::get('/gestion-taller/eliminar/{id}', 'Gos\Taller\MiTallerController@eliminarHorario');
        Route::post('/gestion-taller/subir','Gos\Taller\MiTallerController@subirImg');
        Route::get('/gestion-taller/cargardir/{id}','Gos\Taller\MiTallerController@cargarDir');



        Route::get('/gestion-equipo-trabajo/delete/{id}', 'Gos\EquipoTrabajoController@destroy');
        Route::post('/gestion-equipo-trabajo/store', 'Gos\EquipoTrabajoController@store');

        Route::get('/edt/limit','Gos\EquipoTrabajoController@getLimitUsuarios');
        //_______________________________________________________________________________________E_LEARNING_ROUTES_________________________________________________________________________
        Route::get('/elearn', 'Gos\LearningController@index');
        Route::get('/elearning/videos/{id}', 'Gos\LearningController@selectorVidio');
        Route::get('/elearning/docs/{id}', 'Gos\LearningController@selectorDocs');


        /**
         * Soporte
         */
          Route::get('/soporte','Gos\SoporteController@index');
          Route::post('/soporte/agregarticket','Gos\SoporteController@agregarTicket');
          Route::get('/soporte/mensaje/{id}','Gos\SoporteController@mensaje');
          Route::post('/soporte/mensaje/{id}','Gos\SoporteController@mensajePost');

        /**
         * RUTAS CONTROLLERS PRODUCTOS INTERNOS y EXTERNO
         */
        Route::resource('/inventario-interno', 'Gos\ProductosController');
        Route::resource('/inventario-externo', 'Gos\InventarioExternoController');
        Route::post('/inventario-externo-Entrega','Gos\InventarioExternoController@entregarProductoExterno');
        Route::get('/inventario-externo-lista/{id}','Gos\InventarioExternoController@listaEntregas');
        Route::get('/inventario-externo-Entrega-Historial','Gos\InventarioExternoController@listaEntregasCompleto');

        //
        //HISTORIAL INVENTARIO EXTERNO
        route::get('/Historial-externo-compra/{id}','Gos\InventarioExternoController@ultimaCompra');
        route::get('/Historial-externo-compra-items/{id}','Gos\InventarioExternoController@itemsUltimaCompra');
        route::get('/Historial-externo-compra-tecnicos/{id}','Gos\InventarioExternoController@listaCantidadTecnicos');

        //HISTORIAL INVENTARIO INTERNO
        route::get('/Historial-interno-compra/{id}','Gos\ProductosController@ultimaCompra');
        route::get('/Historial-interno-compra-items/{id}','Gos\ProductosController@itemsUltimaCompra');
        route::get('/Historial-interno-compra-os/{id}','Gos\ProductosController@listaOsVendidos');

        Route::resource('/ubicaciones', 'Gos\ProductosUbicacionesController');
        Route::resource('/ubicacionesstock', 'Gos\ProductosUbicStockControllers');
        Route::resource('/familias', 'Gos\ProductosFamiliasController');
        Route::resource('/marcas-productos', 'Gos\ProductosMarcasController');
        Route::resource('/unidadesMedidas-productos', 'Gos\ProductosUnidadMedidaController');

        Route::post('/MarcaCargaRapida', 'Gos\ProductosMarcasController@cargaRapida');
        Route::post('/FamiliaCargaRapida', 'Gos\ProductosFamiliasController@cargaRapida');
        Route::post('/UbicacionCargaRapida', 'Gos\ProductosUbicacionesController@cargaRapida');



        /**
         * Presupuestos
         */

        Route::resource('/gestion-presupuestos', 'Gos\PresupuestosController');

        Route::get('/CrearPresupuesto', function () {
            return view('/Presupuesto/CrearPresupuesto');
        });
        /**
         * Ordenes de servicios
         */
        Route::resource('/ordenes-servicio', 'Gos\OS\OSController');

        Route::post('/ordenes-servicio/ligar', 'Gos\OS\OSController@LigarOs');
        Route::get('/ordenes-servicio/ligadas/{id}', 'Gos\OS\OSController@GetOsLigadas');

        Route::get('/ordenes-serv/Proceso', 'Gos\OS\OSController@GetOSProceso');
        Route::get('/ordenes-serv/Entregadas', 'Gos\OS\OSController@GetOSEntregadas');
        Route::get('/ordenes-serv/Teminadas', 'Gos\OS\OSController@GetOSTerminadas');
        Route::get('/ordenes-serv/historico', 'Gos\OS\OSController@GetOSHistorico');
        Route::get('/ordenes-serv/canceladas', 'Gos\OS\OSController@GetOSCancelado');

        Route::get('/ordenes-serv/Agregar', 'Gos\OS\AgregarOSController@AgregarOSget');
        Route::Post('/ordenes-serv/Agregar', 'Gos\OS\AgregarOSController@AgregarOSpost');
        Route::get('/ordenes-serv/{id}/getetapa', 'Gos\OS\AgregarOSController@getEtapasTaller');
        Route::get('/ordenes-serv/{id}/getpaquete', 'Gos\OS\AgregarOSController@getPaquetesTaller');
        Route::get('/ordenes-serv/{id}/getvalidaciones', 'Gos\OS\AgregarOSController@getAseguradoraVal');
        Route::get('/ordenes-serv/{id}/getproducto', 'Gos\OS\AgregarOSController@getEtProductoTaller');

        // preuba roque paginacion
        Route::get('/page', 'Gos\OS\OSController@paginacion');
        Route::post('/page', 'Gos\OS\OSController@paginacion');
        Route::get('/listaros', 'Gos\OS\OSController@verospro');
        Route::post('/listaros-search', 'Gos\OS\OSController@resospro');
        Route::get('/listarter', 'Gos\OS\OSController@veroster');
        Route::post('/listarter-search', 'Gos\OS\OSController@resoster');

        Route::get('/listarent', 'Gos\OS\OSController@verosent');
        Route::post('/listarent-search', 'Gos\OS\OSController@resosent');

        Route::get('/listarhis', 'Gos\OS\OSController@veroshis');
        Route::post('/listarhis-search', 'Gos\OS\OSController@resoshis');

        Route::get('/listarcan', 'Gos\OS\OSController@veroscan');
        Route::post('/listarcan-search', 'Gos\OS\OSController@resoscan');


       //apc
        Route::get('/ordenes-serv/{id}/editar', 'Gos\OS\EditarOSController@index');
        Route::post('/ordenes-serv/{id}/editar', 'Gos\OS\EditarOSController@editar');
        Route::get('/ordenes-serv/{id}/editar/eliminaritem', 'Gos\OS\EditarOSController@eliminaritem');

        Route::get('/ordenes-serv/{id}/masetapa/{eta}/{ser}/{to}/{mo}', 'Gos\OS\EditarOSController@agregaretapa');
        Route::get('/ordenes-serv/{id}/maspaq/{paq}', 'Gos\OS\EditarOSController@agregarpaquete');
        Route::get('/ordenes-serv/{id}/masprod/{prod}/{can}/{prec}', 'Gos\OS\EditarOSController@agregarproducto');
        Route::post('/ordenes-serv/{id}/agregarAnticipo', 'Gos\OS\EditarOSController@agregaranticipo');
        Route::get('/ordenes-serv/{osid}/{itmid}/editarorden/{or}', 'Gos\OS\EditarOSController@ordenitem');
        Route::get('/ordenes-serv/{itmid}/estadoeta/{ac}', 'Gos\OS\EditarOSController@estadoitem');

        //apc

        Route::resource('/ordenes-servicio-items', 'Gos\OS\ItemOSController');
        Route::get('/ordenes-servicio-producto-items/{id}', 'Gos\OS\ItemOSController@preparInfoProductoDataTable');
        Route::get('/ordena-os/{id}/{posAnte}/{posFinal}', 'Gos\OS\OSController@ordenaItem'); // {gos_os_item_id}/{posAnte}/{posFinal}
        Route::post('/anticipo-guarda', 'Gos\OS\OSController@guardaAnticipo')->name('/anticipo.store');
        Route::resource('/gestion-anticipos', 'Gos\OS\AnticiposController');

        Route::get('/servicios-os/{id}', 'Gos\OS\ItemOSController@listaServicios');
        Route::get('/orden-servicio-generada/{id}/Itemsserv', 'Gos\OS\ItemOSController@getItmServicios');
        Route::post('/orden-servicio-generada/{id}/AgregarServicio', 'Gos\OS\ItemOSController@AgregarServicio');
        Route::post('orden-servicio-generada/{id}/Guardar', 'Gos\OS\ItemOSController@GuardarServicios');
        Route::post('orden-servicio-generada/{id}/Eliminar', 'Gos\OS\ItemOSController@EliminarServicio');
        Route::post('orden-servicio-generada/tecnico', 'Gos\OS\ItemOSController@TecnicoServicio');
        Route::get('orden-servicio-generada/tecnicoAutoCalc/{id}', 'Gos\OS\ItemOSController@TecnicoServicioAutocal');
        Route::get('/orden-servicio-generada/{id}/tecnicoPreferencias', 'Gos\OS\ItemOSController@TecnicoParams');


        Route::resource('/inventario-vehiculo', 'Gos\OS\InventarioVehiculoController');
        Route::post('/generarIdInventario', 'Gos\OS\InventarioVehiculoController@generarIdInventario');

        Route::get('/preparaInventarioVehiculo/{id}', 'Gos\OS\OSController@preparaInventarioVehiculo');

        Route::post('/ordenes-servicio/canvas', 'Gos\OS\InventarioVehiculoController@CanvasInventario');

        Route::resource('/orden-servicio-generada', 'Gos\OS\OSGeneradaController');
        Route::post('/finalizar-etapas', 'Gos\OS\OSGeneradaController@finalizarEtapa');
        Route::get('/finalizar-etapas-dash/{var}', 'Gos\OS\OSGeneradaController@finalizarEtapaDashboard');

        Route::get('/orden-servicio-generada/{id}/datatable','Gos\OS\OSGeneradaController@getdatatablerefacciones');

        Route::get('/osg-producto-externo/{id}', 'Gos\OS\OSGeneradaController@getDataTableProductoExterno');
        Route::post('/orden-servicio-generada/{id}/guardar','Gos\OS\RefaccionesOSController@guardarref');
        Route::post('/osg-producto-externo-store','Gos\OS\OSGeneradaController@setProductoExternoOS');
        Route::get('/osg-producto-externo-delete/{id}','Gos\OS\OSGeneradaController@deleteProductoExternoOS');
        Route::get('/orden-editar-os-etapas/{id}/{oID}', 'Gos\OS\OSGeneradaController@ordenEtapaOS');
        //_____________________________________________________________________________________________________________BLOCK RUTAS REFACCIONES___________________________________________________________________________________________________
        Route::post('/orden-servicio-generada/presupuesto','Gos\PresupuestosController@OSpresupuestoagregaredt');
        Route::post('/orden-servicio-generada/{id}/AgregarRefaccion','Gos\OS\RefaccionesOSController@agregaritemrefacciones');
        Route::get('/orden-servicio-generada/{id}/EliminarRefaccion','Gos\OS\RefaccionesOSController@eliminaritemrefaccion');
        Route::post('/orden-servicio-generada/CancelarRefaccion/','Gos\OS\RefaccionesOSController@CancelarRefaccion');
        Route::get('/orden-servicio-generada/{id}/refaccion','Gos\OS\RefaccionesOSController@getrefaccion');
        Route::get('/orden-servicio-generada/{id}/provedor','Gos\OS\RefaccionesOSController@getprovedoresrefacciones');
        Route::get('/orden-servicio-generada/{id}/provedores/{cadprov}/piezas','Gos\OS\RefaccionesOSController@countrefaccionespros');
        Route::get('/orden-servicio-generada/{id}/estatus/{cadprov}/piezas','Gos\OS\RefaccionesOSController@countrefaccioneestatus');
        Route::get('/orden-servicio-generada/{id}/{typo}/fecha','Gos\OS\RefaccionesOSController@updatefecha');
        Route::get('/orden-servicio-gen/ubicaciones','Gos\OS\RefaccionesOSController@Ubicacionesref');
        Route::get('/orden-servicio-gen/Proveedores','Gos\OS\RefaccionesOSController@Provedoresesref');
        Route::post('/orden-servicio-gen/Proveedores/refaccion','Gos\OS\RefaccionesOSController@updateprovedor');
        Route::post('/orden-servicio-gen/AgregarProvedorAsig/refaccion','Gos\OS\RefaccionesOSController@createandupdateprovedor');
        Route::get('/orden-servicio-gen/AutorizarRef/{osid}/refacciones','Gos\OS\RefaccionesOSController@Autorizarrefacciones');
        Route::get('/orden-servicio-gen/EntrgarRef/{osid}/refacciones','Gos\OS\RefaccionesOSController@EntrgarRef');
        Route::get('/orden-servicio-gen/FPortarlRef/{osid}/refacciones','Gos\OS\RefaccionesOSController@FPortarlRef');
        Route::get('/orden-servicio-gen/rechasada/{id}/refaccion','Gos\OS\RefaccionesOSController@refrechasada');
        Route::get('/orden-servicio-gen/noauorizada/{id}/refaccion','Gos\OS\RefaccionesOSController@refnoautorizada');
        Route::get('/orden-servicio-gen/{id}/imprimirrefacciones','Gos\OS\RefaccionesOSController@imprimir');
        Route::post('/orden-servicio-gen/{id}/refacciones/guardarcomentario','Gos\OS\RefaccionesOSController@guardarcomentario');

          Route::get('/refacciones/{id}','Gos\OS\RefaccionesOSController@indexplano');
        //_____________________________________________________________________________________________________________BLOCK RUTAS REFACCIONES___________________________________________________________________________________________________
        Route::get('/obtener-mensaje-etapas/{id}', 'Gos\OS\OSGeneradaController@mensajeLista');
        Route::get('/obtener-tipo-etapas/{id}', 'Gos\OS\OSGeneradaController@tipoEtapa');
        Route::get('/obtener-fecha-activa/{id}', 'Gos\OS\OSGeneradaController@fechaEtapaActiva');
        Route::get('/obtener-pedida-pago/{id}', 'Gos\OS\OSGeneradaController@perdidapago');
        Route::post('/osg-siguiente-etapa', 'Gos\OS\OSGeneradaController@siguienteEtapa');
        Route::get('/osg-siguiente-etapa-f/{id}', 'Gos\OS\OSGeneradaController@etapasFinalizadasModal');
        Route::post('/osg-desactivar-etapa', 'Gos\OS\OSGeneradaController@desactivarEtapa');
        Route::get('/obtener-mensaje/{id}', 'Gos\OS\OSGeneradaController@mensajeActivo');
        Route::post('/osg-fecha-promesa', 'Gos\OS\OSGeneradaController@actualizaFechaOS');
        Route::post('/osg-perdidatal', 'Gos\OS\OSGeneradaController@perdidatotal');
        Route::post('/osg-pagodaños', 'Gos\OS\OSGeneradaController@pagodaños');

        Route::get('/osg-fecha-entregar/{id}', 'Gos\OS\OSGeneradaController@entregar');

        Route::post('/osg-comentario-extra', 'Gos\OS\OSGeneradaController@comentarioExtra');

        Route::post('/osg-fecha-ingreso', 'Gos\OS\OSController@actualizaFechaIngresoOS');
        Route::get('/osg-inventario-interno/{id}','Gos\OS\OSGeneradaController@inventarioIntOS');
        Route::post('/osg-agregar-inventario-interno','Gos\OS\ItemOSController@agregarInventarioIntOS');
        Route::get('/osg-clientes-os/{id}', 'Gos\OS\OSController@clientesOS');
        Route::get('/chart-etapas/{id}', 'Gos\OS\OSGeneradaController@chartEtapas');
        Route::get('/refrescaImgInternas/{id}', 'Gos\OS\OSGeneradaController@refrescaImgInternas');
        Route::get('/refrescaImgCliente/{id}', 'Gos\OS\OSGeneradaController@refrescaImgCliente');
        Route::get('/refrescaDocumentos/{id}', 'Gos\OS\OSGeneradaController@refrescaDocumentos');

        Route::get('/osg-mensaje-cliente/{id}','Gos\OS\OSGeneradaController@clientesMensajes');
        // Route::get('/osg-mensaje-cliente/{id}/borrar','Gos\OS\OSGeneradaController@clientesMensajeborrar');
        Route::get('/osg-mensaje-equipo/{id}','Gos\OS\OSGeneradaController@equiposMensajes');
        Route::get('/osg-mensaje/{id}/borrar','Gos\OS\OSGeneradaController@Mensajeborrar');

        Route::post('/guardarImgCliente/{id}', 'Gos\OS\OSGeneradaController@guardarImgCliente')->name('guardarImgCliente');
        Route::get('/imgEtapa/{id}', 'Gos\OS\OSGeneradaController@imgEtapa');
        Route::post('/guardarImgInterna/{id}', 'Gos\OS\OSGeneradaController@guardarImgInterna')->name('guardarImgInterna');
        Route::post('/guardarDocumento/{id}', 'Gos\OS\OSGeneradaController@guardarDocumento')->name('guardarDocumento');

        Route::delete('/destroyDoc/{id}','Gos\OS\OSGeneradaController@destroyDoc')->name('destroyDoc');
        Route::delete('/destroyImgCliente/{id}','Gos\OS\OSGeneradaController@destroyImgCliente');
        Route::delete('/destroyImgInterna/{id}','Gos\OS\OSGeneradaController@destroyImgInterna');

        //ruta repetida OJO
        // Route::resource('/ordenes-servicio', 'Gos\OS\OSController');


        Route::resource('/osg-lista-etapas', 'Gos\SoloPruebas\PruebasYOISController');
        Route::get('/osg-muestra-lista-etapas/{id}', 'Gos\SoloPruebas\PruebasYOISController@listaEtapasOS');
        Route::post('/osg-guarda-datos-etapa', 'Gos\SoloPruebas\PruebasYOISController@guardaDatos');
        Route::get('/osg-lista-items-editar', 'Gos\OS\OSGeneradaController@editaItemOs');
        Route::post('/osg-actualiza-asesor', 'Gos\OS\OSGeneradaController@actualizaAsesor');
        Route::post('/osg-actualiza-precio', 'Gos\OS\OSGeneradaController@actualizaPrecioEtapa');
        Route::post('/osg-actualiza-materiales', 'Gos\OS\OSGeneradaController@actualizaPrecioMateriales');
        Route::get('/osg/{id}/descargarimagenes', 'Gos\OS\OSGeneradaController@descargarImgCliente');
        Route::get('/osg/{id}/descargarimagenesint', 'Gos\OS\OSGeneradaController@descargarImgInterna');
        Route::get('/osg/{id}/borraros', 'Gos\OS\OSGeneradaController@borrarOS');
        Route::get('/osg/{id}/cancelaros', 'Gos\OS\OSGeneradaController@cancelarOS');
        Route::get('/osg/{id}/regresar-cancelaros', 'Gos\OS\OSGeneradaController@regresarCanceladaOS');
        Route::get('/osg/{id}/mandar-his-os', 'Gos\OS\OSGeneradaController@mandarHisOS');
        Route::get('/osg/{id}/terminadas-a-proceso', 'Gos\OS\OSGeneradaController@borrarFecha');
        Route::get('/osg/fecha-historico/{id}', 'Gos\FacturacionController@fechaHistorico');
        Route::get('/osg/mandar-historico/{id}', 'Gos\FacturacionController@mandarOsHistorico');//corregir porque ya no se tomara esa columna
        Route::get('/osg/fecha-cancelada/{id}', 'Gos\FacturacionController@cancelarNotaRemision');
        Route::post('/osg/edit-precio', 'Gos\OS\OSGeneradaController@editarItemPrecio');
        Route::post('/pagar-nota-remision', 'Gos\FacturacionController@pagarNotaRemision');
        Route::get('/cancelar-factura/{id}', 'Gos\FacturacionController@cancelarFactura');
        /* YOIS */

        Route::post('/os-clientes-vehiculo', 'Gos\OS\OSController@insertaClienteVehiculo');
        // .store

        Route::post('/econtrarClientesVehiculos', 'Gos\OS\OSController@encuentra')->name('/ordenes-servicio.encuentra');
        Route::post('/guardarClienteVehiculo', 'Gos\OS\OSController@clienteVehiculoStore')->name('/ordenes-servicio.clienteVehiculoStore');
        Route::post('/enviaWhatsApp', 'Gos\OS\OSController@enviaWhatsApp')->name('/ordenes-servicio.enviaWhatsApp');
        // YOIS
        Route::post('/1', 'Gos\OS\OSController@guardaOrdenServicio')->name('/ordenes-servicio.guardaOrdenServicio');
        // Leo
        Route::post('/1', 'Gos\OS\OSController@guardaItemOrdenServicio')->name('/ordenes-servicio.guardaItemOrdenServicio');
        Route::post('/2', 'Gos\OS\OSController@traeDatosItemEtapa')->name('/ordenes-servicio.traeDatosItemEtapa');
        Route::post('/3', 'Gos\OS\OSController@traeDatosItemPaquete')->name('/ordenes-servicio.traeDatosItemPaquete');
        Route::post('/4', 'Gos\OS\OSController@guardaItemOrdenServicio')->name('/ordenes-servicio.guardaItemOrdenServicio');

        /*
         * Trabajo con PDF
         */
        // Orden-servicio PDF
        Route::get('/OS/{id}/pdf/', 'Gos\GeneracionPDFController@exportPdfOS')->name('OS_pdf');
        Route::get('/orden/export', 'Gos\GeneracionPDFController@exportPdfOS')->name('orden-export');
        // Presupuesto PDF
        Route::get('/presupuesto/export', 'Gos\GeneracionPDFController@exportPdfPresupuesto')->name('/presupuesto-export');
        // Facturacion PDF
        Route::get('/Facturacion/pdf', 'Gos\GeneracionPDFController@exportPdFacturacion');
        Route::get('/facturacion/export', 'Gos\GeneracionPDFController@exportPdfacturacion')->name('/facturacion-export');


        /**
         * Trabajo con EXCEL
         */
        // Vehiculos EXCEL
        Route::get('/ExportExcelVehiculo', 'Gos\ExcelController@plantillaVehiculosExcel')->name('ExportarExcelVehiculo');
        Route::post('/importaVechiculosExcel', 'Gos\ExcelController@importaVechiculosExcel')->name('ImportarExcelVehiculo');
        // Productos EXCEL
        Route::get('/ExportExcelInventario', 'Gos\ExcelController@plantillaInventarioExcel')->name('ExportarExcelInventario');
        Route::post('/importaInventarioExcel', 'Gos\ExcelController@importaInventarioExcel')->name('ImportarExcelInventario');

        /**
         * Compras
         */

        Route::resource('/gestion-compras', 'Gos\ComprasController');
        Route::resource('/gestion-compras-items', 'Gos\ComprasItemsController');
        Route::get('/gestion-comp/Adeudo', 'Gos\ComprasController@GetCompraAdeudo');

        Route::post('/gestion-compras-item-Borrar', 'Gos\ComprasItemsController@borrarItem');
        Route::post('/pagoCompraContacto', 'Gos\ComprasController@pagoCompraContado');
        Route::post('/registro-pago-compra', 'Gos\ComprasController@pagoCompra');
        Route::get('/pagosPorCompra/{id}', 'Gos\ComprasController@listaPagoPorCompra');
        Route::get('/ListaPagos', 'Gos\ComprasController@listaPagos');
        Route::post('/UnirCompraOs', 'Gos\ComprasController@unirCompra');

        Route::get('/RegistroPagosCompra/{id}', 'Gos\ComprasController@RegistroPagosCompra');


        /**
         * Requisiciones
         */

        Route::resource('/gestion-requisicion', 'Gos\RequisicionController');
        Route::resource('/gestion-requisicion-items', 'Gos\RequisicionItemController');
        Route::get('/listaVehiculosRequisicion', 'Gos\RequisicionController@listaVehiculos');


        /**
         * Pagos
         */

        Route::resource('/gestion-pagos', 'Gos\PagosController');
        Route::resource('/gestion-pagos-multiples', 'Gos\PagosController');

        /**
         * Ventas
         */

        Route::resource('/gestion-ventas', 'Gos\VentasController');

        /**
         * Aseguradoras
         */

        Route::resource('/gestion-aseguradoras', 'Gos\AseguradorasController');
        Route::get('/gestion-aseguradoras/delete/{id}', 'Gos\AseguradorasController@destroy');
        // Route::post('/gestion-aseguradoras/store', 'Gos\AseguradorasController@store');
        Route::get('/gestion-aseguradoras/indexAjax', 'Gos\AseguradorasController@indexAjax');

        /**
         * Usuarios
         */
        Route::resource('/gestion-usuarios-tecnicos', 'Gos\UsuariosTecnicosController');
        Route::resource('/gestion-usuarios-admin', 'Gos\UsuariosAdminController');
        Route::resource('/gestion-equipo-trabajo', 'Gos\EquipoTrabajoController');

        /**
         * Prestamos
        */
        Route::resource('/gestion-prestamos', 'Gos\PrestamosController');
        Route::Post('/gestion-prestamos-pagos', 'Gos\PrestamosController@storePago');
        Route::get('/gestion-prestamos-historial/{id}', 'Gos\PrestamosController@HistorialPrestamos');


        /**
         * Reportes
         */

        Route::get('/ReporteProductividadEtapa', 'Gos\Reportes\ReporteProductividadEtapaController@indexV2');
        Route::post('/ReporteProductividadEtapa', 'Gos\Reportes\ReporteProductividadEtapaController@filtros');
        //Route::get('/os-etapas-productividad/{nombre}/{fecha}/{estatus}/{dano}/{aseguradora}', 'Gos\Reportes\ReporteProductividadEtapaController@preparaDataTableOrdenes');
        Route::get('/os-etapas-productividad/{ideta}/{iditem}', 'Gos\Reportes\ReporteProductividadEtapaController@dtitemstetapa');
        Route::get('/os-etapas-productividad-act/{nombre}/{fecha}/{estatus}/{dano}/{aseguradora}', 'Gos\Reportes\ReporteProductividadEtapaController@preparaDataTableOrdenesAct');
        Route::get('/ReporteEtapasEnProceso', 'Gos\Reportes\ReporteEtapasEnProcesoController@index');
        Route::get('/ReporteEtapasEnProceso/aseguradora/{id}', 'Gos\Reportes\ReporteEtapasEnProcesoController@aseguradora');
        Route::get('/ReporteEtapasEnProceso/danio/{id}', 'Gos\Reportes\ReporteEtapasEnProcesoController@danio');
        Route::get('/ReporteEtapasEnProceso/orden/{id}', 'Gos\Reportes\ReporteEtapasEnProcesoController@orden');
        Route::get('/ReporteEtapasEnProceso/etapas/{id}', 'Gos\Reportes\ReporteEtapasEnProcesoController@etapas');

        Route::post('/ReporteEtapasEnProceso/filtrar', 'Gos\Reportes\ReporteEtapasEnProcesoController@filtros');







      // Reporte Nomina
        Route::get('/ReporteNomina', 'Gos\Reportes\ReporteNominaController@index');
        Route::get('/Nomina', 'Gos\Reportes\ReporteNominaController@crearReporte');
        Route::post('/Nomina', 'Gos\Reportes\ReporteNominaController@crearReporteFiltrado');
        Route::post('/ReporteNomina/Agregar', 'Gos\Reportes\ReporteNominaController@AgregarNomina');
        Route::get('/verNomina/{id}', 'Gos\Reportes\ReporteNominaController@verNomina');

        Route::get('/ReporteNominaTecnicos/{nomtec}', 'Gos\Reportes\ReporteNominaController@preparaDataTableervicio');

        // Reporte de seguimiento al cliente
        Route::resource('/ReporteSeguimientoAlCliente','Gos\Reportes\ReporteSeguimientoClienteController');
        Route::post('/ReporteSeguimientoAlCliente','Gos\Reportes\ReporteSeguimientoClienteController@indexFiltros');
        Route::get('/ReporteSeguimientoMjs/{id}','Gos\Reportes\ReporteSeguimientoClienteController@clientesMensajes');

        // Reporte Ordenes por Tecnico
        Route::resource('/ReporteOrdenesTecnicos', 'Gos\Reportes\ReporteOSTecnicos');
        Route::get('/ReporteOrdenesTecnicosOS/{datos}', 'Gos\Reportes\ReporteOSTecnicos@ordenes');
        Route::get('/FiltrostablaTecnicosOS/{datos}', 'Gos\Reportes\ReporteOSTecnicos@setTabla');

        // Reporte Ordenes Imprimir
        Route::resource('/ReporteImprimirOs', 'Gos\Reportes\ReporteOsImprimirController');

        // ReporteEncuestaOS
        Route::resource('/ReporteEncuestaOS', 'Gos\Reportes\ReporteEncuestaOSController');
        Route::get('/ReporteEncuestaOS/chart/{id}/{fechain}/{fechafin}', 'Gos\Reportes\ReporteEncuestaOSController@chart');

        // ReporteSeguimientoRefacciones
        Route::resource('/ReporteSeguimientoRefacciones', 'Gos\Reportes\ReporteSeguimientoRefaccionesController');
        Route::get('/ReporteRefacciones/{osid}/datatable/Povedor/{idprov}/estatus/{idest}', 'Gos\Reportes\ReporteSeguimientoRefaccionesController@getdatatablerefacciones');

        // ReporteUtilidad
        Route::resource('/ReporteUtilidadUnidad', 'Gos\Reportes\ReporteUtilidadController');
        Route::get('/ReporteUtilidadUnidadGraf', 'Gos\Reportes\ReporteUtilidadController@graficoA');
        Route::post('/FiltrosUtilidad', 'Gos\Reportes\ReporteUtilidadController@setTabla');
        Route::get('/detallesOs/{id}', 'Gos\Reportes\ReporteUtilidadController@detallesOs');
        // ReporteFechaPromesa
        Route::resource('/ReporteCalendario', 'Gos\Reportes\ReporteFechaPromesaController');
        Route::get('/ReporteFechaPromesa', 'Gos\Reportes\ReporteFechaPromesaController@cargaDatosTabla');
        // ReporteOrdenServicioProcesada
        Route::resource('/ReporteOrdenesProcesadas', 'Gos\Reportes\ReporteOSProcController');
        Route::get('/ReporteOrdenesProcesadasGraf', 'Gos\Reportes\ReporteOSProcController@graficoA');
        Route::post('/FiltrostablaOSProc', 'Gos\Reportes\ReporteOSProcController@setTabla');
        Route::post('/TablaOSFiltrada', 'Gos\Reportes\ReporteOSProcController@preparaDataTableOrdenes');
         // ReporteCorteDiario
        Route::resource('/ReporteCorteDiario', 'Gos\Reportes\ReporteCorteDiarioController');
        Route::post('/FiltrostablaCorteDiario', 'Gos\Reportes\ReporteCorteDiarioController@setTabla');

        // ReporteCompras
        Route::resource('/ReporteCompras', 'Gos\Reportes\ReporteComprasController');
        Route::post('/FiltrosReporteCompras', 'Gos\Reportes\ReporteComprasController@setTabla');

        // Reporte por pagar Proveedores
        Route::resource('/ReportePorPagarProveedores','Gos\Reportes\ReportePorPagarProvController');
        Route::post('/ReportePorPagarProveedores','Gos\Reportes\ReportePorPagarProvController@indexFiltros');


        //_________________________________________________________________________________VSM BGIN______________________________________________________________
          Route::get('/ReporteVSM', 'Gos\Reportes\ReporteVSMController@indexv2');
          Route::post('/ReporteVSM', 'Gos\Reportes\ReporteVSMController@filterv2');
          Route::get('/ReporteVSM/PDF/{ase}/{fini}/{ffin}', 'Gos\Reportes\ReporteVSMController@VSMPDF');
          Route::get('/ReporteVSM/XLS/{ase}/{fini}/{ffin}', 'Gos\Reportes\ReporteVSMController@VSMXLS');
        //_________________________________________________________________________________VSM END_______________________________________________________________
        //_________________________________________________________________________________REP PRODUCTIVIDAD BGIN_______________________________________________________
             Route::get('/ReporteProductividad', 'Gos\Reportes\ReporteProdController@index');
        //__________________________________________________________________________________REP PRODUCTIVIDAD END _________________________________________________
        /* ---------------- fin reportes -------------------- */

    });
