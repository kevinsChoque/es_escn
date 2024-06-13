<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TSolicitud;

class SolicitudController extends Controller
{
    public function actSolicitud(Request $req)
    {
    	return view('solicitud.solicitud');
    }
    public function actRegistrar(Request $req)
    {
    	return view('solicitud.registrar');
    }
    public function actGuardar(Request $req)
    {
    	// dd($req->all());
        $req['estado']='1';
        $req['fr']=now();
        $ts=TSolicitud::create($req->all());
        if($ts!=null)
        {   return response()->json(["msg"=>"Operacion exitosa.","estado"=>true,]);}
        return response()->json(["msg"=>"No fue posible registrar los datos.","estado"=>false]);
    }
    public function actListar()
    {
        $registros = TSolicitud::select('solicitud.*')
            ->where('solicitud.estado','!=','0')
            ->orderBy('solicitud.idSol', 'DESC')
            ->get();
        return response()->json([
                "data"=>$registros,
            ]);
    }
}
