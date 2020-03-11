@extends('Layout')

@section('Content')
<section id="usuarios">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ 'Agregar tipo de usuario' }}</div>
                  <div class="card-body">
                 <form method="POST" action="{{ url('agregarRegistro') }}" enctype="multipart/form-data">
                          {{csrf_field()}}
                  <div class="clientesformulario">
                        <div class="form-group">
                        <label for="nombre">Nombre del puesto</label>
                        <input type="text" name="nombre" value="" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="nombre">Descripcion</label>
                        <input type="text" name="nombre" value="" class="form-control">
                      </div>
                  </div>
                  <table class="table table">
                  <div class="tipousuariotabla">
                    <thead>
                      <tr>
                        <th scope="col">Área</th>
                        <th scope="col">Agregar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Ver</th>
                        <th scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Clientes</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">Vehículos</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      </tr>
                      <tr>
                        <th scope="row">Presupuestos</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      <tr>
                        <th scope="row">Órdenes</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      </tr>
                      <tr>
                        <th scope="row">Fechas de promesa</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      </tr>
                      <tr>
                        <th scope="row">Actualizar fecha de servicio</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      </tr>
                      <tr>
                        <th scope="row">Etapas</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      </tr>
                      <tr>
                        <th scope="row">Servicios</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                      </tr>
                      <tr>
                        <th scope="row">Facturas</th>
                        <td><input  type="checkbox" checked="checked">
                        <td><input  type="checkbox" id=""></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                        <td><input  type="checkbox" id="gridCheck1"></td>
                       </tr>
                       <tr>
                         <th scope="row">Paquetes</th>
                         <td><input  type="checkbox" checked="checked">
                         <td><input  type="checkbox" id=""></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                       </tr>
                       <tr>
                         <th scope="row">Compras</th>
                         <td><input  type="checkbox" checked="checked">
                         <td><input  type="checkbox" id=""></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                       </tr>
                       <tr>
                         <th scope="row">Proveedores</th>
                         <td><input  type="checkbox" checked="checked">
                         <td><input  type="checkbox" id=""></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                       </tr>
                       <tr>
                         <th scope="row">Requisiciones</th>
                         <td><input  type="checkbox" checked="checked">
                         <td><input  type="checkbox" id=""></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                         <td><input  type="checkbox" id="gridCheck1"></td>
                       <tr>
                         <tr>
                           <th scope="row">ACeptar histórico</th>
                           <td><input  type="checkbox" checked="checked">
                           <td><input  type="checkbox" id=""></td>
                           <td><input  type="checkbox" id="gridCheck1"></td>
                           <td><input  type="checkbox" id="gridCheck1"></td>
                         </tr>
                         <tr>
                           <th scope="row">Seguimiento de refacciones</th>
                           <td><input  type="checkbox" checked="checked">
                           <td><input  type="checkbox" id=""></td>
                           <td><input  type="checkbox" id="gridCheck1"></td>
                           <td><input  type="checkbox" id="gridCheck1"></td>
                         </tr>
                         <tr>
                           <th scope="row">Fecha promesa</th>
                           <td><input  type="checkbox" checked="checked">
                           <td><input  type="checkbox" id=""></td>
                           <td><input  type="checkbox" id="gridCheck1"></td>
                           <td><input  type="checkbox" id="gridCheck1"></td>
                          </tr>
                          <tr>
                            <th scope="row">Cancelar orden</th>
                            <td><input  type="checkbox" checked="checked">
                            <td><input  type="checkbox" id=""></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                          </tr>
                          <tr>
                            <th scope="row">En proceso</th>
                            <td><input  type="checkbox" checked="checked">
                            <td><input  type="checkbox" id=""></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                          </tr>
                          <tr>
                            <th scope="row">Terminadas</th>
                            <td><input  type="checkbox" checked="checked">
                            <td><input  type="checkbox" id=""></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                          </tr>
                          <tr>
                            <th scope="row">Entregadas</th>
                            <td><input  type="checkbox" checked="checked">
                            <td><input  type="checkbox" id=""></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                            <td><input  type="checkbox" id="gridCheck1"></td>
                          <tr>
                    </tbody>
                   </div>
                  </table>
                    <div class="col-md-12">
                        <button style="height:45px" type="submit" class="btn btn-success col-md-12">Guardar</button>
                    </div>
                      </form>
                    </div>
                  </div>
                  </div>
               </div>
            </div>
    </section>
@endsection
