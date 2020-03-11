<?php
namespace App\GosClases;

use App\Gos\Gos_Taller_Conf_gen;
use App\Gos\Gos_Taller_Conf_Os;
use App\Gos\Gos_Taller_Conf_admin;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Zona_Horaria;
use GosClases\GosData;
use Illuminate\Session\ExistenceAwareInterface;
use App\Gos\Gos_Region_Estado;
// modelos principal
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
use App\Gos\Gos_Region_Localidad;
use App\Gos\Gos_Region_Ciudad;
use App\Gos\Gos_Taller_Descripcion;
use Session;

/**
 * Clase para gestionar funciones del taller
 *
 * @author yois
 *
 */
class Taller extends GosData
{

    /**
     *
     * @param unknown $id
     * @return array
     */
    public static function preparaCrearEditar()
    {
        $gos_taller_id = GosUtil::tallerIdActual();

        $taller_conf_gen = null;
        $taller_conf_os = null;
        $taller_conf_admin = null;
        $taller_conf_ase = null;
        $taller_conf_vehiculo = null;
        //
        if ($gos_taller_id > 0) {
            $taller_conf_os = Gos_Taller_Conf_Os::find($gos_taller_id);
            $taller_conf_gen = Gos_Taller_Conf_gen::find($gos_taller_id);
            $taller_conf_admin = Gos_Taller_Conf_admin::find($gos_taller_id);
            $taller_conf_ase = Gos_Taller_Conf_ase::find($gos_taller_id);
            $taller_conf_vehiculo = Gos_Taller_Conf_vehiculo::find($gos_taller_id);
        }

        /**
         * Armar los selects
         */
        // $siNo = GosUtil::listaSiNo();

        return compact('taller_conf_os', 'taller_conf_gen', 'taller_conf_admin', 'taller_conf_ase', 'taller_conf_vehiculo');
    }

    /**
     * Guarda los datos relacionados con el taller
     *
     * @param unknown $request
     */
    public function guardaDatosRelacionados($request)
    {

    /**
     * // gos_taller_conf_admin
     * // gos_taller_conf_ase
     * // gos_taller_conf_gen
     * // gos_taller_conf_os
     * // gos_taller_conf_vehiculo
     * // gos_taller_descripcion
     * // gos_taller_facturacion
     * // gos_taller_horarios
     * // gos_taller_tipo_trabajo
     */
    }

    /**
     * CONFIGURACION DE GEN*
     */
    /**
     * guarda datos de configuracion general del taller
     *
     * @param Request $request
     * @return NULL|\App\Gos\Gos_Taller_Conf_gen
     */
    public static function guardaConfigGEN($request)
    {
        $conf_gen = null;
        $gos_taller_id = GosUtil::tallerIdActual();
        //
        $datos = self::datosConfGEN($request);
        // si ID es mayor a cero
        // si existe el gos_taller_id en la tabla
        $confgen = Gos_Taller_Conf_gen::find($gos_taller_id);
        if ($confgen !== null) {
            $confgen->update($datos);
        } else {
            // creo y guardo datos
            $confgen = new Gos_Taller_Conf_gen($datos);
            $confgen->save();
        }
        return $conf_gen;
    }

    /**
     * Devuelve datos preparados para ser guardados
     * en la Configuracion general del Taller
     *
     * @param unknown $request
     * @return NULL[]
     */
    public static function datosConfGEN($request)
    {

        // $pie_pag_notas_remision = isset($request->pie_pag_notas_remision) ? 1 : 0;
        // $pie_pagina_compras = isset($request->pie_pagina_compras) ? 1 : 0;
        // $pie_pagina_hoja_viajera = isset($request->pie_pagina_hoja_viajera) ? 1 : 0;
        return [
            'gos_taller_id' => GosUtil::tallerIdActual(),
            'gos_zona_horaria_id' => $request->gos_zona_horaria_id,
            'pie_pag_notas_remision' => $request->pie_pag_notas_remision,
            'pie_pagina_compras' => $request->pie_pagina_compras,
            'pie_pagina_hoja_viajera' => $request->pie_pagina_hoja_viajera,
            'iva' => $request->iva
        ];
    }

    /**
     * obtiene informacion de conifguracion de gen
     *
     * @param unknown $gos_taller_id
     * @return unknown
     */
    public static function obtenConfigGEN()
    {
        $gos_taller_id = GosUtil::tallerIdActual();
        return Gos_Taller_Conf_gen::find($gos_taller_id);
    }

    /**
     * FIN CONFIGURACION GEN *
     */

    /**
     * CONFIGURACION DE OS*
     */
    /**
     * guarda datos de confugracion de orden de servicio del taller
     *
     * @param Request $request
     * @return NULL|\App\Gos\Gos_Taller_Conf_Os
     */
    public static function guardaConfigOS($request)
    {
        $conf_os = null;
        $gos_taller_id = GosUtil::tallerIdActual();
        //
        $datos = self::datosConfOS($request);
        // si ID es mayor a cero
        // si existe el gos_taller_id en la tabla
        $conf_os = Gos_Taller_Conf_Os::find($gos_taller_id);
        if ($conf_os !== null) {
            $conf_os->update($datos);
        } else {
            // creo y guardo datos
            $conf_os = new Gos_Taller_Conf_Os($datos);
            $conf_os->save();
        }
        return $conf_os;
    }

    /**
     * Deveulve datos preparados para ser guardados
     * en la Configuracion de Orden de servicio del Taller
     *
     * @param unknown $request
     * @return NULL[]
     */
    public static function datosConfOS($request)
    {
        $minimo_fotos = isset($request->minimo_fotos) ? 1 : 0;
        $precargar_marc_modelo = isset($request->precargar_marc_modelo) ? 1 : 0;
        $seguimiento_etapa = isset($request->seguimiento_etapa) ? 1 : 0;
        $mostrar_comentario = isset($request->mostrar_comentario) ? 1 : 0;
        $total_presupuesto_a_etapa = isset($request->total_presupuesto_a_etapa) ? 1 : 0;
        $total_etapa_a_servicio = isset($request->total_etapa_a_servicio) ? 1 : 0;
        $ocultar_riesgo = isset($request->ocultar_riesgo) ? 1 : 0;
        $ocultar_orden = isset($request->ocultar_orden) ? 1 : 0;
        return [
            'gos_taller_id' => GosUtil::tallerIdActual(),
            'minimo_fotos' => $minimo_fotos,
            'precargar_marc_modelo' => $precargar_marc_modelo,
            'seguimiento_etapa' => $seguimiento_etapa,
            'mostrar_comentario' => $mostrar_comentario,
            'total_presupuesto_a_etapa' => $total_presupuesto_a_etapa,
            'total_etapa_a_servicio' => $total_etapa_a_servicio,
            'ocultar_riesgo' => $ocultar_riesgo,
            'ocultar_orden' => $ocultar_orden
        ];
    }

    /**
     * obtiene informacion de conifguracion de OS
     *
     * @param unknown $gos_taller_id
     * @return unknown
     */
    public static function obtenConfigOS()
    {
        $gos_taller_id = GosUtil::tallerIdActual();
        return Gos_Taller_Conf_Os::find($gos_taller_id);
    }

    /**
     * FIN CONFIGURACION OS *
     */

    /**
     * CONFIGURACION DE ADMIN*
     */
    /**
     * guarda datos de configuracion administrativa del taller
     *
     * @param Request $request
     * @return NULL|\App\Gos\Gos_Taller_Conf_admin
     */
    public static function guardaConfigADMIN($request)
    {
        $conf_admin = null;
        $gos_taller_id = GosUtil::tallerIdActual();
        //
        $datos = self::datosConfADMIN($request);
        // si ID es mayor a cero
        // si existe el gos_taller_id en la tabla
        $conf_admin = Gos_Taller_Conf_admin::find($gos_taller_id);
        if ($conf_admin !== null) {
            $conf_admin->update($datos);
        } else {
            // creo y guardo datos
            $conf_admin = new Gos_Taller_Conf_admin($datos);
            $conf_admin->save();
        }
        return $conf_admin;
    }

    /**
     * Devuelve datos preparados para ser guardados
     * en la Configuracion administrativa del Taller
     *
     * @param unknown $request
     * @return NULL[]
     */
    public static function datosConfADMIN($request)
    {
        $habilitar_facturacion = isset($request->habilitar_facturacion) ? 1 : 0;
        return [
            'gos_taller_id' => GosUtil::tallerIdActual(),
            'proc_adicional_prod' => $request->proc_adicional_prod,
            'costo_adq_mini_venta' => $request->costo_adq_mini_venta,
            'iva_preseleccionado' => $request->iva_preseleccionado,
            'habilitar_facturacion' => $habilitar_facturacion
        ];
    }

    /**
     * obtiene informacion de conifguracion de OS
     *
     * @param unknown $gos_taller_id
     * @return unknown
     */
    public static function obtenConfigADMIN()
    {
        $gos_taller_id = GosUtil::tallerIdActual();
        return Gos_Taller_Conf_admin::find($gos_taller_id);
    }

    /**
     * FIN CONFIGURACION ADIM *
     */

    /**
     * CONFIGURACION DE ASE*
     */
    /**
     * guarda datos de configuracion aseguradora del taller
     *
     * @param Request $request
     * @return NULL|\App\Gos\Gos_Taller_Conf_ase
     */
    public static function guardaConfigASE($request)
    {
        $conf_ase = null;
        $gos_taller_id = GosUtil::tallerIdActual();
        //
        $datos = self::datosConfASE($request);
        // si ID es mayor a cero
        // si existe el gos_taller_id en la tabla
        $conf_ase = Gos_Taller_Conf_ase::find($gos_taller_id);
        if ($conf_ase !== null) {
            $conf_ase->update($datos);
        } else {
            // creo y guardo datos
            $conf_ase = new Gos_Taller_Conf_ase($datos);
            $conf_ase->save();
        }
        return $conf_ase;
    }

    /**
     * Devuelve datos preparados para ser guardados
     * en la Configuracion aseguradora del Taller
     *
     * @param unknown $request
     * @return NULL[]
     */
    public static function datosConfASE($request)
    {
        $habilitar_facturacion = isset($request->habilitar_facturacion) ? 1 : 0;
        return [
            'gos_taller_id' => GosUtil::tallerIdActual(),
            'nomb_campo_ase' => $request->nomb_campo_ase,
            'nomb_campo_poliza' => $request->nomb_campo_poliza,
            'nomb_campo_siniestro' => $request->nomb_campo_siniestro,
            'nomb_campo_reporte' => $request->nomb_campo_reporte
        ];
    }

    /**
     * obtiene informacion de conifguracion de aseguradora
     *
     * @param unknown $gos_taller_id
     * @return unknown
     */
    public static function obtenConfigASE()
    {
        $gos_taller_id = GosUtil::tallerIdActual();
        return Gos_Taller_Conf_ase::find($gos_taller_id);
    }

    /**
     * FIN CONFIGURACION ASE *
     */

    /**
     * CONFIGURACION DE VEHICULO*
     */
    /**
     * guarda datos de configuracion vehículo del taller
     *
     * @param Request $request
     * @return NULL|\App\Gos\gos_taller_conf_vehiculo
     *
     */
    public static function guardaConfigVEHiCULO($request)
    {
        $conf_vehiculo = null;
        $gos_taller_id = GosUtil::tallerIdActual();
        //
        $datos = self::datosConfVEHiCULO($request);
        // si ID es mayor a cero
        // si existe el gos_taller_id en la tabla
        $conf_vehiculo = Gos_Taller_Conf_vehiculo::find($gos_taller_id);
        if ($conf_vehiculo !== null) {
            $conf_vehiculo->update($datos);
        } else {
            // creo y guardo datos
            $conf_vehiculo = new Gos_Taller_Conf_vehiculo($datos);
            $conf_vehiculo->save();
        }
        return $conf_vehiculo;
    }

    /**
     * Devuelve datos preparados para ser guardados
     * en la Configuracion vehículo del Taller
     *
     * @param unknown $request
     * @return NULL[]
     *
     */
    public static function datosConfVEHiCULO($request)
    {
        $nros_serie_unicos = isset($request->nros_serie_unicos) ? 1 : 0;
        $ocultar_campos_adicionales = isset($request->ocultar_campos_adicionales) ? 1 : 0;
        return [
            'gos_taller_id' => GosUtil::tallerIdActual(),
            'nomb_modulo_camp_vehiculo' => $request->nomb_modulo_camp_vehiculo,
            'nomb_marca' => $request->nomb_marca,
            'nomb_modelo' => $request->nomb_modelo,
            'nomb_anio' => $request->nomb_anio,
            'nomb_color' => $request->nomb_color,
            'nomb_placa' => $request->nomb_placa,
            'nomb_economico' => $request->nomb_economico,
            'nros_serie_unicos' => $nros_serie_unicos,
            'ocultar_campos_adicionales' => $ocultar_campos_adicionales
        ];
    }

    /**
     * obtiene informacion de conifguracion de aseguradora
     *
     * @param unknown $gos_taller_id
     * @return unknown
     *
     */
    public static function obtenConfigVEHiCULO()
    {
        $gos_taller_id = GosUtil::tallerIdActual();
        return Gos_Taller_Conf_vehiculo::find($gos_taller_id);
    }

    /**
     * FIN CONFIGURACION VEHICULO *
     */

    /**
     * Trabajo hecho por el equipo de Mexico importado por Yassel *
     */
    /**
     *
     * @return array
     */
    public static function preparaIndexPrincipal()
    {
        $estados = Gos_Region_Estado::all();
        $ciudades = Gos_Region_Ciudad::all();
        $usuario = Session::get('usr_Data');
        $taller = Gos_Taller::find($usuario->gos_taller_id);
        $factaller = Gos_Taller_Facturacion::find($usuario->gos_taller_id);
        $ciudadsel = Gos_Region_Ciudad::where('gos_region_ciudad_id', $taller->gos_region_ciudad_id)->first();
        $estadosel = Gos_Region_Estado::where('gos_region_estado_id', $ciudadsel->gos_region_estado_id)->first();
        // $Facciudadsel=Gos_Region_Ciudad::where('gos_region_ciudad_id', $factaller->gos_region_ciudad_id)->first();
        // $Facestadosel=Gos_Region_Estado::where('gos_region_estado_id',$Facciudadsel->gos_region_estado_id )->first();

        $thorarios = Gos_Taller_Horarios::where('gos_taller_id', $taller->gos_taller_id)->first();
        $descripcion = Gos_Taller_Descripcion::find($usuario->gos_taller_id);
        $horahasta = substr($thorarios->hora_hasta, - 8, 5);
        $horadesde = substr($thorarios->hora_desde, - 8, 5);
        $Listazona_horarias = Gos_Zona_Horaria::all();
        //
        return compact('taller', 'factaller', 'estados', 'ciudades', 'thorarios', 'horahasta', 'horadesde', 'descripcion', 'estadosel','Listazona_horarias');
    }

    /**
     * guardar los datos de facturacion
     */
    public static function guardaDatosFacturacion($request)
    {
        $usuario = Session::get('usr_Data');
        $factaller = Gos_Taller_Facturacion::find($usuario->gos_taller_id);
        $factaller->razon_social = $request->razon_social;
        $factaller->rfc = $request->rfc;
        $factaller->regimen_fiscal = $request->regimen_fiscal;
        $factaller->tipo_persona = $request->gos_fac_tipo_persona_id;
        $factaller->email_direccion = $request->email_direccion;
        $factaller->dir_fiscal_calle = $request->dir_fiscal_calle;
        $factaller->dir_fiscal_nro_ext = $request->dir_fiscal_nro_ext;
        $factaller->dir_fiscal_nro_int = $request->dir_fiscal_nro_int;
        $factaller->dir_fiscal_cod_postal = $request->dir_fiscal_cod_postal;
        $factaller->dir_fiscal_cta_pago = $request->cuenta_pago;
        $factaller->indiciaciones_fac = $request->Indicacionesfacturacion;
        $factaller->save();
    }

    /**
     *
     * @param unknown $request
     */
    public static function guardaDatosPrinciales($request)
    {
        $usuario = Session::get('usr_Data');
        $taller = Gos_Taller::find($usuario->gos_taller_id);
        $thorarios = Gos_Taller_Horarios::where('gos_taller_id', $taller->gos_taller_id)->first();
        $descripcion = Gos_Taller_Descripcion::find($taller->gos_taller_id);
        if ($descripcion != null) {
            $descripcion->descripcion = $request->Descripción_general;
            $descripcion->save();
        } else {
            $descripcion = new Gos_Taller_Descripcion();
            $descripcion->gos_taller_id = $taller->gos_taller_id;
            $descripcion->descripcion = $request->Descripción_general;
            $descripcion->save();
        }
        $taller->taller_nomb = $request->TallerNomb;
        $taller->codigo_taller = $request->TallerCod;
        $taller->propietario_nombre = $request->NombrePropietario;
        $taller->propietario_apellidos = $request->PropietarioApellidos;
        $taller->propietario_tel_movil = $request->CelularPropietario;
        $taller->propietario_tel_fijo = $request->TelefonoPropietario;
        $taller->propietario_email = $request->CorreoPropietario;
        $taller->correo_respuestas = $request->CorreoRespuestas;
        $taller->correo_refacciones = $request->CorreoRef;
        $taller->taller_tel_principal = $request->TallerTelefonoPrincipal;
        $taller->taller_direccion = $request->DireccionTaller;
        $taller->taller_colonia = $request->Tallercolonia;
        $taller->taller_municipio = $request->Tallermunicipio;
        $taller->gos_region_ciudad_id = $request->Tallerciudadid;
        $taller->save();
        $thorarios->dia_desde = $request->diadesde;
        $thorarios->dia_hasta = $request->diahasa;
        $thorarios->hora_desde = $request->hora_desde;
        $thorarios->hora_hasta = $request->hora_hasta;
        $thorarios->save();
    }


}
