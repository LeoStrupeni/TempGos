<div class="modal fade" id="modalGuardar" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-l" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="" id="exampleModalLabel">Orden guardada</h6>
			</div>
			<div class="modal-body">
					@include('Layout/errores')
				<div class="row">
					<div style="font-size: 400%; margin-left: 15%; color: #5867dd;" class="col">
						<form class="" action="" method="post">
							@csrf <a href="/OS/pdf"><i class="fas fa-download"></i></a>
							<button style="height: 35px; margin-top: 5%; margin-left: -17%" type="button" class="btn btn">Descargar</button>
						</form>
					</div>
					<div style="font-size: 400%; color: #5867dd" class="col">
						<form id="formularioEmail" >
							@csrf <a href="/OS/ComentarioEmail"><i class="fas fa-envelope-open-text"></i></a>
							<button style="height: 35px; margin-top: 5%; margin-left: -10%;" type="button" class="btn btn" id="btn-formularioEmail">Correo</button>
						</form>
					</div>

					<div style="font-size:400%; color:#5867dd" class="col">
						<a href="https://api.whatsapp.com/send?phone={{isset($cliente)? $cliente->telefono: '' }}&text=Bienvenido(a)%20{{isset($cliente)? $cliente->telefono: '' }}%20para%20un%20mejor%20seguimiento%20de%20tu%20auto%20ingresa%20a%20{{isset($cliente)? $cliente->url: '' }}">
						<i class="fab fa-whatsapp"></i></a>
						<button style="height:35px; margin-top:5%; margin-left:-20%;" type="button" class="btn btn">WhatssApp</button>
					</div>
				</div>
				<button style="height: 35px; margin-top: 5%;" type="submit" class="btn btn-success col-md-12">Continuar</button>
			</div>
		</div>
	</div>
</div>
