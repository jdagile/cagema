@extends('layouts.master')
@section('head')
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
    <script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
    <script src="{{asset('assets/js/angular.js')}}" ></script>
    <script stype="text/javascript">
    var ngRolesApp = angular.module('ngRolesApp', [], function($interpolateProvider)
       {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
       ngRolesApp.controller('ngRolesController', function($scope) {
       $scope.role=[];
       $scope.role.perms=[];
       $scope.master=[3];
       $scope.permissions=JSON.parse('{!! $perms !!}');
        $('#roles-form').Edit({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'roles',ModuleItemName:'role',NgAppName:'ngRolesApp',callback:function(){
        $scope.role.perms = $.map($scope.role.perms, function(value, index) {return value.id;});
        }});
       $('#roles-form').Delete({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'roles',ModuleItemName:'role',NgAppName:'ngRolesApp'});
       $('#roles-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'roles',ModuleItemName:'role',NgAppName:'ngRolesApp'});
    });
</script>
@stop
@section('content')
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Roles
                                <small>
                                    Users's Roles
                                </small>
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
                                    <h2>Manage Roles</h2>
                                    <button class="btn btn-primary form-modal-button" data-toggle="modal" data-target=".form-modal">Add New Role</button>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <table class="table table-striped responsive-utilities jambo_table dataTable" id="roles-table">
                                    <thead>
                                        <tr>
                                         <th>ID</th>
                                         <th>Nombre</th>
                                         <th>Nombre desplegable</th>
                                         <th>Descripción</th>
                                         <th>Creado</th>
                                         <th>Editado</th>
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
        <h4 class="modal-title" id="myLargeModalLabel">Role Name
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
        <form  ng-app="ngRolesApp" ng-controller="ngRolesController" id="roles-form" class="form-horizontal form-label-left" method="post" action='{!! route("rolescreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='role.name' type="text" id="name" name='name' required="required" class="form-control col-md-7 col-xs-12" >
                                <label class='danger alert-danger' ng-repeat='nameError in moduleerrors.name' ng-bind='nameError'></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Display Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='role.display_name' type="text" id="display_name" name='display_name' required="required" class="form-control col-md-7 col-xs-12" >
                                <label class='danger alert-danger' ng-repeat='display_nameError in moduleerrors.display_name' ng-bind='display_nameError'></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='role.description' type="text" id="description" name='description' required="required" class="form-control col-md-7 col-xs-12" >
                                <label class='danger alert-danger' ng-repeat='descriptionError in moduleerrors.description' ng-bind='descriptionError'></label>
                            </div>
                        </div>
                        <div class="form-group" ng-repeat="permission in permissions track by $index">
                            <div class="checkbox">
                                <label>
                                    <!--role.perms.indexOf(permission.id) > -1 -->
                                    <input type="checkbox" name="permissions[]"   ng-checked="role.perms.indexOf(permission.id )> -1" value="<% permission.id %>"> <% permission.display_name %>
                                </label>
                            </div>
                          </div>
                        <input ng-model='role.id' type="text" id="id" name="id" style="display: none" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset" class="btn btn-primary cancel">Cancelar</button>
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
        ListTable = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("getroles") !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'},
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'actions', name: 'actions','searchable':false}
        ],
        order: [[1, 'asc']]
    });
        });

   </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    @stop
