
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
  

      <div class="wrapper fadeInDown">
      <div id="formContent">

          <div class="fadeIn first">
            <img  src="../img/logo.png" id="icon" alt="User Icon" />
          </div>

          <form id="loginForm" action="" method="POST">
              {{ csrf_field() }}
            <input type="text" id="Email" class="fadeIn second" name="email" placeholder="Email">

            <input type="submit" class="fadeIn fourth" value="Restablecer">
          </form>

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