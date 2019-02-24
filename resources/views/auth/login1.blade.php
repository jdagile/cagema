<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title >CicohAlert  </title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/custom.css'); ?>" rel="stylesheet">
    <script src="<?php echo asset('assets/js/jquery.min.js') ?>"></script>
    <link href="<?php echo asset('assets/css/animate.min.css'); ?>" rel="stylesheet">

</head>
<script>
function inicio(){
     document.f1.f1t1.value = 30
  };
  window.onload = inicio;

</script>
<body  style="background-color: rgb(31, 84, 147);" >

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form id ="f1" name="f1" method="POST" action="{!! url('/login') !!}" data-parsley-validate >
                         {!! csrf_field() !!}
                         <img src ="{{ asset('app/media/img//logos/logo-1.png')}}" alt ="logo">
                        <h1 style="color : white;">CicohAlert</h1>
                        <div>
                            <input id="email" type="text" type="email" name="email" value="{{ old('email') }}" class="form-control"  required="" />
                        </div>
                        <div>
                            <input id="password"  type="password" name="password" class="form-control"  required="" />
                        </div>
                        <div>
                            <button id="ingresar" type="submit" class="btn btn-default submit">Ingresar</button>

                        </div>
                        <div class="clearfix"></div>

                    </form>
                    <div class="">
                      <table align="center" >
                      <tr >
                        <br>
                        <br>

                        <td><img src ="{{ asset('app/media/img//logos/cicoh.png')}}"  width="70%" alt ="logo"></td>
                        <td><img src ="{{ asset('app/media/img//logos/usaid.png')}}"  width="70%" alt ="logo"></td>
                      </tr>
                      </table>
                     <h6 style="color : white;"></h6>
                     <span style="color: white">
<small><small>CicohAlert se hace posible gracias al apoyo del pueblo estadounidense a través de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID). El contenido de este sistema es responsabilidad exclusiva de DAI y no refleja necesariamente los puntos de vista de la Agencia de Estados Unidos para el Desarrollo Internacional o del Gobierno de los Estados Unidos.</small></small></span>
                      </div>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form method="POST" action="{!! url('/register') !!}" data-parsley-validate>
                        {!! csrf_field() !!}
                        <h1>Crear Cuenta</h1>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />

                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Submit</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="passwordreset" class="animate form">
                <section class="login_content">
                    <form method="POST" action="{{ url('/password/reset') }}" data-parsley-validate>
                        {!! csrf_field() !!}
                        <h1>Cambiar Contraseña</h1>
                        <div>
                            <input  type="email" class="form-control" name="email" placeholder="Email" required="" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Ingresar</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Iniciar Sesión </a>
                            </p>
                            <div class="clearfix"></div>
                        </div>
                    </form>

                    <!-- form -->
                </section>
                <!-- content -->

            </div>
        </div>

    </div>



</body>


 <script>
 function inicio(){
      document.f1.email.value = "juandavid92000@gmail.com"
        document.f1.password.value = "honduras"
        document.f1.ingresar.click();

   };
   window.onload = inicio;

 </script>

</html>
