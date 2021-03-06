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
			<div class="col-4">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">Etapa</h3>
				</div>
			</div>
			<div class="col-8 border-left">
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
						<th class="text-nowrap" style="width: 170px;">Aseguradora</th>
						<th class="text-nowrap" style="width: 170px;">Vehiculo</th>
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
							# reporte: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_reporte}}</strong><br>
							# siniestro: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_siniestro}}</strong><br>
							# poliza: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_poliza}}</strong><br>
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
							Economico: <strong style="color: #27395C; font-weight: 500;">{{$os->economico}}</strong><br>
							Serie: <strong style="color: #27395C; font-weight: 500;">{{$os->nro_serie}}</strong>
						</td>
						<td class="text-center">${{number_format($precio_total, 2, '.', '') ??''}}</td>
						<td class="text-center"></td>
					</tr>
				</tbody>
			</table>
		</div>
		{{-- Parte Gráficos 
		{{--<div class="container">
				<div style="margin-top:0%;" class="col-12 col-md-12">
					<div  class="">
					<!--begin::Section-->
					<div class="kt-section kt-section--last">
						<h3 class="kt-portlet__head-title kt-align-center">
						Etapa
						</h3>
						<div style="max-height:200rem;">

						<input type="hidden" name="gos_os_id" id="gos_os_id"
						value="{{$os->gos_os_id}}"> @if(isset($listaEtapasA))
						@foreach ($listaEtapasA as $key => $etapa)
						<div class="form-group">
							<span class="kt-widget14__title" style="font-size: 1rem;" >{{$etapa->nombre}}</span>
							<div class="progress">
							<!-- <div class="progress-bar" role="progressbar" style="background-color: {{($etapa->estado_etapa == 'A') ? 'black': 'green'}}; width: {{($etapa->estado_etapa == 'F') ? '100': '0'}}%;color: {{($etapa->estado_etapa == 'A') ? 'black': 'white'}};-webkit-text-stroke-width: thick;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> -->
							@if ($etapa->estado_etapa == 'A')
							<div class="progress-bar" role="progressbar" style="width: 100%;color:white;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							Etapa Activa
							@elseif ($etapa->estado_etapa == 'F')
							<div class="progress-bar" role="progressbar" style="background-color: green; width: 100%;color:white;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
								Terminado
							@else
							<div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
								0%
							@endif
							</div>
							</div>
						</div>

							@endforeach @endif

						</div>

					</div>
					<!--end::Section-->
					</div>
				</div>
		</div>--}}
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

		@include('OS/Generada/CargaArchivos')

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
						<th >id</th>
						<th >Nombre</th>
						<th >Orden</th>
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
				</tbody>
			</table>
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
			<button type="button" class="btn w-100 btn-info" value="{{$os->estado_expediente}}" id="btnmodalservicios">Servicios:MO -
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
<script src="{{env('APP_URL')}}/gos/OS/ajax-os-generada-etapas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

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

