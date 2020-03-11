@if (count($errors) > 0)
<div class="alert alert-danger">
	Errores<br> <br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li> @endforeach
	</ul>
</div>
@endif

<div id="alert1" class="alert1 alert-danger">
	<ul>
	</ul>
</div>