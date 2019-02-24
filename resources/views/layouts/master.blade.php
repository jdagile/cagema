<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> CicohAlert </title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo asset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo asset('assets/fonts/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('assets/css/animate.min.css'); ?>" rel="stylesheet">
        <!-- Custom styling plus plugins -->
        <link href="<?php echo asset('assets/css/custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo asset('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
        <link href="<?php echo asset('assets/css/floatexamples.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset('assets/css/jquery-ui.theme.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset('assets/css/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!--link href="<?php echo asset('assets/css/datetimepicker/bootstrap-datetimepicker.css'); ?>" rel="stylesheet" type="text/css" /-->
        <!--link href="<?php echo asset('assets/css/app-builder.css'); ?>" rel="stylesheet" type="text/css" /-->
        <style>
        .legendLabel {
        color:black !important;
        }
        </style>
        <script src="<?php echo asset('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo asset('assets/js/jquery-ui.min.js') ?>"></script>
        <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
        <script src="<?php echo asset('assets/js/ckeditor/adapters/jquery.js') ?>"></script>
        <script src="<?php echo asset('assets/js/jquery-ui.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('assets/js/moment.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo asset('assets/js/jquery.form.min.js'); ?>"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <!--script type="text/javascript" src="<?php echo asset('assets/js/datetimepicker/collapse.js') ?>"></script-->
        <script src="<?php echo asset('assets/js/progressbar/bootstrap-progressbar.min.js'); ?>"></script>
        @section('head')
        @show
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="clearfix"></div>
                        <!-- menu prile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                <img src="<?php echo url('photos' . '/' . Auth::user()->image) ?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido,al CICOHALERT,</span>
                                <h2><?php echo session('name'); ?></h2>
                            </div>
                        </div>
                        <!-- /menu prile quick info -->
                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    @forelse($all_menu_items as $menu_item)
                                    <?php //if (!empty(array_intersect(array('users','roles','permissions'), $user_permissions_names))): ?>
                                    <li>
                                        <a href="@if($menu_item['type']=='module'){!! route($menu_item['url']) !!} @else {{ $menu_item['url'] }} @endif"><i class="fa {{ $menu_item['icon'] }}"></i> {{ $menu_item['name'] }}
                                            @if(isset($menu_item['children']) && !empty($menu_item['children']))
                                            <span class="fa fa-chevron-down"></span>
                                            @endif
                                        </a>
                                        <ul class="nav child_menu" style="display: none">
                                        @forelse($menu_item['children'] as $menu_item_children)
                                        <li><a href="@if($menu_item_children['type']=='module') {!! route($menu_item_children['url']) !!} @else {{ $menu_item_children['url'] }} @endif"> {{ $menu_item_children['name'] }}</a></li>
                                        @empty
                                        @endforelse
                                        </ul>
                                    </li>
                                    @empty
                                    @endforelse
                                    <?php if (!empty(array_intersect(array('inicio'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-home"></i> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('inicio', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('inicio'); ?>">Inicio</a></li>
                                            <?php endif; ?>
                                        </ul>

                                    </li>
                                    <?php endif; ?>

                                    <?php if (!empty(array_intersect(array('users','roles','permissions'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-users"></i> Gestión de Usuarios <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('users', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('users'); ?>">Usuarios</a></li>
                                            <?php endif; ?>
                                            <?php if (in_array('roles', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('roles'); ?>">Roles</a></li>
                                            <?php endif; ?>
                                            <?php if (in_array('permissions', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('permissions'); ?>">Permisos</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (!empty(array_intersect(array('filemanager'), $user_permissions_names))): ?>
                                        <li><a><i class="fa fa-file-o"></i> Gestión de Archivos  <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <?php if (in_array('filemanager', $user_permissions_names)): ?>
                                                <li><a href="<?php echo url('laravel-filemanager'); ?>?type=Files">File Manager</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty(array_intersect(array('user-profile-view'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-user-circle"></i> Configuración de Cuenta <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('user-profile-view', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('userprofile'); ?>">Perfil de Usuario</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>

                                    <?php endif; ?>

                                    <?php if (!empty(array_intersect(array('valoresacumuladosporfasefenologicas','productofaseelementorangos' ,'regionesestaciones'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-cog"></i>Parametrización <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                          <?php if (in_array('tipodeproducto', $user_permissions_names)): ?>
                                                  <li><a href="<?php echo Route('tipodeproducto'); ?>">Tipo de Producto</a></li>
                                           <?php endif; ?>
                                           <?php if (in_array('fasefenologica', $user_permissions_names)): ?>
                                                   <li><a href="<?php echo Route('fasefenologica'); ?>">Fase-Fenologica</a></li>
                                            <?php endif; ?>
                                          <?php if (in_array('regiones', $user_permissions_names)): ?>
                                                  <li><a href="<?php echo Route('regiones'); ?>">Regiones</a></li>
                                           <?php endif; ?>
                                          <?php if (in_array('regionesestaciones', $user_permissions_names)): ?>
                                                  <li><a href="<?php echo Route('regionesestaciones'); ?>">Regiones Estaciones</a></li>
                                           <?php endif; ?>
                                            <?php if (in_array('valoresacumuladosporfasefenologicas', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('valoresacumuladosporfasefenologicas'); ?>">Valores Acumulados</a></li>
                                            <?php endif; ?>
                                            <?php if (in_array('productofaseelementorangos', $user_permissions_names)): ?>
                                                    <li><a href="<?php echo Route('productofaseelementorangos'); ?>">Producto-Fase-Elemento-Rango</a></li>
                                             <?php endif; ?>
                                             <?php if (in_array('correlacion', $user_permissions_names)): ?>
                                                     <li><a href="<?php echo Route('correlacion'); ?>">Correlacion</a></li>
                                              <?php endif; ?>
                                              <?php if (in_array('correlaciondetalle', $user_permissions_names)): ?>
                                                      <li><a href="<?php echo Route('correlaciondetalle'); ?>">Correlacion-Detalle</a></li>
                                               <?php endif; ?>
                                               <?php if (in_array('alertasadiconales', $user_permissions_names)): ?>
                                                       <li><a href="<?php echo Route('alertasadiconales'); ?>">Alertas adicinales</a></li>
                                                <?php endif; ?>

                                        </ul>
                                    </li>
                                    <?php endif; ?>

                                    <?php if (!empty(array_intersect(array('modulebuilder_menu','modulebuilder_modules'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-cubes"></i> Constructor De Modulos <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('modulebuilder_menu', $user_permissions_names)): ?>
                                            <li><a href="<?php echo Route('modulebuildermenu'); ?>">Menu</a></li>
                                            <?php endif; ?>
                                            <?php if (in_array('modulebuilder_modules', $user_permissions_names)): ?>
                                            <li><a href="<?php echo Route('all_modules'); ?>">Modulos</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo url('photos' . '/' . Auth::user()->image) ?>" alt=""><?php echo session('name'); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <?php if (in_array('user-profile-view', $user_permissions_names)): ?>
                                        <li><a href="{{ route('userprofile') }}"> Editar Perfil</a></li>
                                        <?php endif; ?>

                                      <li><a href="<?php echo Route('logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
                                        </li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-blue">0</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">


                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong><a href="/">ver todas</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->


                <!-- page content -->
                <div class="right_col" role="main">
                    @section('content')
                    This is the master content.
                    @show
                </div>
                <!-- /page content -->
            </div>

        </div>
        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>
        <script src="<?php echo asset('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo asset('assets/js/nicescroll/jquery.nicescroll.min.js') ?>"></script>
        <!-- icheck -->
        <script src="<?php echo asset('assets/js/icheck/icheck.min.js') ?>"></script>

        <script src="<?php echo asset('assets/js/custom.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.js') ?>"></script>


<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.spline.js') ?>"></script>

<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.resize.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.time.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.axislabels.js') ?>"></script>


        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        @section('script-adicional')
        @show

        <!-- /footer content -->
        <script type="text/javascript">
$('textarea.editor').ckeditor();
        </script>
        <div class="ajaxLoader" style="display: none;width: 100%;background-color: white;position: fixed;z-index: 1000;height: 100%;top: 0px;opacity: 0.7;">
            <div class="progress progress-striped progress_wide" style="width: 40%;margin: 0 auto;top: 50%;">
                <div class="progress-bar progress-bar-success" data-transitiongoal="10" aria-valuenow="10" style="width: 10%;"></div>
            </div>
        </div>
        @section('footer')
        @show
    </body>

</html>
