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
        <link href="<?php echo asset('assets/css/custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo asset('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
        <link href="<?php echo asset('assets/css/floatexamples.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset('assets/css/jquery-ui.theme.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset('assets/css/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset('assets/css/app-builder.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo asset('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo asset('assets/js/jquery-ui.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('assets/js/jquery.form.min.js'); ?>"></script>

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
                                <img src="<?php echo asset('assets/images/img.jpg') ?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido,</span>
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
                                    <?php if (!empty(array_intersect(array('modulebuilder_menu','modulebuilder_modules'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-cubes"></i> Costructor De Modulos <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('modulebuilder_menu', $user_permissions_names)): ?>
                                            <li><a href="<?php echo Route('modulebuildermenu'); ?>">Menu</a></li>
                                            <?php endif; ?>
                                            <?php if (in_array('modulebuilder_modules', $user_permissions_names)): ?>
                                            <li><a href="<?php echo Route('all_modules'); ?>">Modules</a></li>
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
                                        <li><a><i class="fa fa-file-o"></i>Gestión de Archivos <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <?php if (in_array('filemanager', $user_permissions_names)): ?>
                                                <li><a href="<?php echo url('laravel-filemanager'); ?>?type=Files">Gestión de Documentos</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty(array_intersect(array('profile'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-user-circle"></i>Perfil <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('profile', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('userprofile'); ?>">Perfil del Usuario</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (!empty(array_intersect(array('valoresacumuladosporfasefenologicas'), $user_permissions_names))): ?>
                                    <li><a><i class="fa fa-cog"></i>Parametrización <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if (in_array('valoresacumuladosporfasefenologicas', $user_permissions_names)): ?>
                                                <li><a href="<?php echo Route('valoresacumuladosporfasefenologicas'); ?>">Valores Acumulados</a></li>
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
                                        <img src="<?php echo asset('assets/images/img.jpg'); ?>" alt=""><?php echo session('name'); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <?php if (in_array('user-profile-view', $user_permissions_names)): ?>
                                        <li><a href="{{ route('userprofile') }}">  Profile</a></li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Help</a>
                                        </li>
                                        <li><a href="<?php echo Route('logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo asset('assets/images/img.jpg'); ?>" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo asset('assets/images/img.jpg'); ?>" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo asset('assets/images/img.jpg'); ?>" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo asset('assets/images/img.jpg'); ?>" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong><a href="inbox.html">See All Alerts</strong>
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
        <script src="<?php echo asset('assets/js/custom.js'); ?>"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- /footer content -->

        @section('footer')
        @show
    </body>

</html>
