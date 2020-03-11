@extends('Layout')

@section('Content')
<div class="container-fluid">
  @if (session('notification'))
  <div class="alert alert-success">
    {{session('notification')}}
  </div> @endif

  @if (count($errors)>0)
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($errors->all() as $error): ?>
        <li>
          {{ $error }}
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
@endif

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title kt-font-primary">
        Ticket {{$ticket->id??''}}
      </h3>
    </div>

    <!-- Trigger the modal with a button -->
    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-actions">

      </div>	</div>
    </div>
    <div class="kt-portlet__body p-2">

      <div class="card ">
        <div class="card-header">
          <h6 class="kt-portlet__head-title ">
            Fecha: {{$ticket->created_at??''}}
          </h6>

          <h6 class="kt-portlet__head-title ">
            Modulo: {{$ticket->modulo??''}}
          </h6>
          <h6 class="kt-portlet__head-title ">
            Nombre: {{$ticket->nombre ??''}}
          </h6>
          <h6 class="kt-portlet__head-title ">
            Descripcion: {{$ticket->descripcion??''}}
          </h6>
        </div>
      </div>


    </div>

    <div class="kt-portlet__body p-2">
      <div class="table-responsive ">
        <table class="table table-sm table-hover" id="soporte_table">
          <thead >
            <tr>

              <th>Mensajes</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($messages as $message)
            <tr>
              <td>



                <div class="card ">
                  <div class="card-header">
                    <?php if ($message->gos_usuario_id > 0): ?>
                      <!-- <i class="flaticon2-user kt-font-brand"></i> -->
                    <div class="card-title"> <i class="flaticon2-user kt-font-brand"></i>&nbsp;&nbsp;<font size=4><b>Cliente</b></font>&nbsp;&nbsp;{{$message->gos_usuario_name}}&nbsp;&nbsp; <label for="">{{$message->created_at}}</label> </div>
                    <?php else: ?>
                    <div class="card-title"> <i class="kt-menu__link-icon fas fa-headset kt-font-secondary"></i>&nbsp;&nbsp;<font size=4><b>Soporte</b></font>&nbsp;&nbsp;{{$message->gos_usuario_name}}&nbsp;&nbsp; <label for="">{{$message->created_at}}</label> </div>
                    <?php endif; ?>
                  </div>
                  <div class="card-body">
                      <p class="card-text">{{$message->mensaje}}</p>
                  </div>
                </div>



              </td>

              </tr>
              @endforeach


            </tbody>
          </table>
        </div>
      </div>





      <div class="card ">
        <div class="card-header">

        </div>
        <div class="card-body">
          <h5 class="card-title">Nuevo comentario</h5>

          <form class="" action="/soporte/mensaje/{{$ticket->id??''}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$ticket->id??''}}">
            <div class="form-group">

              <textarea class="form-control" rows="5" name="mensaje"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block mt-2" id="Publicar">Guardar</button>

          </form>
        </div>
      </div>



    </div>



  @include('Soporte/modalAgregar')
  @endsection

  @section('ScriptporPagina')


  @endsection
