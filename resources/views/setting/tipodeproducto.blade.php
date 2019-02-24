@extends('layouts.master')
@section('head')
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
    <script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
    <script src="{{asset('assets/js/angular.js')}}" ></script>
    <script stype="text/javascript">
    var ngProductosApp = angular.module('ngProductosApp', [], function($interpolateProvider)
       {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
       ngProductosApp.controller('ngtipodeproductoController', function($scope) {
       $scope.producto=[];
       $('#tipodeproducto-form').Edit({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'tipodeproducto',ModuleItemName:'producto',NgAppName:'ngProductosApp'});
       $('#tipodeproducto-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'producto',ModuleItemName:'producto',NgAppName:'ngProductosApp'});
  });
</script>
@stop
@section('content')
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Parametrización de :
                                <small>Lista de Productos </small>
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
                                    <h2>Gestión de Productos </h2>
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
                                <table class="table table-striped responsive-utilities jambo_table dataTable" id="tipodeproducto-table">
                                    <thead>
                                        <tr>
                                         <th>Id</th>
                                         <th>Descripción</th>
                                         <th>Está Activo</th>
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
        <h4 class="modal-title" id="myLargeModalLabel">Productos
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
       <form  ng-app="ngProductosApp" ng-controller="ngtipodeproductoController" id="tipodeproducto-form" class="form-horizontal form-label-left" method="post" action='{!! route("tipodeproductocreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripcion : <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input ng-model='tipodeproducto.descripcion' value="<% producto.descripcion %>" id="descripcion"  type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripción del Producto" required="" />
                             </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Está Activo : </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='producto.estaactivo'  value="<% producto.estaactivo %>" id="estaactivo"  type="checkbox"  name='estaactivo'  ><ul class="parsley-errors-list" ></ul>
                         </div>
                        </div>

                      <input ng-model='producto.id' type="text" id="id" name="id" style="display: none" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset"  class="btn btn-primary cancel" method="get" action='{!! route("gettipodeproducto") !!}' >Cancelar</button>
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
        ListTable = $('#tipodeproducto-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("gettipodeproducto") !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'descripcion', name: 'descripcion'},
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
