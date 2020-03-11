@extends('Layout')

@section('estiloPorPagina')
<link rel="stylesheet" href="../gos/css/menu_vertical.css">
@endsection

@section('Content')
<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h5 class="kt-portlet__head-title kt-font-primary">Calendario</h5>
        </div>
        {{-- <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <button type="button" class="btn btn-hover-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item imprimirFechaPromesa" href="javascript:void(0);"><i class="la la-user"></i> Imprimir</a>
                        <a class="dropdown-item descargarFechaPromesa" href="javascript:void(0);"><i class="la la-cloud-download"></i> Descargar</a>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
    <div class="kt-portlet__body">
            <div class="row">
                <div class="col-sm-12 col-lg-12 px-1">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="fechaPromesa" role="tabpanel">
                            <div class="row mb-1">
                                <div class="col-2 pr-1">
                                    <select class="form-control kt-selectpicker" data-live-search="true" id="EstadoPromesa">
                                        <option value="" selected>Todo</option>
                                        <option value="En Tiempo">En Tiempo</option>
                                        <option value="Fuera de tiempo">Fuera de tiempo</option>
                                        <option value="Sin fecha promesa">Sin fecha promesa</option>
                                    </select>
                                </div>
                                <div class="col-2 px-0">
                                    <select class="form-control kt-selectpicker" data-live-search="true" id="aseguradora">
                                        <option value="" selected>Todo</option>
                                        @foreach ($listaAsegurados as $asegurado)
                                        <option value="{{$asegurado->TipoClienteFiltro}}">{{$asegurado->TipoClienteFiltro}}</option>            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 pl-1 pr-0">
                                    <select class="form-control kt-selectpicker" data-live-search="true" id="etapa_Proceso">
                                        <option value=""></option>
                                        @foreach ($listaEtapasActivas as $etapa)
                                        <option value="{{$etapa->etapa_actual}}">{{$etapa->etapa_actual}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 pl-1">
                                    <input type="text" class="form-control" id="global_filtro">
                                </div>
                            </div>

                            <div class="row px-2 pb-1">
                                <div class="col-4 px-1 pb-1">
                                    <div class="bg-success text-center pt-2 kt-opacity-7" style="height: 30px;">
                                        <h6 class="text-white">En tiempo</h6>
                                    </div>    
                                    <div class="bg-success text-center pt-4" style="height: 70px;">
                                        <h3 class="text-white">{{$entiempo}}</h3>
                                    </div>    
                                </div>
                                <div class="col-4 px-1 pb-1">
                                    <div class="bg-warning text-center pt-2 kt-opacity-7" style="height: 30px;">
                                        <h6 class="text-white">Fuera de tiempo</h6>
                                    </div>    
                                    <div class="bg-warning text-center pt-4" style="height: 70px;">
                                        <h3 class="text-white">{{$fueradeTiempo}}</h3>     
                                    </div>    
                                </div>
                                <div class="col-4 px-1 pb-1">
                                    <div class="bg-primary text-center pt-2 kt-opacity-7" style="height: 30px;">
                                        <h6 class="text-white">Sin fecha promesa</h6>
                                    </div>    
                                    <div class="bg-primary text-center pt-4" style="height: 70px;">
                                        <h3 class="text-white">{{$sinfechaPromesa}}</h3>
                                    </div>     
                                </div>   
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-2 col-lg-2 pt-3" style=" margin-top: 3rem!important;">
                                    <ul class="nav nav-pills flex-column m-0" id="myTab" role="tablist" style="background-color: #9c9c9c;color: black">
                                        <li class="nav-item w-100 m-0">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#fechaPromesa" role="tab" aria-selected="true">Fecha Promesas<span class="badge badge-light">{{$entiempo}}</span></a>
                                        </li>
                                        <li class="nav-item w-100 m-0">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Citas" role="tab" aria-selected="false">Citas<span class="badge badge-light">0</span></a>
                                        </li>
                                        <li class="nav-item w-100 m-0">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Recordatorios" role="tab" aria-selected="false">Recordatorios<span class="badge badge-light">0</span></a>
                                        </li>
                                    </ul>
                                </div>   
                                <div class="col-sm-10 table-responsive" id="imprimir-tabla-fecha-Promesas">
                                    <table class="table table-sm table-hover text-center" id="dt-fechaPromesa">
                                        <thead class="thead-light">
                                            <tr>
                                {{-- col 0 --}}<th class="p-0">Estado</th>
                                {{-- col 1 --}}<th class="p-0">Fecha Ingreso</th>
                                {{-- col 2 --}}<th class="p-0">Fecha Promesa</th>
                                {{-- col 3 --}}<th class="p-0">Aseguradora</th>
                                {{-- col 4 --}}<th class="p-0">Vehiculo Marca</th>
                                {{-- col 5 --}}<th class="p-0">Vehiculo Modelo</th>
                                {{-- col 6 --}}<th class="p-0">Vehiculo Color</th>
                                {{-- col 7 --}}<th class="p-2">Fechas</th>
                                {{-- col 8 --}}<th class="p-2">Dias</th>
                                {{-- col 9 --}}<th class="p-2"># de orden</th>
                                {{-- col 10 --}}<th class="p-2">Cliente</th>
                                {{-- col 11 --}}<th class="p-2">Tipo de cliente</th>
                                {{-- col 12 --}}<th class="p-2">Etapa actual</th>
                                {{-- col 13 --}}<th class="p-2">Productos</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="Citas" role="tabpanel" aria-labelledby="profile-tab">
                            <h2>Citas</h2>
                        </div>
                        <div class="tab-pane fade" id="Recordatorios" role="tabpanel" aria-labelledby="contact-tab">
                            <h2>Recordatorios</h2>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</div>
@endsection

@section('ScriptporPagina')
    <script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteFechasPromesa.js"></script> 
@endsection

