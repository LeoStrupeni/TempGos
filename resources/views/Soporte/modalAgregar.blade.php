
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ticket</h4>
        <button type="button" class="close" data-dismiss="modal"></button>

      </div>

      <div class="modal-body">
        <form class="" action="/soporte/agregarticket" method="post">
          @csrf
          <div class="input-group">
            <select class="form-control kt-selectpicker" title="Selecciona el modulo " data-size="6" data-live-search="true" id="gos_usuario_perfil_id_ADM" name="modulo">
              <option value="Clientes">Clientes</option>
              <option value="Vehiculos">Vehiculos</option>
              <option value="Presupuestos">Presupuestos</option>
              <option value="Ordenes">Ordenes</option>
              <option value="Facturacion">Facturacion</option>
              <option value="Paquetes">Paquetes</option>
              <option value="Compras">Compras</option>
              <option value="Equipo de Trabajo">Equipo de Trabajo</option>
              <option value="Inventario">Inventario</option>
                <option value="Inventario">Otro</option>


            </select>


          </div>

          <div class="form-group">
            <label for="usr">Nombre:</label>
            <input type="text" class="form-control"  name="nombre">
          </div>

          <div class="form-group">
            <label for="comment">Descripcion:</label>
            <textarea class="form-control" rows="5" name="desc"></textarea>
          </div>

          <div class="form-group">
            <label for="comment">Comentario:</label>
            <textarea class="form-control" rows="5" name="com"></textarea>
          </div>

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile01"
              aria-describedby="inputGroupFileAddon01" name="archivo">
              <label class="custom-file-label" for="inputGroupFile01">Selecciona el archivo</label>
            </div>
          </div>

          <button type="submit" class="btn btn-success btn-block mt-2" id="guardarTicket">Guardar</button>
        </form>
      </div>

    </div>

  </div>
</div>
