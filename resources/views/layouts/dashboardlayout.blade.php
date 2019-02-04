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
<!--    <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/css/maps/jquery-jvectormap-2.0.1.css'); ?>" />-->
<link href="<?php echo asset('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
<link href="<?php echo asset('assets/css/floatexamples.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo asset('assets/css/jquery-ui.theme.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo asset('assets/css/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo asset('assets/css/app-builder.css'); ?>" rel="stylesheet" type="text/css" />
<style>
.legendLabel {
color:black !important;
}
</style>
<script src="<?php echo asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo asset('assets/js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/jquery.form.min.js'); ?>"></script>
<!--    <script src="<?php echo asset('assets/js/nprogress.js') ?>"></script>-->
<!--    <script>
NProgress.start();
</script>-->

<!--[if lt IE 9]>
<script src="../assets/js/ie8-responsive-file-warning.js"></script>
<![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
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
<li><a><i class="fa fa-cubes"></i> Constructor de CRUD <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu" style="display: none">
<?php if (in_array('modulebuilder_menu', $user_permissions_names)): ?>
<li><a href="<?php echo Route('modulebuildermenu'); ?>">Menú</a></li>
<?php endif; ?>
<?php if (in_array('modulebuilder_modules', $user_permissions_names)): ?>
<li><a href="<?php echo Route('all_modules'); ?>">Modulos</a></li>
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
<li><a><i class="fa fa-file-o"></i> Gestor de Archivos <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu" style="display: none">
<?php if (in_array('filemanager', $user_permissions_names)): ?>
<li><a href="<?php echo url('laravel-filemanager'); ?>?type=Files">Gestión de Archivos</a></li>
<?php endif; ?>
</ul>
</li>
<?php endif; ?>
<?php if (!empty(array_intersect(array('user-profile-view'), $user_permissions_names))): ?>
<li><a><i class="fa fa-user-circle"></i> Configuración de Cuenta <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu" style="display: none">
<?php if (in_array('user-profile-view', $user_permissions_names)): ?>
<li><a href="<?php echo Route('userprofile'); ?>">Perfil de U</a></li>
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
<img src="<?php echo url('photos' . '/' . Auth::user()->image) ?>" alt="..." >


<span class=" fa fa-angle-down"></span>
</a>
<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
<?php if (in_array('user-profile-view', $user_permissions_names)): ?>
<li><a href="{{ route('userprofile') }}">  Per</a></li>
<?php endif; ?>
<li>
<a href="javascript:;">
<span class="badge bg-red pull-right">50%</span>
<span>Configuración</span>
</a>
</li>
<li>
<a href="javascript:;">Help</a>
</li>
<li><a href="<?php echo Route('logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
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

<script src="<?php echo asset('assets/js/bootstrap.min.js') ?>"></script>

<!-- gauge js -->
<!--    <script type="text/javascript" src="<?php echo asset('assets/js/gauge/gauge.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/gauge/gauge_demo.js') ?>"></script>-->
<!-- chart js -->
<!--    <script src="<?php echo asset('assets/js/chartjs/chart.min.js') ?>"></script>-->
<!-- bootstrap progress js -->
<script src="<?php echo asset('assets/js/progressbar/bootstrap-progressbar.min.js') ?>"></script>
<script src="<?php echo asset('assets/js/nicescroll/jquery.nicescroll.min.js') ?>"></script>
<!-- icheck -->
<script src="<?php echo asset('assets/js/icheck/icheck.min.js') ?>"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo asset('assets/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/datepicker/daterangepicker.js'); ?>"></script>

<script src="<?php echo asset('assets/js/custom.js'); ?>"></script>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.pie.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.orderBars.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.time.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/date.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.spline.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.stack.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/curvedLines.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/flot/jquery.flot.resize.js') ?>"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script>
$(document).ready(function () {
                  // [17, 74, 6, 39, 20, 85, 7]
                  //[82, 23, 66, 9, 99, 6, 2]
                  var data1 = [
                  <?php foreach($humedad_relativa as $rt):?>
                  [
                  <?php echo $rt->out_fecha;?>,
                  <?php echo $rt->out_valor;?>
                  ],
                  <?php endforeach;?>
                  ];
                  //   var data1 = [[gd(2012, 1, 1), 17], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];

                  var data2 = [
                  <?php foreach($temperatura_ambiente as $rt): ?>
                  [
                  <?php echo $rt->out_fecha;?>,
                  <?php echo $rt->out_valor;?>
                  ],
                  <?php endforeach;?>
                  ];
                  $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                                                     {label:"Humedad relativa",data:data1},
                                                     {label:"Temperatura ambiente",data:data2}
                                                     ], {
                                                     series: {
                                                     lines: {
                                                     show: false,
                                                     fill: true
                                                     },
                                                     splines: {
                                                     show: true,
                                                     tension: 0.4,
                                                     lineWidth: 1,
                                                     fill: 0.05
                                                     },
                                                     points: {
                                                     radius: 0,
                                                     show: true
                                                     },
                                                     shadowSize: 2
                                                     },
                                                     grid: {
                                                     verticalLines: true,
                                                     hoverable: true,
                                                     clickable: true,
                                                     tickColor: "#d5d5d5",
                                                     borderWidth: 1,
                                                     color: '#fff'
                                                     },
                                                     colors: ["rgba(38, 185, 154, 0.6)", "rgba(127, 0, 0, 6)"],
                                                     xaxis: {
                                                     tickColor: "rgba(51, 51, 51, 0.06)",
                                                     mode: null,
                                                     tickSize: [1, "day"],
                                                     //tickLength: 10,
                                                     axisLabel: "Date",
                                                     axisLabelUseCanvas: true,
                                                     axisLabelFontSizePixels: 12,
                                                     axisLabelFontFamily: 'Verdana, Arial',
                                                     axisLabelPadding: 10
                                                     //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                                                     },
                                                     yaxis: {
                                                     ticks: 8,
                                                     tickColor: "rgba(51, 51, 51, 0.06)",
                                                     },
                                                     tooltip: false
                                                     });

                  function gd(year, month, day) {
                  return new Date(year, month - 1, day).getTime();
                  }
                  });
</script>

<!-- worldmap -->
<!--    <script type="text/javascript" src="<?php echo asset('assets/js/maps/jquery-jvectormap-2.0.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/maps/gdp-data.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/maps/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/js/maps/jquery-jvectormap-us-aea-en.js'); ?>"></script>-->
<!--    <script>
$(function () {
  $('#world-map-gdp').vectorMap({
                                map: 'world_mill_en',
                                backgroundColor: 'transparent',
                                zoomOnScroll: false,
                                series: {
                                regions: [{
                                values: gdpData,
                                scale: ['#E6F2F0', '#149B7E'],
                                normalizeFunction: 'polynomial'
                                }]
                                },
                                onRegionTipShow: function (e, el, code) {
                                el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                                }
                                });
  });
</script>-->
<!-- skycons -->
<script src="<?php echo asset('assets/js/skycons/skycons.js'); ?>"></script>
<script>
var icons = new Skycons({
                        "color": "#73879C"
                        }),
list = [
"clear-day", "clear-night", "partly-cloudy-day",
"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
"fog"
],
i;

for (i = list.length; i--; )
icons.set(list[i], list[i]);

icons.play();
</script>

<!-- dashbord linegraph -->
<!--    <script>
var doughnutData = [
{
value: 30,
color: "#455C73"
},
{
value: 30,
color: "#9B59B6"
},
{
value: 60,
color: "#BDC3C7"
},
{
value: 100,
color: "#26B99A"
},
{
value: 120,
color: "#3498DB"
}
];
var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
</script>-->
<!-- /dashbord linegraph -->
<!-- datepicker -->
<script type="text/javascript">
$(document).ready(function () {

                  var cb = function (start, end, label) {
                  console.log(start.toISOString(), end.toISOString(), label);
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                  //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
                  }

                  var optionSet1 = {
                  startDate: moment().subtract(29, 'days'),
                  endDate: moment(),
                  minDate: '01/01/2012',
                  maxDate: '12/31/2015',
                  dateLimit: {
                  days: 60
                  },
                  showDropdowns: true,
                  showWeekNumbers: true,
                  timePicker: false,
                  timePickerIncrement: 1,
                  timePicker12Hour: true,
                  ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  },
                  opens: 'left',
                  buttonClasses: ['btn btn-default'],
                  applyClass: 'btn-small btn-primary',
                  cancelClass: 'btn-small',
                  format: 'MM/DD/YYYY',
                  separator: ' to ',
                  locale: {
                  applyLabel: 'Submit',
                  cancelLabel: 'Clear',
                  fromLabel: 'From',
                  toLabel: 'To',
                  customRangeLabel: 'Custom',
                  daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octobre', 'Noviembre', 'Deciembre'],
                  firstDay: 1
                  }
                  };
                  $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                  $('#reportrange').daterangepicker(optionSet1, cb);
                  $('#reportrange').on('show.daterangepicker', function () {
                                       console.log("show event fired");
                                       });
                  $('#reportrange').on('hide.daterangepicker', function () {
                                       console.log("hide event fired");
                                       });
                  $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                                       console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
                                       });
                  $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                                       console.log("cancel event fired");
                                       });
                  $('#options1').click(function () {
                                       $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                                       });
                  $('#options2').click(function () {
                                       $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                                       });
                  $('#destroy').click(function () {
                                      $('#reportrange').data('daterangepicker').remove();
                                      });
                  });
</script>
<!--    <script>
NProgress.done();
</script>-->
<!-- /datepicker -->
<!-- /footer content -->
<footer>

<table align="center" >
<tr>
<td><img src ="{{ asset('app/media/img//logos/usaid.png')}}"  width="20%" alt ="logo"></td>
<td><img src ="{{ asset('app/media/img//logos/gema.png')}}"  width="20%" alt ="logo"></td>

</tr>
</table>
Copyrig {{date('Y')}}
</footer>
@section('footer')
@show


</body>


</html>
