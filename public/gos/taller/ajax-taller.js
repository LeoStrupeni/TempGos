


$(document).ready(function() {





//photoLoader(null,1)
 console.log("ajax-Taller-DReady");

 $("#eliminar").click(function(){
   if (confirm("Press a button!")) {
     txt = "You pressed OK!";
   } else {
     txt = "You pressed Cancel!";
   }
  });
});


///////////////////////////////////////////////////////////////////////
//Cargar fotos de taller
///////////////////////////////////////////////////////////////////////
function tallerPics(input,idPic) {

  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        if(idPic == 1)
          $('#pic1').attr('src', e.target.result);
          if(idPic == 2)
            $('#pic2').attr('src', e.target.result);
            if(idPic == 3)
              $('#pic3').attr('src', e.target.result);

           loadImage(reader.result,idPic);


      };
       reader.readAsDataURL(input.files[0]);
  }
}

function loadImage(img,idPic){

var req ={ imag:img,id:idPic}
$.ajax({
data:  req,
url : '/gestion-taller/subir',
type : "POST",
done : function(response) {console.log(response);},
success : function(data) {
  console.log(data)

}
});
}
/////////////////////////////////////////////////////////////////////////////
















function AgregarHoraro() {
var div=document.getElementById('Divhorarios');
var hrlength= parseInt(document.getElementById('lengthhorarios').value);
hrlength=hrlength+1;
console.log(hrlength);
$(div).append('<div class="border-top "><br></div><div class="form-row col-12"><div class="col-11 col-sm-5"><select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="'+hrlength+'diadesde" >'+
				'	<option value="Lunes" >Lunes</option><option value="Martes" >Martes</option><option value="Miercoles">Miercoles</option><option value="Jueves">Jueves</option>'+
				'	<option value="Viernes">Viernes</option><option value="Sabado">Sabado</option><option value="Domingo" ?> Domingo</option></select></div>'+
	'	<div class="col-11 col-sm-1"><p style="-webkit-text-stroke-width: medium; text-align:center; padding-top: 1rem;">A</p></div><div  class="col-11 col-sm-5">'+
		'		<select class="form-control kt-selectpicker" data-live-search="true" data-size="5" name="'+hrlength+'diahasta">'+
				'	<option value="Lunes">Lunes</option><option value="Martes" >Martes</option><option value="Miercoles">Miercoles</option><option value="Jueves" >Jueves</option>'+
		     '<option value="Viernes">Viernes</option><option value="Sabado" >Sabado</option><option value="Domingo">Domingo</option>'+
				'</select></div></div>'+
			'	<div class="form-row col-12"><div class="col-5 col-sm-5" >'+
				'<input type="time"style="padding-top: 1rem;" class="form-control" name="'+hrlength+'horadesde" >'+
					'</div><div class="col-1 col-sm-1"><p style="-webkit-text-stroke-width: medium; text-align:center; padding-top: 1rem;">A</p>'+
					'</div><div  class="col-5 col-sm-5" >'+
						'	<input type="time" style="padding-top: 1rem;"class="form-control" name="'+hrlength+'horahasta">'+
				'	</div></div> <br> <div class="col-11"style=" border-bottom: 2px  solid lightgrey; margin: 1rem;"></div>'
							 );
document.getElementById('lengthhorarios').value=hrlength;
}





function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);

                  cargarimagen(reader.result);
            };
             reader.readAsDataURL(input.files[0]);
        }

    }

    function cargarimagen(img){

    var req ={ logo:img}
		$.ajax({
			data:  req,
			url : '/gestion-taller/logotaller',
      type : "POST",
			done : function(response) {console.log(response);},
			success : function(data) {
				alert(data);
			}
		});
    }
