$(document).ready(function() {
    
    var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});	   

    var wrapper = $(".container1");
    var add_button = $(".add_form_field");
    var X=10;
    var x = 1;
   
    function show(){        
        var elem = document.getElementById('sel'+x+'');
        elem.style.display = 'flex';        
        // console.log(x);    
    }
    function hide(){
        var elem = document.getElementById('sel1');
        elem.style.display = 'none';
    }
    $(add_button).click(function(e) {
        e.preventDefault();   
        if (x < X) {
            show();
            x++;
        
            
        }
        else {
            $(add_button).hide();
            
            alert('Has llegado al limite de preguntas')
            
        }           
        x=x++;
    }); 

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        // console.log(x);
        x=x;
        X1=X++;
        // console.log(X1);
    })
    X=X;   

    var selector = '.vertical-menu a';
    $(selector).on('click', function(){
        $(selector).removeClass('active');
        $(this).addClass('active');
    });
    //------------------------------------agregar repuesta y pregunta-------------------------------------
    



    //-------------------------------------editar pregunta-------------------------------------
    $('body').on('click', '#editar-pregunta', function () {
        var id = $(this).data('id');
        // console.log(id);
        $.get(app_url+'/gestion-preguntas/' + id +'/edit', function (data) {
            // console.log();
            var lengthrespuesta = data['respuestas'].length;
           // console.log(lengthrespuesta)
            $('#ModalEditarpregunta').modal('show');
            $('#gos_enc_preguntas_id').val(data['PreguntaUnica'].gos_enc_preguntas_id);
            $('#pregunta_editar').val(data['PreguntaUnica'].pregunta);
            $('#pregunta_editar').change();

            var max_fields      = 10; //maximum input boxes allowed
            var wrap  = $("#opciones-respuestas"); //Fields wrap
            var add_button_editar = $(".add_field_button"); //Add button ID

            for( i=0; i< lengthrespuesta; i++){
                var respuesta = data['respuestas'][i].tipo_respuestas;
                var gos_encuesta_respuestas_id = data['respuestas'][i].gos_encuesta_respuestas_id;
            //    console.log( data['respuestas']);
                $(wrap).append('<div class="form-group row " style="margin-left:0px"><div class="col-10"><input class="form-control" type="hidden" placeholder="Opción" name="respuestaid'+gos_encuesta_respuestas_id+'[]" id="" value="'+gos_encuesta_respuestas_id+'"><input class="form-control" type="text" placeholder="Opción" disabled name="respuestaid'+gos_encuesta_respuestas_id+'[]" id="" value="'+respuesta+'">'); 
 
            }
            // console.log(i)
            var x = i; //initlal text box count
            $(add_button_editar).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrap).append('<div class="form-group row" style="margin-left:0px"><div class="col-10"><input class="form-control" type="text" placeholder="Opción" name="respuesta[]" id="" disabled value=""/>'); //add input box
                }
            });
            
            $(wrap).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })         
         
        });        
    
    });
    //-------------------------------------actualizar pregunta-------------------------------------
    //-------------------------------------Borrar encuesta -------------------------------------
    $('body').on('click', '#btnborrar-encuesta', function () {
        var id = $(this).data('id');
        // console.log(id);
        if (confirm('¿Esta seguro que desea borrar esta encuesta? Se eliminara definitivamente')) {
			$.ajax({
				type : 'get',
				url : app_url+'/gestion-encuesta/'+ id +'/borrar',
				success : function(data) {
					console.log(data);
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
    });
    //-----------------------------------------------------------------------------------------------------
    //-------------------------------------Borrar encuesta -------------------------------------
    $('body').on('click', '#btnborrar-preguntas', function () {
        var id = $(this).data('id');
        // console.log(id);
        if (confirm('¿Esta seguro que desea borrar esta pregunta? Se eliminara definitivamente')) {
			$.ajax({
				type : 'get',
				url : app_url+'/gestion-preguntas/'+ id +'/borrar',
				success : function(data) {
					console.log(data);
					window.location.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
    });
    //----------------------------------------------------------------------------------------------------
    //-------------------------------------EDIT encuesta -------------------------------------
    $('body').on('click', '#btnborrarpreguntaenc', function () {
         var idpreg = $(this).data('id');
        alert(idpreg);
        $("#preguntadiv"+idpreg).remove();
        // // console.log(id);
        // if (confirm('¿Esta seguro que desea borrar esta pregunta? Se eliminara definitivamente')) {
		// 	$.ajax({
		// 		type : 'get',
		// 		url : app_url+'/gestion-preguntas/'+ id +'/borrar',
		// 		success : function(data) {
		// 			console.log(data);
		// 			window.location.reload();
		// 		},
		// 		error : function(data) {
		// 			console.log('Error:', data);
		// 		}
		// 	});
		// }
    });

});
function appendpreguntaedit(){
    var select=document.getElementById("pregunta");

    var value=select.value;
    console.log(value);
    if(value!==""){
    var res = value.split(',');
    var insert=res[1];
    var insertid=res[0];
        console.log(res);
    var val=insertid;
    var text=insert;
        NumeroPregunta=NumeroPregunta+1;
    $('#appendQuestions').append(' <div class="d-flex justify-content-center" id="preguntadiv'+val+'">'+
    '<input type="hidden" name="appendQuestions[]" value="'+val+'"><label class="form-control" style="border: solid;width: auto;" >'+text+'</label>'+
    '<a id="btnborrarpreguntaenc" data-id="'+val+'" class="ml-3" href="javascript:void(0);">'+
        '<i class="far fa-2x fa-times-circle text-danger"></i>'+
    '</a>'+
    '</div>');

    $("#pregunta option:selected").remove();
    $('#pregunta').selectpicker('refresh');
    // alert("Selected country removed.");
    }   
    else{""}    
    
}

 
  var NumeroPregunta=0;
function appendpregunta(){
    var select=document.getElementById("pregunta");

    var value=select.value;
    console.log(value);
    if(value!==""){
    var res = value.split(',');
    var insert=res[1];
    var insertid=res[0];
        console.log(res);
    var val=insertid;
    var text=insert;
        NumeroPregunta=NumeroPregunta+1;
    $('#appendQuestions').append(' <div class="d-flex justify-content-center" "><input type="hidden" name="appendQuestions[]" value="'+val+'"><label class="form-control" style="border: solid;width: auto;" >'+NumeroPregunta+'.- '+text+'</label></div>');

    $("#pregunta option:selected").remove();
    $('#pregunta').selectpicker('refresh');
    // alert("Selected country removed.");
    }   
    else{""}    
    
}

//-------------------------------------Agregar encuesta -------------------------------------
function getselect() {
    // console.log("getselected");
    var idselect=document.getElementById("bs-select-1");
    // console.log(idselect);
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    var obj = { name: insert, taller: 0};
    // console.log(res);
    $.ajax({
        type: 'POST',
        url: '/agregarEncuesta/guardarpregunta',
        data: obj,
        success: function(data) {
            // console.log(data);
            $('#pregunta').append('<option value="'+data+'" selected>'+insert+'</option>');
            $('#pregunta').selectpicker('refresh');            
        }        
    });    
  }

  function displayresp(val){
    //   alert(val);
      if(val==1){$('#btn_crear_pregunta').show();$('#mult_resp').hide();}
      if(val==2){$('#mult_resp').show();
      $('#btn_crear_pregunta').hide();}
}
  
//----------------------------------------------------------------------------------------------------

function displaydatatable(){ 
    $('#Encuesta-lista').show();
    $('#Pregunta-lista').hide();
}
function displaydatatablepre(){
  $('#Encuesta-lista').hide();
  $('#Pregunta-lista').show();
}


function guardaresp() {
	$('#btn-guardar-respuesta').html('Guardando');
		$.ajax({contenttype : 'application/json; charset=utf-8',
			data: $('#form-guardar-respuesta').serialize(),
			url : '/agregarEncuesta/guardar',
			type : 'POST',				
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,textStatus,data) {
				$('#btn-guardar-respuesta').html('Guardar');
				//
				printErrorMsg(textStatus);
				//
				if (console && console.log) {
					console.log('La solicitud a fallado: '+ textStatus);
					console.log('La solicitud a fallado: '+ textStatus);
					}
			},
			success : function(data) {
                $('#btn-guardar-respuesta').html('Guardar');
                // console.log(data);
                alert('Pregunta y respuesta añadida!!!');
                $('#form-guardar-respuesta').trigger('reset');
                $('#pregunta').selectpicker('refresh');
                $('#mult_resp').hide();
                $('#btn_crear_pregunta').hide();
                $('#respuesta').selectpicker('refresh');
				
			}
		});
	}