<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Nota de Remisión</title>
		<link rel="stylesheet" href="{{$css}}">
		<link rel="stylesheet" href="{{$css1}}">
		<link rel="stylesheet" href="{{$css2}}">
		<link rel="stylesheet" href="{{$css3}}">
		<link rel="stylesheet" href="{{$css4}}">
		<link rel="stylesheet" href="{{$css5}}">

	</head>
	<body>
	<div style="background-color: white; color: black;margin: auto; font-size: 12px" class="container-fluid">
		<div style="" class="row">
			<div class="col-5">
				<ul class="pl-1 border list-unstyled text-left" style="border-radius: 10px;">
					<li style="font-size: 1em;"><span style="font-weight:bold">Datos de Nota de Remisión </span></li>
					<li style="font-size: 1em;"><span style="font-weight:bold">No. Remisión: </span>N - {{$notaRemision->gos_nota_remision_id}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold">Fecha y hora de emisión: </span>{{$notaRemision->fecha_nota}}</li><br>

				</ul>
			</div>
			<div class="col-2">
				<!-- <img src="{{$logo ??''}}" alt="logo" style="max-width:100px;"> -->
			</div>
			<div class="col-5">
				<ul class="pl-1 border list-unstyled text-left" style="border-radius: 10px;">
					<li style="font-size: 1em;"><span style="font-weight:bold">Datos del Cliente </span></li>
					<li style="font-size: 1em;"><span style="font-weight:bold;">Nombre: </span>{{$oss->nombre ??''}} {{$oss->apellidos ??''}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold;">Teléfono: </span> {{$oss->celular ??''}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold;"><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?>: </span>{{$os[0]->empresa}}</li>
				</ul>
			</div>
		</div>
		<!--begin::Section-->
		<div class="pt-3">
			<div class="border" style="border-radius: 10px;">
				<table class="table"  >
					<thead>
						<tr class="text-center">
							<th colspan="8" class="p-0" style="font-size: 1em; border:none;"><strong>Número de Orden: #{{$numorden->nro_orden_interno ??''}}</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr class="text-center">
							<td class="p-0" style="font-size: 1em; border:none;"><strong><?php if ($taller_conf_vehiculo->nomb_marca!=null): ?>{{$taller_conf_vehiculo->nomb_marca ??''}}<?php else: ?>Marca<?php endif; ?>: </strong> {{$oss->marca_vehiculo ??''}}</td>
							<td class="p-0" style="font-size: 1em; border:none;"><strong><?php if ($taller_conf_vehiculo->nomb_anio!=null): ?>{{$taller_conf_vehiculo->nomb_anio ??''}}<?php else: ?>Año<?php endif; ?>: </strong> {{$oss->anio_vehiculo ??''}} </td>
							<td class="p-0" style="font-size: 1em; border:none;"><strong><?php if ($taller_conf_vehiculo->nomb_color!=null): ?>{{$taller_conf_vehiculo->nomb_color ??''}}<?php else: ?>Color<?php endif; ?>: </strong> {{$oss->nomb_color ??''}}</td>
							<td class="p-0" style="font-size: 1em; border:none;"><strong># de <?php if ($taller_conf_vehiculo->nomb_placa!=null): ?>{{$taller_conf_vehiculo->nomb_placa ??''}}<?php else: ?>Placa<?php endif; ?>: </strong> {{$oss->placa ??''}}</td>
							<td class="p-0" style="font-size: 1em; border:none;"><strong><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?>:</strong> {{$oss->empresa ??''}}</td>
							<td class="p-0" style="font-size: 1em; border:none;"><strong>Reporte: </strong> {{$oss->nro_reporte ??''}}</td>

							<td class="p-0" colspan="2" style="font-size: 1em; border:none;"><strong>Siniestro:</strong> {{$oss->nro_siniestro ??''}}</td>



						</tr>
						<tr class="text-center">
							<td colspan="1" class="p-0" style="font-size: 1em; border:none;"><strong><?php if ($taller_conf_vehiculo->nomb_modelo!=null): ?>{{$taller_conf_vehiculo->nomb_modelo ??''}}<?php else: ?>Modelo<?php endif; ?>:</strong> {{$oss->modelo_vehiculo ??''}}</td>
							<td colspan="2" class="p-0" style="font-size: 1em; border:none;"><strong># de Serie: </strong> {{$oss->nro_serie ??''}}</td>
							<td colspan="1" class="p-0" style="font-size: 1em; border:none;"><strong>Kilometraje: </strong> {{$oss->kilometraje ?? '0'}}</td>
							<td colspan="1" class="p-0" style="font-size: 1em; border:none;"><strong>Póliza:</strong> {{$oss->nro_poliza ??''}}</td>
							<td colspan="2" class="p-0" style="font-size: 1em; border:none;"><strong>Estatus:</strong> {{$oss->estado_expediente ??''}}</td>
							<td colspan="1" class="p-0" style="font-size: 1em; border:none;"><strong>Daño:</strong> {{$oss->tipo_danio ??''}}</td>


						</tr>


					</tbody>
				</table>
			</div>
		</div>
		<!-----------------------------------------------------------------DESGLOSE--------------------------------------------------------------------------------------------------->
		
		<div class="col-9">
			<div class="table-responsive pt-2">
				<table class="table table-bordered">
					<thead  class="thead-light">
						<tr class="text-center" >
							<th class="p-0" style="border:none;">Concepto</th>
							<th class="p-0" style="border:none;">Tipo</th>
							<th class="p-0" style="border:none;">Cantidad</th>
							<th class="p-0" style="border:none;">Descuento</th>
							<th class="p-0" style="border:none;">Precio</th>
							<th class="p-0" style="border:none;">Total</th>
							<th class="p-0" colspan="4" style="border:none;"></th>
						</tr>
					</thead>
					<tbody>
					<?php $subtotal =0; $subtotalser =0; $subtotalprod =0;?>
					@foreach($notaRemisionItem as $item)
					<?php if ($item->precio!=0): ?>
						<tr style="">
							<td class="p-0" style="text-align: center; border:none;">{{$item->concepto}}</td>
							<td class="p-0" style="text-align: center; border:none;"><?php if ($item->tipo==0): ?>Servicio<?php else: ?>Producto<?php endif; ?></td>
							<?php $cantidad = ($item->cantidad != 0) ? $item->cantidad: 1; ?>
							<td class="p-0" style="text-align: center; border:none;">{{$cantidad}}</td>
							<td class="p-0" style="text-align: center; border:none;">{{$item->descuento}}</td>
							<?php $precioprod = $item->precio*1.16;?>
							<td class="p-0" style="text-align: center; border:none;"><?php if ($item->tipo==0): ?>{{$item->precio}}<?php else: ?>{{$precioprod}}<?php endif; ?></td>
							<td class="p-0" style="text-align: center; border:none;"><?php if ($item->tipo==0): ?>{{$item->precio*$cantidad - $item->descuento}}<?php else: ?>{{$precioprod*$cantidad - $item->descuento}}<?php endif; ?></td>
							<td class="p-0" colspan="4" style="text-align: center; border:none;"></td>
						</tr>	
							<?php $subtotal += $item->precio*$cantidad - $item->descuento;?>				
							<?php if ($item->tipo==0): ?>
							<?php $subtotalser += $item->precio*$cantidad - $item->descuento;?>
							<?php endif; ?>
							<?php if ($item->tipo==1): ?>
							<?php $subtotalprod += $precioprod*$cantidad - $item->descuento;?>
							<?php endif; ?>				
					<?php endif; ?>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<?php 
			$totr= $subtotalprod*.16 + $subtotalprod;  $totrefa = number_format($totr, 2);
			$imp= $subtotalprod*.16 + $subtotalprod + $subtotalser;  $importe = number_format($imp, 2);
			$tot= $subtotalser + ($subtotalprod*.16 + $subtotalprod) - $notaRemision->abono;  $total = number_format($tot, 2);
		
		?>
		<div class="d-flex justify-content-end">
			<div class="col-3 pt-2 " style="border-radius: 10px;">
				<table class="table" >
					<tbody>
					<?php if ($notaRemision->desglose!=null): ?>
						<tr>
							<td colspan="1" class="p-0 text-right"  style="font-size: 1em; border:none; width:1rem;"><span style="font-weight:bold;">Mano de Obra:</span> </td>
							<td colspan="1" class="p-0 text-center"  style="font-size: 1em; border:none; width:.5rem;">{{$subtotalser ?? ''}}</td>
						</tr>
						<tr>
							<td colspan="1" class="p-0 text-right"  style="font-size: 1em; border:none; width:1rem;"><span style="font-weight:bold;">Refacciones:</span> </td>
							<td colspan="1" class="p-0 text-center"  style="font-size: 1em; border:none; width:.5rem;">{{$totrefa}}</td>
						</tr>
						<?php endif; ?>
						<tr>
							<td colspan="1" class="p-0 text-right"  style="font-size: 1em; border:none; width:1rem;"><span style="font-weight:bold;">Importe:</span> </td>
							<td colspan="1" class="p-0 text-center"  style="font-size: 1em; border:none;">{{$importe}} </td>
						</tr>
						<tr>
							<td colspan="1" class="p-0 text-right"  style="font-size: 1em; border:none; width:1rem;"><span style="font-weight:bold;">Abono:</span> </td>
							<td colspan="1" class="p-0 text-center"  style="font-size: 1em; border:none; width:.5rem;">{{$notaRemision->abono}} </td>
						</tr>
						<tr>
							<td colspan="1" class="p-0 text-right"  style="font-size: 1em; border:none; width:1rem;"><span style="font-weight:bold;">Total:</span>  </td>
							<td colspan="1" class="p-0 text-center"  style="font-size: 1em; border:none; width:.5rem;">{{$total}} </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		
	<!-----------------------------------------------------------------SIN DESGLOSE--------------------------------------------------------------------------------------------------->
		
		<!-- <div class="col-10">
			<div class="table-responsive pt-2">
				<table class="table table-bordered">
					<thead  class="thead-light">
						<tr class="text-center" >
							<th class="p-0" style="border:none;">Concepto</th>
							<th class="p-0" style="border:none;">Cantidad</th>
							<th class="p-0" style="border:none;">Descuento</th>
							<th class="p-0" style="border:none;">Precio</th>
							<th class="p-0" style="border:none;">Total</th>
							<th class="p-0" colspan="4" style="border:none;"></th>
						</tr>
					</thead>
					<tbody>
					<?php $subtotal =0?>
					@foreach($notaRemisionItem as $item)
					<?php if ($item->precio!=0): ?>
						<tr style="">
							<td class="p-0" style="text-align: center; border:none;">{{$item->concepto}}</td>
							<?php $cantidad = ($item->cantidad != 0) ? $item->cantidad: 1; ?>
							<td class="p-0" style="text-align: center; border:none;">{{$cantidad}}</td>
							<td class="p-0" style="text-align: center; border:none;">{{$item->descuento}}</td>
							<td class="p-0" style="text-align: center; border:none;">{{$item->precio}}</td>
							<td class="p-0" style="text-align: center; border:none;">{{$item->precio*$cantidad - $item->descuento}}</td>
							<td class="p-0" colspan="4" style="text-align: center; border:none;"></td>
						</tr>
						<?php $subtotal += $item->precio*$cantidad - $item->descuento; ?>
					<?php endif; ?>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="d-flex justify-content-end">
			<div class="col-2 pt-2 border" style="border-radius: 10px;">
				<table class="table" >
					<tbody>
						<tr>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:2rem;"><span style="font-weight:bold;">Importe:</span></td>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:.5rem;">{{$subtotal}}</td>
						</tr>
						<tr>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:2rem;"><span style="font-weight:bold;">Abono:</span></td>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:.5rem;">{{$notaRemision->abono}} </td>
						</tr>
						<tr>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:2rem;"><span style="font-weight:bold;">Subtotal:</span></td>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:.5rem;">{{$subtotal - $notaRemision->abono}} </td>
						</tr>
						<tr>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:2rem;"><span style="font-weight:bold;">Total:</span></td>
							<td class="p-0 text-left"  style="font-size: 1em; border:none; width:.5rem;">{{$subtotal - $notaRemision->abono*0.16}} </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div> -->
	<!-----------------------------------------------------------------SIN DESGLOSE--------------------------------------------------------------------------------------------------->

		<!--end::Section-->
		<div class="row" style="margin-top: 10rem;">
			<div class="col-sm-12">
				<div style="border-style: hidden;" class="card">
					<!--begin::Section-->



					<!--end::Section-->
					<div style="margin-left:65%;width:10%" class="col-4">

					</div>

				</div>
			</div>
		</div>
		<!--end::Section-->
	</div>
</body>
</html>
