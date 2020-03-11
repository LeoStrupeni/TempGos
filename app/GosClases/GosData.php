<?php
namespace GosClases;

/**
 * Clase para manejar datos comunes
 *
 * @author yois
 *        
 */
class GosData
{

    /**
     *
     * @var integer id de la entidad
     */
    private $_entidad_id = 0;

    /**
     * Enidad principal
     *
     * @var unknown entidad principal
     */
    private $entidad;

    private $_nomb_id = '';

    /**
     *
     * @return the $_entidad_id
     */
    public function getEntidad_id()
    {
        return $this->_entidad_id;
    }

    /**
     *
     * @return the $entidad
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     *
     * @return the $_nomb_id
     */
    public function getNomb_id()
    {
        return $this->_nomb_id;
    }

    /**
     *
     * @param number $_entidad_id            
     */
    public function setEntidad_id($_entidad_id)
    {
        $this->_entidad_id = $_entidad_id;
    }

    /**
     *
     * @param \GosClases\unknown $entidad            
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    }

    /**
     *
     * @param string $_nomb_id            
     */
    public function setNomb_id($_nomb_id)
    {
        $this->_nomb_id = $_nomb_id;
    }

    /**
     *
     * @return string[]|number[]
     */
    public static function condIdTaller()
    {
        return [
            [
                'gos_taller_id',
                '=',
                self::tallerIdActual()
            ]
        ];
    }

    /**
     *
     * @return integer
     */
    public static function tallerIdActual()
    {
        // Obtener el id de la informacion de la SESSION DEL TALLER ACTUAL
        return 1;
    }

    /**
     *
     * @param unknown $d            
     * @return unknown[]
     */
    public static function capturaCampos($idname, $d)
    {
        $campos = array();
        foreach ($d as $id => &$valores) {
            foreach ($valores as $c => $v) {
                $campos[$c] = $v;
            }
        }
        $campos[$idname] = $id;
        return $campos;
    }
}

