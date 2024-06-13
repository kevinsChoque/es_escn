<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\TTecnical;
use App\Models\TAssign;

class LoginController extends Controller
{
    public function actSigin(Request $r)
    {
        // dd($r->all());
    	$tec = TTecnical::where('dni',$r->dni)->first();

        if($tec != null)
        {
            $assign = TAssign::where('idTec',$tec->idTec)->orderby('idTec','desc')->first();
            session(['tecnical' => $tec]);
            session(['assign' => $assign]);
            return response()->json(['estado' => true, 'message' => 'ok']);
        }
        else
            return response()->json(['estado' => false, 'message' => 'Ocurrio un error en el ingreso']);
    }
}
