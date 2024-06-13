<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function actBPorInscripcion(Request $req)
    {
        // dd('aki es');
        $serverName = 'informatica2-pc\sicem_bd';
        $connectionInfo = array(
            "Database"=>"SICEM_AB",
            "UID"=>"comercial",
            "PWD"=>"1",
            "CharacterSet"=>"UTF-8"
        );
        $conn_sis = sqlsrv_connect($serverName,$connectionInfo);
        if($conn_sis)
        {
            $sql = "select * from regsoli where SolInscri='00000138'";
            $stmt = sqlsrv_query($conn_sis, $sql); 
            $arreglo = array(); 
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
            {
                $arreglo[] = $row;
            }
            return response()->json([
                "data"=>$arreglo,
                "msg"=>"Datos traidos exitosamente.",
                "estado"=>true
            ]);
        }
        else
        {   return response()->json(["msg"=>"Error en la conexion a la BD principal.","estado"=>false]);}
    }
}
