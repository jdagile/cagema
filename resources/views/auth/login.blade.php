<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
<script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
<script src="{{asset('assets/js/angular.js')}}" ></script>
<script stype="text/javascript">
    var ngLoginApp = angular.module('ngLoginApp', [], function($interpolateProvider)
        {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
        ngLoginApp.controller('ngLoginController', function($scope) {
        $scope.login=[];
        $scope.regions={!! $regions !!};
               $('#login-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'logins',ModuleItemName:'login',NgAppName:'ngLoginApp'});

    });
</script>
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

<body  style="background-color: rgb(31, 84, 147);" >

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form  method="POST" action="{!! url('/login') !!}" data-parsley-validate >
                         {!! csrf_field() !!}
                         <img src ="{{ asset('app/media/img//logos/logo-1.png')}}" alt ="logo">
                        <h1 style="color : white;">CicohAlert</h1>
                        <div>
                            <input type="text" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Ingrese Correo" required="" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese Contraseña" required="" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Ingresar</button>

                        </div>
                        <div class="clearfix"></div>
                                              <div class="separator">

                                                  <p style="color: white" class="change_link"> quieres registrarte ?
                                                      <a style="color: white" href="#toregister" class="to_register"> Crea una Cuenta ! </a>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <br />
                                              </div>
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
                    <form id="login-form" ng-app="ngLoginApp" ng-controller="ngLoginController" method="POST" action="{!! url('/register') !!}" data-parsley-validate>
                        {!! csrf_field() !!}
                        <img src ="{{ asset('app/media/img//logos/logo-1.png')}}" alt ="logo">
                       <h1 style="color : white;">CicohAlert</h1>
                        <h3 style="color: white">Crear Cuenta</h3>
                        <div>
                               <select name="regions" id="regions" class="form-control">
                                      <option ng-selected="login.regions_id==region.id" ng-repeat="region in regions" value="<% region.id %>" ><% region.descripcion %></option>
                                </select>
                        </div>
                        <br>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Ingrese su Nombre y apellido." required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" name="email" placeholder="Ingrese su correo." required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Ingrese su Contraseña." required="" />

                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Guardar</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p style="color: white" class="change_link">Estas registrado ?
                                <a style="color: white" href="#tologin" class="to_register"> Inicio de sesión </a>
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
                            <input type="email" class="form-control" name="email" placeholder="Email" required="" />
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

</html>
