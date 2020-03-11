@extends('Layout')

@section('Content')

    <form class="" action="" method="patch">
      @csrf
    <div style="background:white;padding:15px;margin:0 auto" class="container">
    <div class="encabezado">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div id="nav-marcas" class="">
          <a class="navbar-brand mr-5 mb-3" href="{{'Usuarios/agregar'}}">Equipo de trabajo</a>
        </div>
          <a  href="{{ url('CLientes/agregarCliente') }}"> <button class="btn btn-primary mr-5 ml-5 " type="button" name="button" >Agregar Empleado</button> </a>
        <div id="nav-marcas" class="collapse navbar-collapse " id="navbarSupportedContent">
          <label for="busqueda">Búsqueda</label>
          <input type="text" name="" value="">
          <label for="busqueda">Filtro</label>
          <input type="text" name="" value="">
        </div>
    </nav>
    </div>
    <table class="table table-striped" >
        <thead class="thead-white">
          <tr>
           <th scope="col">Fecha</th>
           <th scope="col">Nombre</th>
           <th scope="col">Número de empleado</th>
           <th scope="col">Número de seguro social</th>
           <th scope="col">Puesto</th>
           <th scope="col">Email</th>
           <th scope="col"></th>
          </tr>
        </thead>
        <div class="progress" style="height: 5px;">
          <div class="progress-bar" role="progressbar" style="width:100%;background-color:turquoise" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <tbody>
        <tr>
          <td>muestra</td>
          <td>muestra</td>
          <td>muestra</td>
          <td>muestra</td>
          <td>muestra</td>
          <td>muestra</td>
          <td class="text-center">
              <a class="" href="">
                <i class='fa fa-pencil-alt' aria-hidden='true'></i>
              </a>
              <form action="" method="POST"
                class="form-usuarios">
                @csrf
                @method('DELETE')
                <a class="" href="">
                  <i class='fa fa-trash-alt' aria-hidden='true'></i>
                </a>
              </form>
            </td>
          {{-- @if ($usuario->count())
          @foreach($usuarios as $usuario)
          <tr>
          <td scope="row">{{ $usuario->created_at}}</td>
          <td scope="row">{{ $usuario->nombre}}<td>
          <td scope="row">{{ $usuario->nro_empleado}}</td>
          <td scope="row">{{ $usuario->nro_seguro_social}}</td>
          <td scope="row">{{ $usuario->puesto}}<td>
          <td scope="row">{{ $usuario->email}}</td>
          <td class="text-center">
              <a class="" href="{{action('UsuariosController@edit',$usuario->gos_usuario_id)}}">
                <i class='fa fa-pencil-alt' aria-hidden='true'></i>
              </a>

              <form action="" method="POST"
                class="form-usuarios">
                @csrf
                @method('DELETE')
                <a class="delete-usuarios">
                  <i class='fa fa-trash-alt' aria-hidden='true'></i>
                </a>
              </form>
            </td>
          </tr>
        @endforeach
        @else
        <tr>
        <td colspan="13">No hay registro!</td>
        </tr>
        @endif
         --}}
        </tbody>
        </table>
        </div>
        <div class="row text-center mx-auto mt-1">
        <div class="col-md-6 offset-5">
        </div>
        </div>

        @endsection
