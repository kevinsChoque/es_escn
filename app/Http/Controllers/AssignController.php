<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\TAssign;

class AssignController extends Controller
{
    public function actListAssign()
    {
        // $list = TAssign::all();
        // dd($activePeriod);
        $sql = "select t.*, a.month, a.flat, a.idAss
            from assign a
                inner join tecnical t on a.idTec=t.idTec
                inner join ending e on e.idEnd=a.idEnd
            where e.state=1";
            // dd($sql);
        $list=DB::select($sql);

        return response()->json(['state' => true, 'data' => $list]);
    }
    public function actDeleteAssign(Request $r)
    {
        // eliminar un registro segun idass en la tabla assign, asiendo uso de eloquent y verificando con un if la eliminacion
        // $assign = TAssign::find($r->idAss);
        // if($assign)
        // {
        //     if($assign->delete())
        //     {
        //         return response()->json(['state' => true, 'data' => $assign]);
        //     }

        // }
        // else
        //     return response()->json(['state' => false, 'data' => $assign]);
    }
}
