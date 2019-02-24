@extends('layouts.master')
@section('head')
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
    <script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
    <script src="{{asset('assets/js/angular.js')}}" ></script>
    <script stype="text/javascript">
    var ngRegionesestacionesApp = angular.module('ngRegionesestacionesApp', [], function($interpolateProvider)
       {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
       ngRegionesestacionesApp.controller('ngregionesestacionesController', function($scope) {
       $scope.regionestacion=[];
       $scope.regiones={!! $regiones !!};
       $scope.estaciones={!! $estaciones !!};

       $('#regionesestaciones-form').Edit({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'regionesestaciones',ModuleItemName:'regionestacion',NgAppName:'ngRegionesestacionesApp'});
       $('#regionesestaciones-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'regionestacion',ModuleItemName:'regionestacion',NgAppName:'ngRegionesestacionesApp'});
  });
</script>
@stop
@section('content')
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Parametrización de :
                                <small>Lista de Estaciones y region a la que pertenecen</small>
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Gestión de estaciones y region a la que pertenecen </h2>
                                    <button  class="btn btn-primary form-modal-button" data-toggle="modal" data-target=".form-modal"   >Agregar Nuevo </button>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                @if ( Session::has('flash_message') )
                                <div  class="alert {{ Session::get('flash_type') }}" >
                                    <h5> {{ Session::get('flash_message') }}</h5>
                                </div>
                              @endif
                                <div class="x_content">
                                <table class="table table-striped responsive-utilities jambo_table dataTable" id="regionesestaciones-table">
                                    <thead>
                                        <tr>
                                         <th>ID</th>
                                         <th>Region</th>
                                         <th>Estacion</th>
                                          <th>EstaActivo</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- Form modal -->
<div class="modal fade form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Regiones de Estaciones
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
       <form  ng-app="ngRegionesestacionesApp" ng-controller="ngregionesestacionesController" id="regionesestaciones-form" class="form-horizontal form-label-left" method="post" action='{!! route("regionesestacioncreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                              <label for="region" class="control-label col-md-3 col-sm-3 col-xs-12">Región o sector :</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name="regiones" id="regiones" class="form-control">
                                      <option ng-selected="regionestacion.region_id==region.id" ng-repeat="region in regiones" value="<% region.id %>" ><% region.descripcion %></option>
                                  </select>
                             </div>
                       </div>

                        <div class="form-group">
                            <label for="estacion" class="control-label col-md-3 col-sm-3 col-xs-12">Estación :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="estaciones" id="estaciones" class="form-control">
                                    <option ng-selected="regionestacion.estaciones_id==estaciones.id" ng-repeat="estacion in estaciones" value="<% estacion.id %>" ><% estacion.descripcion %></option>
                                </select>
                            </div>

                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Está Activo : </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='regionestacion.estaactivo'  value="<% regionestacion.estaactivo %>" id="estaactivo"  type="checkbox"  name='estaactivo'  ><ul class="parsley-errors-list" ></ul>
            </div>
                        </div>

<input ng-model='regionestacion.id' type="text" id="id" name="id" style="display: none" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset"  class="btn btn-primary cancel" method="get" action='{!! route("getregionesestaciones") !!}' >Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
      </div>
    </div>
  </div>
</div>
                </div>

    @stop
    @section('footer')
    <script type="text/javascript">
    var ListTable;
    $(document).ready(function () {
        ListTable = $('#regionesestaciones-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("getregionesestaciones") !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'region', name: 'region'},
            {data: 'estacion', name: 'estacion'},
            {data: 'estaactivo', name: 'estaactivo'},
            {data: 'action', name: 'action',searchable:false}
        ],
        order: [[1, 'asc']]
    });
        });


   </script>
   <script type="text/javascript">
     setTimeout("$('.alert').fadeOut('slow')", 8000)
      </script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    @stop
