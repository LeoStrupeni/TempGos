<?php
namespace App\GosClases;

use Session;

/**
 * Clase con fuciones utiles para el proyecto GOS
 *
 * @author yois
 *        
 */
class GosUtil
{

    /**
     *
     * @return string[]
     */
    public static function listaSiNo()
    {
        return array(
            '0' => 'Si',
            '1' => 'No'
        );
    }

    /**
     * devuelve fecha y hora actual
     *
     * @return string
     */
    protected static function ahoraFormatoMySQL()
    {
        
        // fecha y hora actual
        return date("Y-m-d H:i:s");
    }

    /**
     *
     * @return string
     */
    public static function sinAsignar()
    {
        // obtener datos
        $sinAsignar = 'Sin Asignar';
        return $sinAsignar;
    }

    /**
     *
     * @return string[]|number[]
     */
    protected static function condIdTaller()
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
     * obtiene el id del taller actual tomado desde la session
     * 
     * @return mixed|\Illuminate\Session\Store|\Illuminate\Session\SessionManager|number
     */
    public static function tallerIdActual()
    {
        $session_param = 'usr_Data.gos_taller_id';
        if (isset($session_param)) {
            return session($session_param);
        } else {
            return 0;
        }
    }

    /**
     * convierte fecha a formato MySQL
     *
     * @param unknown $fechaOriginal            
     * @return string
     */
    /**
     * convierte fecha a formato MySQL
     *
     * @param unknown $fechaOriginal            
     * @return string
     */
    public static function convierteFechaHaciaMySQLFormat($fechaOriginal)
    {
        // $date = str_replace('/', '-', $fechaOriginal);
        return date("Y-m-d", strtotime($fechaOriginal));
    }

    /**
     * convierte fecha desde formato MySQL
     *
     * @param string $fechaOriginal            
     */
    public static function convierteFechaDesdeMySQLFormat($fechaOriginal)
    {
        return date("m/d/Y", strtotime($fechaOriginal));
    }

    /**
     * devuele lista de zonas horarias
     *
     * @param string $zonas_explicitas
     *            $zonas_explicitas
     *            ejemplo $zonas_explicitas=preg_match('/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id']) && $zone['timezone_id'];
     * @return array lsita de ciudades
     */
    public static function listaZonasHorarias($zonas_explicitas = '')
    {
        $zonasHorarias = \DateTimeZone::listAbbreviations();
        $ciudades = array();
        foreach ($zonasHorarias as $dato => $zonas) {
            foreach ($zonas as $id => $zona) {
                /**
                 * Solo obtenga zonas horarias explícitamente que no formen parte de "Otros".
                 *
                 * @see http://www.php.net/manual/en/timezones.others.php
                 */
                if ($zonas_explicitas !== '') {
                    $ciudades[$zona['timezone_id']][] = $dato;
                } else {
                    if ($zonas !== "")
                        $ciudades[$zona['timezone_id']][] = $dato;
                }
            }
        }
        // lista separada por comas de todas las zonas horarias posibles
        // tenga por ciudad, .
        foreach ($ciudades as $dato => $valor)
            $ciudades[$dato] = join(', ', $valor);
        
        // Dejar ciudades unicas (la primera y también la más importante)
        // para cada conjunto de posibilidades.
        $ciudades = array_unique($ciudades);
        // Ordenar por área / nombre de ciudad.
        ksort($ciudades);
        return $ciudades;
    }
}

