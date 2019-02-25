@extends('layouts.master')
@section('head')
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
    <script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
    <script src="{{asset('assets/js/angular.js')}}" ></script>
    <script stype="text/javascript">
    var ngProductoFaseElementoRangosApp = angular.module('ngProductoFaseElementoRangosApp', [], function($interpolateProvider)
       {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
       ngProductoFaseElementoRangosApp.controller('ngproductofaseelementorangosController', function($scope) {
       $scope.productofaseelementorango=[];
       $scope.tipodeproductos={!! $tipodeproductos !!};
       $scope.fasefenologicas={!! $fasefenologicas !!};
       $scope.tipodealturas={!! $tipodealturas !!};
       $scope.tipodealertas={!! $tipodealertas !!};
       $scope.elementos={!! $elementos !!};

       $('#productofaseelementorangos-form').Edit({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'productofaseelementorangos',ModuleItemName:'productofaseelementorango',NgAppName:'ngProductoFaseElementoRangosApp'});
       $('#productofaseelementorangos-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'productofaseelementorango',ModuleItemName:'productofaseelementorango',NgAppName:'ngProductoFaseElementoRangosApp'});
  });
</script>
@stop
@section('content')
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Parametrización de :
                                <small>Lista de Productos por fase fenológica ,elemento y rangos</small>
                            </h3>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Gestión de Productos por fase fenologica ,elemento y rangos.</h2>
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
                                <table class="table table-striped responsive-utilities jambo_table dataTable" id="productofaseelementorangos-table">
                                    <thead>
                                        <tr>
                                         <th>ID</th>
                                         <th>Producto</th>
                                         <th>Fase Fenológica </th>
                                          <th>Elemento</th>
                                          <th>Altura</th>
                                          <th>Alerta</th>
                                          <th>Valor Minimo</th>
                                          <th>Valor Maximo</th>
                                          <th>Esta Activo</th>
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
        <h4 class="modal-title" id="myLargeModalLabel">Productos por fase fenologica ,elemento y rangos
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
       <form  ng-app="ngProductoFaseElementoRangosApp" ng-controller="ngproductofaseelementorangosController" id="productofaseelementorangos-form" class="form-horizontal form-label-left" method="post" action='{!! route("productofaseelementorangocreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                              <label for="tipodeproducto" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Producto :</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name="tipodeproductos" id="tipodeproductos" class="form-control">
                                      <option ng-selected="productofaseelementorango.tipodeproducto_id==tipodeproducto.id" ng-repeat="tipodeproducto in tipodeproductos" value="<% tipodeproducto.id %>" ><% tipodeproducto.descripcion %></option>
                                  </select>
                             </div>
                       </div>
                        <div class="form-group">
                            <label for="fasefenologica" class="control-label col-md-3 col-sm-3 col-xs-12">Fase Fenológica :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="fasefenologicas" id="fasefenologicas" class="form-control">
                                    <option ng-selected="productofaseelementorango.fasefenologica_id==fasefenologica.id" ng-repeat="fasefenologica in fasefenologicas" value="<% fasefenologica.id %>" ><% fasefenologica.descripcion %></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="elemento" class="control-label col-md-3 col-sm-3 col-xs-12">Elementos :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="elementos" id="elementos" class="form-control">
                                    <option ng-selected="productofaseelementorango.elementos_id==elemento.id" ng-repeat="elemento in elementos" value="<% elemento.id %>" ><% elemento.descripcion %></option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="tipodealtura" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo De Altura :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="tipodealturas" id="tipodealturas" class="form-control">
                                    <option ng-selected="productofaseelementorango.tipodealtura_id==tipodealtura.id" ng-repeat="tipodealtura in tipodealturas" value="<% tipodealtura.id %>" ><% tipodealtura.descripcion %></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipodealerta" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo De Alerta :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="tipodealertas" id="tipodealertas" class="form-control">
                                    <option ng-selected="productofaseelementorango.tipodealerta_id==tipodealerta.id" ng-repeat="tipodealerta in tipodealertas" value="<% tipodealerta.id %>" ><% tipodealerta.descripcion %></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Valor Mínimo Requerido : <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input  ng-model='productofaseelementorango.valorminimo' value="<% productofaseelementorango.valorminimo %>" id="valorminimo"  type="number" placeholder="0" required name="valorminimo" min="0" value="0" step="0.01" title="Currency" pattern="^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$/.test(this.value)?'inherit':'red'">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Valor Maximo Requerido : <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input  ng-model='productofaseelementorango.valormaximo' value="<% productofaseelementorango.valormaximo %>" id="valormaximo"  type="number" placeholder="0" required name="valormaximo" min="0" value="0" step="0.01" title="Currency" pattern="^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$/.test(this.value)?'inherit':'red'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Está Activo: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='productofaseelementorango.estaactivo'  value="<% productofaseelementorango.estaactivo %>" id="estaactivo"  type="checkbox"  name='estaactivo'  ><ul class="parsley-errors-list" ></ul>
            </div>
                        </div>

<input ng-model='productofaseelementorango.id' type="text" id="id" name="id" style="display: none" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset"  class="btn btn-primary cancel" method="get" action='{!! route("getproductofaseelementorangos") !!}' >Cancelar</button>
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
        ListTable = $('#productofaseelementorangos-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("getproductofaseelementorangos") !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'tipodeproducto', name: 'tipodeproducto'},
            {data: 'fasefenologica', name: 'fasefenologica'},
            {data: 'elemento', name: 'elemento'},
            {data: 'tipodealtura', name: 'tipodealtura'},
            {data: 'tipodealerta', name: 'tipodealerta'},
            {data: 'valorminimo', name: 'valorminimo'},
            {data: 'valormaximo', name: 'valormaximo'},
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
