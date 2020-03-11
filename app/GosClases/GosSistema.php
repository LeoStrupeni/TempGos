<?php
namespace GosClases;

use App\Gos\Gos_Sistema_Parametro;

/**
 * Clase para gestion de parametros del sistema
 *
 * @author yois
 *        
 */
class GosSistema
{

    /**
     * deveulve el valor entero de un parametro
     *
     * @param unknown $nomb_parametro            
     * @return number
     */
    public static function valorEntero($nomb_parametro)
    {
        /**
         *
         * @var unknown $p
         */
        $p = Gos_Sistema_Parametro::where('parametro', $nomb_parametro)->first();
        if (isset($p->valor_entero))
            return $p->valor_entero;
        else
            return 0;
    }

    /**
     * devuelve un parametro de texto
     *
     * @param string $nomb_parametro            
     * @return string
     */
    public static function valorTexto($nomb_parametro)
    {
        /**
         *
         * @var unknown $p
         */
        $p = Gos_Sistema_Parametro::where('parametro', $nomb_parametro)->first();
        if (isset($p->valor_texto))
            return $p->valor_texto;
        else
            return '';
    }

    /**
     * devuelve rol del tecnio
     *
     * @return number
     */
    public static function rolTecnico()
    {
        return self::valorEntero('rol_tecnico');
    }

    /**
     * deveulve rol del administrador
     *
     * @return number
     */
    public static function rolAdministrador()
    {
        return self::valorEntero('rol_administrador');
    }

    /**
     *
     * @return string
     */
    public static function obtenTipoComision()
    {
        return self::valorTexto('tipo_comision_pred');
    }

    /**
     *
     * @return string
     */
    public static function etapaPendiente()
    {
        return self::valorTexto('etapa_pendiente');
    }

    /**
     *
     * @return string
     */
    public static function itemOsEtapa()
    {
        return self::valorTexto('tipo_item_os_etapa');
    }

    /**
     *
     * @return string
     */
    public static function itemOsPaquete()
    {
        return self::valorTexto('tipo_item_os_paq');
    }

    /**
     *
     * @return string
     */
    public static function itemOsProducto()
    {
        return self::valorTexto('tipo_item_os_pr');
    }

    /**
     * devuelve nombre de carpeta para las imagenes del cliente
     * 
     * @return string
     */
    public static function carpetaImagenesCliente()
    {
        // TODO:Actualizar tabla del sistema con parametro $carpeta_imagenes_cliente
        return '/public/VehiculoCliente';
    }
   
    public static function carpetaImagenesInternas()
    {
        // TODO:Actualizar tabla del sistema con parametro $carpeta_imagenes_Internas
        return '/public/VehiculoInterna';
    }

    public static function carpetaDocumentos()
    {
        // TODO:Actualizar tabla del sistema con parametro $carpeta_documentos
        return '/public/VehiculoDocumentos';
    }
}

