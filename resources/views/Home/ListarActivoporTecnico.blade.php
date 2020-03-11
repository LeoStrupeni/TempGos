<!-- Modal -->
<div class="modal fade" id="serv_tecnico" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <div class="modal-title">
               <h4 class="" id="exampleModalLongTitle">Tecnico:</h4><small class="" id="labeltecnicoser"></small>
              </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
              <div class="kt-portlet kt-portlet--mobile">
              	<div class="kt-portlet__head kt-portlet__head--lg">
              		<div class="kt-portlet__head-label">
              			<h3 class="kt-portlet__head-title">Órdenes asignadas y activas</h3>
              		</div>
              		<div class="kt-portlet__head-toolbar">
              			<div class="kt-portlet__head-wrapper">
              				<div class="kt-portlet__head-actions">
              				</div>
              			</div>
              		</div>
              	</div>
              	<div class="kt-portlet__body">
              		<div class="table-responsive">
              			<!--begin: Datatable -->
              			<table class="table table-sm table-hover" id="ordenesActivasPorTecnico">
              				<thead class="thead-light">
              					<tr>
								  	<th>ID</th>
              						<th>Orden</th>
									<th>Fecha</th>
									<!-- <th>Días</th> -->
									<th>Cliente</th>
									<!-- <th>Aseguradora</th> -->
									<th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></th>
									<th>Tiempo</th>
									<th>Técnico</th>
									<!-- <th>Total</th> -->
									<th>Avance</th>
									<th style="width: 3%;"></th>
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
<!-- Fin Modal -->
