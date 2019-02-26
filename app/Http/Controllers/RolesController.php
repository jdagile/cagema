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
use App\PermissionRole;

Class RolesController extends Controller
{

    public $Now;

    public function __construct()
    {
        parent::__construct();
        $this->Now = date('Y-m-d H:i:s');
    }

    //Role Manipulation
    private function createRole(Request $request)
    {
        $RoleName = $request->input('name');
        $Slug = $request->input('slug');
        $Description = $request->input('description');
        $Level = $request->input('level');
        $adminRole = Role::create(['name' => $RoleName, 'slug' => $Slug, 'description' => $Description, 'level' => $Level,]);
    }

    private function EditRole(Request $request)
    {

        $ID = $request->input('id');
        $RoleName = $request->input('name');
        $Slug = $request->input('slug');
        $Description = $request->input('description');
        $Level = $request->input('level');
        Role::where('id', $ID)->update(['name' => $RoleName, 'slug' => $Slug, 'description' => $Description, 'level' => $Level]);
    }

    private function DeleteRole(Request $request)
    {
        $id = explode(',', $request->input('id'));
        Role::whereIn('id', $id)->delete();
    }

    public function Roles()
    {
        $Permissions = Permission::all();
        return View('users/roles', array('perms' => $Permissions->toJson()));
    }

    public function GetRoles()
    {
        $Roles = Role::all();
        return Datatables::of($Roles)->addColumn('actions', function ($Roles) {
                $column = '<a href="javascript:void(0)"  data-url="' . route('rolesedit', $Roles->id) . '" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';

                return $column;
            })->make(true);
    }

    public function Edit($ID)
    {
//        $Permissions=PermissionRole::select('permission_id')->where('role_id',$ID)->get();
//        foreach($Permissions as $permission):
//            $FinalPermission[]=$permission->permission_id;
//        endforeach;
//        print_r($FinalPermission);die();
        echo Role::with('perms')->where('id', $ID)->get()->toJson();
    }

    public function Delete($ID)
    {
        Role::where('id', $ID)->delete();
    }

    public function CreateOrUpdate(Request $request)
    {

        $All_input = $request->input();
        $ValidationResult = $this->ValidateCreateUpdate($request);
        if ($ValidationResult->fails()):
            return response()->json($ValidationResult->errors(), 404);
        else:
            if ($request['id'] != ''):
                $Role = Role::where('id', $All_input['id'])->first();
                $Role->name = $All_input['name'];
                $Role->display_name = $All_input['display_name'];
                $Role->description = $All_input['description'];
                $Role->save();
            //Role::where('id',$All_input['id'])->update(array('name'=>$All_input['name'],'display_name'=>$All_input['display_name'],'description'=>$All_input['description']));
            else:
                $Role = new Role();
                $Role->name = $All_input['name'];
                $Role->display_name = $All_input['display_name'];
                $Role->description = $All_input['description'];
                $Role->save();
            //Role::insert(array('name'=>$All_input['name'],'display_name'=>$All_input['display_name'],'description'=>$All_input['description']));
            endif;
            if (isset($All_input['permissions']) && count($All_input['permissions']) > 0):
                $Role->perms()->sync($All_input['permissions']);
            else:
                $Role->perms()->sync([]);
            endif;

        endif;
    }

    protected function ValidateCreateUpdate(Request $request)
    {
        return Validator::make($request->all(), ['name' => 'required|max:255', 'display_name' => 'required|max:255', 'description' => 'required|max:255']);
    }
}
