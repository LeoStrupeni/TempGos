@section('estiloPorPagina')
<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
<link href="{{env('APP_URL')}}/gos/datatable-editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
<link rel="stylesheet" href="../gos/css/progress-bar.css">

@endsection
@extends('Layout') @section('Content')
<div class="kt-portlet kt-portlet--mobile">
	@if (session('notification'))
	<div class="alert alert-danger">
	 {{session('notification')}}
	 </div> @endif
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="row mt-4 mb-2">
			<div class="col-7">
				<div class="kt-portlet__head-label">
				  <img src="../img/logoqualitas.png" alt=""  style="width: 13rem;">
				</div>
			</div>
			<div class="col-5 border-left">
				<p class="text-nowrap">
					<span>Número de Orden: <strong style="color: red;">
							{{$number}} </strong></span>
				</p>
			</div>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<div class="dropdown dropdown-inline">
						<button type="button"
							class="btn btn-default btn-icon-sm dropdown-toggle"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="kt-nav">
								<li class="kt-nav__item"><a class="dropdown-item"
									data-toggle="modal" data-target="#modalcomentario"
									class="kt-nav__link"> <span class="kt-nav__link-text"><i
											style="color: #C0C0C0;" class="fas fa-pencil-alt"></i>
											Agregar comentario</span>
								</a></li>
								<li class="kt-nav__item"><a class="dropdown-item" style="color: inherit;"
								href="{{route('ordenes-servicio.edit',$os->gos_os_id)}}" class="kt-nav__link"> <span
										class="kt-nav__link-text"><i style="color: #C0C0C0;"
											class="fas fa-edit"></i> Editar</span>
								</a></li>
								<li class="kt-nav__item"><a class="dropdown-item"
									data-toggle="modal" data-target="#modalInventario"
									class="kt-nav__link"> <span class="kt-nav__link-text"><i
											style="color: #C0C0C0;" i class="fas fa-edit"></i> Editar
											inventario</span>
								</a></li>
								<li class="kt-nav__item"><a class="dropdown-item"
									data-toggle="modal" data-target="#modal-mensaje"
									class="kt-nav__link"> <span class="kt-nav__link-text"><i
											style="color: #C0C0C0;" class="far fa-arrow-alt-circle-up"></i>
											Reenviar Mensaje</span>
								</a></li>
								<li class="kt-nav__item"><a class="dropdown-item"
									data-toggle="modal" data-target="#modal-fecha-promesa"
									class="kt-nav__link"> <span class="kt-nav__link-text"><i
											style="color: #C0C0C0;" class="fas fa-calendar-alt"></i>
											Fecha promesa</span>
								</a></li>
								<li class="kt-nav__item">
									<a href="{{ route('OS_pdf',$os->gos_os_id) }}" target="_blank" style="color: inherit;" class="dropdown-item">
										<i style="color: #C0C0C0;" class="fas fa-print"></i> Imprimir inventario vehículo</span>
									</a>
								</li>
								<li  class="kt-nav__item"><a href="/osg/{{$os->gos_os_id}}/descargarimagenes" class="dropdown-item"
									class="kt-nav__link" > <span
										class="kt-nav__link-text"><i style="color: #C0C0C0;"
											class="far fa-arrow-alt-circle-down"></i> Descargar imagenes
											cliente</span>
								</a></li>
								<li  class="kt-nav__item"><a href="/osg/{{$os->gos_os_id}}/descargarimagenesint" class="dropdown-item"
									class="kt-nav__link" > <span
										class="kt-nav__link-text"><i style="color: #C0C0C0;"
											class="far fa-arrow-alt-circle-down"></i> Descargar imagenes
											internas</span>
								</a></li>
							</ul>
						</div>
					</div>
					&nbsp;
				</div>
			</div>
		</div>
	</div>
	{{-- Arranca el Cuerpo --}}
	<div class="kt-portlet__body p-1">
		<div class="mt-2 table-responsive">
			<table class="table table-striped"
				style="background: #fff; font-size: 1rem;">
				<thead>
					<tr style="font-weight: 500;">
						<th class="text-nowrap" style="width: 150px;">Fecha</th>
						<th class="text-nowrap" style="width: 170px;">Cliente</th>
						<th class="text-nowrap" style="width: 170px;"><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
						<th class="text-nowrap" style="width: 170px;"><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
						<th class="text-nowrap" style="width: 50px;">Subtotal</th>
						<th class="text-nowrap" style="width: 200px;">Compras Relacionadas</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Apertura de la orden">
								<i class="fas fa-circle" style="color: #339af0;"></i>
								{{$os->fecha_creacion_os}}
							</p>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Ingreso a reparacion">
								<i class="fas fa-caret-square-right" style="color: green;"></i>
								{{ $os->fecha_ingreso_v_os ?? 'Fecha reparacion' }}
							</p>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Fecha promesa">
								<i class="fas fa-square" style="color: yellow;"></i> {{
								($os->fecha_promesa_os == 0) ? 'Fecha promesa':$os->fecha_promesa_os }}
							</p>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Fecha terminado">
								<i class="fas fa-circle" style="color: #339af0;"></i> {{
								$os->fecha_terminado ?? 'Fecha terminado' }}
							</p>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Fecha entregado">
								<i class="fas fa-caret-square-left" style="color: red;"></i> {{
								$os->fecha_entregado ?? 'Fecha entregado' }}
							</p>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Fecha facturado">
								<i class="fas fa-circle" style="color: #339af0;"></i> {{
								$os->fecha_facturado ?? 'Fecha facturado' }}
							</p>
							<p class="m-0" data-toggle="popover" data-trigger='hover'
								data-placement="top" data-content="Fecha de pago">
								<i class="fas fa-circle" style="color: #339af0;"></i> {{
								$os->fecha_pago ?? 'Fecha pago' }}
							</p>
						</td>
						<td class="text-uppercase">{{$os->nombre}} <br> {{$os->apellidos}}
							<br> <a href="">{{$os->celular}}</a>
						</td>
						<td><strong style="color: #27395C; font-weight: 500;">{{$os->empresa}}</strong><br>
							# <?php if ($taller_conf_ase->nomb_campo_reporte!=null): ?>{{$taller_conf_ase->nomb_campo_reporte ??''}}<?php else: ?>Reporte<?php endif; ?>: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_reporte}}</strong><br>
							# <?php if ($taller_conf_ase->nomb_campo_siniestro!=null): ?>{{$taller_conf_ase->nomb_campo_siniestro ??''}}<?php else: ?>Siniestro<?php endif; ?>: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_siniestro}}</strong><br>
							# <?php if ($taller_conf_ase->nomb_campo_poliza!=null): ?>{{$taller_conf_ase->nomb_campo_poliza ??''}}<?php else: ?>Poliza<?php endif; ?>: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_poliza}}</strong><br>
							Deducible: <strong style="color: #27395C; font-weight: 500;">{{$os->deducible}}</strong><br>
							Demerito: <strong style="color: #27395C; font-weight: 500;">{{$os->demerito}}</strong><br>
							Tipo Orden: <strong style="color: #27395C; font-weight: 500;">{{$os->tipo_orden}}</strong><br>
							Tipo Daño: <strong style="color: #27395C; font-weight: 500;">{{$os->tipo_danio}}</strong><br>
							Estatus: <strong style="color: #27395C; font-weight: 500;">{{$os->estado_expediente}}</strong>
						</td>
						<td><strong style="color: #27395C; font-weight: 500;">{{$os->marca_vehiculo}},{{$os->modelo_vehiculo}}
								{{$os->anio_vehiculo}}</strong><br> Color: <strong
							style="color: #27395C; font-weight: 500;">{{$os->nomb_color}}</strong><br>
							P: <strong style="color: #27395C; font-weight: 500;">{{$os->placa}}</strong><br>
							<?php if ($taller_conf_vehiculo->nomb_economico!=null): ?>{{$taller_conf_vehiculo->nomb_economico ??''}}<?php else: ?>Economico<?php endif; ?>: <strong style="color: #27395C; font-weight: 500;">{{$os->economico}}</strong><br>
							Serie: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_serie}}</strong>
						</td>
						<td class="text-center">${{number_format($precio_total, 2, '.', '') ??''}}</td>
						<td class="text-center"></td>
					</tr>
				</tbody>
			</table>
		</div>
		{{-- Parte Gráficos --}}
		<div class="container">
			<div style="margin-top:0%;" class="col-12 col-md-12">
				<div  class="">
					<!--begin::Section-->
					<div class="kt-section kt-section--last">
						<h3 class="kt-portlet__head-title kt-align-center">
						Etapa
						</h3>
						<div style="max-height:200rem;">
							<input type="hidden" name="gos_os_id" id="gos_os_id" value="{{$os->gos_os_id}}">
							@if(isset($listaEtapasA))
								@foreach ($listaEtapasA as $key => $etapa)
									@if ($etapa->estado_etapa == 'A')
										<div class="form-group">
											<span class="kt-widget14__title" style="font-size: 1rem;" >{{$etapa->nombre ?? ''}}</span>
											<div class="progress">
												<!-- <div class="progress-bar" role="progressbar" style="background-color: {{($etapa->estado_etapa == 'A') ? 'black': 'green'}}; width: {{($etapa->estado_etapa == 'F') ? '100': '0'}}%;color: {{($etapa->estado_etapa == 'A') ? 'black': 'white'}};-webkit-text-stroke-width: thick;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> -->
												<div class="progress-bar" role="progressbar" style="width: 100%;color:white;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
												Etapa Activa
												</div>
											</div>
										</div>
									@endif
								@endforeach
							@endif
						</div>
					</div>
					<!--end::Section-->
				</div>
			</div>
		</div>
		<!-- <div class="row justify-content-center">
			<input type="hidden" name="gos_os_id" id="gos_os_id"
				value="{{$os->gos_os_id}}"> @if(isset($listaEtapasA))
				@foreach ($listaEtapasA as $key => $etapa)
			<div class="col-3">
				<div class="kt-portlet kt-portlet--height-fluid">
					<div class="kt-widget14">
						<div class="kt-widget14__header d-flex justify-content-center">
							<h3 style="font-size: 1rem;"
								class="kt-widget14__title ">{{$etapa->nombre}}</h3>
						</div>
						<div class="kt-widget14__content d-flex justify-content-center">
							<div class="kt-widget14__chart">
								<div class="chartjs-size-monitor">
									<div class="chartjs-size-monitor-expand">
										<div class=""></div>
									</div>
									<div class="chartjs-size-monitor-shrink">
										<div class=""></div>
									</div>
								</div>
								<div class="kt-widget14__stat">
								@if ($etapa->estado_etapa == 'A')
									0
								@elseif ($etapa->estado_etapa == 'F')
									100
								@else
									0
								@endif</div>
								<canvas id="etapas_os_{{$key}}"
									style="height: 100px; width: 100px; display: block;"
									width="140" height="140" class="chartjs-render-monitor"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach @endif
		</div> -->

		<div class="d-flex justify-content-center">
			<div class="d-flex justify-content-between">
				<i class="flaticon-squares-2"
					style="margin-right: 5%; color: #32b89d;"></i>
				<p>Estapas Finalizadas</p>
			</div>
			<div class="d-flex justify-content-between">
				<i class="flaticon-squares-2"
					style="margin-right: 5%; color: #3859FF;"></i>
				<p>Etapa Activa o en Progreso</p>
			</div>
			<div class="d-flex justify-content-between">
				<i class="flaticon-squares-2"
					style="margin-right: 5%; color: #DCDC;"></i>
				<p>Etapa Pendiente de comenzar</p>
			</div>
		</div>

    <!------------------------------------------------------------ARCHIVOS-------------------------------------------------------------------->
    <div>
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn text-white mr-2" id="btn-os-ajustes" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseAjustes" data-toggle="tab" role="tab">
                    <i class="fas fa-tools fa-2x pl-2 my-3"></i>
                    <p class="mb-0">Ajustes <br> 0/10</p>
                    <i class="fas fa-chevron-down pl-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn text-white mr-2" id="btn-os-clientes" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseClientes"  data-toggle="tab" role="tab">
                    <i class="fas fa-camera fa-2x pl-2 my-3"></i>
                    <p class="mb-0" id="cantidadClientes">Clientes <br> {{$countImgCliente}}/30</p>
                    <i class="fas fa-chevron-down pl-2"></i>
                    <input type="hidden" id="cantidadClientesOculto" value={{$countImgCliente}}>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn text-white mr-2" id="btn-os-internas" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseInternas" data-toggle="tab" role="tab">
                    <i class="fas fa-camera fa-2x pl-2 my-3"></i>
                    <p class="mb-0" id="cantidadInternas">Internas <br> {{$countImgInternas}}/50</p>
                    <i class="fas fa-chevron-down pl-2"></i>
                    <input type="hidden" id="cantidadInternasOculto" value={{$countImgInternas}}>
                </a>
            </li>
            <li class="nav-item">
                <a class="btn text-white mr-2" id="btn-os-archivos" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseArchivos" data-toggle="tab" role="tab">
                    <i class="fas fa-folder-open fa-2x pl-2 my-3"></i>
                    <p class="mb-0" id="cantidadDocs">Archivos <br> {{$countDocumentos}}/10</p>
                    <i class="fas fa-chevron-down pl-2"></i>
                    <input type="hidden" id="cantidadDocsOculto" value={{$countDocumentos}}>
                </a>
            </li>
        </ul>
        <div class="tab-content">
      <div class="tab-pane border" id="collapseAjustes" role="tabpanel">

                            <img src="../img/logo.png" alt="" style="border-radius:50%; border: 1px solid grey;height: 100px; width: 100px;">

        </div>

    <!-- ----------------------- imagenes con modal ------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <!-- ---------------------- imagenes con magnific popup------------------------------------------------------------------------------------------------------------------------------------------------ -->
            <div class="tab-pane border" id="collapseClientes" role="tabpanel">
                <div class="row" id="img-os-cliente">
                    @foreach ($listaImgCliente as $key => $imgCli)
                        <div class='col-4 col-sm-3 col-md-2 text-center mb-2' id='imgcliente_{{$imgCli->gos_os_imagen_cliente_id}}'>
                            <a id="btnborrarImgCliente" data-id="{{$imgCli->gos_os_imagen_cliente_id}}" class="position-absolute w-25 p-0" style="right:0px;"
                                href="javascript:void(0);">
                                <i class="far fa-2x fa-times-circle text-danger"></i>
                            </a>
                            <a class="popup-link-img" href='/storage/VehiculoCliente/{{$imgCli->imagen_cliente}}'>
                                <img src='/storage/VehiculoCliente/{{$imgCli->imagen_cliente}}' style='border-radius:50%; height: 100px; width: 100px;'>
                            </a>
                        </div>
                    @endforeach
                    @if (count($listaImgCliente) < 30)
                        <div class='col-4 col-sm-3 col-md-2 order-last'>
                            <form enctype="multipart/form-data" class="kt-form kt-form--label-right">
                                @csrf
                                <label for="img_clientes">
                                    <i class="fas fa-camera fa-4x border border-success rounded-circle p-3 text-success"
                                    style="border-width: 10px !important;"></i>
                                    <input type="file" name="img_clientes[]" id="img_clientes" class="d-none" accept=".png, .jpg, .jpeg" onchange="scaleImageClient(this);" multiple>
                                </label>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane border" id="collapseInternas" role="tabpanel">
              <div class="row" id="img-os-internas">
                     @foreach ($listaImgInternas as $key => $imgInt)
                        <div class='col-4 col-sm-3 col-md-2 text-center mb-2' id="imginterna_{{$imgInt->gos_os_imagen_interna_id}}">
                            <a id="btnborrarImgInterna" data-id="{{$imgInt->gos_os_imagen_interna_id}}" class="position-absolute w-25 p-0" style="right:0px;"
                                href="javascript:void(0);">
                                <i class="far fa-2x fa-times-circle text-danger"></i>
                            </a>
                            <a class="popup-link-img" href='/storage/VehiculoInterna/{{$imgInt->imagen_interna}}'>
                                <img src='/storage/VehiculoInterna/{{$imgInt->imagen_interna}}'
                                style='border-radius:50%; height: 100px; width: 100px;'>
                            </a>
                        </div>
                    @endforeach
                    @if (count($listaImgInternas) < 50)
                    <div class="col-4 col-sm-3 col-md-2 order-last">
                        <form enctype="multipart/form-data" class="kt-form kt-form--label-right">
                            @csrf
                            <label for="img_internas">
                                <i class="fas fa-camera fa-4x border border-success rounded-circle p-3 text-success"
                                style="border-width: 10px !important;"></i>
                                <input type="file" name="img_internas[]" id="img_internas" class="d-none" accept=".png, .jpg, .jpeg" onchange="scaleImageInterna(this);" multiple>
                            </label>
                        </form>
                    </div>
                    @endif
              </div>
            </div>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
            <div class="tab-pane border" id="collapseArchivos" role="tabpanel">

										<div class="card  text-center m-3 ">
		                <div class="card-header "> <h5>Documentos Qualitas</h5></div>
										<div class="card-body">
		                 <div class="row">
											 <?php if ($archiveqlts!=null): ?>
                           <?php
													  $notFirmada=0; $Ordenadmision=0; $documentos=0; $infdanios=0; $fotosser=0; $fcomp=0; $valucion=0; $archrefa=0; $otrosarc=0;
													  foreach ($archiveqlts as $archivecount){
                             if ($archivecount->carpeta==2){$Ordenadmision=$Ordenadmision+1;}
                             if ($archivecount->carpeta==1){$notFirmada=$notFirmada+1;}
														 if ($archivecount->carpeta==3){$documentos=$documentos+1;}
														 if ($archivecount->carpeta==4){$infdanios=$infdanios+1;}
													 	 if ($archivecount->carpeta==6){$fcomp=$fcomp+1;}
														 if ($archivecount->carpeta==7){$valucion=$valucion+1;}
													   if ($archivecount->carpeta==8){$archrefa=$archrefa+1;}
													   if ($archivecount->carpeta==9){$otrosarc=$otrosarc+1;}

														}
														 ?>
											 <?php endif; ?>
		                   <div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1" type="button" name="button" onclick="modaldocsqlt(1)" >Not. Firmada - ({{$notFirmada}})</button> </div>
											 <div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(2)">Orden Admision - ({{$Ordenadmision}})</button> </div>
											 <div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(3)">Fotos Cliente</button> </div>
											 <div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(4)">Documentos - ({{$documentos}})</button> </div>
											 <div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(5)">Informe Daños - ({{$infdanios}})</button></div>
											  <div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(7)">Fotos Internas - ({{$fcomp}})</button></div>
												<div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(8)">Valuacion - ({{$valucion}})</button></div>
												<div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(9)">Refacciones - ({{$archrefa}})</button></div>
												<div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1"  type="button" name="button" onclick="modaldocsqlt(10)">Otros - ({{$otrosarc}})</button></div>
												<div class="col-2"><button  class="btn btn-md btn-secondary w-100 m-1" ><i class="fas fa-file-download"></i> Complemento</button></div>
												<?php if ($pres!=null): ?>
													<div class="col-2">
													<button type="button" class=" btn btn-outline-secondary w-100 m-1" id="" onclick="ImprimirPres({{$pres->gos_pres_id ?? '' }});" style="margin-bottom: 1rem;"><i class="fas fa-print"></i>PDF Presupuesto</button>
													</div>
														<div class="col-2">
														<button type="button" class=" btn btn-outline-secondary w-100 m-1" id="" onclick="ImprimirPresHV({{$pres->gos_pres_id ?? '' }});" style="margin-bottom: 1rem;"><i class="fas fa-car"></i>Hoja Viajera</button>
														</div>
												<?php endif; ?>
		                 </div>
										</div>
										</div>

										<div class="container"  style="display: none;" id="dropdowndocumentos">
                    <div class="card">
                    <div class="card-header text-center"> <h6 id="titlemodalqualitas"></h6></div>
										<div class="card-body">
										<form class="" action="/osgenqlts/{{$os->gos_os_id}}/subirFiles" method="post" enctype="multipart/form-data">
											@csrf
											<?php foreach ($archiveqlts as $file): ?>
											 <button class="btn btn-sm btn-secondary m-2 fileclass{{$file->carpeta}} fileclassall" type="button" name="button" style="display: none;" >{{$file->nombre}}.{{$file->formato}}</button>
											<?php endforeach; ?>
											<div class="container" id="appendinnerdocqlts">
											</div>
											 <input type="hidden" id="tipofileqlt" name="tipofileqlt" value="">
											 	 <input type="hidden" id="carpetaqlts" name="carpetaqlts" value="">
											 <input class="form-control"  id="inputenviarfiles" type="file" name="archivosQlt[]" value="" multiple onchange="Guardarfiles();">
                       <button type="submit" id="btnenviarfiles" style="display: none;">save</button>
										</form>
										   <div class="float-right">
											 <button class="btn btn-sm btn-secondary m-2"  type="button" name="button" onclick="cerrardrwpdwnqls();">cerrar</button>
									   </div>
										</div>
                    </div>
									</div>
            </div>
        </div>
    </div>

		<div style="margin: 2% auto;">
			<button type="button" class="btn btn-info" data-toggle="modal"
				data-target="#modalInventario">Editar inventario</button>
		</div>
		<div class="kt-form__actions">
			<button type="button" id="btnGuardarfinalizarEtapa" style="border-color: #32B89D; background-color: #32B89D; display:none;" class="btn btn-success btn-block mb-2 mt-2">Finalizar la orden y notificar al cliente</button>
		</div>
		<div class="table-responsive">
			<table style="font-size: 12px;" class="table table-sm table-hover" id="dt-etapas-os">
				<thead class="thead-light">
					<tr>
						<h3 style="font-size: 1rem;" class="kt-widget14__title ">{{$infopaquete->nomb_paquete ?? ''}}</h3>
					</tr>
					<tr>
						<th style="display:none">id</th>
						<th >Nombre</th>
						<th style="display:none">Orden</th>
						<th >Descripción</th>
						<th >Asesor</th>
						<th style="text-align: -webkit-center;">Importe Solicitado</th>
						<th style="text-align: -webkit-center;">Precio</th>
						<th style="text-align: -webkit-center;">Precio M.O.</th>
						<th style="text-align: -webkit-center;">Materiales</th>
						<th style="text-align: -webkit-center;">Tiempo</th>
						<th style="text-align: -webkit-center;">Estado</th>
						<th style="text-align: -webkit-center;">Finalizar Etapa</th>
						<th style="text-align: -webkit-center;" class="text-center" style="width: 3%;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($listaEtapasA as  $eta)
						<tr>
							<!--ID  -->
							<td style="display:none"> # {{$eta->gos_os_item_id}}</td>
							<!--Nombre  -->
							<td >
							 {{$eta->nombre}}
							</td>
							<!--Orden  -->
							<td style="display:none">{{$eta->orden_etapa}}</td>
							<!--Descripción  -->
							<td style="vertical-align: middle;">
							{{$eta->descripcion}}
							</td>
							<!--Asesor  -->
							<td style="vertical-align: middle;">{{$eta->asesor}}</td>
							<!--Importe Solicitado  -->
							<td style="text-align:center;vertical-align: middle;"> {{$eta->importe_solicitado}} </td>
							<form action="/osg/edit-precio" method="POST">
					@CSRF
							<!--Precio  -->
							<td  style="text-align:center;vertical-align: middle;">
							<input class="form-control form-control-sm col-12 col-lg-6 col-xl-4" type="text" style="display:none" id="preetapint{{$eta->gos_os_item_id}}" name="preetapint[]" value="{{$eta->precio_etapa}}">
							<button class="btn btn-info btn-sm col-12 col-lg-6 col-xl-4" type="submit" style="display:none" id="btnsaveprecio{{$eta->gos_os_item_id}}" name="btnsaveprecio">Guardar</button>
								<input type="hidden"  name="itemidetapa[]" class="form-control form-control-sm"  value="{{$eta->gos_os_item_id}}">
								<a  id="clickprecio{{$eta->gos_os_item_id}}" style="display:inline;" onclick="displaymodaledit({{$eta->gos_os_item_id}})" >
									{{$eta->precio_etapa}}
								</a>
							</td>
							<!--Precio M.O.  -->
							<td style="text-align:center;vertical-align: middle;">{{$eta->precio_mo}} </td>
							<!--Materiales  -->
							<td style="text-align:center;vertical-align: middle;" >
									<?php if ($eta->precio_materiales != null): ?>
										<input  class="form-control form-control-sm col-12 col-lg-6 col-xl-4" type="text" style="display:none"  id="premateint{{$eta->gos_os_item_id}}" name="premateint[]" value="{{$eta->precio_materiales}}">
										<input type="hidden"  name="itemidetapamate[]" class="form-control form-control-sm"  value="{{$eta->gos_os_item_id}}">
										<button class="btn btn-info btn-sm col-12 col-lg-6 col-xl-4" type="submit" style="display:none" id="btnsavemateriales{{$eta->gos_os_item_id}}" name="btnsavemateriales">Guardar</button>

									<?php endif; ?>
								<a  id="clickpreciomaterial{{$eta->gos_os_item_id}}" style="display:inline;" onclick="displaymodaleditmat({{$eta->gos_os_item_id}})">
									{{$eta->precio_materiales}}
								</a>
							</td>
							<!--Tiempo  -->
							<td style="text-align:center;vertical-align: middle;">{{$eta->tiempo_meta_texto}} </td>



							<!--Estado  -->
							<?php $estetap= $eta->estado_etapa;?>
							<?php if ($estetap== "A"): ?>
								<td style="vertical-align: middle;">
								<div  style="color: #5d78ff; -webkit-text-stroke-width: medium; font-size:1rem; text-align-last: center;">Activa</div>
								</td>
								<?php elseif($estetap== "F"): ?>
								<td style="vertical-align: middle;">
								<div  style="color: #32b89d; -webkit-text-stroke-width: medium; font-size:1rem; text-align-last: center;">Finalizada</div>
								</td>
								<?php else: ?>
								<td style="vertical-align: middle;">
								<div  style="-webkit-text-stroke-width: medium; font-size:1rem; text-align-last: center;">Pendiente</div>
								</td>
							<?php endif; ?>


							<!--Finalizar Etapa  -->
							<?php  $tmcheck=explode("|", $eta->tiempo_meta_checkbox);?>
							<?php if ($tmcheck[2]== "A"): ?>
								<td style="vertical-align: middle;">
									<div style="text-align-last: center;"><a data-toggle="modal" id="checka" data-target="#modal-siguente-etapa" data-id="{{$tmcheck[1]}}" class="kt-nav__link">
									<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4">
									<input type="checkbox"> <span ></span></label></a></div>
								</td>
								<?php elseif($tmcheck[2]== "F"): ?>
								<td style="vertical-align: middle;">
									<div style="text-align-last: center;"><a data-toggle="modal" id="checka" data-target="#modal-siguente-etapa" data-id="{{$tmcheck[1]}}" class="kt-nav__link">
									<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4">
									<input type="checkbox"  checked="checked" > <span ></span></label></a></div>
								</td>
								<?php else: ?>
								<td style="vertical-align: middle;">
									<div style="text-align-last: center;"><a  class="kt-nav__link">
									<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-4">
									<input type="checkbox" disabled> <span border: 1px solid #ebedf2;></span></label></a></div>
								</td>
							<?php endif; ?>

							<td style="width: 3%; text-align:center;vertical-align: middle;">

							</td>

						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="DTE DTE_Bubble"  id="modaledit" style=" opacity: 1; display: none;">
			<div class="DTE_Bubble_Liner" style="left: 0px;">
				<div data-dte-e="head" class="DTE_Header">
					<div class=" row">
					<div class="DTE_Header_Content col-9">Editar
					</div>

					<button type="button" class="btn btn-secondary d-flex justify-content-end" style="position: relative; bottom: .75rem; left: .75rem; border-radius: 15px;  color: black;"  onclick="displaymodaleditoff()" data-dismiss="modal">X</button>
					</div>
				</div>
				<div class="DTE_Bubble_Table">

						<div data-dte-e="form_content" class="DTE_Form_Content">
							<div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_precio_etapa">
								<label data-dte-e="label" class="DTE_Label" id="titleedit" for="DTE_Field_precio_etapa" style="font-size:1.25rem;"><div data-dte-e="msg-label" class="DTE_Label_Info"></div>
								</label>
								<div data-dte-e="input" class="DTE_Field_Input">
									<div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
										<input type="hidden" id="itemetapaid_edit" name="itemetapaid_edit" value="">
										<input id="DTE_Field_precio_etapa" name="DTE_Field_precio_etapa" type="text" value="">
										<input id="DTE_Field_precio_materiales" name="DTE_Field_precio_materiales" type="text" value="">

									</div>
									<div data-dte-e="multi-value" class="multi-value" style="display: none;">
										Multiple values
										<span data-dte-e="multi-info" class="multi-info" style="display: none;">
										The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span>
									</div>
									<div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div>
									<div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div>
									<div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div>
									<div data-dte-e="msg-info" class="DTE_Field_Info"></div>
								</div>
								<div data-dte-e="field-processing" class="DTE_Processing_Indicator"><span></span></div>
							</div>
						</div>

						<div class="icon close"></div>
						<div class="DTE_Processing_Indicator"><span></span></div>
						<div data-dte-e="form_buttons" class="DTE_Form_Buttons">
							<button type="button" id="btnsaveprecio" class="btn btn-primary" tabindex="0" onclick="btnclcikcont()" value="">Continuar</button>
							<button type="submit" class="btn btn-primary" tabindex="0">Guardar</button>
						</div>
					</form>
				</div>
				<div data-dte-e="form_error" class="DTE_Form_Error" style="display: none;"></div>
			</div>
			<div class="DTE_Bubble_Triangle"></div>
		</div>




		<div class="table-responsive">
		<table class="table table-sm table-hover my-4" id="dt-lista-producto-os" style="font-size: 1rem;">
					<thead class="thead-light">
						<tr style="font-weight: 500;">
							<th>ID</th>
							<th>Producto</th>
							<th>Descripción</th>
							<th>Código SAT</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Descuento</th>
							<th>Importe</th>
							<th style="width:3%;"></th>
						</tr>
					</thead>
					<tbody id="dt_lista_items_os_body">

					</tbody>
				</table>
		</div>
		{{-- Arranca parte tabla 2 --}} {{--
		<div class="table-responsive">
			<table style="font-size: 12px;" class="table table-sm table-hover"
				id="dt-ServiciosEdicionRapida">
				<thead class="thead-light">
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Descripción</th>
						<th>Precio venta</th>
						<th>Importe</th>
						<th class="text-center" style="width: 3%;"></th>
					</tr>
				</thead>
			</table>
		</div>
		--}} {{-- Arranca parte Botones Modales --}}
		<div class="row d-flex justify-content-center">
			<div class="form-group col-4 col-lg-2 mt-2 mb-2">
				<button type="button" class="btn w-100 btn-info" data-toggle="modal"
					data-target="#modal-presupuesto">Presupuesto -
					{{$countpres}}</button>
			</div>
			<div class="form-group col-4 col-lg-2 mt-2 mb-2">
				<button type="button" class="btn w-100 btn-info" data-toggle="modal"
					data-target="#modal-refaccionesOS">Refacciones -
					{{$countrefacciones}} / {{$countrefaccionesR}} / {{$countrefaccionesC}}</button>
			</div>
			<div class="form-group col-4 col-lg-2 mt-2 mb-2">
			<button type="button" class="btn w-100 btn-info" id="btnmodalservicios">Servicios:MO -
					{{$countserviciosFin}} / {{$countservicios}} </button>
			</div>
			<div class="form-group col-4 col-lg-2 mt-2 mb-2">
				<button type="button" class="btn w-100 btn-info" data-toggle="modal"
					data-target="#modal-inventario">Inventario Int. -
					{{$countproductoint}}</button>
			</div>
			<div class="form-group col-4 col-lg-2 mt-2 mb-2">
				<button type="button" class="btn w-100 btn-info" data-toggle="modal"
					data-target="#modal-inventario-ext">Productos Ext. -
					{{$countproductoext}}</button>
			</div>
		</div>
		{{-- Arranca parte Comentarios --}}
		<div class="mt-5">
			<div class="row d-flex justify-content-center">
					<h5>Comentarios</h5>
			</div>
			<div class="row d-flex justify-content-center">
					<button type="button"
						class="btn btn-success btn-elevate-hover btn-icon-sm"
						data-toggle="modal" data-target="#modalcomentario">
						<i class="fas fa-plus kt-shape-font-color-1"></i>
						Añadir Comentario
					</button>
			</div>
			{{-- Arranca parte Acordiones --}}
			<div class="accordion accordion-toggle-arrow mt-2">
				<div class="card">
					<div class="card-header">
						<div class="card-title collapsed" data-toggle="collapse"
							data-target="#listacomentarioEquipo" aria-expanded="false">
							<p style="margin: 0 auto;">Equipo - @isset($mensajeEquipo)
								{{$mensajeEquipo->count($mensajeEquipo->id_mensaje)}} @endisset
							</p>
						</div>

					</div>
					<div id="listacomentarioEquipo" class="collapse">
						<div class="card-body">
							<div class="table-responsive">
								<table style="font-size: 12px;"
									class="table table-sm table-hover" id="dt-EquipoEdicionRapida">
									<thead class="thead-light">
										<tr>
											<th>ID</th>
											<th>Prioridad</th>
											<th>Fecha</th>
											<th>Nombre</th>
											<!-- <th>Imagen</th> -->
											<th>Comentario</th>

											<th>Opciones</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="card-title collapsed" data-toggle="collapse"
							data-target="#listacomentarioCliente" aria-expanded="false">
							<p style="margin: 0 auto;">Cliente - @isset($clientesmensaje)
								{{$clientesmensaje->count($clientesmensaje->id_mensaje)}}
								@endisset</p>
						</div>
					</div>
					<div id="listacomentarioCliente" class="collapse">
						<div class="card-body">
							<div class="table-responsive">
								<table style="font-size: 12px;"
									class="table table-sm table-hover" id="dt-ClienteEdicionRapida">
									<thead class="thead-light">
										<tr>
											<th>ID</th>
											<th>Prioridad</th>
											<th>Fecha</th>
											<th>Nombre</th>
											<!-- <th>Imagen</th> -->
											<th>Comentario</th>
											<th>Opciones</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-1">

		@include('OS/Inventario/ModalInventario')
		<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
	</div>

</div>
</div>
</div>

@include('OS/Generada/modalFinalizarEtapas')
@include('OS/Generada/modalSiguienteEtapa')
@include('OS/Inventario/modalInventarioIntOS')
@include('OS/Inventario/modalInventarioExtOS')
@include('OS/Items/modalServiciosOS')
@include('OS/Mensajes/mensajes')
@include('OS/Refacciones/Refacciones')
@include('OS/Comentarios/modalComentarioExtraOS')
@include('OS/Presupuestos/modalPresupuesto')
@include('OS/Refacciones/FechaPromesa')
{{--
@include('OS/Comentarios/comentariosOS') --}}

@endsection

@section('ScriptporPagina')
<script>$(function(){$('[data-toggle="popover"]').popover()}); </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/ajax-os-generada.js"></script>

<!-- YOIS -->
<!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>-->
<script src="{{env('APP_URL')}}/gos/datatable-editor/js/dataTables.editor.min.js"></script>
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/ajax-os-generada-etapas-plano.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="gos\OS\ajax-os-generada-qualitas.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/ajax-os-inventario-vehiculo.js"></script>



<!-- YOIS -->
{{--
<script src="{{env('APP_URL')}}/gos/ajax-edicion-rapida-os.js"></script>
<script src="{{env('APP_URL')}}/gos/ajax-edicion-rapida-os-graficos.js"></script>
--}}
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-inventarioExt.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-inventarioInt.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-fecha-promesa.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-os-servicios.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-refacciones.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-os-presupuesto.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-clientes.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-equipos.js"></script>


<script src="/assets/js/pages/crud/file-upload/ktavatar.js"></script>
<script src="{{env('APP_URL')}}/gos/OS/Editar/ajax-os-comentarios.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
@endsection
