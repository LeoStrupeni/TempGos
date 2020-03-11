<?php

namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index(){
      return view('/E-learning/E-welcome');
    }
    public function selectorDocs($id){
      $tittle = "";
      $src = "";
        // return view('/E-Learning/E-Learning')->with(compact('tittle','param2'));
      switch ($id) {
        case 0:
        $tittle = "Clientes";
        $src = "/elearning/documentos/1 Agregar Clientes.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 1:
        $tittle = "Clientes";
        $src = "/elearning/documentos/2 Agregar Aseguradoras.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 2:
        $tittle = "Clientes";
        $src = "/elearning/documentos/3 Agregar Otro Taller ( TOT).pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 3:
        $tittle = "Vehiculos";
        $src = "/elearning/documentos/1 Agregar Vehiculos.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 4:
        $tittle = "Vehiculos";
        $src = "/elearning/documentos/2 Agregar Marcas y Modelos.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 5:
        $tittle = "Vehiculos";
        $src = "/elearning/documentos/3 Agregar Colores.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 6:
        $tittle = "Presupuestos";
        $src = "video6.mp4";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 7:
        $tittle = "Presupuestos";
        $src = "video7.mp4";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 8:
        $tittle = "Ordenes";
        $src = "/elearning/documentos/1 Agregar Orden de Servicio.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 9:
        $tittle = "Ordenes";
        $src = "/elearning/documentos/1 Funciones del menu dentro de la orden de servicio.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 10:
        $tittle = "Ordenes";
        $src = "/elearning/documentos/2 Carga de fotos Cliente y Valuacion.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 11:
        $tittle = "Ordenes";
        $src = "/elearning/documentos/3 Carga Documentos.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 12:
        $tittle = "Ordenes";
        $src = "/elearning/documentos/4 Asociar o Cargar Productos  Internos y Externos.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 13:
        $tittle = "Ordenes";
        $src = "/elearning/documentos/5 Servicios, asignacion de tecnicos.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 14:
        $tittle = "Log In";
        $src = "/elearning/documentos/1 Ingreso a sistema ( Log In ).pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;
        case 15:
        $tittle = "Inventario";
        $src = "/elearning/documentos/1 Crear Inventario de Vehiculo.pdf";
          return view('/E-learning/E-docs')->with(compact('tittle','src'));
        break;

        default:
        return redirect('/elearn');
          break;
      }
    }

    public function selectorVidio($id){
      $tittle = "";
      $src = "";
        // return view('/E-Learning/E-Learning')->with(compact('tittle','param2'));
      switch ($id) {
        case 0:
        $tittle = "Agregar Clientes";
        $src = "/elearning/videos/02 Agregar Clientes v08feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 1:
        $tittle = "Agregar Aseguradoras";
        $src = "/elearning/videos/03 Agregar Aseguradoras v08feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 2:
        $tittle = "Agregar Otro Taller";
        $src = "/elearning/videos/04 Agregar Otro Taller v07feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 3:
        $tittle = "Agregar Vehiculo a un Cliente";
        $src = "/elearning/videos/05 Agregar vehiculo a un cliente v07feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 4:
        $tittle = "Agregar Marcas y Modelos";
        $src = "/elearning/videos/06 Agregar Marcas y Modelos v07feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 5:
        $tittle = "Agregar Colores a la Base de Datos";
        $src = "/elearning/videos/07 Agregar Colores a la Base de Datos v07feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 6:
        $tittle = "Presupuestos";
        $src = "/elearning/videos/Login.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 7:
        $tittle = "Funciones del Menu de la Orden de Servicio";
        $src = "/elearning/videos/08 Funciones del Menu de la Orden de Servicio v07feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 8:
        $tittle = "Agregar Fotos en Orden de Servicio";
        $src = "/elearning/videos/11 Agregar Fotos en Orden de Servicio v08feb2020-2.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 9:
        $tittle = "Mensajes a Cliente por API WhatsApp";
        $src = "/elearning/videos/10 Mensajes a Cliente por API WhatsApp v08feb2020-2.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 10:
        $tittle = "Agregar Documentos a la Orden de Servicio";
        $src = "/elearning/videos/09 Agregar Documentos a la Orden de Servicio v07feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 11:
        $tittle = "Asociar o Cargar Productos Internos y Externos";
        $src = "/elearning/videos/12 Asociar o Cargar Productos Internos y Externos v08feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 12:
        $tittle = "Facturacion";
        $src = "/elearning/videos/Login.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 13:
        $tittle = "Paquetes";
        $src = "/elearning/videos/Login.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 14:
        $tittle = "Compras";
        $src = "/elearning/videos/Login.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 15:
        $tittle = "Equipo de Trabajo";
        $src = "/elearning/videos/Login.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 16:
        $tittle = "Inventarios";
        $src = "/elearning/videos/AgregarInventario.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 17:
        $tittle = "Reportes";
        $src = "/elearning/videos/Login.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 18:
        $tittle = "Como Hacer Login";
        $src = "/elearning/videos/01 Como Hacer Login v06feb2020.mp4";
          return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 19:
          $tittle = "Agregar Orden de Servicio";
          $src = "/elearning/videos/AgregarOrdenServicio.mp4";
            return view('/E-learning/E-Learning')->with(compact('tittle','src'));
          break;
        case 20:
          $tittle = "Paquetes";
          $src = "/elearning/videos/Paquetes.mp4";
            return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 21:
          $tittle = "Servicios";
          $src = "/elearning/videos/Servicios.mp4";
            return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 22:
          $tittle = "Etapas";
          $src = "/elearning/videos/Etapas.mp4";
            return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;
        case 23:
          $tittle = "Orden de Servicio";
          $src = "/elearning/videos/Etapa_simultanea.mp4";
            return view('/E-learning/E-Learning')->with(compact('tittle','src'));
        break;

        default:
          return view('/E-learning/E-Learning');
          break;
      }
    }


}
