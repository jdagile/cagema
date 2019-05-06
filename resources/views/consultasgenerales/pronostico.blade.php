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
  <div class="count"><?php echo $pronostico ; ?></div>

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
