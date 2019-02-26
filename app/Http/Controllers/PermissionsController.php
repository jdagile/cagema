<?php
namespace App\Http\Controllers;

Use App\User;
Use App\Role;
Use App\Permission;
Use App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;

Class PermissionsController extends Controller
{

    public $Now;

    public function __construct()
    {
        parent::__construct();
        $this->Now = date('Y-m-d H:i:s');
    }

    public function Permissions()
    {
        return View('users/permissions');
    }

    Public function CreatePermission()
    {

    }

    public function GetPermissions()
    {
        $permissions = Permission::orderBy('id', 'asc');
        return Datatables::of($permissions)->addColumn('action', function ($permissions) {
                $column = '<a href="javascript:void(0)" data-url="' . route('permissionsedit', $permissions->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
                              return $column;
            })->make(true);
    }

    public function MangePermissions()
    {
        return View('users/managepermissions');
    }

    public function Edit($ID)
    {
        echo Permission::where('id', $ID)->get()->toJson();
    }

    public function Delete($ID)
    {
        Permission::where('id', $ID)->delete();
    }

    public function CreateOrUpdate(Request $request)
    {
        $All_input = $request->input();
        $ValidationResult = $this->ValidateCreateUpdate($request);
        if ($ValidationResult->fails()):
            return response()->json($ValidationResult->errors(), 404);
        else:
            if ($request['id'] != ''):
                Permission::where('id', $All_input['id'])->update(array('name' => $All_input['name'], 'display_name' => $All_input['display_name'], 'description' => $All_input['description']));
            else:
                Permission::insert(array('name' => $All_input['name'], 'display_name' => $All_input['display_name'], 'description' => $All_input['description']));
            endif;
        endif;
    }

    protected function ValidateCreateUpdate(Request $request)
    {
        return Validator::make($request->all(), ['name' => 'required|max:255', 'display_name' => 'required|max:255', 'description' => 'required|max:255']);
    }
}
