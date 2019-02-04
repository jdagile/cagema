@extends('layouts.master')

@section('head')
<script src="{{asset('assets/js/angular.js')}}" ></script>
    <!-- PNotify -->
    <script type="text/javascript" src="{{ asset('assets/js/notify/pnotify.core.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/notify/pnotify.buttons.js')}} "></script>
    <script type="text/javascript" src="{{ asset('assets/js/notify/pnotify.nonblock.js')}}"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" />
<script stype="text/javascript">
    var ngModulesApp = angular.module('ngModulesApp', [], function($interpolateProvider)
    {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    ngModulesApp.controller('ngModulesController', function($scope) {
        $scope.module_title = 'Modulos Builder';
        $scope.page_title = 'Todos los Modulos';
        $scope.fieldtypes =<?php echo $field_types; ?>;

        $scope.module=[];
        $('body').on('click','.edit',function(){
        var URL=$(this).attr('data-url');
            $.ajax({
                url:URL,
                type:'GET',
                data:{'_token':'<?php echo csrf_token();?>'},
                success:function(module){
                // Reset Form
                $('#modules-form')[0].reset();$scope.module=[];
                $scope.$apply();
                $scope.module=JSON.parse(module)[0];$scope.$apply();
                $('.bd-example-modal-lg').modal('show');
                }
            });
       });
       $('body').on('click','.delete',function(){
       var AjaxLoaderInt='';
       var percentage=10;
        var URL=$(this).attr('data-url');
            $.ajax({
                url:URL,
                type:'GET',
                data:{'_token':'<?php echo csrf_token();?>'},
                beforeSend:function(){
                    $('.ajaxLoader').show();
                    AjaxLoaderInt=setInterval(function(){
                        if(percentage<90)
                        {percentage=percentage+10;$('.ajaxLoader .progress .progress-bar').width(percentage+'%');}
                    },200);
                },
                success:function(module){
                $('.ajaxLoader .progress .progress-bar').width('100%');
                clearInterval('AjaxLoaderInt');
                // Reset Form
                $('#modules-form')[0].reset();$scope.module=[];$scope.$apply();
                new PNotify({title: 'Module Deleted Successfully',text: 'Page is going to reload !',type: 'success'});
                modules.ajax.reload();
                location.reload();
                }
            });
       });
       $('#modules-form').on('submit',function(e){
       e.preventDefault();
       $.ajax({
                url:$(this).attr('action'),
                type:'post',
                data:$(this).serialize(),
                success:function(){$('#modules-form')[0].reset();$scope.module=[];$scope.$apply();modules.ajax.reload();
                $('.bd-example-modal-lg').modal('hide');
                },
                error:function(moduleerrors){$scope.moduleerrors=moduleerrors.responseJSON;$scope.$apply();}
            });
       });
       $('.cancel').on('click',function(){
       $('.bd-example-modal-lg').modal('hide');
       });
    });

</script>
<link href="{{ asset('assets/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
<script type='text/javascript' src="{{ asset('assets/js/iconpicker.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/jquery.ui.pos.js') }}"></script>
<script type='text/javascript'>
    jQuery(document).ready(function(){
    $('#module_icon').iconpicker();
    });
    </script>
@stop

@section('content')
<?php //print_r($FinalTablesInfo);  ?>
<div class="" ng-app="ngModulesApp" ng-controller="ngModulesController">
    <div class="page-title">
        <div class="title_left">
            <h3 ng-bind="module_title"></h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 ng-bind="page_title"></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar Nuevo Modulo</button>
                    <table class="table table-striped responsive-utilities jambo_table dataTable" id="modules-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Modulo</th>
                                <th>Icono</th>
                                <th>Fecha Creación</th>
                                <th>Actiones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Form modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Nuevo / Editar Moduleo
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </h4>
      </div>
      <div class="modal-body">
        @include('modulebuilder.forms.add_new_module')
      </div>
    </div>
  </div>
</div>

</div>
@stop

@section('footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>-->
<script type='text/javascript'>
    var modules;
jQuery(document).ready(function(){
           modules = $('#modules-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            ajax: '{!! route("moduleslist") !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'module_name', name: 'module_name'},
                {data: 'module_icon', name: 'module_icon'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions','searchable':false}
            ],
            order: [[1, 'asc']]
        });
});
</script>

@stop
