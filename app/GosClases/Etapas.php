<?php
namespace GosClases;

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
use Session;
/**
 * Clase para la gestion de etapas
 *
 * @author yois
 *
 */
class Etapas extends GosData
{

    /**
     * devuelve lista de etapas
     *
     * @return unknown
     */
    public static function listadoGeneral()
    {
        // traer etapas de lista de etapas asociadas al taller y no desde licencias
        return Gos_V_Paq_Etapas::where('gos_taller_id', GosUtil::tallerIdActual());
    }

    /**
     * Devuelve etapa segun su id
     *
     * @param unknown $gos_paq_etapa_id
     * @return unknown
     */
    public static function obtenEtapaPorID($gos_paq_etapa_id)
    {
        return Gos_V_Paq_Etapas::find($gos_paq_etapa_id);
    }

    /**
     *
     * @param unknown $gos_paq_etapa_id
     * @return unknown[]
     */
    public static function obtenEtapaDatosPorID($gos_paq_etapa_id)
    {
        $gral = Gos_V_Paq_Etapas::find($gos_paq_etapa_id);
        $msj = Gos_Paq_Etapa_Mensaje::where('gos_paq_etapa_id', $gos_paq_etapa_id)->get();
        $CalcTiempo = Gos_Paq_Etapa_Calc_Tiempo::where('gos_paq_etapa_id', $gos_paq_etapa_id)->get();
        $PerdidaTotal = Gos_Paq_Etapa_Perdida_Total::where('gos_paq_etapa_id', $gos_paq_etapa_id)->get();
         $ligada = gos_Paq_Etapa_Ligada::where('gos_paq_etapa_id', $gos_paq_etapa_id)->get();
        $Danios = Gos_Paq_Etapa_Pago_Danios::where('gos_paq_etapa_id', $gos_paq_etapa_id)->get();
        //
        $datos = array(
            'gral' => $gral,
            'mjs' => $msj,
            'CalcTiempo' => $CalcTiempo,
            'PerdTotal' => $PerdidaTotal,
             'Ligaga' => $ligada,
            'Danios' => $Danios
        );
        return $datos;
    }

    /**
     * Guardar etapa
     *
     * @param unknown $request
     *            datos a guardar enl
     * @return NULL|\App\Gos\Gos_Paq_Etapa
     */
    public static function guardaEtapa($request)
    {
        $etapa = null;
        $gos_paq_etapa_id = isset($request->gos_paq_etapa_id) ? $request->gos_paq_etapa_id : 0;
        $datos = self::datosEtapa($request);

        if ($gos_paq_etapa_id > 0) {
            $etapa = Gos_Paq_Etapa::find($gos_paq_etapa_id);
            $etapa->update($datos);
        } else {
            $etapa = new Gos_Paq_Etapa($datos);
            $etapa->save();
            $gos_paq_etapa_id = $etapa->gos_paq_etapa_id;
        }

        return $etapa;
    }

    /**
     *
     * @param unknown $request
     * @return unknown[]|number[]|NULL[]
     */
    private static function datosEtapa($request)
    {

        $gos_usuario_tecnico_id = isset($request->gos_usuario_tecnico_id) ? $request->gos_usuario_tecnico_id : 0;

        $tiempo_meta = $request->tiempo_meta;
        $minimo_fotos = $request->minimo_fotos;

        $genera_valor = $request->genera_valor == 'on' ? '1' : '0';
        $complemento = $request->complemento == 'on' ? '1' : '0';
        $materiales = $request->materiales == 'on' ? '1' : '0';
        $refacciones = $request->refacciones == 'on' ? '1' : '0';
        $checkperdida = $request->checkperdida == 'on' ? '1' : '0';
        $checkpao = $request->checkpao == 'on' ? '1' : '0';


        return [
            'nomb_etapa' => $request->nomb_etapa,
            'gos_usuario_tecnico_id' => $gos_usuario_tecnico_id,
            'gos_taller_id' => Session::get('taller_id'),
            'descripcion_etapa' => $request->descripcion_etapa,
            'comision_asesor' => $request->comision_asesor,
            'comision_asesor_tipo' => $request->comision_asesor_tipo,
            'tiempo_meta' => $tiempo_meta,
            'materiales' => $materiales,
            'minimo_fotos' => $minimo_fotos,
            'genera_valor' => $genera_valor,
            'complemento' => $complemento,
            'refacciones' => $refacciones,
            'perdidatotal' => $checkperdida,
            'pagodanios' => $checkpao,
            'link' => $request->link
        ];
    }

    /**
     * guarda datos de informacion de calculo de tiempo
     *
     * @param unknown $request
     * @return NULL|\App\Gos\Gos_Paq_Etapa_Calc_Tiempo
     */
    public static function guardaCalculoTiempo($request, $gos_paq_etapa_id)
    {
        $lista = self::preparaListaCalcTiempo($request, $gos_paq_etapa_id);
        $calculosTiempo = null;
        foreach ($lista as $tiempo) {
            $datos = self::datosCalcTiempo($tiempo);
            $gos_paq_etapa_calc_tiempo_id = $tiempo['gos_paq_etapa_calc_tiempo_id'];
            //
            if ($gos_paq_etapa_calc_tiempo_id > 0) {
                $calculosTiempo = Gos_Paq_Etapa_Calc_Tiempo::find($gos_paq_etapa_calc_tiempo_id);
                $calculosTiempo->update($datos);
            } else {
                $calculosTiempo = new Gos_Paq_Etapa_Calc_Tiempo($datos);
                $calculosTiempo->save();
            }
        }
        return $calculosTiempo;
    }

    /**
     *
     * @param unknown $request
     * @param unknown $gos_paq_etapa_id
     * @return array
     */
    private static function preparaListaCalcTiempo($request, $gos_paq_etapa_id)
    {
        $lista = [];
        for ($i = 1; $i < 11; $i ++) {
            if (null !== $request->get('gos_aseguradora_id_' . $i)) {
                array_push($lista, array(
                    "gos_paq_etapa_id" => $gos_paq_etapa_id,
                    "gos_paq_etapa_calc_tiempo_id" => $request->get('gos_paq_etapa_calc_tiempo_id_' . $i),
                    "gos_aseguradora_id" => $request->get('gos_aseguradora_id_' . $i),
                    "monto" => $request->get('monto_' . $i)
                ));
            }
        }
        return $lista;
    }

    /**
     *
     * @param unknown $request
     * @return unknown
     */
    private static function gos_paq_etapa_id($request)
    {
        return $request->gos_paq_etapa_id;
    }

    /**
     * datos del calculo de tiempo
     *
     * @param unknown $tiempo
     * @return \GosClases\the[]|unknown[]
     */
    private static function datosCalcTiempo($tiempo)
    {
        return [
            'gos_paq_etapa_id' => $tiempo['gos_paq_etapa_id'],
            'gos_aseguradora_id' => $tiempo['gos_aseguradora_id'],
            'monto' => $tiempo['monto']
        ];
    }

    /**
     * guarda etapas de perdida total
     *
     * @param unknown $request
     * @return NULL|\App\Gos\Gos_Paq_Etapa_Perdida_Total
     */
    public static function guardaEtapasPerdidaTotal($request, $gos_paq_etapa_id)
    {
        $etapas = $request->perdida_total_id;
        $etapa_perdida_total = null;
        if (is_array($etapas)) {
            for ($i = 0; $i < count($etapas); $i ++) {
                $etapa_perdida_total_id_rel = $etapas[$i];
                $datos = self::datosEtapasPerdidaTotal($gos_paq_etapa_id, $etapa_perdida_total_id_rel);
                $condBusqueda = [
                    [
                        'gos_paq_etapa_id',
                        '=',
                        $gos_paq_etapa_id
                    ],
                    [
                        'etapa_perdida_total_id_rel',
                        '=',
                        $etapa_perdida_total_id_rel
                    ]
                ];
                $etapaEcontrada = Gos_Paq_Etapa_Perdida_Total::where($condBusqueda)->get();
                if ($etapaEcontrada->isEmpty()) {
                    $etapa_perdida_total = new Gos_Paq_Etapa_Perdida_Total($datos);
                    $etapa_perdida_total->save();
                }
            }
        }
        return $etapa_perdida_total;
    }

    /**
     * datos etapa perdida total
     *
     * @param unknown $gos_paq_etapa_id
     * @param unknown $etapa_perdida_total_id_rel
     * @return unknown[]
     */
    private static function datosEtapasPerdidaTotal($gos_paq_etapa_id, $etapa_perdida_total_id_rel)
    {
        return [
            'gos_paq_etapa_id' => $gos_paq_etapa_id,
            'etapa_perdida_total_id_rel' => $etapa_perdida_total_id_rel
        ];
    }

    /**
     * guarda datos etapas ligadas
     *
     * @param unknown $request
     * @return NULL|\GosClases\gos_Paq_Etapa_Ligada
     */
    public static function guardaEtapasLigadas($request, $gos_paq_etapa_id)
    {
        $etapas = $request->etapa_ligada_id;
        $etapa_ligada = null;
        if (is_array($etapas)) {
            for ($i = 0; $i < count($etapas); $i ++) {
                $etapa_ligada_relacionada = $etapas[$i];
                $datos = self::datosEtapasLigadas($gos_paq_etapa_id, $etapa_ligada_relacionada);
                $condBusqueda = [
                    [
                        'gos_paq_etapa_id',
                        '=',
                        $gos_paq_etapa_id
                    ],
                    [
                        'etapa_ligada_relacionada',
                        '=',
                        $etapa_ligada_relacionada
                    ]
                ];
                $etapaEcontrada = Gos_Paq_Etapa_Ligada::where($condBusqueda)->get();
                if ($etapaEcontrada->isEmpty()) {
                    $etapa_ligada = new Gos_Paq_Etapa_Ligada($datos);
                    $etapa_ligada->save();
                }
            }
        }
        return $etapa_ligada;
    }

    /**
     *
     * @param unknown $request
     * @param unknown $gos_paq_etapa_id
     * @return array
     */
    private static function preparaListaEtapasLigadas($request, $gos_paq_etapa_id)
    {
        $lista = [];
        for ($i = 1; $i < 11; $i ++) {
            if (null !== $request->get('etapa_ligada_id' . $i)) {
                array_push($lista, array(
                    "gos_paq_etapa_id" => $gos_paq_etapa_id,
                    "etapa_ligada_relacionada" => $request->get('etapa_ligada_id_' . $i)
                ));
            }
        }
        return $lista;
    }

    /**
     * datos etapas ligadas
     *
     * @param unknown $etapa_ligada_relacionada
     * @return unknown[]|NULL[]
     */
    private static function datosEtapasLigadas($gos_paq_etapa_id, $etapa_ligada_relacionada)
    {
        return [
            'gos_paq_etapa_id' => $gos_paq_etapa_id,
            'etapa_ligada_relacionada' => $etapa_ligada_relacionada
        ];
    }

    /**
     * guarda etapa de pago de daños
     *
     * @param unknown $request
     * @return NULL|\App\Gos\Gos_Paq_Etapa_Pago_Danios
     */
    public static function guardaEtapasPagoDanios($request, $gos_paq_etapa_id)
    {
        $etapas = $request->etapa_danio_id;
        $etapa_danio = null;
        if (is_array($etapas)) {
            for ($i = 0; $i < count($etapas); $i ++) {
                $etapa_pago_danios_id_rel = $etapas[$i];
                $datos = self::datosEtapasDanios($gos_paq_etapa_id, $etapa_pago_danios_id_rel);
                $condBusqueda = [
                    [
                        'gos_paq_etapa_id',
                        '=',
                        $gos_paq_etapa_id
                    ],
                    [
                        'etapa_pago_danios_id_rel',
                        '=',
                        $etapa_pago_danios_id_rel
                    ]
                ];
                $etapaEcontrada = Gos_Paq_Etapa_Pago_Danios::where($condBusqueda)->get();
                if ($etapaEcontrada->isEmpty()) {
                    $etapa_danio = new Gos_Paq_Etapa_Pago_Danios($datos);
                    $etapa_danio->save();
                }
            }
        }
        return $etapa_danio;
    }

    /**
     * datos etapa pago de daños
     *
     * @param unknown $id
     * @return unknown[]|NULL[]
     */
    private static function datosEtapasDanios($gos_paq_etapa_id, $etapa_pago_danios_id_rel)
    {
        return [
            'gos_paq_etapa_id' => $gos_paq_etapa_id,
            'etapa_pago_danios_id_rel' => $etapa_pago_danios_id_rel
        ];
    }

    /**
     * //
     * // if (is_array($nombMensajes)) {
     * // for ($i = 0; $i < count($nombMensajes); $i ++) {
     * // $datos = $this->datosWhatsapp($request, $i);
     * // $gos_paq_etapa_mensaje_id = isset($request->gos_paq_etapa_mensaje_id[$i]) ? $request->gos_paq_etapa_mensaje_id[$i] : 0;
     *
     * // if ($gos_paq_etapa_mensaje_id > 0) {
     * // $mensajeWhatsapp = Gos_Paq_Etapa_Mensaje::find($gos_paq_etapa_mensaje_id);
     * // $mensajeWhatsapp->update($datos);
     * // } else {
     * // $mensajeWhatsapp = new Gos_Paq_Etapa_Mensaje($datos);
     * // $mensajeWhatsapp->save();
     * // }
     * // }
     * // }
     */
    /**
     * duarda mensajes de whatssap de una etapa
     *
     * @param unknown $request
     * @return NULL|\App\Gos\Gos_Paq_Etapa_Mensaje
     */
    public static function guardaMensajesWhatsapp($request, $gos_paq_etapa_id)
    {


        $lista = [];
        for ($i = 1; $i < 4; $i ++) {
            if (null !== $request->get('mensaje_nomb_' . $i)) {
                array_push($lista, array(
                    "gos_paq_etapa_mensaje_id" => $request->get('gos_paq_etapa_mensaje_id_' . $i),
                    "mensaje_nomb" => $request->get('mensaje_nomb_' . $i),
                    "mensaje_cuerpo" => $request->get('mensaje_cuerpo_' . $i),
                    'gos_paq_etapa_id' => $gos_paq_etapa_id
                ));
            }
        }
        $mensajes = null;

        foreach ($lista as $mensaje) {
            $datos = self::datosMensaje($mensaje);
            $gos_paq_etapa_mensaje_id = isset($mensaje['gos_paq_etapa_mensaje_id']) ? $mensaje['gos_paq_etapa_mensaje_id'] : 0;
           if ($gos_paq_etapa_mensaje_id > 0) {
                $mensajes = Gos_Paq_Etapa_Mensaje::find($gos_paq_etapa_mensaje_id);
                $mensajes->update($datos);
            } else {
                $mensajes = new Gos_Paq_Etapa_Mensaje($datos);
                $mensajes->save();
            }
        }
        return $mensajes;
    }

    /**
     *
     * @param unknown $mensaje
     * @return \GosClases\the[]|unknown[]
     */
    private static function datosMensaje($mensaje)
    {
        // obtener los datos a guardar
        return [
            'gos_paq_etapa_id' => $mensaje['gos_paq_etapa_id'],
            "mensaje_cuerpo" => $mensaje['mensaje_cuerpo'],
            "mensaje_nomb" => $mensaje['mensaje_nomb']
        ];
    }

    /**
     * borra etapa
     *
     * @param unknown $gos_paq_etapa_id
     * @return unknown|NULL
     */
    public static function borra($gos_paq_etapa_id)
    {
        $etapa = Gos_Paq_Etapa::find($gos_paq_etapa_id);
        if ($etapa) {
            return $etapa->delete();
        } else
            return null;
    }

    /**
     * prepara las listas de datos a usar en la edicion
     *
     * @return array
     */
    public static function preparaListas()
    {
        // pocos campos id, y nombres
        $listaAseguradoras = Gos_V_Min_Aseguradoras::where('gos_taller_id', Session::get('taller_id'))->get();
        $listaAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', Session::get('taller_id'))->where('gos_usuario_rol_id', 2)->get();
        $listaEtapas = Gos_Paq_Etapa::where('gos_taller_id', Session::get('taller_id'))->get();
        $listaEtapasPerdidasTotales = $listaEtapas;
        $listaEtapasLigadas = $listaEtapas;
        $listaEtapasDanios = $listaEtapas;
        $compact = compact('listaEtapasPerdidasTotales', 'listaEtapasLigadas', 'listaEtapasDanios', 'listaAsesores', 'listaAseguradoras');
        return $compact;
    }
}
