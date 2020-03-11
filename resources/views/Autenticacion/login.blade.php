
<!DOCTYPE html>

    <html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8"/>

        <title>Pro Order | Login </title>
        <meta name="description" content="Login page example">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <!--begin::Page Custom Styles(used by this page) -->
        <link href="../assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../gos/css/login.css">
    <!-- begin::Body -->
    <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading"  >

    	<!-- begin:: Page -->
  <div class="wrapper fadeInDown">
  <div id="formContent">
  <!-- Tabs Titles -->

  <!-- Icon -->
  <div class="fadeIn first">
    <img  src="../img/logo.png" id="icon" alt="User Icon" />
  </div>

  <!-- Login Form -->
  <form id="loginForm" action="" method="POST">
      {{ csrf_field() }}
@csrf
    <input type="text" id="Email" class="fadeIn second" name="email" placeholder="Email">
    <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
    <input type="text" id="text" class="fadeIn second" name="taller" placeholder="ID-Taller"> <br>
      <input type="checkbox"  name="tyc" value="1"/><label for="">He Leido Y Acepto Los Terminos Y Condiciones</label>
    <input type="submit" class="fadeIn fourth" value="Log In">
  </form>
  <!-- Remind Passowrd -->
  <div id="formFooter">

       <a  class="underlineHover" href="/terminosycondiciones" style=" color: #646c9a;"> Leer Terminos y Condciones</a> <br>
       <a class="underlineHover" href="/avisodeprivasidad" style=" color: #646c9a;">Aviso De Privacidad</a> <br>
       <a class="underlineHover" href="/RecuperarClave">Olvidaste Tu Contraseña?</a> <br>
  </div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

</body>
