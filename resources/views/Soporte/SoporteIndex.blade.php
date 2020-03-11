@extends('Layout')

@section('Content')
<div class="container-fluid">
											 @if (session('notification'))
											 <div class="alert alert-success">
												{{session('notification')}}
												</div> @endif

												@if (count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							<?php foreach ($errors->all() as $error): ?>
								<li>
									{{ $error }}
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
			 </div>
			 @endif

<div class="kt-portlet">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-primary">
				Tickets
			</h3>
		</div>

		<!-- Trigger the modal with a button -->
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-actions">

		<button class="btn btn-brand btn-elevate btn-icon-sm nuevoUsuarioAdm" style="width:150px;" type="button" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
		</button>
	</div>	</div>
	</div>
	<div class="kt-portlet__body p-2">
    <div class="table-responsive ">
			<table class="table table-sm table-hover datatablaList" id="dt-permisos-equipo-trabajo">
				<thead >
					<tr>
						<th>Id</th>
						<th>Nombre</th>
            <th>Modulo</th>
				


					</tr>
				</thead>
				<tbody>
				@foreach($ticketList as $ticket)
					<tr>
						<td><a href="/soporte/mensaje/{{$ticket->id}}">{{$ticket->id}}</a></td>
						<td>{{$ticket->nombre}}</td>
						<td>{{$ticket->modulo}}</td>

					</tr>
					@endforeach
				</tbody>

			</table>
		</div>
	</div>
</div>


@include('Soporte/modalAgregar')
@endsection

@section('ScriptporPagina')


@endsection
