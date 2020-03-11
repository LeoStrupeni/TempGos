<div class="modal fade" id="modalLigarOs" tabindex="-1"
	role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;min-width: 70%;">
		<div class="modal-content">
			<div class="modal-header p-1">
                <h4 class="m-1 pt-2 pl-3">Busqueda de Cliente/Vehiculo</h4>
                <h6 class="pt-3 pl-5" id="nroOsLigadas"></h6>
                <h6 class="pt-3 pl-5" id="nroOs"></h6>
                <input type="hidden" id="nroOsHidden">
                <input type="hidden" id="nroOsInternoHidden">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive table-sm p-1">
                    <table class="table table-sm table-hover nowrap" id="dt-ordenesLigar">
                        <thead class="thead-light">
                            <tr>
                                <th>Orden</th>
                                <th>Cliente</th>
                                <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
                                <th># Económico</th>
                                <th># Serie</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($os as $key => $o)
                            <tr>
                                <td style="text-align:center;vertical-align: middle;">
                                    <a href='/orden-servicio-generada/{{$o->gos_os_id}}'> #{{$o->nro_orden_interno}}</a>
                                </td>
                                <?php $cl=explode("|", $o->nomb_cliente);?>
                                <td style="vertical-align: middle;"> {{$cl[0]}} <br>{{$cl[1]}} <br>{{$cl[2]}}</td>
                                <?php $vhc=explode("|", $o->detallesVehiculo);?>
                                <td style="vertical-align: middle;">
                                    <i class="fas fa-circle" style="background-color:#{{$vhc[0]}}; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i>
                                    {{$vhc[1]}}
                                    <br>
                                    <div class="pl-4"> {{$vhc[2]}} </div>
                                    
                                </td>
                                <?php $eco=substr($vhc[3],12,50)?>
                                <td style="vertical-align: middle;">{{$eco}}</td>
                                <?php $ser=substr($vhc[4],8,50)?>
                                <td style="vertical-align: middle;">{{$ser}}</td>
                                <td>
                                    <a href="javascript:void(0);" data-id="{{$o->gos_os_id.'|'.$o->nro_orden_interno}}" class="btn btn-verde btn-ligar text-nowrap mt-2" id="btn-ligar-{{$o->gos_os_id}}" style="text-align:center;color:white;width:100px;">Ligar orden
									</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>    
			</div>
			<div class="modal-footer">
				<a href="javascript:void(0);" class="btn btn-warning btn-block text-white btn-cerrar-ligar">Guardar</a>
			</div>
		</div>
	</div>
</div>

