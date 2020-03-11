<div class="row m-2" >
    <div class="col">
        <form id="presupuesto-form">
            @csrf
            <input type="hidden" id="gos_os_id" name="gos_os_id" value="0">
            <input type="hidden" id="gos_vehiculo_id" name="gos_vehiculo_id">
            <input type="hidden" id="gos_cliente_id" name="gos_cliente_id">
            <div class="row col-lg-12 col-sm-12">

                <div class="col-12 col-md-3 col-lg-3 col-sm-6"  id="clsbuscarcliente">
                    <label >Cliente</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nomb_cliente" name="nomb_cliente" readonly>

                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary p-0"
                             data-toggle="modal" data-target="#modalbuscarcliente">
                                <i class="fas fa-search kt-shape-font-color-1 p-0"></i>
                            </button>
                        </div>

                    </div>
                    <small  id="errorespresupuestoscliente" style="display: none; color:red;">Insertar Cliente</small>
                </div>

                <div class="col-12 col-md-3 col-lg-3 col-sm-6">
                    <label >Vehículo</label>
                    <input type="text" class="form-control" id="detallesVehiculo" name="detallesVehiculo" disabled>
                      <small  id="errorespresupuestosvehi" style="display: none; color:red;">Insertar vehiculo</small>
                </div>
                <div class="col-4 col-md-2 col-lg-2 col-sm-4">
                    <label ># Reporte</label>
                    <input type="text" class="form-control" name="nro_poliza" id="nro_poliza">
                      <small  id="errorespresupuestospol" style="display: none; color:red;">Insertar Reporte</small>

                </div>
                <div class="col-4 col-md-2 col-lg-2 col-sm-4">
                    <label  ># Siniestro</label>
                    <input type="text" class="form-control" name="nro_siniestro" id="nro_siniestro">
                      <small  id="errorespresupuestossin" style="display: none; color:red;">Insertar Siniestro</small>

                </div>
                <div class="col-4 col-md-2 col-lg-2 col-sm-4">
                    <label >Kilometraje</label>
                    <input type="text" class="form-control" name="kilometraje" id="kilometraje" required>
                      <small  id="errorespresupuestoskm" style="display: none; color:red;">Insertar kilometraje</small>
                </div>

        </form>
    </div>
</div>
</div>
