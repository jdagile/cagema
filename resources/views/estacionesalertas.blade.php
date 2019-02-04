@extends('layouts.master')
@section('head')
<!-- This is the localization file of the grid controlling messages, labels, etc.
    <!-- A link to a jQuery UI ThemeRoller theme, more than 22 built-in and many more custom -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/jquery-ui.css') ?>" />
    <!-- The link to the CSS that the grid needs -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/trirand/ui.jqgrid.css') ?>" />
@stop
@section('content')
<!--Begin::Section-->
<div class="row">
<div class="col-xl-12">
  <div class="m-portlet m-portlet--mobile ">
    <div class="m-portlet__head">
      <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
          <h3 class="m-portlet__head-text">
          Ultimas Alertas
          </h3>
        </div>
      </div>
      <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
          <li class="m-portlet__nav-item">

          </li>
        </ul>
      </div>
    </div>
    <div class="m-portlet__body">
      <!--begin: Datatable -->


<div class="panel-body">
      <table class="table table-bordered" id='alertas'>
                <thead>


                  <th>Estación</th>
                  <th>Elemento</th>
                  <th>Valor</th>
                  <th>Medida</th>
                  <th>Fecha</th>
                   <th>Aviso</th>
                                    </thead>
                <tbody>
                @foreach($estacionesalertas as $alerta)
                    <tr>


                        <td>{{$alerta->estacion}}
                         </td>
                         <td>{{$alerta->elemento}}
                          </td>
                          <td>{{$alerta->valor}}
                           </td>
                           <td>{{$alerta->unidadDeMedida}}
                            </td>
                            <td>{{$alerta->fechaestacion}}
                           </td>
                           <td>{{$alerta->aviso}}
                           </td>


                     </tr>

                @endforeach
                </tbody>
            </table>
</div>





      <!--end: Datatable -->
    </div>
  </div>
</div>

</div>
<!--End::Section-->
    <!-- footer content -->

    <footer>
        <div class="">

        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    @stop

    @section('footer')

    @stop
