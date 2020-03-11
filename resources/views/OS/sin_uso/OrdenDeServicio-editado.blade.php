@extends('Layout')
<title>Orden de Servicio</title>
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
                    <tr>
                        <td class="kt-datatable__cell kt-datatable__toggle-detail">
                            <a class="kt-datatable__toggle-detail" href="">
                                <i class="fa fa-caret-right"></i>
                            </a>
                        </td>
                        <td data-field="Order ID" class="kt-datatable__cell">
                            <span style="width: 110px;">{{--{{$orden->update_at}}--}}</span>
                        </td>
                        <td data-field="Car Make" class="kt-datatable__cell">
                            <span style="width: 110px;">
                                {{--{{$orden->cliente_id->nomb_cliente}}--}}
                                <br>
                                {{--{{$orden->cliente_id->telefono}}--}}
                            </span>
                        </td>

                        <td data-field="Car Model" class="kt-datatable__cell">
                            <span style="width: 110px;">
                                Seguro {{--{{$orden->aseguradora_id->empresa}}--}}<br>
                                #R: {{--{{$orden->reporte_id}}--}}<br>
                                #S: {{--{{$orden->siniestro_id->siniestro}}--}}<br>
                                #P: {{--{{$orden->poliza_id->poliza}}--}}<br>
                                Deducible: {{--{{$orden->deducible}}--}}<br>
                                Demerito: {{--{{$orden->demerito}}--}}<br>
                                Daño: {{--{{$orden->dano_id->nomb_dano}}--}}<br>
                                Estatus: {{--{{$orden->estatus_id->nomb_estatus}}--}}
                            </span>
                        </td>
                        <td data-field="Color" class="kt-datatable__cell">
                            <span style="width: 110px;">
                                {{--{{$orden->marca_id->nomb_marca}}--}},
                                {{--{{$orden->modelo_id->nomb_modelo}}--}}
                                {{--{{$orden->modelo_id->ano}}--}}<br>
                                Color: {{--{{$orden->color_id->nomb_color}}--}}<br>
                                P: {{--{{$orden->placa}}--}}<br>
                                Economico: {{--{{$orden->economico}}--}}<br>
                                Serie: {{--{{$orden->serie}}--}}
                            </span>
                        </td>
                        <td data-field="Deposit Paid" class="kt-datatable__cell">
                            <span style="width: 110px;">{{--{{$orden->total}}--}}</span>
                        </td>
                        <td data-field="Order Date" class="kt-datatable__cell">
                            <span style="width: 110px;">{{--{{$orden->compras_relacionada}}--}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    {{-- Arranca parte Graficos --}}
        <div class="d-flex justify-content-around">
            {{-- @foreach ($ListaEtapas as $etapa) --}}
            <div class="col-xl-3 col-lg-3 order-lg-2 order-xl-1" style="display: inline-block;padding:0;">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14">
                        <div class="kt-widget14__header d-flex justify-content-center">
                            <h3 class="kt-widget14__title">
                                Profit Share {{-- {{$etapa->nombre}} --}}
                            </h3>
                        </div>
                        <div class="kt-widget14__content d-flex justify-content-center">
                            <div class="kt-widget14__chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class="">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class="">
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget14__stat">
                                    45 {{-- {{$etapa->porcentaje_completo}} --}}
                                </div>
                                <canvas id="kt_chart_profit_share" style="height: 140px; width: 140px; display: block;" width="140" height="140" class="chartjs-render-monitor">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
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

        {{-- @include('OS/comentariosOS') --}}

    </div>
</div>

@endsection
