<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteProdController extends Controller
{
 public function index()
 {
   return view('Reportes/ReporteProductividadtaller');
 }
}
