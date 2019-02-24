@extends('layouts.master')
@section('head')
<!-- This is the localization file of the grid controlling messages, labels, etc.
    <!-- A link to a jQuery UI ThemeRoller theme, more than 22 built-in and many more custom -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/jquery-ui.css') ?>" />
    <!-- The link to the CSS that the grid needs -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/trirand/ui.jqgrid.css') ?>" />
@stop
@section('content')


<div align="center" class="panel-body">

      <thead>
          <div class="">
                  <table align="center">
                  <img src ="{{ asset('app/media/img//logos/logo-1.png')}}" alt ="logo">
                 <h1>CicohAlert</h1>
                   </table>
           </div>
          </thead>
                <tbody>
                  <div class="">
                    <table align="center" >
                    <tr >
                      <br>
                      <br>

                      <td><img src ="{{ asset('app/media/img//logos/cicoh.png')}}"  width="70%" alt ="logo"></td>
                      <td><img src ="{{ asset('app/media/img//logos/usaid.png')}}"  width="70%" alt ="logo"></td>
                    </tr>
                    </table>
                   <h6>CICOH ALERT se hace posible gracias al apoyo del pueblo estadounidense a través de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID). El contenido de este sistema es responsabilidad exclusiva de DAI y no refleja necesariamente los puntos de vista de la Agencia de Estados Unidos para el Desarrollo Internacional o del Gobierno de los Estados Unidos.</h6>

                    </div>
                  <!-- form -
                </tbody>
            </table>
</div>





      <!--end: Datatable -->
    </div>
    <footer>
        <div class="">

        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    @stop

    @section('footer')

    @stop
