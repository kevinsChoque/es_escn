<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function connectionSql()
    {
        $serverName = 'KEVIN-O3VME56';
        $connectionInfo = array("Database"=>"sicem_ab_local","CharacterSet"=>"UTF-8");
        return sqlsrv_connect($serverName, $connectionInfo);
    }
}
