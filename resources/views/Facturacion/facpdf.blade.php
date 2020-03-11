<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Facturación</title>
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
			<div class="col-5  ">
				<ul class="pl-1 border list-unstyled text-left " style="border-radius: 10px;">
					<li style="font-size: 1em;"><span style="font-weight:bold">No. Factura: </span>#{{$factura->folio}} </li>				
					<li style="font-size: 1em;"><span style="font-weight:bold">Folio Fiscal: </span>{{$facturatimbrado[0]->UUID}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold">Certificado del emisor: </span>  {{$facturatimbrado[0]->certCFDI}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold">Fecha y Hora de Emisión: </span>{{$factura->fecha}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold">Fecha y Hora de Certificación: </span>{{$facturatimbrado[0]->fecha}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold">Certificado del SAT: </span>{{$facturatimbrado[0]->certCFDI}}</li>					
				</ul>				
			</div>
			<div class="col-2 mb-3 text-center">
				<img src="{{$logo ??''}}" alt="logo" style="max-width:100px;">
			</div>
			<div class="col-5 ">
				<ul class=" border list-unstyled text-left  pl-1" style="border-radius: 10px;">
					
					<li style="font-size: 1em;"><span style="font-weight:bold;"><i class="fas fa-industry pr-2"></i> {{$tallerfac->razon_social ??''}} </span>  </li>
					
					<li style="font-size: 1em;"><span style="font-weight:bold;"><i class="fas fa-phone-alt pr-2"></i>  Teléfono: </span> {{$listataller->taller_tel_principal ??''}}<span class="pl-2" style="font-weight:bold">RFC:</span> {{$tallerfac->rfc ??''}} </li>
					<li style="font-size: 1em;"><i class="fas fa-traffic-light pr-2"></i>  {{$tallerfac->dir_fiscal_direccion ??''}} <?php if($tallerfac->dir_fiscal_nro_ext != 0 ):?>#{{$tallerfac->dir_fiscal_nro_ext ??''}}  <?php endif;?> 
					<?php if($tallerfac->dir_fiscal_nro_int != 0 ):?>int: {{$tallerfac->dir_fiscal_nro_int ??''}}  <?php endif;?>
					col: {{$tallerfac->dir_fiscal_colonia ??''}} CP: {{$tallerfac->dir_fiscal_cod_postal ??''}} </li>
					<li style="font-size: 1em;"><span style="font-weight:bold;"><i class="fas fa-user pr-2"></i> Regimen Fiscal: </span>  {{$tallerfac->regimen_fiscal ??''}} Persona {{$tallerfac->tipo_persona ??''}}</li>
					<li style="font-size: 1em;"><span style="font-weight:bold;">Lugar de Expedición: </span>  {{$tallerfac->dir_fiscal_municipio ??''}},{{$tallerfac->nomb_ciudad ??''}},{{$tallerfac->nomb_estado ??''}} </li>		<br>	
				</ul>
			</div>
			
		</div>
		<!--begin::Section-->
			<div class="table-responsive p-2 pt-1  border" style="border-radius: 10px;">
                <table class="table table-bordered ">
                   
                    <tbody >
                        <tr >
						
						<!-- <input type="text" value="{{$asegfac->habilita_facturacion_cliente}}"> -->
						<?php if ($asegfac->habilita_facturacion_cliente==1	): ?>  
							<td  colspan="4" class="p-0 text-left" style="font-size: 1em; border:none;">
								<i class="fas fa-industry pr-2"></i><strong> Razón Social: </strong>{{$clientefac->razon_social ??''}}  &nbsp;&nbsp;&nbsp; <strong>RFC: </strong>{{$clientefac->rfc ??''}} <br>								
								<i class="fas fa-traffic-light pr-2"></i><strong>Dirección: </strong>
								{{$clientefac->calle_nro_fac ??''}} <?php if($clientefac->nro_exterior_fac != null ):?>#{{$clientefac->nro_exterior_fac ??''}}  <?php endif;?> 
								<?php if($clientefac->nro_interior_fac != null ):?>int: {{$clientefac->nro_interior_fac ??''}}  <?php endif;?> &nbsp;&nbsp;&nbsp;
								<strong>Col: </strong> {{$clientefac->cliente_fac_localidad ??''}} <br> <strong>CP:</strong> {{$clientefac->cp_fac ??''}}. {{--$clientefac->cliente_fac_municipio ??''--}} {{$clientefac->nomb_ciudad ??''}}, {{$clientefac->nomb_estado ??''}} <br> 
								<strong>Unidad: </strong>{{$oss->marca_vehiculo ??''}}, {{$oss->modelo_vehiculo ??''}}, {{$oss->anio_vehiculo ??''}} <br>							
							<strong>Color: </strong>{{$oss->nomb_color ??''}}  &nbsp;&nbsp;&nbsp; 
							</td>
						<?php else: ?>
							<td  colspan="4" class="p-0 text-left" style="font-size: 1em; border:none;">
								<i class="fas fa-industry pr-2"></i><strong>Razón Social: </strong>{{$asegfac->razon_social ??''}} &nbsp;&nbsp;&nbsp; <strong>RFC: </strong>{{$asegfac->rfc ??''}} <br>								
								<i class="fas fa-traffic-light pr-2"></i><strong>Dirección: </strong>
								{{$asegfac->calle_nro_fac ??''}} <?php if($asegfac->nro_exterior_fac != null ):?>#{{$asegfac->nro_exterior_fac ??''}}  <?php endif;?> 
								<?php if($asegfac->nro_interior_fac != null ):?>int: {{$asegfac->nro_interior_fac ??''}}  <?php endif;?>&nbsp;&nbsp;&nbsp;
								<strong>Col: </strong>{{$asegfac->ase_fac_localidad ??''}} <br> <strong>CP:</strong> {{$asegfac->cp_fac ??''}}. {{--$asegfac->ase_fac_municipio ??''--}} {{$asegfac->nomb_ciudad ??''}}, {{$asegfac->nomb_estado ??''}} <br>
								<strong>Unidad: </strong>{{$oss->marca_vehiculo ??''}}, {{$oss->modelo_vehiculo ??''}}, {{$oss->anio_vehiculo ??''}} <br>							
								<strong>Color: </strong>{{$oss->nomb_color ??''}}  &nbsp;&nbsp;&nbsp; 
							</td>
						<?php endif; ?>
                           
                            <td colspan="4" class="p-0 text-left" style="font-size: 1em; border:none;">
							<strong>Número de Orden: {{$numorden->nro_orden_interno ??''}}</strong><br>
							
							<strong># de Placa: </strong>{{$oss->placa ??''}}  &nbsp;&nbsp;&nbsp;
							<strong>Kilometraje: </strong>{{$oss->kilometraje ?? '0'}} <br>						
							<strong># de Serie: </strong>{{$oss->nro_serie ??''}}  &nbsp;&nbsp;&nbsp; 
							<strong>Aseguradora:</strong> {{$oss->empresa ??''}} <br>
							
							<strong>Póliza:</strong> {{$oss->nro_poliza ??''}}  &nbsp;&nbsp;&nbsp;
							<strong>Siniestro:</strong> {{$oss->nro_siniestro ??''}} <br>
							<strong>Daño:</strong> {{$oss->tipo_danio ??''}}  &nbsp;&nbsp;&nbsp;
							<strong>Estatus:</strong> {{$oss->estado_expediente ??''}} &nbsp;&nbsp;&nbsp;
							<strong>Reporte:</strong>{{$oss->nro_reporte ??''}}
							</td>
                            
                            
                        </tr>
                       
                    </tbody>
                </table>
            </div>
			<div class="col-12 ">
				<div class="table-responsive pt-2">
					<table class="table table-bordered">
						<thead class="thead-light">
							<tr class="text-center" >
								<th class="p-0" style="border:none; width: 40%;">Concepto</th>
								<th class="p-0" style="border:none;">CveProdServ</th>
								<th class="p-0" style="border:none;">Cantidad</th>
								<th class="p-0" style="border:none;">Unidad</th>							
								<th class="p-0" style="border:none;">Precio</th>
								<th class="p-0" style="border:none;">Descuento</th>
								<th class="p-0" style="border:none;">Importe</th>
							</tr>
						</thead>
						<tbody>
						<?php $subtotal =0?>
						@foreach($facturaitem as $item)
							<tr style="">
								<td class="p-0" style="text-align: center; border:none;">{{$item->descripcion}}</td>
								<td class="p-0" style="text-align: center; border:none;">{{$item->clave_prod_serv}}</td>
								<?php $cantidad = ($item->cantidad != 0) ? $item->cantidad: 1;  $cantidad = number_format($cantidad, 0); ?>
								<td class="p-0" style="text-align: center; border:none;">{{$cantidad}}</td>
								<td class="p-0" style="text-align: center; border:none;">{{$item->clave_unidad_medida}}</td>
								<?php $desc= $item->descuento;  $descuento = number_format($desc, 2);
								$imp= $item->importe/$cantidad;  $importe = number_format($imp, 2);
								$desc= $item->descuento;  $descuento = number_format($desc, 2);?>											
								<td class="p-0" style="text-align: center; border:none;">${{$importe}}</td>
								<td class="p-0" style="text-align: center; border:none;">${{$descuento}}</td>
								<td class="p-0" style="text-align: center; border:none;">${{$item->importe - $item->descuento}}</td>
							</tr>
							<?php $subtotal += $item->importe- $item->descuento; ?>
						@endforeach
						</tbody>
					</table>
				</div>					
			</div>
			<div class="row d-flex justify-content-start">
				<div class="col-8">
					<span style="font-size: 1em;"><strong>Uso de CFDI:</strong> {{$factura->uso_cfdi}}</span><br>	
					<span style="font-size: 1em;"><strong>Forma de Pago:</strong> {{$factura->forma_pago}}</span><br>
					<span style="font-size: 1em;"><strong>Método de Pago:</strong> {{$factura->metodo_pago}}</span><br>
					<span style="font-size: 1em;"><strong>Cuenta de Pago:</strong> {{$factura->totalLetra}}</span><br>
					<span style="font-size: 1em;"><strong>Importe con letra </strong> *** {{$facturatimbrado[0]->totalLetra}} *** </span>	
				</div>
				
				<div class="col-3 pt-2 border" style="border-radius: 10px; margin-left:50px;">
					<table class="table" >			
						<tbody>							
						
							<tr class="text-center">
							<td class="p-0" class="" style="font-size: 1em; border:none;"><span style="font-weight:bold;">Subtotal: </span></td>
								<td class="p-0" style="font-size: 1em; border:none;">${{$subtotal}}</td>
							</tr>
							<tr class="text-center" style="text-align: center;">
							<td class="p-0" class="" style="font-size: 1em; border:none;"><span style="font-weight:bold;">IVA: </span></td>
								<td class="p-0" style="font-size: 1em; border:none;">16% </td>
							</tr>
							<tr class="text-center">
							<td class="p-0" class="" style="font-size: 1em; border:none;"><span style="font-weight:bold;">Impuesto Transladado: </span></td>
								<td class="p-0" style="font-size: 1em; border:none;">${{$factura->total_impuesto}} </td>
							</tr>
							<tr class="text-center">
							<td class="p-0" class="" style="font-size: 1em; border:none;"><span style="font-weight:bold;">Total:</span></td>
								<td class="p-0" style="font-size: 1em; border:none;">${{$factura->total}}</td>
							</tr>
							
						</tbody>
					</table>
				</div>
				

			</div>
			<div>
			
			</div>
		<div class="row mt-3" style="">
		<div class="col-2"  >
			<img src="{{$qrGenerado ??''}}" width="150" height="150" >
			</div>
			<div class="col-10 mt-3 " >
				<div  class="card container" style="border:none;">
					<p style="font-size:.61em;">				
						<span style="font-weight:bold">Sello Digital </span>					
						{{$facturatimbrado[0]->sello}}<br>
						<span style="font-weight:bold">Sello Digital del SAT </span>
						{{$facturatimbrado[0]->selloSAT}}<br>
						<span style="font-weight:bold">Cadena Original del Complemento de Certificación Digital del SAT </span>
						{{$facturatimbrado[0]->cadena}} <br>
						<span style="font-weight:bold">Este documento es una representación impresa de un comprobante fiscal digital.</span>
					</p>			
									
				</div>
			</div>
			
		</div>
	


	</div>
</body>
</html>
