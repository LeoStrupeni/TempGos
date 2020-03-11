@extends('Layout')

@section('Content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="d-flex justify-content-center">
  <div class="col-8 align-justify-center">
    <div class="kt-portlet kt-portlet--mobile">
        
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Agregar tipo de Encuesta
            </h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
              <div class="kt-portlet__head-actions">
                
              </div>
            </div>
          </div>
        </div>

        <form class="kt-form kt-form--label-right" style="margin-bottom: 0 !important;" action="/agregarEncuesta/generarencuesta" method="Post">
          @csrf
          <div class="kt-portlet__body">
            <div class="form-group row border-bottom" style="margin-bottom: 0 !important;">
                <div class="col-3 mb-3">  
                    <label >Compañía</label>                         
                    <select class="form-control kt-selectpicker" data-live-search="true" data-size="5" title="Selecionar" data-col-index="2" name="Aseguradora">
                    <option value=""></option>  
                        @foreach($listaAseguradora as $aseg)              
                        <option value="{{$aseg->gos_aseguradora_id}}">{{$aseg->empresa}}</option>
                        @endforeach             
                    </select>
                </div>
                <div class="col-4 mb-3">                           
                    <label >Nombre de encuesta</label>
                    <input type="text" class="form-control" id="nombre_encuesta" name="nombre_encuesta" value="" >
                </div>    
                <div class="col-4 mb-3">                           
                    <label >Descripción</label>
                    <input type="text" class="form-control" id="descripcion_encuesta" name="descripcion_encuesta" value="" >
                </div>    
            </div>
          </div>

          <div class="kt-portlet__body">        
            <div class="container1 d-flex justify-content-center">
                <div class="form-group">      
                  <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                          <label >Selecciona las preguntas deseadas en la encuesta</label>                                
                          <select class="form-control kt-selectpicker" title="Selecciona o ingresa una pregunta"  data-size="6"  id="pregunta" name="pregunta[]">
                          @isset($listaPreguntas)
                          <option value=""></option>
                              @foreach ($listaPreguntas as $pregunta)
                              <option value="{{$pregunta->gos_enc_preguntas_id}},{{$pregunta->pregunta}}" >{{$pregunta->pregunta}}</option>
                              @endforeach                                  
                          @endisset
                          </select>           
                        </div>                          
                        <div class="col-1  col-lg-1 col-sm-1 mb-2 align-self-end">
                            <button type="button" id="btn_Itempreguntas" class="btn btn-success" style="height:35.6px;" onclick="appendpregunta();">
                                <i class="fas fa-plus p-0" style="color: white!important;"></i>
                            </button>
                        </div>
                    </div>                    
                  </div>                  
                  <div class="form-group" id="appendQuestions">                
                  </div>
                </div>
            </div>                
            <div class="row col-12 ">            
                <button type="submit" class="btn btn-success w-100" id="btn_guardar_encuesta">Guardar Encuesta</button>         
            </div>
          </div>
      </form>     
        @csrf
        
    </div>
  </div>
</div>

<!---------------------------------------------------------------Modal----------------------------------------------------------------------------------->


@endsection
@section('ScriptporPagina')
  <script src="../gos/ajax-encuestas.js"></script>
	
@endsection