<?php
namespace App\Http\Controllers\Gos\OS;

use App\Http\Controllers\Gos\GosControllers;
use Illuminate\Http\Request;

class ItemsController extends GosControllers
{

    private $nombre = '';

    private $servicio = '';

    private $descripcion = '';

    private $precio_etapa = 0;

    private $precio_servicio = 0;

    private $precio_materiales = 0;

    private $descuento = 0.00;

    private $gos_usuario_tecnico_id = 0;

    private $cantidad = 1;

    private $gos_os_id = 0;

    private $codigo_sat = '';

    private $tipo_item = 'ET';

    private $gos_producto_id = 0;

    private $gos_paq_etapa_id = 0;

    private $estado_etapa = 'P';

    private $orden_etapa = 0;

    private $gos_paquete_id = 0;

    private $comision_asesor = 0;

    private $comision_asesor_tipo = 'PORCIENTO';

    private $tiempo_meta = 1;

    private $materiales = 0;

    private $destajo = 0;

    private $minimo_fotos = 0;

    private $genera_valor = 0;

    private $complemento = 0;

    private $refacciones = 0;

    private $link = '';

    /**
     *
     * @return the $comision_asesor
     */
    public function getComision_asesor()
    {
        return $this->comision_asesor;
    }

    /**
     *
     * @return the $comision_asesor_tipo
     */
    public function getComision_asesor_tipo()
    {
        return $this->comision_asesor_tipo;
    }

    /**
     *
     * @return the $tiempo_meta
     */
    public function getTiempo_meta()
    {
        return $this->tiempo_meta;
    }

    /**
     *
     * @return the $materiales
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    /**
     *
     * @return the $destajo
     */
    public function getDestajo()
    {
        return $this->destajo;
    }

    /**
     *
     * @return the $minimo_fotos
     */
    public function getMinimo_fotos()
    {
        return $this->minimo_fotos;
    }

    /**
     *
     * @return the $genera_valor
     */
    public function getGenera_valor()
    {
        return $this->genera_valor;
    }

    /**
     *
     * @return the $complemento
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     *
     * @return the $refacciones
     */
    public function getRefacciones()
    {
        return $this->refacciones;
    }

    /**
     *
     * @return the $link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     *
     * @param field_type $comision_asesor            
     */
    public function setComision_asesor($comision_asesor)
    {
        $this->comision_asesor = $comision_asesor;
    }

    /**
     *
     * @param string $comision_asesor_tipo            
     */
    public function setComision_asesor_tipo($comision_asesor_tipo)
    {
        $this->comision_asesor_tipo = $comision_asesor_tipo;
    }

    /**
     *
     * @param field_type $tiempo_meta            
     */
    public function setTiempo_meta($tiempo_meta)
    {
        $this->tiempo_meta = $tiempo_meta;
    }

    /**
     *
     * @param field_type $materiales            
     */
    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;
    }

    /**
     *
     * @param field_type $destajo            
     */
    public function setDestajo($destajo)
    {
        $this->destajo = $destajo;
    }

    /**
     *
     * @param field_type $minimo_fotos            
     */
    public function setMinimo_fotos($minimo_fotos)
    {
        $this->minimo_fotos = $minimo_fotos;
    }

    /**
     *
     * @param field_type $genera_valor            
     */
    public function setGenera_valor($genera_valor)
    {
        $this->genera_valor = $genera_valor;
    }

    /**
     *
     * @param field_type $complemento            
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     *
     * @param field_type $refacciones            
     */
    public function setRefacciones($refacciones)
    {
        $this->refacciones = $refacciones;
    }

    /**
     *
     * @param field_type $link            
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     *
     * @return the $gos_paquete_id
     */
    public function getGos_paquete_id()
    {
        return $this->gos_paquete_id;
    }

    /**
     *
     * @param number $gos_paquete_id            
     */
    public function setGos_paquete_id($gos_paquete_id)
    {
        $this->gos_paquete_id = $gos_paquete_id;
    }

    /**
     *
     * @return the $gos_producto_id
     */
    public function getGos_producto_id()
    {
        return $this->gos_producto_id;
    }

    /**
     *
     * @return the $gos_paq_etapa_id
     */
    public function getGos_paq_etapa_id()
    {
        return $this->gos_paq_etapa_id;
    }

    /**
     *
     * @return the $estado_etapa
     */
    public function getestado_etapa()
    {
        return $this->estado_etapa;
    }

    /**
     *
     * @return the $orden_etapa
     */
    public function getorden_etapa()
    {
        return $this->orden_etapa;
    }

    /**
     *
     * @param number $gos_producto_id            
     */
    public function setGos_producto_id($gos_producto_id)
    {
        $this->gos_producto_id = $gos_producto_id;
    }

    /**
     *
     * @param number $gos_paq_etapa_id            
     */
    public function setGos_paq_etapa_id($gos_paq_etapa_id)
    {
        $this->gos_paq_etapa_id = $gos_paq_etapa_id;
    }

    /**
     *
     * @param string $estado_etapa            
     */
    public function setestado_etapa($estado_etapa)
    {
        $this->estado_etapa = $estado_etapa;
    }

    /**
     *
     * @param number $orden_etapa            
     */
    public function setorden_etapa($orden_etapa)
    {
        $this->orden_etapa = $orden_etapa;
    }

    /**
     *
     * @return the $tipo_item
     */
    public function getTipo_item()
    {
        return $this->tipo_item;
    }

    /**
     *
     * @param string $tipo_item            
     */
    public function setTipo_item($tipo_item)
    {
        $this->tipo_item = $tipo_item;
    }

    /**
     *
     * @return the $precio_etapa
     */
    public function getPrecio_etapa()
    {
        return $this->precio_etapa;
    }

    /**
     *
     * @return the $precio_servicio
     */
    public function getPrecio_servicio()
    {
        return $this->precio_servicio;
    }

    /**
     *
     * @param number $precio_etapa            
     */
    public function setPrecio_etapa($precio_etapa)
    {
        $this->precio_etapa = $precio_etapa;
    }

    /**
     *
     * @param number $precio_servicio            
     */
    public function setPrecio_servicio($precio_servicio)
    {
        $this->precio_servicio = $precio_servicio;
    }

    /**
     *
     * @return the $codigo_sat
     */
    public function getCodigo_sat()
    {
        return $this->codigo_sat;
    }

    /**
     *
     * @param string $codigo_sat            
     */
    public function setCodigo_sat($codigo_sat)
    {
        $this->codigo_sat = $codigo_sat;
    }

    /**
     *
     * @return the $gos_os_id
     */
    public function getGos_os_id()
    {
        return $this->gos_os_id;
    }

    /**
     *
     * @param number $gos_os_id            
     */
    public function setGos_os_id($gos_os_id)
    {
        $this->gos_os_id = $gos_os_id;
    }

    /**
     *
     * @return the $gos_usuario_tecnico_id
     */
    public function getGos_usuario_tecnico_id()
    {
        return $this->gos_usuario_tecnico_id;
    }

    /**
     *
     * @return the $cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     *
     * @param number $gos_usuario_tecnico_id            
     */
    public function setGos_usuario_tecnico_id($gos_usuario_tecnico_id)
    {
        $this->gos_usuario_tecnico_id = $gos_usuario_tecnico_id;
    }

    /**
     *
     * @param number $cantidad            
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     *
     * @return the $descuento
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     *
     * @param number $descuento            
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     *
     * @return the $precio_materiales
     */
    public function getPrecio_materiales()
    {
        return $this->precio_materiales;
    }

    /**
     *
     * @param number $precio_materiales            
     */
    public function setPrecio_materiales($precio_materiales)
    {
        $this->precio_materiales = $precio_materiales;
    }

    /**
     *
     * @return the $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     *
     * @return the $servicio
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     *
     * @return the $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     *
     * @param string $nombre            
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     *
     * @param string $servicio            
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;
    }

    /**
     *
     * @param string $descripcion            
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

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
    protected function datosEntidad($request)
    {
        
        // preparar variables
        $descuento = $this->getDescuento();
        $sinAsignar = $this->sinAsignar();
        $ahora = $this->ahoraFormatoMySQL();
        //
        $fecha_inicio_et = isset($request->fecha_inicio_et) ? $request->fecha_inicio_et : $ahora;
        $fecha_promesa_et = isset($request->fecha_promesa_et) ? $request->fecha_promesa_et : $ahora;
        $fecha_meta_et = isset($request->fecha_meta_et) ? $request->fecha_meta_et : $ahora;
        $descuento = isset($request->descuento) ? $request->descuento : 0;
        //
        $codigo_sat = $this->getCodigo_sat();
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
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
        /**
         * Table: etapa como item
         * Columns:
         * nombre varchar(255)
         * servicio varchar(255)
         * descripcion varchar(255)
         * codigo_sat varchar(255)
         * gos_usuario_tecnico_id varchar(255)
         * cantidad double(16,2)
         * precio_etapa double(16,2)
         * precio_servicio double(16,2)
         * precio_materiales double(16,2)
         * descuento double(16,2)
         * fecha_inicio_et datetime
         * fecha_promesa_et datetime
         * fecha_meta_et datetime
         * tipo_item enum('ET','PQ','PR')
         * gos_producto_id int(11)
         * gos_paq_etapa_id int(11)
         * estado_etapa enum('P','A','F','NA')
         * orden_etapa smallint(6)
         * gos_paquete_id int(11)
         * comision_asesor double(16,2)
         * comision_asesor_tipo enum('PESOS','PORCIENTO')
         * tiempo_meta smallint(6)
         * materiales smallint(6)
         * destajo double(16,2)
         * minimo_fotos smallint(6)
         * genera_valor smallint(6)
         * complemento smallint(6)
         * refacciones smallint(6)
         * link varchar(255)
         */
        return [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'servicio' => $servicio,
            // CODIGO SAT
            'codigo_sat' => $codigo_sat,
            'cantidad' => $cantidad,
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
            // TECNICO ASESOR
            'gos_usuario_tecnico_id' => $gos_usuario_tecnico_id,
            // ETAPA
            'gos_paq_etapa_id' => $gos_paq_etapa_id,
            // PAQUETE
            'gos_paquete_id' => $gos_paquete_id,
            // PRODUCTO
            'gos_producto_id' => $gos_producto_id,
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
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosItemEtapas($request)
    {
        //
        $tipo_item = $this->tipoItemOSEtapa();
        $this->setTipo_item($tipo_item);
        //
        $nomb_etapa = $request->nomb_etapa;
        $nomb_servicio = $request->nomb_servicio; //
        $gos_usuario_tecnico_id = $request->gos_usuario_tecnico_id;
        $precio_etapa = $request->gos_etapa_total;
        $precio_servicio = $request->gos_etapa_MO;
        $gos_paq_etapa_id = $request->gos_paq_etapa_id;
        $this->setDescuento($this->preparaDescuento());
        $this->setNombre($nomb_etapa);
        
        $this->setServicio($nomb_servicio);
        $this->setDescripcion($request->descripcion_etapa);
        $this->setGos_usuario_tecnico_id($gos_usuario_tecnico_id);
        $this->setGos_paq_etapa_id($gos_paq_etapa_id);
        // precio de etapa
        $this->setPrecio_etapa($precio_etapa);
        // precio del servicio
        $this->setPrecio_servicio($precio_servicio);
        //
        return $this->datosEntidad($request);
    }
}
