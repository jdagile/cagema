@extends('layouts.master')
@section('content')
                <!-- top tiles -->
                <div class="row tile_count">
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"> <i class="fa fa-square"> Región ó sector: </i>
                                                 <br />
                              <span class="count_bottom"><i class="blue"> </i> <h3><?php echo $sectordeusuario ; ?></h3>  </span>

                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-spoon"></i> Cantidad De Estaciones</span>
                            <div class="count blue">
                          <?php echo $cantidaddeestaciones ; ?>
                            </div>
                            <span class="count_bottom"><i class="fa fa-sort-asc">Instalada(s) en el sector </i> </span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-thermometer"></i> Temperatura promedio</span>
                            <div class="count"><?php echo $valorpromediotemperatura ; ?></div>
                            <span class="count_bottom"><i class="blue">°C <i class="fa fa-sort-asc"></i></i> Grados Celsius</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-percent"></i> Humedad Relativa</span>
                            <div class="count blue"><?php echo $valorpromediohumedadrelativa ; ?></div>
                            <span class="count_bottom"><i class="blue"> % <i class="fa fa-sort-asc"></i></i> Porciento</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-cloud"></i> Precipitacion acumulada del sector </span>
                            <div class="count">0.60</div>
                            <span class="count_bottom"><i class="blue">mm <i class="fa fa-sort-asc"></i></i> milimetros</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-send"></i> Velocidad del Viento</span>
                            <div class="count blue"><?php echo $valorpromediovelocidaddelviento ; ?></div>
                            <span class="count_bottom"><i class="blue"> km/h <i class="fa fa-sort-asc"></i></i> kilometros por Hora</span>
                        </div>
                    </div>
                </div>
                <!-- /top tiles -->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard_graph">

                            <div class="row x_title">
                                <div class="col-md-12">
                                    <h3>Alertas (Ultimos 5 Días) <small>en base a los valores promedios de su sector se generaron las siguientes alertas </small></h3>
                                </div>
                            </div>
                            <div class="panel-body">
                                  <table class="table table-bordered" id='alertas'>
                                            <thead>


                                              <th>Alertas Generadas en el sector.</th>

                                                                </thead>
                                            <tbody>

                                                <tr>


                                                    <td>
                                                     </td>



                                                 </tr>


                                            </tbody>
                                        </table>
                            </div>
                            <div class="row x_title">
                                <div class="col-md-12">
                                    <h3>Gráfica de Temperatura y Humedad Relativa (Ultimos 5 Días) <small>en base a los valores promedios de su sector </small></h3>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                                <div style="width: 100%;">
                                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <br />

@stop
@section('script-adicional')
<script>
$(document).ready(function () {
                  // [17, 74, 6, 39, 20, 85, 7]
                  //[82, 23, 66, 9, 99, 6, 2]
                  var data1 = [
                  <?php foreach($humedad_relativa as $rt):
                    $fecha = explode("/",$rt->out_fecha);
                  ?>
                  [
                  gd(<?php echo $fecha[2].",".$fecha[1].",".$fecha[0];?>),
                  <?php echo $rt->out_valor;?>
                  ],
                  <?php endforeach;?>
                  ];
                  //   var data1 = [[gd(2012, 1, 1), 17], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];

                  var data2 = [
                  <?php foreach($temperatura_ambiente as $rt):
                    $fecha = explode("/",$rt->out_fecha);
                  ?>
                  [
                  gd(<?php echo $fecha[2].",".$fecha[1].",".$fecha[0];?>),
                  <?php echo $rt->out_valor;?>
                  ],
                  <?php endforeach;?>
                  ];
                  $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                                                     {label:"% de HR",data:data1},
                                                     {label:"°C de Temperatura",data:data2}
                                                     ], {
                                                     xaxes:  [
                                                         {
                                                             mode: "time",
                                                             timeformat: "%m/%d",
                                                             tickSize: [1, "day"],
                                                             axisLabel: "Fechas",
                                                             axisLabelUseCanvas: true,
                                                             axisLabelFontSizePixels: 12,
                                                             axisLabelFontFamily: 'Verdana, Arial',
                                                             axisLabelPadding: 10,
                                                             position: 'bottom'
                                                         }
                                                     ],
                                                     yaxes:  [
                                                         {
                                                          axisLabel: "Valores",
                                                         axisLabelUseCanvas: true,
                                                         axisLabelFontSizePixels: 12,
                                                         axisLabelFontFamily: 'Verdana, Arial',
                                                         axisLabelPadding: 10,
                                                         position: 'left'
                                                         }
                                                     ],
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
                                                     /*xaxis: {

                                                         tickColor: "rgba(51, 51, 51, 0.06)",
                                                         mode: null,
                                                         tickSize: [1, "day"],
                                                         //tickLength: 10,
                                                         axisLabel: "Date",
                                                         labelString: "0-5 ultimos dias",
                                                         axisLabelUseCanvas: true,
                                                         axisLabelFontSizePixels: 12,
                                                         axisLabelFontFamily: 'Verdana, Arial',
                                                         axisLabelPadding: 10
                                                         //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                                                     },*/

                                                     yaxis: {
                                                       gridLines: {
                                                      color: "black",
                                                      borderDash: [2, 5],
                                                    },
                                                    scaleLabel: {
                                                      display: true,
                                                      labelString: "valores",
                                                      fontColor: "green"
                                                    },


                                                     ticks: 8,
                                                     tickColor: "rgba(51, 51, 51, 0.06)",
                                                     },
                                                     tooltip: true,
                                                     });

                  
                  });
function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
}
</script>
@stop
