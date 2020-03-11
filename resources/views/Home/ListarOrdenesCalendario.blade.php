<!-- Modal -->
<div class="modal fade" id="ordenes-en-proceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ordenes en Proceso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
              <div class="kt-portlet kt-portlet--mobile">
              	<input type="hidden" id="gos_os_id">
              	<div class="kt-portlet__body">
              		<div class="table-responsive">
                      <input type="hidden" id="app_url" name="app_url" url=".."/>
						<div class="table-responsive table-sm p-1" >
							<table class="table table-sm table-hover nowrap" id="dt-ordenes-servicios" style="font-size: 1rem;">
								<thead class="thead-light">
									<tr style="font-weight: 500;">
										<th>ID</th>
										<th>Orden</th>
										<th>Fecha</th>
										<th>Días</th>
										<th>Cliente</th>
										<th>Aseguradora</th>
										<th>Vehículo</th>
										<th>Tiempo</th>
										<th>Asesor</th>
										<th>Etapa</th>
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
