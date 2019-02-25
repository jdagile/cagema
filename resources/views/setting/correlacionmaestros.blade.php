@extends('layouts.master')
@section('head')
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
    <script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
    <script src="{{asset('assets/js/angular.js')}}" ></script>
    <script stype="text/javascript">
    var ngCorrelacionMaestrosApp = angular.module('ngCorrelacionMaestrosApp', [], function($interpolateProvider)
       {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
       ngCorrelacionMaestrosApp.controller('ngcorrelacionmaestrosController', function($scope) {
       $scope.correlacionmaestro=[];
       $scope.tipodeproductos={!! $tipodeproductos !!};
       $scope.fasefenologicas={!! $fasefenologicas !!};
       $scope.alertasgenerales={!! $alertasgenerales !!};

       $('#correlacionmaestros-form').Edit({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'correlacionmaestros',ModuleItemName:'correlacionmaestro',NgAppName:'ngCorrelacionMaestrosApp'});
       $('#correlacionmaestros-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'correlacionmaestro',ModuleItemName:'correlacionmaestro',NgAppName:'ngCorrelacionMaestrosApp'});
  });
</script>
@stop
@section('content')
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Parametrización de :
                                <small>Lista de Correlación</small>
                            </h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Gestión de Correlacion General.</h2>
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
                                <table class="table table-striped responsive-utilities jambo_table dataTable" id="correlacionmaestros-table">
                                    <thead>
                                        <tr>
                                         <th>ID</th>
                                         <th>Producto</th>
                                         <th>Fase Fenológica </th>
                                          <th>Alerta</th>
                                          <th>Descripción</th>
                                          <th>Está Activo</th>
                                          <th>Acción</th>
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
        <h4 class="modal-title" id="myLargeModalLabel">Correlación
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
       <form  ng-app="ngCorrelacionMaestrosApp" ng-controller="ngcorrelacionmaestrosController" id="correlacionmaestros-form" class="form-horizontal form-label-left" method="post" action='{!! route("correlacionmaestrocreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                              <label for="tipodeproducto" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Producto :</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name="tipodeproductos" id="tipodeproductos" class="form-control">
                                      <option ng-selected="correlacionmaestro.tipodeproducto_id==tipodeproducto.id" ng-repeat="tipodeproducto in tipodeproductos" value="<% tipodeproducto.id %>" ><% tipodeproducto.descripcion %></option>
                                  </select>
                             </div>
                       </div>
                        <div class="form-group">
                            <label for="fasefenologica" class="control-label col-md-3 col-sm-3 col-xs-12">Fase Fenológica :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="fasefenologicas" id="fasefenologicas" class="form-control">
                                    <option ng-selected="correlacionmaestro.fasefenologica_id==fasefenologica.id" ng-repeat="fasefenologica in fasefenologicas" value="<% fasefenologica.id %>" ><% fasefenologica.descripcion %></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alertageneral" class="control-label col-md-3 col-sm-3 col-xs-12">Alerta :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="alertasgenerales" id="alertasgenerales" class="form-control">
                                    <option ng-selected="correlacionmaestro.alertasgenerales_id==alertageneral.id" ng-repeat="alertageneral in alertasgenerales" value="<% alertageneral.id %>" ><% alertageneral.descripcion %></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripcion : <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input ng-model='correlacionmaestro.descripcion' value="<% correlacionmaestro.descripcion %>" id="descripcion"  type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripción del Producto" required="" />
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Está Activo: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='correlacionmaestro.estaactivo'  value="<% correlacionmaestro.estaactivo %>" id="estaactivo"  type="checkbox"  name='estaactivo'  ><ul class="parsley-errors-list" ></ul>
            </div>
                        </div>
<input ng-model='correlacionmaestro.id' type="text" id="id" name="id" style="display: none" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset"  class="btn btn-primary cancel" method="get" action='{!! route("getcorrelacionmaestros") !!}' >Cancelar</button>
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
        ListTable = $('#correlacionmaestros-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("getcorrelacionmaestros") !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'tipodeproducto', name: 'tipodeproducto'},
            {data: 'fasefenologica', name: 'fasefenologica'},
            {data: 'alerta', name: 'alerta'},
            {data: 'descripcion', name: 'descripcion'},
            {data: 'estaactivo', name: 'estaactivo'},
            {data: 'action', name: 'action',searchable:false}
        ],

    });
        });


   </script>
   <script type="text/javascript">
     setTimeout("$('.alert').fadeOut('slow')", 8000)
      </script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    @stop
