<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\TAssign;

class CourtController extends Controller
{
    protected $month = [
        'Enero' => '01-01-2024',
        'Febrero' => '01-02-2024',
        'Marzo' => '01-03-2024',
        'Abril' => '01-04-2024',
        'Mayo' => '01-05-2024',
        'Junio' => '01-06-2024',
        'Julio' => '01-07-2024',
        'Agosto' => '01-08-2024',
        'Septiembre' => '01-09-2024',
        'Octubre' => '01-10-2024',
        'Noviembre' => '01-11-2024',
        'Diciembre' => '01-12-2024',
    ];
    public function formatCategories($categories)
    {
        $elements = explode(',', $categories);
        $quotedElements = array_map(function($element) {
            return "'" . $element . "'";
        }, $elements);
        return implode(',', $quotedElements);
    }
    public function actStart()
    {
        if(Session::get('tecnical')->type == 'admin')
            return view('start.start');
        else
            return view('tecnical.tecnical');
    }
    public function actShowCourtFilter(Request $r)
    {
        try {
            // $serverName = 'informatica2-pc\sicem_bd';
            // $connectionInfo = array(
            //     "Database" => "SICEM_AB",
            //     "UID" => "comercial",
            //     "PWD" => "1",
            //     "CharacterSet" => "UTF-8"
            // );
            $serverName = 'KEVIN-O3VME56';
            $connectionInfo = array("Database"=>"sicem_ab_local","CharacterSet"=>"UTF-8");
            $conn_sis = sqlsrv_connect($serverName, $connectionInfo);

            if ($conn_sis)
            {
                $script = "SELECT TF.PreMzn,TF.PreLote,TF.InscriNrx,TF.FacEstado, TF.FecPago,TF.FacTotal,I.CtaFacSal, I.CtaMesAct,I.CtaMesRec, I.CliproLeg, C.CodTipSer
                    FROM TOTFAC TF
                    INNER JOIN CONEXION c ON TF.InscriNrx=c.InscriNro
                    left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
                WHERE I.CliproLeg='CORTADOABRIL24' AND TF.FacFecFac='01-03-2024'";

                $script = "select c.PreMzn, c.PreLote,t.InscriNrx, c.Clinomx as cli,rz.CalTip, rz.CalDes,i.Tarifx, T.FMedidor,i.CtaMesAct, i.CtaFacSal, c.CodTipSer, t.FConsumo
                    from TOTFAC t INNER JOIN
                    CONEXION c ON t.InscriNrx=c.InscriNro
                    left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
                    left outer join rzcalle rz ON rz.calcod = c.precalle
                where t.FacFecFac='01-03-2024' and t.FacEstado=0 and i.CtaMesAct>=2";

                $script = "select top 666 c.PreMzn as code, c.PreLote as cod,t.InscriNrx as numberInscription, c.Clinomx as client,rz.CalTip as streetType,
                rz.CalTip + ' ' + rz.CalDes as streetDescription,i.Tarifx as rate, T.FMedidor as meter,i.CtaMesAct as monthDebt, i.CtaFacSal as amount, c.CodTipSer as serviceEnterprise, t.FConsumo as consumption
                    from TOTFAC t INNER JOIN CONEXION c ON t.InscriNrx=c.InscriNro
                    left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
                    left outer join rzcalle rz ON rz.calcod = c.precalle
                    where t.FacFecFac='01-03-2024' and t.FacEstado=0 and i.CtaMesAct>=2";

                $stmt = sqlsrv_query($conn_sis, $script);
                $arreglo = array();
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
                {   $arreglo[] = $row;}
                return response()->json(['estado' => true,"data"=>$arreglo]);
            }
            else
            {
                dd('No se pudo establecer la conexión');
            }
        } catch (QueryException $e) {
            dd('Error en la conexión: ' . $e->getMessage());
        }
    }
    public function actSearchRecords(Request $r)
    {
        // dd($r->all(),$this->month[$r->month], gettype($r->services));
        // dd($this->formatCategories($r->categories));
        try {
            // $serverName = 'informatica2-pc\sicem_bd';
            $serverName = 'KEVIN-O3VME56';
            // $connectionInfo = array(
            //     "Database" => "sicem_ab_local",
            //     "UID" => "comercial",
            //     "PWD" => "1",
            //     "CharacterSet" => "UTF-8"
            // );
            $connectionInfo = array("Database"=>"sicem_ab_local","CharacterSet"=>"UTF-8");
            $conn_sis = sqlsrv_connect($serverName, $connectionInfo);

            if ($conn_sis)
            {
                $conRoutes = " and c.PreMzn in (".$r->routes.") ";
                $conMonth = " and t.FacFecFac='".$this->month[$r->month]."' ";
                $conMonthDebt = " and i.CtaMesAct=".$r->monthDebt." ";
                $conMonthDebt = $r->monthDebt==3 ? " and i.CtaMesAct >=".$r->monthDebt." " : " and i.CtaMesAct=".$r->monthDebt." ";
                $conStateReceipt = " and t.FacEstado=".$r->stateReceipt." ";
                // $conCategory = $r->category!='all' ? " and LEFT(i.Tarifx, 1) = '".$r->category."' ":'';
                $categories = $this->formatCategories($r->categories);
                $conCategory = strpos($r->categories, 'all') !== false ? " " : " and LEFT(i.Tarifx, 1) in (".$categories.") ";
                $conServices = strpos($r->services, 'all') !== false ? " and c.CodTipSer in (1,2,3) " : " and c.CodTipSer in (".$r->services.") ";

                $script = "select c.PreMzn as code, c.PreLote as cod,t.InscriNrx as numberInscription, c.Clinomx as client,rz.CalTip as streetType,
                rz.CalTip + ' ' + rz.CalDes as streetDescription,i.Tarifx as rate, T.FMedidor as meter,i.CtaMesAct as monthDebt, i.CtaFacSal as amount, c.CodTipSer as serviceEnterprise, t.FConsumo as consumption
                    from TOTFAC t INNER JOIN CONEXION c ON t.InscriNrx=c.InscriNro
                    left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
                    left outer join rzcalle rz ON rz.calcod = c.precalle
                    where t.InscriNrx is not null and i.CourtEscn is null ".$conRoutes.$conMonth.$conMonthDebt.$conStateReceipt.$conCategory.$conServices;
                    // dd($script);
                $lastFilter = " where t.InscriNrx is not null ".$conRoutes.$conMonth.$conMonthDebt.$conStateReceipt.$conServices;
                session(['lastFilter' => $lastFilter]);
                session(['nameMonth' => $r->nameMonth]);


                $stmt = sqlsrv_query($conn_sis, $script);
                $arreglo = array();
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
                {   $arreglo[] = $row;}
                return response()->json(['estado' => true,"data"=>$arreglo]);
            }
            else
            {
                dd('No se pudo establecer la conexión');
            }
        } catch (QueryException $e) {
            dd('Error en la conexión: ' . $e->getMessage());
        }
    }
    public function actCourtAssign()
    {
        $assign = TAssign::where('idTec',Session::get('tecnical')->idTec)->orderby('idTec','desc')->first();
        // dd(Session::get('tecnical')->idTec,$assign);
        if($assign != null)
        {
            $conSql = $this->connectionSql();
            if($conSql)
            {
                $script = "select i.StateUserEscn as courtState,t.FacEstado as paid, c.PreMzn as code, c.PreLote as cod,t.InscriNrx as numberInscription, c.Clinomx as client,rz.CalTip as streetType,
                    rz.CalTip + ' ' + rz.CalDes as streetDescription,i.Tarifx as rate, T.FMedidor as meter,i.CtaMesAct as monthDebt, i.CtaFacSal as amount, c.CodTipSer as serviceEnterprise, t.FConsumo as consumption
                        from TOTFAC t INNER JOIN CONEXION c ON t.InscriNrx=c.InscriNro
                        left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
                        left outer join rzcalle rz ON rz.calcod = c.precalle
                        where i.CourtEscn = '".$assign->flat."' and t.FacFecFac='".$this->month[ucfirst($assign->month)]."' order by c.PreMzn, c.PreLote";
                        // dd($script);
                $stmt = sqlsrv_query($conSql, $script);
                $arrayRecords = array();
                // dd(count($arrayRecords));
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
                {   $arrayRecords[] = $row;}
                return response()->json(['state' => true,"data"=>$arrayRecords,"c"=>count($arrayRecords)]);
            }
            else
                return response()->json(['state' => false, 'message' => 'Ocurrio un error en la conexion al sistema.']);
        }
        else
            return response()->json(['state' => false, 'message' => 'No cuenta con programa asignado.']);
    }

}
