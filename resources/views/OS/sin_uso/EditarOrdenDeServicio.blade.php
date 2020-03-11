@extends('Layout')
<title>Orden de Servicio</title>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
@section('Content')

	<div class="kt-portlet kt-portlet--mobile">
	    <div class="kt-portlet__head kt-portlet__head--lg">
	        <div class="kt-portlet__head-label">
	            <h3 class="kt-portlet__head-title">
	                Etapa
	                <small>{{--{{$orden->orden_id}}--}}</small>
	            </h3>
	        </div>
	        <div class="kt-portlet__head-toolbar">
	            <div class="kt-portlet__head-wrapper">
	                <div class="kt-portlet__head-actions">
	                    <div class="dropdown dropdown-inline">
	                        <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right">
	                            <ul class="kt-nav">
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Editar</span>
	                                    </a>
	                                </li>
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Reenviar Mensaje</span>
	                                    </a>
	                                </li>
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Fecha Promesa</span>
	                                    </a>
	                                </li>
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Imprimir Orden</span>
	                                    </a>
	                                </li>
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Descargar Imagenes Cliente</span>
	                                    </a>
	                                </li>
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Descargar Imagenes Internas</span>
	                                    </a>
	                                </li>
	                                <li class="kt-nav__item">
	                                    <a href="#" class="kt-nav__link">
	                                        <span class="kt-nav__link-text">Reingreso</span>
	                                    </a>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                    &nbsp;
	                </div>
	            </div>
	        </div>
	    </div>
	{{-- Arranca el Cuerpo --}}
	    <div class="kt-portlet__body">
	    {{-- Arranca La Tabla --}}
	        <div class="table-container mt-2 table-responsive">
	            <table id="mytable" class="table table-striped " style="background:#fff;font-size: 1rem;">
	                <thead>
	                    <tr style="font-weight: 500;">
	                        <th class="kt-datatable__cell kt-datatable__toggle-detail kt-datatable__cell--sort"><span></span></th>
	                        <th data-field="Order ID" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Fecha</span></th>
	                        <th data-field="Car Make" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Cliente</span></th>
	                        <th data-field="Car Model" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Aseguradora</span></th>
	                        <th data-field="Color" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Vehiculo</span></th>
	                        <th data-field="Deposit Paid" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Total</span></th>
	                        <th data-field="Order Date" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Compras Relacionadas</span></th>
	                    </tr>
	                </thead>
	                <tbody>
										{{-- @foreach ($ListaOrdenes as $orden) --}}
	                    <tr>
	                        <td class="kt-datatable__cell kt-datatable__toggle-detail">
	                            <a class="kt-datatable__toggle-detail" href="">
	                                <i class="fa fa-caret-right"></i>
	                            </a>
	                        </td>
	                        <td data-field="Order ID" class="kt-datatable__cell">
	                            <span style="width: 110px;">{{--{{$orden->orden_id->update_at}}--}}</span>
	                        </td>
	                        <td data-field="Car Make" class="kt-datatable__cell">
	                            <span style="width: 110px;">
	                                {{--{{$orden->orden_id->cliente_id->nomb_cliente}}--}}
	                                <br>
	                                {{--{{$orden->orden_id->cliente_id->telefono}}--}}
	                            </span>
	                        </td>

	                        <td data-field="Car Model" class="kt-datatable__cell">
	                            <span style="width: 110px;">
	                                Seguro {{--{{$orden->orden_id->aseguradora_id->empresa}}--}}<br>
	                                #R: {{--{{$orden->orden_id->reporte_id}}--}}<br>
	                                #S: {{--{{$orden->orden_id->siniestro_id->siniestro}}--}}<br>
	                                #P: {{--{{$orden->orden_id->poliza_id->poliza}}--}}<br>
	                                Deducible: {{--{{$orden->orden_id->deducible}}--}}<br>
	                                Demerito: {{--{{$orden->orden_id->demerito}}--}}<br>
	                                Daño: {{--{{$orden->orden_id->dano_id->nomb_dano}}--}}<br>
	                                Estatus: {{--{{$orden->orden_id->estatus_id->nomb_estatus}}--}}
	                            </span>
	                        </td>
	                        <td data-field="Color" class="kt-datatable__cell">
	                            <span style="width: 110px;">
	                                {{--{{$orden->orden_id->marca_id->nomb_marca}}--}},
	                                {{--{{$orden->orden_id->modelo_id->nomb_modelo}}--}}
	                                {{--{{$orden->orden_id->modelo_id->ano}}--}}<br>
	                                Color: {{--{{$orden->orden_id->color_id->nomb_color}}--}}<br>
	                                P: {{--{{$orden->orden_id->placa}}--}}<br>
	                                Economico: {{--{{$orden->orden_id->economico}}--}}<br>
	                                Serie: {{--{{$orden->orden_id->serie}}--}}
	                            </span>
	                        </td>
	                        <td data-field="Deposit Paid" class="kt-datatable__cell">
	                            <span style="width: 110px;">{{--{{$orden->orden_id->total}}--}}</span>
	                        </td>
	                        <td data-field="Order Date" class="kt-datatable__cell">
	                            <span style="width: 110px;">{{--{{$orden->orden_id->compras_relacionada}}--}}</span>
	                        </td>
	                    </tr>
										{{-- @endforeach --}}
	                </tbody>
	            </table>
	        </div>

					{{-- Parte Gráficos --}}
		<div class="d-flex justify-content-around">
			<div class="col-xl-3 col-lg-3 order-lg-2 order-xl-1" style="display: inline-block;padding:0;">
					<!--begin:: Widgets/Profit Share-->
					<div class="kt-portlet kt-portlet--height-fluid">
						<div class="kt-widget14">
							<div class="kt-widget14__header d-flex justify-content-center">
								<h3 class="kt-widget14__title">
									Etapa 1
								</h3>
							</div>
							<div class="kt-widget14__content d-flex justify-content-center">
								<div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
									<div class="kt-widget14__stat">20</div>
									<canvas id="kt_charty_profit_share" style="height: 140px; width: 140px; display: block;" width="140" height="140" class="chartjs-render-monitor"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Profit Share-->
		</div>

		<div class="col-xl-3 col-lg-3 order-lg-2 order-xl-1" style="display: inline-block;padding:0;">
				<!--begin:: Widgets/Profit Share-->
				<div class="kt-portlet kt-portlet--height-fluid">
					<div class="kt-widget14">
						<div class="kt-widget14__header d-flex justify-content-center">
							<h3 class="kt-widget14__title">
								Etapa 2
							</h3>
						</div>
						<div class="kt-widget14__content d-flex justify-content-center">
							<div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
								<div class="kt-widget14__stat">50</div>
								<canvas id="kt_charty_profit_share1" style="height: 140px; width: 140px; display: block;" width="140" height="140" class="chartjs-render-monitor"></canvas>
							</div>
						</div>
					</div>
				</div>
				<!--end:: Widgets/Profit Share-->
			</div>
	</div>
	<div class="d-flex justify-content-center">
		<div class="d-flex justify-content-between">
			<i class="flaticon-squares-2" style="margin-right:5%;color:#3859FF;"></i>
			<p>Estapas Finalizadas</p>
		</div>
		<div class="d-flex justify-content-between">
			<i class="flaticon-squares-2" style="margin-right:5%;color:#32b89d;"></i>
			<p>Etapa Activa o en Progreso</p>
		</div>
	</div>

	{{-- Arranca parte Acordiones --}}
			<div class="accordion accordion-toggle-arrow" id="accordionExample4">
					<div class="card">
							<div class="card-header" id="headingTwo4">
									<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
											<i class="flaticon-photo-camera"></i> Clientes 0/30
									</div>
							</div>
							<div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample4">
									<div class="card-body">
											<div class="col-lg-9 col-xl-6">
											{{-- @foreach ($ListaImgClientes as $imgClientes) --}}
													<div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
															<div class="kt-avatar__holder" {{-- style="background-image: {{ route('storage/clientes/'.$imgClientes->imagen) }}" --}}>
																	<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Agregar Archivo">
																			<i class="fa fa-pen"></i>
																			<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
																	</label>
															</div>
													</div>
											{{-- @endforeach --}}
											</div>
									</div>
							</div>
					</div>

					<div class="card">
							<div class="card-header" id="headingThree4">
									<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
											<i class="flaticon-photo-camera"></i> Internas 0/50
									</div>
							</div>
							<div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
									<div class="card-body">
											<div class="col-lg-9 col-xl-6">
											{{-- @foreach ($ListaImgInternas as $imgInternas) --}}
													<div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
															<div class="kt-avatar__holder" {{-- style="background-image: {{ route('storage/imgInternas/'.$imgInternas->imagen) }}" --}}>
																	<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Subir Foto">
																			<i class="fa fa-pen"></i>
																			<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
																	</label>
															</div>
													</div>
											{{-- @endforeach --}}
											</div>
									</div>
							</div>
					</div>

					<div class="card">
							<div class="card-header" id="headingFour4">
									<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
											<i class="flaticon-tool"></i> Archivos 0/10
									</div>
							</div>
							<div id="collapseFour4" class="collapse" aria-labelledby="headingFour1" data-parent="#accordionExample4">
									<div class="card-body">
											<div class="col-lg-9 col-xl-6">
											{{-- @foreach ($listaArchivos as $key => $archivo) --}}
													<div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
															<div class="kt-avatar__holder" {{-- style="background-image: {{ route('storage/imgInternas/'.$$archivo->imagen) }}" --}}>
																	<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Subir Foto">
																			<i class="fa fa-pen"></i>
																			<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
																	</label>
															</div>
													</div>
											{{-- @endforeach --}}
											</div>
									</div>
							</div>
					</div>
			</div>

	{{-- Arranca parte tabla 2 --}}
	<div class="table-container mt-2 table-responsive">
		<table id="mytable" class="table table-striped" style="background:#fff;font-size: 1rem;">
			<thead>
				<tr style="font-weight: 500;">
					<th class="kt-datatable__cell kt-datatable__toggle-detail kt-datatable__cell--sort"><span></span></th>
					<th data-field="Order ID" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Nombre</span></th>
					<th data-field="Car Make" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Cantidad</span></th>
					<th data-field="Car Model" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Descripción</span></th>
					<th data-field="Color" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Precio Venta</span></th>
					<th data-field="Deposit Paid" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;">Importe</span></th>
					<th data-field="Order Date" class="kt-datatable__cell kt-datatable__cell--sort"><span style="width: 110px;"> </span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="kt-datatable__cell kt-datatable__toggle-detail"><a class="kt-datatable__toggle-detail" href=""><i class="fa fa-caret-right"></i></a></td>
					<td data-field="Order ID" class="kt-datatable__cell"><span style="width: 110px;">{{--{{$orden->nombre}}--}}</span></td>
					<td data-field="Car Make" class="kt-datatable__cell"><span style="width: 110px;">{{--$orden->cantidad--}}</span></td>
					<td data-field="Car Model" class="kt-datatable__cell"><span style="width: 110px;">{{--{{$orden->descripcion}}--}}</span></td>
					<td data-field="Color" class="kt-datatable__cell"><span style="width: 110px;">{{--{{$orden->precio_venta}}--}}</span></td>
					<td data-field="Deposit Paid" class="kt-datatable__cell"><span style="width: 110px;">{{--$orden->importe--}}</span></td>
					<td data-field="Order Date" class="kt-datatable__cell"><span style="width: 110px;">
						<form action="{{--{{action('Gos\OrdenController@destroy',$oreden->orden_id)}}--}}" method="POST"
							class="form-clientes">
							@csrf
							@method('DELETE')
							<a class="delete-orden">
								<input type="hidden" name="gos_producto_id" value="{{--{{$oden->orden_id}}--}}">
								<button type="submit" class="btn btn-sm p-1"><i class="flaticon2-delete"></i></button>
							</a>
						</form>
					</span></td>
				</tr>
			</tbody>
		</table>
	</div>

	{{-- Arranca parte Botones Modales --}}
			<div class="d-flex justify-content-around table-responsive">
					<div class="col">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#kt_modal_5">Presupuesto - {{--{{$presupuesto->num}}--}} </button>
					</div>
					<div class="col">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#kt_modal_6">Refacciones - {{--{{$refacciones->num}}--}} </button>
					</div>
					<div class="col">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#kt_modal_7">Servicios / MO - {{--{{$servicioMO->num}}--}} </button>
					</div>
					<div class="col">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#kt_modal_8">Inventario Int. - {{--{{$productoInt->num}}--}}</button>
					</div>
					<div class="col">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#kt_modal_9">Productos Ext. - {{--{{$productoExt->num}}--}} </button>
					</div>
			</div>

			{{-- @include('OS/modalInventarioIntOS')

			@include('OS/modalProductoExtOS') --}}

	{{-- Arranca parte Comentarios --}}

			

	</div>
	</div>




<script type="text/javascript">
$( document ).ready(function() {

	fetch('http://localhost:8000/api/chart-etapas')
		.then(function(res){
			return res.json();
		})
		.then(function(datos){
			var ctx = KTUtil.getByID('kt_charty_profit_share').getContext('2d');
			var config = {
					type: 'doughnut',
					data: {
							datasets: [{
									data:	datos.data,
									backgroundColor: [
										'#32B89D','#EAEBF1',
									]
							}],
							labels: datos.labels
					},
					options: {
							cutoutPercentage: 75,
							responsive: true,
							maintainAspectRatio: false,
							legend: {
									display: false,
									position: 'top',
							},
							title: {
									display: false,
									text: 'Technology'
							},
							animation: {
									animateScale: true,
									animateRotate: true
							},
							tooltips: {
									enabled: true,
									intersect: false,
									mode: 'nearest',
									bodySpacing: 5,
									yPadding: 10,
									xPadding: 10,
									caretPadding: 0,
									displayColors: false,
									backgroundColor: '#5D78FF',
									titleFontColor: '#ffffff',
									cornerRadius: 4,
									footerSpacing: 0,
									titleSpacing: 0
							}
					}
			};
			var ctx = KTUtil.getByID('kt_charty_profit_share').getContext('2d');
			var myDoughnut = new Chart(ctx, config);
		});


			var ctx = KTUtil.getByID('kt_charty_profit_share1').getContext('2d');
			var config = {
			type: 'doughnut',
			data: {
					datasets: [{
							data:	 [50,40],
							backgroundColor: [
								'#32B89D','#EAEBF1',
							]
					}],
					labels: ['Completado', 'En Proceso']
			},
			options: {
					cutoutPercentage: 75,
					responsive: true,
					maintainAspectRatio: false,
					legend: {
							display: false,
							position: 'top',
					},
					title: {
							display: false,
							text: 'Technology'
					},
					animation: {
							animateScale: true,
							animateRotate: true
					},
					tooltips: {
							enabled: true,
							intersect: false,
							mode: 'nearest',
							bodySpacing: 5,
							yPadding: 10,
							xPadding: 10,
							caretPadding: 0,
							displayColors: false,
							backgroundColor: '#5D78FF',
							titleFontColor: '#ffffff',
							cornerRadius: 4,
							footerSpacing: 0,
							titleSpacing: 0
					}
			}
			};
			var ctx = KTUtil.getByID('kt_charty_profit_share1').getContext('2d');
			var myDoughnut = new Chart(ctx, config);

});
</script>
@endsection
