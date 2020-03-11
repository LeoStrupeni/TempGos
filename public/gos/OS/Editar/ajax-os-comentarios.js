$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});


    $('body').on('click','#enviar-whatsapp',function() {

		var NCL= $("input#celular_cliente").val();
		console.log(NCL);
        var value = $("textarea#mensaje").val();
        var url = "https://api.whatsapp.com/send?phone=52"+NCL+"&text="+value+"&source=&data=";
        console.log(url);
         window.open(url, '_blank');



    });
    $("#btnGuardarComentario").click(function(){
     var msg=document.getElementById('mensaje').value;
		 if(msg==""){
			swal.fire({
				 title: 'Ups!!',
				 text: "Olvidaste llenar el campo de comentario",
				 type: 'warning'
			 });
		 }
		 else{document.getElementById("submitbtnGuardarComentario").click();}
		});

});
