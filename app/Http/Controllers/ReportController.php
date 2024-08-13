<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function actShowReport()
    {
        return view('report.report');
    }
    public function actAdvanceCuts()
    {
        $sqlOnlyCuts = "select c.idAss,count(c.idCou) as cant,t.name,a.cant as total
            from court c
                left join activation ac on c.idCou=ac.idCou
                inner join assign a on c.idAss=a.idAss
                inner join tecnical t on a.idTec=t.idTec
            where ac.idAct is null
            group by c.idAss,t.name,a.cant
            order by c.idAss;";
        $sqlOnlyCuts = "select c.idAss,count(c.idCou) as cant,t.name,a.cant as total
            from court c
                left join activation ac on c.idCou=ac.idCou
                LEFT join assign a on c.idAss=a.idAss
                left join tecnical t on a.idTec=t.idTec
            where ac.idAct is null
            group by c.idAss,t.name,a.cant;";
        $sqlOnlyAct = "SELECT idAss,count(idAct) cantAct FROM activation group by idAss;";
		// dd($sql);
		$recordsOnlyCuts = DB::select($sqlOnlyCuts);
		$recordsOnlyAct = DB::select($sqlOnlyAct);
        // dd($recordsOnlyCuts);
		return response()->json(["recordsOnlyCuts"=>$recordsOnlyCuts, "recordsOnlyAct"=>$recordsOnlyAct]);
    }
}


// select c.idAss,count(c.idCou) as cant
// from court c
// 	left join activation ac on c.idCou=ac.idCou
// group by c.idAss;
