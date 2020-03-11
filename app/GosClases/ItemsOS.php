<?php
namespace GosClases;

use App\Gos\Gos_V_Os_Items;
use App\Gos\Gos_V_Items_Paquetes;
use App\Gos\Gos_Os_Item;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_V_Os_Etapas;
use App\Gos\Gos_V_Os_Producto_Interno_Externo;
use App\Gos\Gos_OS;

use App\Gos\Gos_Producto_Ubic_Stock;
/**
 * Clase para gestionar etapas, paquetes y productos como items
 *
 * @author yois
 *        
 */
class ItemsOS extends GosData
{

    /**
     *
     * @var string
     */
    protected $opcionesEditDataTable = 'OS.Items.OpcionesItemsDatatable';

    /**
     * Datos de etamas como items V1.0 :
     * Contiene datos de entidades que seran normalizadas en
     * proximas versiones.
     *
     * @param unknown $gos_os_id            
     * @param unknown $sinAsignar            
     * @param unknown $codigo_sat            
     * @return unknown[]|NULL[]|number[]|string[]
     */
    public function datosEntidad($item)
    {
        
        // preparar variables
        $descuento = $this->getDescuento();
        $sinAsignar = $this->sinAsignar();
        $ahora = $this->ahoraFormatoMySQL();
        //
        $fecha_inicio_et = isset($item->fecha_inicio_et) ? $item->fecha_inicio_et : $ahora;
        $fecha_promesa_et = isset($item->fecha_promesa_et) ? $item->fecha_promesa_et : $ahora;
        $fecha_meta_et = isset($item->fecha_meta_et) ? $item->fecha_meta_et : $ahora;
        $descuento = isset($item->descuento) ? $item->descuento : 0;
        //
        $codigo_sat = $this->getCodigo_sat();
        $nomb_etapa = $this->getNombre();
        $descripcion_etapa = $this->getDescripcion();
        $servicio = $this->getServicio();
        
        $cantidad = $this->getCantidad();
        $precio_etapa = $this->getPrecio_etapa();
        $precio_servicio = $this->getPrecio_servicio();
        $precio_materiales = $this->getPrecio_materiales();
        $gos_os_id = $this->getGos_os_id();
        $tipo_item = $this->getTipo_item();
        $estado_etapa = $this->getestado_etapa();
        $orden_etapa = $this->getorden_etapa();
        // TECNICO ASESOR
        $gos_usuario_tecnico_id = $this->getGos_usuario_tecnico_id();
        // ETAPA
        $gos_paq_etapa_id = $this->getGos_paq_etapa_id();
        // PAQUETE
        $gos_paquete_id = $this->getGos_paquete_id();
        // PRODUCTO
        $gos_producto_id = $this->getGos_producto_id();
        //
        $comision_asesor = $this->getComision_asesor();
        $comision_asesor_tipo = $this->getComision_asesor_tipo();
        $tiempo_meta = $this->getTiempo_meta();
        $materiales = $this->getMateriales();
        $destajo = $this->getDestajo();
        $minimo_fotos = $this->getMinimo_fotos();
        $genera_valor = $this->getGenera_valor();
        $complemento = $this->getComplemento();
        $refacciones = $this->getRefacciones();
        $link = $this->getLink();
        //
        return [
            'gos_os_id' => $gos_os_id,
            // TECNICO ASESOR
            'gos_usuario_tecnico_id' => $gos_usuario_tecnico_id,
            // ETAPA
            'gos_paq_etapa_id' => $gos_paq_etapa_id,
            // PAQUETE
            'gos_paquete_id' => $gos_paquete_id,
            // PRODUCTO
            'gos_producto_id' => $gos_producto_id,
            //
            'nombre' => $nomb_etapa,
            'descripcion' => $descripcion_etapa,
            'servicio' => $servicio,
            'codigo_sat' => $codigo_sat,
            'cantidad' => $cantidad,
            //
            'precio_etapa' => $precio_etapa,
            'precio_servicio' => $precio_servicio,
            'precio_materiales' => $precio_materiales,
            'descuento' => $descuento,
            //
            'fecha_inicio_et' => $fecha_inicio_et,
            'fecha_promesa_et' => $fecha_promesa_et,
            'fecha_meta_et' => $fecha_meta_et,
            //
            'tipo_item' => $tipo_item,
            'estado_etapa' => $estado_etapa,
            // ORDEN
            'orden_etapa' => $orden_etapa,
            //
            'comision_asesor' => $comision_asesor,
            'comision_asesor_tipo' => $comision_asesor_tipo, // enum('PESOS','PORCIENTO')
            'tiempo_meta' => $tiempo_meta,
            'materiales' => $materiales,
            'destajo' => $destajo,
            'minimo_fotos' => $minimo_fotos,
            'genera_valor' => $genera_valor,
            'complemento' => $complemento,
            'refacciones' => $refacciones,
            'link' => $link
        
        ];
    }

    /**
     * Develve los datos de una etama a serc cargados en el sistema
     *
     * La sección de destajo nos permite configurar una opción que definirá el tiempo
     * meta de las etapas que tienen asociado un servicio, y este funciona en base al
     * siguiente criterio:
     * El valor económico de la etapa / el pago por hora pactado con la compañía o empresa
     * Eso es dinero/precio por hora =a tiempo meta
     * En esta sección solo necesitamos un campo para realizar select de las empresas o
     * aseguradoras generadas en catalogo y delante de ello definir el precio por hora.
     * Aquí se genera una pequeña lista de los que ya fueron configurados
     */
    /**
     * prepara datos para guardar Etapa como item
     *
     * @param unknown $etapa            
     * @return unknown
     */
    public function datosItemEtapas($etapa)
    {
        //
        $this->setGos_os_id($etapa->gos_os_id_EtapaItem);
        $tipo_item = $this->tipoItemOSEtapa();
        $this->setTipo_item($tipo_item);
        //
        $nomb_etapa = $etapa->nomb_etapa;
        $nomb_servicio = $etapa->nomb_servicio; //
        $gos_usuario_tecnico_id = $etapa->gos_usuario_tecnico_id;
        $precio_etapa = $etapa->gos_etapa_total;
        $precio_servicio = $etapa->gos_etapa_MO;
        $gos_paq_etapa_id = $etapa->gos_paq_etapa_id;
        $this->setDescuento($this->preparaDescuento());
        $this->setNombre($nomb_etapa);
        
        $this->setServicio($nomb_servicio);
        $this->setDescripcion($etapa->descripcion_etapa);
        $this->setGos_usuario_tecnico_id($gos_usuario_tecnico_id);
        $this->setGos_paq_etapa_id($gos_paq_etapa_id);
        // precio de etapa
        $this->setPrecio_etapa($precio_etapa);
        // precio del servicio
        $this->setPrecio_servicio($precio_servicio);
        //
        return $this->datosEntidad($etapa);
    }

    /**
     * prepara y guarda datos de paquete
     * a ser agregado como Item
     *
     * @param unknown $paquete            
     * @return unknown
     */
    public function preparaGuardaPaquete($paquete)
    {
        // obtener el id de os
        $gos_os_id = $paquete->gos_os_id_PaqueteItem;
        // si os es mayor a cero
        $gos_paquete_id = $paquete->gos_paquete_id;
        // consultar items del paqeute elegido
        $itemsPaq = Gos_V_Items_Paquetes::where('gos_paquete_id', $gos_paquete_id)->get();
        // recorrer todos los items del paqeute
        foreach ($itemsPaq as $item) {
            $datos = $this->datosEntidad($item);
            // agrear item a la os
            $item = new Gos_Os_Item($datos);
            $item->save();
        }
        
        return $gos_os_id;
    }

    /**
     *
     * @return string
     */
    public function tipoItemOSPaquete()
    {
        return GosSistema::valorTexto('tipo_item_os_paq');
    }

    /**
     *
     * @return string
     */
    public function tipoItemOSEtapa()
    {
        return GosSistema::valorTexto('tipo_item_os_etapa');
    }

    /**
     *
     * @return string
     */
    public function tipoItemOSProducto()
    {
        return GosSistema::valorTexto('tipo_item_os_pr');
    }

    /**
     *
     * @param unknown $gos_os_id            
     * @return unknown
     */
    public static function listaItemsOSPorId($gos_os_id)
    {
        $l = Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->where('gos_producto_id',0)->get();
        return $l;
    }
    public static function listaItemsProductoOSPorId($gos_os_id)
    {
        $l = Gos_V_Os_Producto_Interno_Externo::where('gos_os_id', $gos_os_id)->get();
        return $l;
    }
    /**
     * lista de etapas de OS
     *
     * @param unknown $gos_os_id            
     * @return unknown
     */
    public static function listaEtapasOS($gos_os_id)
    {
        $l = Gos_V_Os_Etapas::where('gos_os_id', $gos_os_id)->where('gos_paq_etapa_id','>','0')->orderByRaw('orden_etapa ASC')->get();
        return $l;
    }
    public static function listaEtapasOSActivas($gos_os_id)
    {
        $l = Gos_V_Os_Etapas::where('gos_os_id', $gos_os_id)->where('estado_etapa','NA')->orderByRaw('orden_etapa ASC')->get();
        return $l;
    }
    public static function listaEtapasOSActivasOper($gos_os_id)
    {
        $l = Gos_V_Os_Etapas::where('gos_os_id', $gos_os_id)->where('estado_etapa','NA')->where('tipo',2)->orderByRaw('orden_etapa ASC')->get();
        return $l;
    }
    public static function listaEtapasOSActivasAdmin($gos_os_id)
    {
        $l = Gos_V_Os_Etapas::where('gos_os_id', $gos_os_id)->where('estado_etapa','NA')->where('tipo',1)->orderByRaw('orden_etapa ASC')->get();
        return $l;
    }
    /**
     *
     * @return number
     */
    public function preparaDescuento()
    {
        $descuento = isset($request->p_descuento) ? floatval($request->p_descuento) : floatval(0);
        return $descuento;
    }

    /**
     *
     * @param unknown $tipoItem            
     * @param unknown $datosItem            
     * @return string
     */
    public static function guardaItemPorTipo($tipoItem, $datosItem)
    {
        // inicializar variables
        $datos = array();
        $tipoItem = $datosItem->item_tipo;
        $gos_os_id = 0;
        // Dependiendo del tipo de item elegido
        switch ($tipoItem) {
            case 'Etapa':
                $datos = PaqueteItems::datosEntidad($request); // $this->datosItemEtapas($datosItem);
                break;
            case 'Producto':
                $datos = PaqueteItems::datosItemProducto($datosItem);
                break;
            default:
                $gos_os_id = PaqueteItems::preparaGuardaPaquete($datosItem);
                break;
        }
        // si hay datos
        if (count($datos) > 0) {
            // agregar item a la os
            $item = new Gos_Os_Item($datos);
            $item->save();
            $gos_os_id = $item->gos_os_id;
        }
        return self::listaItemsOSPorId($gos_os_id);
    }

    /**
     *
     * @param unknown $gos_os_item_id            
     * @return unknown
     */
    public static function borraItemOS($gos_os_item_id)
    {     
        $item = Gos_Os_Item::find($gos_os_item_id);

        $existProducto = Gos_Producto_Ubic_Stock::where('gos_producto_id',$item->gos_producto_id)->first();
        if(isset($existProducto)){
            $restante = $existProducto->ingreso + $item->cantidad;
            $existProducto->ingreso = $restante;
            $existProducto->save();
        }
        
        $os = Gos_Os::find($item->gos_os_id);
        $subtt = $os->subtotal - ($item->precio_materiales*$item->cantidad);
        $os->subtotal = $subtt;
        $os->save();
        
        $item->delete();
        return $item;
    }

    /**
     *
     * @param unknown $gos_os_item_id            
     * @param unknown $posAnte            
     */
    public static function cambiaOrden($gos_os_item_id, $posAnte, $posFinal)
    {
        if ($posAnte <= $posFinal) {
            DB::statement('CALL gos_os_item_sube_prioridad(?,?)', array(
                $gos_os_item_id,
                $posFinal
            ));
        } else {
            DB::statement('CALL  gos_os_item_baja_prioridad(?,?)', array(
                $gos_os_item_id,
                $posFinal
            ));
        }
    }

    /* YOIS */
    
    /**
     * Actualiza los datos de un asesor
     *
     * @param unknown $gos_os_item_id            
     * @param unknown $gos_usuario_asesor_id            
     * @return unknown
     */
    public static function actualizaAsesor($gos_os_item_id, $gos_usuario_asesor_id)
    {
        $item = Gos_Os_Item::find($gos_os_item_id);
        if ($item) {
            $item->gos_usuario_asesor_id = $gos_usuario_asesor_id;
            $item->save();
        }
        return $item;
    }

    /**
     * Actualiza el precio de la etapa
     *
     * @param unknown $gos_os_item_id            
     * @param unknown $precio_etapa            
     * @return unknown
     */
    public static function actualizaPrecioEtapa($gos_os_item_id, $precio_etapa)
    {
        $item = Gos_Os_Item::find($gos_os_item_id);
        if ($item) {
            $item->precio_etapa = $precio_etapa;
            $item->save();
        }
        return $item;
    }

    /**
     * Actualiza el precio de los materiales
     *
     * @param unknown $gos_os_item_id            
     * @param unknown $precio_materiales            
     * @return unknown
     */
    public static function actualizaPrecioMateriales($gos_os_item_id, $precio_materiales)
    {
        $item = Gos_Os_Item::find($gos_os_item_id);
        if ($item) {
            $item->precio_materiales = $precio_materiales;
            $item->save();
        }
        
        return $item;
    }
    
    /* YOIS */
}

