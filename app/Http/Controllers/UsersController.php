<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
Use App\User;
Use App\Role;
Use App\Region;
Use App\Permission;
Use App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Storage;
use Illuminate\Support\Facades\File;

Class UsersController extends Controller
{

    public $Now;

    public function __construct()
    {
        parent::__construct();
        $this->Now = date('Y-m-d H:i:s');
    }

    public function Login()
    {
          $Regions=Region::where('estaactivo', true)->get();
        return view('auth.login' ,array('regions' => $Regions->toJson() ));
    }

    public function Login1()
    {
        return view('auth.login1');
    }
    public function auth(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $UserInfo = User::where('email', $request->input('email'))->first();
            Session::put('name', $UserInfo->name);
              Session::put('email', $UserInfo->email);
              Session::put('region_id', $UserInfo->regions_id);
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function Logout()
    {
        Auth::logout();
        Session::forget('email');
        return redirect('/login');
    }

    public function register()
    {
      $Roles = Role::all();
      $Regions= Region::all();
        return View('auth/register');
    }

    public function RegisterPost(Request $request)
    {

        $user = new User();
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->image = 'img.jpg';
        $user->remember_token   = str_random(60);
       $user->save();
        $user->roles()->sync(array(3));
        $url = route('confirmation',['token'=> $user->remember_token]);

       Mail::send('emails/registration',compact('user','url'),function($m) use($user) {
         $m->to($user->email,$user->name )->subject('Activa tu cuenta desde tu correo electrónico ');
       });

       //Session::flash('flash_message', 'Activa tu cuenta desde tu correo electrónico!');
       //Session::flash('flash_type', 'alert-success');
       return redirect('/login')->with('alert','Te enviamos un correo electrónico de confirmación!') ;

    }

  protected function  getConfirmation($token)
  {

      try {
           $user = User::where('remember_token',$token)->firstOrFail();
           $user->remember_token =null;
           $user->save();
              return redirect('/login')->with('alert','El Correo se confirmo correctamente, puedes iniciar Sessión!') ;

         }
         catch (\Exception $e) {
                                 return $e->getMessage();
                                }

  }





    public function RegisterUserToAdmin()
    {
        $Users=User::select('id')->get();
        foreach($Users as $User):
            $User=User::where('id',$User->id)->first();
            $User->roles()->sync(array(2));
        endforeach;
    }
    public function Index()
    {
        $Roles = Role::all();
        $Regions= Region::all();
        return View('users/users', array('roles' => $Roles->toJson() ,'regions' => $Regions->toJson()  ));
    }

    public function All()
    {
        $Users = User::all();
        return Datatables::of($Users)->addColumn('actions', function ($Users) {
                $column = '<a href="javascript:void(0)"  data-url="' . route('usersedit', $Users->id) . '" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';

                return $column;
            })->make(true);
    }

    public function Edit($ID)
    {
        echo User::with('Roles')->where('id', $ID)->get()->toJson();
    }

    public function UsuarioPorEmail($EMAIL)
    {

          $User = User::where('email', $EMAIL)->first();
         return  $User->id ;
    }

    public function CreateOrUpdate(Request $request)
    {
        $All_input = $request->input();
        if ($request['id'] != ''):
            $User = User::where('id', $All_input['id'])->first();
            $User->name = $All_input['name'];
            $User->email = $All_input['email'];
              $User->regions_id = $All_input['regions'];
            if ($All_input['password'] != ''):
                $User->password = Hash::make($All_input['password']);
            endif;
            $User->save();
        else:
            $User = new User();
            $User->name = $All_input['name'];
            $User->email = $All_input['email'];
            $User->password = Hash::make($All_input['password']);
              $User->regions_id = $All_input['regions'];
            $User->save();
        endif;
        $User->roles()->sync(array($All_input['roles']));
    }

    public function Delete($ID)
    {
        User::where('id', $ID)->delete();
    }

    public function GetResellers()
    {
        $users = User::all();
        return View('users/users', array('users' => $users));
    }

    public function Profile()
    {
          $Regions= Region::all();
        $User = Auth::user();
        return View('profile', array('user' => $User->toJson(),'regions' => $Regions->toJson() ));
    }

    public function ProfileUpdate(Request $request)
    {
        $All_input = $request->input();
        if ($request['id'] != ''):
            $User = User::where('id', $All_input['id'])->first();
            $User->name = $All_input['name'];
            $User->email = $All_input['email'];
            $User->regions_id = $All_input['regions'];

            if ($All_input['password'] != ''):
                $User->password = Hash::make($All_input['password']);
            endif;
            if ($request->file('image')):
                $User->image = $this->UploadProfilePic($request);
            endif;
            $User->save();
        endif;



    }

    protected function UploadProfilePic(Request $request)
    {
        $Image = $request->file('image');
        $Extension = $Image->getClientOriginalExtension();
        $path = $Image->getFilename() . '.' . $Extension;
        Storage::disk('public_folder')->put($path, File::get($request->file('image')));
        return $path;
    }
}

?>
