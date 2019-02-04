<?php
namespace App\Http\Controllers;

use App\User;
Use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

Class AdminController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function DashBoard()
    {
	    $humedad_relativa = app('App\Http\Controllers\EstacionesAlertasControler')->humedad_relativa();
        $temperatura_ambiente = app('App\Http\Controllers\EstacionesAlertasControler')->temperatura_ambiente();
        $UsersCount=User::count();
        $UsersCountLasWeekPercentage=$UsersCount*(User::where('created_at','>=',  date('Y-m-d',strtotime(date('Y-m-d').'-1 month')) )->count())/100;
        return view('dashboard',array('UsersCount'=>$UsersCount,'UsersCountLasWeekPercentage'=>$UsersCountLasWeekPercentage,'humedad_relativa'=>$humedad_relativa,'temperatura_ambiente'=>$temperatura_ambiente));
    }

    public function FileManage()
    {
        return view('filemanage');
    }
}

?>
