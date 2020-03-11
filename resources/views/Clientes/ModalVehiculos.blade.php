

<div class="modal fade" id="modal-vehiculos-clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ordenes en Proceso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="kt-portlet kt-portlet--mobile">
                <input type="hidden" name="gos_cliente_vehiculo_id" id="gos_cliente_vehiculo_id" >
                    <div class="kt-portlet__body">
                        <div class="table-responsive">
                        <input type="hidden" id="app_url" name="app_url" url=".."/>
                            <div class="table-responsive table-sm p-1" >
                            <table class="table   table-sm table-hover " id="vehiculos-DataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Cliente</th>
                                        <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculos<?php endif; ?></th>
                                        <th># de Serie</th>
                                        <th class="text-center" style="width:3%;"></th>
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