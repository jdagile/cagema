@extends('layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
<script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
<script src="{{asset('assets/js/angular.js')}}" ></script>
<script stype="text/javascript">
    var ngUsersApp = angular.module('ngUsersApp', [], function($interpolateProvider)
        {$interpolateProvider.startSymbol('<%');$interpolateProvider.endSymbol('%>');});
        ngUsersApp.controller('ngUsersController', function($scope) {
        $scope.user=[];
        $scope.roles={!! $roles !!};
        $scope.regions={!! $regions !!};
        $('#users-form').Edit({Type:'GET',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'users',ModuleItemName:'user',NgAppName:'ngUsersApp'});
       $('#users-form').Submit({Type:'POST',Data:{'_token':'<?php echo csrf_token();?>'},ModuleName:'users',ModuleItemName:'user',NgAppName:'ngUsersApp'});

    });
</script>
@stop
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Gestión de Usuarios</h3>
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
                    <h2>Lista de Usuarios</h2>
                    <button class="btn btn-primary form-modal-button" data-toggle="modal" data-target=".form-modal">Agregar nuevo usuario</button>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table dataTable" id="users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>E-mail</th>
                                <th>Creado</th>
                                <th>Editado At</th>
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
        <h4 class="modal-title" id="myLargeModalLabel">Gestión de Usuarios
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
       <form  ng-app="ngUsersApp" ng-controller="ngUsersController" id="users-form" class="form-horizontal form-label-left" method="post" action='{!! route("userscreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de Usuario <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='user.name' type="text" id="name" name='name' required="required" class="form-control col-md-7 col-xs-12" ><ul class="parsley-errors-list" ></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo Electronico<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input ng-model='user.email' type="text" id="email" name="email"  autocomplete="new-email" required="required" class="form-control col-md-7 col-xs-12" ><ul class="parsley-errors-list" ></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="password" autocomplete="new-password" ><ul class="parsley-errors-list" ></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="control-label col-md-3 col-sm-3 col-xs-12">Rol</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="roles" id="roles" class="form-control">
                                    <option ng-selected="user.roles[0].id==role.id" ng-repeat="role in roles" value="<% role.id %>" ><% role.display_name %></option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="region" class="control-label col-md-3 col-sm-3 col-xs-12">Región</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="regions" id="regions" class="form-control">
                                    <option ng-selected="user.regions_id==region.id" ng-repeat="region in regions" value="<% region.id %>" ><% region.descripcion %></option>
                                </select>
                            </div>

                        </div>



                        <input ng-model='user.id' type="text" id="id" name="id" style="display: none" />
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
    $(document).ready(function() {

        ListTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("userslist") !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
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
