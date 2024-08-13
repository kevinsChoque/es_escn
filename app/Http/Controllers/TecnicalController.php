<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\Models\TTecnical;
use App\Models\TAssign;
use App\Models\TEnding;
use App\Models\TCourt;
use App\Models\TActivation;
use App\Models\TEvidence;


class TecnicalController extends Controller
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
    public function actList()
    {
        // $list = TTecnical::all();
        $activePeriod = TEnding::where('state','1')->first();
        // dd($activePeriod);
        $sql = "SELECT t.*
            FROM tecnical t
            WHERE NOT EXISTS (
                SELECT 1
                FROM assign a
                INNER JOIN ending e ON a.idEnd = e.idEnd
                WHERE t.idTec = a.idTec
                AND e.idEnd = ".$activePeriod->idEnd."
                AND e.state = 1
            )";
            // dd($sql);
        $list=DB::select($sql);

        return response()->json(['state' => true, 'data' => $list]);
    }
    public function actAssign(Request $r)
    {
        try{
            // dd($r->all(),'cascsa', TEnding::where('state',1)->orderBy('idEnd', 'desc')->first());
            // dd(Session::get('listCuts'));
            // $listCutsOld = [];
            // $data = Session::get('listCuts');
            // for ($i = 0; $i < count($data); $i++) {
            //     $listCutsOld[] = [
            //         "CtaMesActOld" => $data[$i]['CtaMesActOld'],
            //         "courtState" => $data[$i]['courtState'],
            //         "paid" => $data[$i]['paid'],
            //         "code" => $data[$i]['code'],
            //         "cod" => $data[$i]['cod'],
            //         "numberInscription" => $data[$i]['numberInscription'],
            //         "client" => trim($data[$i]['client']),
            //         "streetType" => $data[$i]['streetType'],
            //         "streetDescription" => trim($data[$i]['streetDescription']),
            //         "rate" => trim($data[$i]['rate']),
            //         "meter" => $data[$i]['meter'],
            //         "monthDebt" => $data[$i]['monthDebt'],
            //         "amount" => $data[$i]['amount'],
            //         "serviceEnterprise" => $data[$i]['serviceEnterprise'],
            //         "consumption" => $data[$i]['consumption'],
            //     ];
            // }
            // $sizeInBytes = strlen($json_data);
            // $sizeInMegabytes = $sizeInBytes / (1024 * 1024);
            // dd(gettype($json_data),$sizeInMegabytes,$json_data);
            $flat = $r->idTec.'_'.strtolower(Session::get('nameMonth')).'_'.Carbon::now()->year;
            $r->merge(['idEnd' => TEnding::where('state',1)->orderBy('idEnd', 'desc')->first()->idEnd]);
            $r->merge(['month' => strtolower(Session::get('nameMonth'))]);
            $r->merge(['flat' => $flat]);
            $r->merge(['filter' => Session::get('lastFilter')]);
            // $r->merge(['listCutsOld' => json_encode($listCutsOld, JSON_PRETTY_PRINT)]);
            $ass=TAssign::create($r->all());
            if($ass)
            {
                // dd($ass);
                $conSql = $this->connectionSql();
                if($conSql)
                {
                    $script = "UPDATE INSCRIPC
                        SET CourtEscn = '".$flat."', CtaMesActOldEscn=CtaMesAct
                        FROM INSCRIPC i
                        INNER JOIN CONEXION c ON i.InscriNro = c.InscriNro
                        INNER JOIN TOTFAC t ON t.InscriNrx = c.InscriNro ".Session::get('lastFilter')." and i.CourtEscn is null";
                    $stmt = sqlsrv_query($conSql, $script);

                    if($stmt)
                    {
                        $filter = str_replace("and i.CourtEscn is null", " ", $ass->filter);
                        $script = "select i.CtaMesActOldEscn as CtaMesActOld,i.StateUserEscn as courtState,t.FacEstado as paid, c.PreMzn as code, c.PreLote as cod,t.InscriNrx as numberInscription, c.Clinomx as client,rz.CalTip as streetType,
                        rz.CalTip + ' ' + rz.CalDes as streetDescription,i.Tarifx as rate, T.FMedidor as meter,i.CtaMesAct as monthDebt, i.CtaFacSal as amount, c.CodTipSer as serviceEnterprise, t.FConsumo as consumption
                            from TOTFAC t INNER JOIN CONEXION c ON t.InscriNrx=c.InscriNro
                            left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
                            left outer join rzcalle rz ON rz.calcod = c.precalle
                            ".$filter." and i.CourtEscn='".$ass->flat."' order by c.PreMzn, c.PreLote";
                        $scriptCant = "select count(*) as cant from INSCRIPC where CourtEscn='".$ass->flat."'";
                        // dd($script);
                        $stmt = sqlsrv_query($conSql, $script);
                        $stmtCant = sqlsrv_query($conSql, $scriptCant);
                        $rowCant = sqlsrv_fetch_array( $stmtCant, SQLSRV_FETCH_ASSOC);

                        $data = array();
                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
                        {   $data[] = $row;}
                        $listCutsOld = [];
                        for ($i = 0; $i < count($data); $i++) {
                            $listCutsOld[] = [
                                "CtaMesActOld" => $data[$i]['CtaMesActOld'],
                                "courtState" => $data[$i]['courtState'],
                                "paid" => $data[$i]['paid'],
                                "code" => $data[$i]['code'],
                                "cod" => $data[$i]['cod'],
                                "numberInscription" => $data[$i]['numberInscription'],
                                "client" => trim($data[$i]['client']),
                                "streetType" => $data[$i]['streetType'],
                                "streetDescription" => trim($data[$i]['streetDescription']),
                                "rate" => trim($data[$i]['rate']),
                                "meter" => $data[$i]['meter'],
                                "monthDebt" => $data[$i]['monthDebt'],
                                "amount" => $data[$i]['amount'],
                                "serviceEnterprise" => $data[$i]['serviceEnterprise'],
                                "consumption" => $data[$i]['consumption'],
                            ];
                        }
                        $ass=TAssign::where('idTec',$ass->idTec)->where('idEnd',$ass->idEnd)->first();
                        // dd($ass);
                        $ass->listCutsOld = json_encode($listCutsOld, JSON_PRETTY_PRINT);
                        $ass->cant = $rowCant['cant'];
                        $ass->save();
                        // realizar la consulta
                        return response()->json(['state' => true, 'message' => 'Se realizó la asignación correctamente']);
                    }
                    else
                    {
                        throw new \Exception('Error al momento de actualizar CORTES: ' . print_r(sqlsrv_errors(), true));
                        // return response()->json(['state' => false, 'message' => 'Error al momento de actualizar CORTES: ' . print_r(sqlsrv_errors(), true)]);
                    }
                }
                else
                {
                    // return response()->json(['state' => false, 'message' => 'Ocurrio un error en la conexion al sistema.']);
                    throw new \Exception('Ocurrió un error en la conexión al sistema.');
                }
            }
            else
            {
                throw new \Exception('No fue posible crear una asignación.');
                // return response()->json(['state' => false, 'message' => 'No fue posible crear una asignacion.']);
            }
        }
        catch (\Exception $e) {
            return response()->json(['state' => false, 'message' => $e->getMessage()]);
        }
    }
    public function verifyListCutsOld($inscription)
    {
        $data = json_decode(Session::get('assign')->listCutsOld, true);
        if (json_last_error() !== JSON_ERROR_NONE)
        {
            dd('Error al decodificar JSON');
            // return ['state' => false, 'checked' => false, 'message' => 'Error al decodificar JSON'];
        }
        $found = null;
        foreach ($data as $element)
        {
            if ($element['numberInscription'] == $inscription)
            {
                $found = $element;
                break;
            }
        }
        if ($found)
        {
            // dd("Elemento encontrado: ",$found);
            return ['state' => true, 'reg' => $found];
        }
        else
            dd("Elemento no encontrado para el número de inscripción $numeroInscripcionABuscar.\n");
    }
    public function actCourtUser(Request $r)
    {
        // dd($r->all());

        // $reg = $this->verifyListCutsOld($r->inscription);

        // dd($reg['reg']['monthDebt']);
        // dd('csac');
        // en vez de esto $reg['reg']['monthDebt'] ira $rowVerify['CtaMesActOldEscn']
        $conSql = $this->connectionSql();
        if($conSql)
        {
            // $script = "select * from TOTFAC where InscriNrx='".$r->inscription."' and FacFecFac='".$this->month[ucfirst(Session::get('assign')->month)]."' ";
            // dd($script);
            $script = "select CtaMesAct,CourtEscn,* from INSCRIPC where InscriNro='".$r->inscription."'";

            $stmtVerify = sqlsrv_query($conSql, $script);
            $rowVerify = sqlsrv_fetch_array( $stmtVerify, SQLSRV_FETCH_ASSOC);
            // cancelar corte (true)
            if($r->state=='true')
            {
                if($rowVerify['CtaMesActOldEscn'] == 3 && $rowVerify['CtaMesAct'] == 2)
                {

                }
                else
                {
                    if($rowVerify['CtaMesAct'] >= 2)
                    {

                    }
                    else
                    {
                        if($rowVerify['CtaMesAct'] != $rowVerify['CtaMesActOldEscn'])
                            return response()->json(['state' => false, 'according' => 'paid', 'paid' => false, 'checked' => false, 'message' => 'No es posible cancelar corte.', 'monthDebt' => $rowVerify['CtaMesAct']]);
                    }

                }
            }
            else //cortar (false)
            {
                // if($rowVerify['CtaMesAct']<=3)
                if($rowVerify['CtaMesActOldEscn']<=3)
                {
                    // if($reg['reg']['monthDebt'] == 3 && $rowVerify['CtaMesAct'] == 2)
                    // {
                    //     return response()->json(['state' => false, 'according' => 'paid', 'paid' => true, 'checked' => false, 'message' => 'No es posible realizar el corte posibles motivos (pago, convenio, reclamo).']);
                    // }
                    if($rowVerify['CtaMesActOldEscn'] == 3 && $rowVerify['CtaMesAct'] == 2)
                    {
                        // return response()->json(['state' => false, 'according' => 'paid', 'paid' => true, 'checked' => false, 'message' => 'No es posible realizar el corte posibles motivos (pago, convenio, reclamo).']);
                    }
                    else
                    {
                        if($rowVerify['CtaMesAct'] != $rowVerify['CtaMesActOldEscn'])
                            return response()->json(['state' => false, 'according' => 'paid', 'paid' => true, 'checked' => false, 'message' => 'No es posible realizar el corte posibles motivos (pago, convenio, reclamo).', 'monthDebt' => $rowVerify['CtaMesAct']]);
                    }
                }
                else
                {
                    if($rowVerify['CtaMesAct'] == 0)
                        return response()->json(['state' => false, 'according' => 'paid', 'paid' => true, 'checked' => false, 'message' => 'No es posible realizar el corte posibles motivos (pago, convenio).', 'monthDebt' => $rowVerify['CtaMesAct']]);
                }
            }

            // dd($row['FacEstado']);
            // ----------------
            // if ($stmtVerify === false)
            //     return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error al momento de verificar pago.']);// die(print_r(sqlsrv_errors(), true)); // Manejar errores en la consulta
            // if ($r->state=='true' && $rowVerify['FacEstado']=='1')
            //     return response()->json(['state' => false, 'according' => 'paid', 'paid' => false, 'checked' => false, 'message' => 'No es posible cancelar corte, recibo pagado despues de corte.']);
            // if ($rowVerify['FacEstado']=='1')
            //     return response()->json(['state' => false, 'according' => 'paid', 'paid' => true, 'checked' => false, 'message' => 'No es posible realizar el corte, RECIBO PAGADO.']);
            // ----------------
            // $stateTotFac = $rowVerify['FacEstado'];
            // $fcTotFac = $rowVerify['FConsumo'];//only verify
            // dd($fcTotFac,$stateTotFac, $stateTotFac=='1'?true:false);
            // dd($rowVerify['CtaMesAct'],$reg['reg']['monthDebt']);
            if($r->state=='false')
                $script = "UPDATE INSCRIPC
                SET StateUserEscn = '4'
                WHERE InscriNro ='".$r->inscription."'";
            else
                $script = "UPDATE INSCRIPC
                SET StateUserEscn = null
                WHERE InscriNro ='".$r->inscription."'";

            // dd($r->state,gettype($script),$script);
            $stmt = sqlsrv_query($conSql, $script);
            // return response()->json(['state' => true, 'message' => 'Se registro el corte correctamente.']);
            if($stmt)
            {
                if($r->state=='false')
                {
                    // $script = "select top 1 CargoNro from cargos order by CargoNro desc";
                    $script = "select UltNro,* from docum where DocTip='CARGO'";
                    $stmt = sqlsrv_query($conSql, $script);

                    if ($stmt === false)
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error interno al asignar codigo al cargo.']);
                    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                    $id = $row['UltNro']+1;

                    $script = "INSERT INTO [dbo].[CARGOS]([OfiCod],[OfiAgeCod],[CargoNro],[CargoFecha],[InscriNro],[CargoEstad],[CargoMonto],[DigCod],[FacConCod],[CargoDoc],[FlagId])
                    VALUES (1,1,'$id',GETDATE(),'$r->inscription','I',26.69,50,805,'escn: corte de servicio de agua',1)";
                    $stmt = sqlsrv_query($conSql, $script);

                    $scriptDocum = "update docum set UltNro=".$id." where DocTip='CARGO'";
                    $stmtDocum = sqlsrv_query($conSql, $scriptDocum);
                    // dd($script);
                    if($stmt && $stmtDocum)
                    {
                        $script = "select CodTipSer,* from CONEXION where InscriNro='".$r->inscription."'";
                        $stmt = sqlsrv_query($conSql, $script);
                        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                        $pm = $row['PreMzn'];
                        $pl = $row['PreLote'];
                        if($row['CodTipSer']=='1')
                        {
                            $scriptCoagua = "select * from COAGUA where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $scriptCodesa = "select * from CODESA where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                            $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                            $rowCoagua = sqlsrv_fetch_array( $stmtCoagua, SQLSRV_FETCH_ASSOC);
                            $rowCodesa = sqlsrv_fetch_array( $stmtCodesa, SQLSRV_FETCH_ASSOC);
                            $coaguaState = $rowCoagua['ConEstado'];
                            $codesaState = $rowCodesa['ConDEstad'];

                            $scriptCoagua = "update COAGUA set ConEstado=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $scriptCodesa = "update CODESA set ConDEstad=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                            $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                            if($stmtCoagua && $stmtCodesa)
                            {
                                $court=TCourt::create([
                                    'idAss' => Session::get('assign')->idAss,
                                    'cargoNro' => $id,
                                    'inscription' => $r->inscription,
                                    'dateCourt' => Carbon::now()->format('Y-m-d H:i:s'),
                                    'coaguaState' => $coaguaState,
                                    'codesaState' => $codesaState,
                                ]);
                                if(!$court)
                                    return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                                return response()->json(['state' => true,
                                    'checked' => true,
                                    'message' => 'Se guardo el registro de corte: con numero de inscripcion '.$r->inscription.'.'
                                ]);
                            }
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                        }
                        if($row['CodTipSer']=='2')
                        {
                            $scriptCoagua = "select * from COAGUA where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                            $rowCoagua = sqlsrv_fetch_array( $stmtCoagua, SQLSRV_FETCH_ASSOC);
                            $coaguaState = $rowCoagua['ConEstado'];

                            $scriptCoagua = "update COAGUA set ConEstado=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                            if($stmtCoagua)
                            {
                                $court=TCourt::create([
                                    'idAss' => Session::get('assign')->idAss,
                                    'cargoNro' => $id,
                                    'inscription' => $r->inscription,
                                    'dateCourt' => Carbon::now()->format('Y-m-d H:i:s'),
                                    'coaguaState' => $coaguaState,
                                ]);
                                if(!$court)
                                    return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                                return response()->json(['state' => true,
                                    'checked' => true,
                                    'message' => 'Se guardo el registro de corte: con numero de inscripcion '.$r->inscription.'.'
                                ]);
                            }
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                        }
                        if($row['CodTipSer']=='3')
                        {
                            $scriptCodesa = "select * from CODESA where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                            $rowCodesa = sqlsrv_fetch_array( $stmtCodesa, SQLSRV_FETCH_ASSOC);
                            $codesaState = $rowCodesa['ConDEstad'];

                            $scriptCodesa = "update CODESA set ConDEstad=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                            if($stmtCodesa)
                            {
                                $court=TCourt::create([
                                    'idAss' => Session::get('assign')->idAss,
                                    'cargoNro' => $id,
                                    'inscription' => $r->inscription,
                                    'dateCourt' => Carbon::now()->format('Y-m-d H:i:s'),
                                    'codesaState' => $codesaState,
                                ]);
                                if(!$court)
                                    return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                                return response()->json(['state' => true,
                                    'checked' => true,
                                    'message' => 'Se guardo el registro de corte: con numero de inscripcion '.$r->inscription.'.'
                                ]);
                            }
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                        }
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                    }
                    else
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error interno al crear CARGO.']);

                }
                else
                {
                    $court = TCourt::where('idAss',Session::get('assign')->idAss)->where('inscription',$r->inscription)->first();
                    if($court)
                    {
                        $script = "DELETE FROM cargos WHERE CargoNro='$court->cargoNro'";
                        $stmt = sqlsrv_query($conSql, $script);
                        if($stmt)
                        {
                            $script = "select CodTipSer,* from CONEXION where InscriNro='".$r->inscription."'";
                            $stmt = sqlsrv_query($conSql, $script);
                            $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                            $pm = $row['PreMzn'];
                            $pl = $row['PreLote'];
                            if($row['CodTipSer']=='1')
                            {
                                $scriptCoagua = "update COAGUA set ConEstado=".$court->coaguaState." where PreMzn='".$pm."' and PreLote='".$pl."'";
                                $scriptCodesa = "update CODESA set ConDEstad=".$court->codesaState." where PreMzn='".$pm."' and PreLote='".$pl."'";
                                $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                                $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                                if(!$stmtCoagua || !$stmtCodesa)
                                    return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                            }
                            if($row['CodTipSer']=='2')
                            {
                                $scriptCoagua = "update COAGUA set ConEstado=".$court->coaguaState." where PreMzn='".$pm."' and PreLote='".$pl."'";
                                $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                                if(!$stmtCoagua)
                                    return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                            }
                            if($row['CodTipSer']=='3')
                            {
                                $scriptCodesa = "update CODESA set ConDEstad=".$court->codesaState." where PreMzn='".$pm."' and PreLote='".$pl."'";
                                $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                                if(!$stmtCodesa)
                                    return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                            }
                            if($court->delete())
                            {
                                $listCuts = TEvidence::where('idCou',$court->idCou)->get();
                                if(count($listCuts)!=0)
                                {
                                    $listCuts = TEvidence::where('idCou',$court->idCou)->delete();
                                    // Storage::deleteDirectory('public/uploads/imagenes');
                                    if($listCuts)
                                    {
                                        $path = 'public/evidences/court/'.Session::get('assign')->idAss.'-'.$court->inscription;
                                        $deleteDir = Storage::deleteDirectory($path);
                                        if ($deleteDir)
                                            return response()->json(['state' => true, 'checked' => false, 'message' => '--Se cancelo el corte: con numero de inscripcion '.$r->inscription.'.']);
                                        else
                                            return response()->json(['state' => false, 'checked' => false, 'message' => 'No fue posible eliminar los archivos de las evidencias.']);
                                    }
                                }
                                else
                                {
                                    return response()->json(['state' => true, 'checked' => false, 'message' => 'Se cancelo el corte: con numero de inscripcion '.$r->inscription.'.']);
                                }
                                return response()->json(['state' => false, 'checked' => false, 'message' => 'No fue posible eliminar las evidencias asociadas al corte.']);
                            }
                            else
                            {
                                return response()->json(['state' => false, 'checked' => false, 'message' => 'Se elimino el registro del CARG
                                O, pero no se elimino el registro del corte en la BD de apoyo.']);
                            }
                        }
                        else
                        {
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'No fue posible borrar el CARGO.']);
                        }
                    }
                    else
                    {
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'No se encontro el registro del c
                        orte en la BD de apoyo.']);
                    }
                }
            }
            else
                return response()->json(['state' => false, 'checked' => false, 'message' => 'Error al momento de registrar el corte : ' . print_r(sqlsrv_errors(), true)]);
        }
        return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error al momento de conectarse con la informacion.']);
    }
    public function actActivateUser(Request $r)
    {
        // dd($r->all());
        $conSql = $this->connectionSql();
        if($conSql)
        {
            if($r->state=='false')
                $script = "UPDATE INSCRIPC
                SET StateUserEscn = '1'
                WHERE InscriNro ='".$r->inscription."'";
            else
                $script = "UPDATE INSCRIPC
                SET StateUserEscn = '4'
                WHERE InscriNro ='".$r->inscription."'";
            $stmt = sqlsrv_query($conSql, $script);
            if($stmt)
            {
                if($r->state=='false')
                {
                    $script = "select CodTipSer,* from CONEXION where InscriNro='".$r->inscription."'";
                    $stmt = sqlsrv_query($conSql, $script);
                    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                    $pm = $row['PreMzn'];
                    $pl = $row['PreLote'];
                    if($row['CodTipSer']=='1')
                    {
                        $scriptCoagua = "update COAGUA set ConEstado=1 where PreMzn='".$pm."' and PreLote='".$pl."'";
                        $scriptCodesa = "update CODESA set ConDEstad=1 where PreMzn='".$pm."' and PreLote='".$pl."'";
                        $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                        $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                        if(!$stmtCoagua || !$stmtCodesa)
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                    }
                    if($row['CodTipSer']=='2')
                    {
                        $scriptCoagua = "update COAGUA set ConEstado=1 where PreMzn='".$pm."' and PreLote='".$pl."'";
                        $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                        if(!$stmtCoagua)
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                    }
                    if($row['CodTipSer']=='3')
                    {
                        $scriptCodesa = "update CODESA set ConDEstad=1 where PreMzn='".$pm."' and PreLote='".$pl."'";
                        $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                        if(!$stmtCodesa)
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                    }
                    $court = TCourt::where('idAss',Session::get('assign')->idAss)->where('inscription',$r->inscription)->first();
                    if($court)
                    {
                        $activate=TActivation::create([
                            'idCou' => $court->idCou,
                            'idAss' => Session::get('assign')->idAss,
                            'inscription' => $r->inscription,
                            'dateActivation' => Carbon::now()->format('Y-m-d H:i:s'),
                        ]);
                        if($activate)
                        {
                            return response()->json(['state' => true,
                                'checked' => $r->state=='true'?false:true,
                                'message' => $r->state=='true'?'Se cancelo la activacion: con numero de inscripcion '.$r->inscription.'.':'Se guardo el registro de activacion: con numero de inscripcion '.$r->inscription.'.'
                            ]);
                        }
                        else
                        {
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Se guardo el registro de la ACTIVACION, pero no se registro en la BD de apoyo.']);
                        }
                    }
                    else
                    {
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'No se encontro ningun corte en la BD con el numero de inscripcion '.$r->inscription]);
                    }

                }
                else
                {
                    $activate = TActivation::where('idAss',Session::get('assign')->idAss)->where('inscription',$r->inscription)->first();
                    if($activate)
                    {
                        $script = "select CodTipSer,* from CONEXION where InscriNro='".$r->inscription."'";
                        $stmt = sqlsrv_query($conSql, $script);
                        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                        $pm = $row['PreMzn'];
                        $pl = $row['PreLote'];
                        if($row['CodTipSer']=='1')
                        {
                            $scriptCoagua = "update COAGUA set ConEstado=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $scriptCodesa = "update CODESA set ConDEstad=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                            $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                            if(!$stmtCoagua || !$stmtCodesa)
                                return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador..']);
                        }
                        if($row['CodTipSer']=='2')
                        {
                            $scriptCoagua = "update COAGUA set ConEstado=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCoagua = sqlsrv_query($conSql, $scriptCoagua);
                            if(!$stmtCoagua)
                                return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                        }
                        if($row['CodTipSer']=='3')
                        {
                            $scriptCodesa = "update CODESA set ConDEstad=2 where PreMzn='".$pm."' and PreLote='".$pl."'";
                            $stmtCodesa = sqlsrv_query($conSql, $scriptCodesa);
                            if(!$stmtCodesa)
                                return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, porfavor contactese con el Administrador.']);
                        }

                        if($activate->delete())
                        {
                            $listEvidence = TEvidence::where('idAct',$activate->idAct)->get();
                            if(count($listEvidence)!=0)
                            {
                                $listEvidence = TEvidence::where('idAct',$activate->idAct)->delete();
                                if($listEvidence)
                                {
                                    $path = 'public/evidences/activate/'.Session::get('assign')->idAss.'-'.$activate->inscription;
                                    $deleteDir = Storage::deleteDirectory($path);
                                    if ($deleteDir)
                                        return response()->json(['state' => true,
                                            'checked' => $r->state=='true'?false:true,
                                            'message' => $r->state=='true'?'Se cancelo la activacion: con numero de inscripcion '.$r->inscription.'.':'Se guardo el registro de activacion: con numero de inscripcion '.$r->inscription.'.'
                                        ]);
                                    else
                                        return response()->json(['state' => false, 'checked' => false, 'message' => 'No fue posible eliminar los archivos de las evidencias.']);
                                }
                            }
                            else
                            {
                                return response()->json(['state' => true,
                                    'checked' => $r->state=='true'?false:true,
                                    'message' => $r->state=='true'?'Se cancelo la activacion: con numero de inscripcion '.$r->inscription.'.':'Se guardo el registro de activacion: con numero de inscripcion '.$r->inscription.'.'
                                ]);
                            }
                        }
                        else
                        {
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Se activo correctamente pero no fue posible cambiar estado en la BD de apoyo de la inscripcion con numero: '.$r->inscription]);
                        }
                    }
                    else
                    {
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'No se encontro ningun registro de activacion en la BD con el numero de inscripcion '.$r->inscription.', pero la activacion fue exitosa.']);
                    }
                }
            }
            else
                return response()->json(['state' => false, 'checked' => false, 'message' => 'Error al momento de reactivar el corte : ' . print_r(sqlsrv_errors(), true)]);
        }
        return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error al momento de conectarse con la informacion.']);
    }
    public function actShowAssignTecnical(Request $r)
    {
        // dd('cascacsac csaca vdsv');
        return view('assign.list');
    }
    public function actListCut(Request $r)
    {
        // quiero sacar el assign de la variable de sesion q ya existe con su id quiero sacarlo
        // dd(Session::get('assign')->idAss);
        $listCut = TAssign::find(Session::get('assign')->idAss);
        // dd($listCut->listCutsOld);
        return response()->json(['state' => true, 'data' => $listCut->listCutsOld]);
    }
    public function actUpdateRecords(Request $r)
    {
        // dd($r->all());
        $ass = TAssign::find(Session::get('assign')->idAss);
        $ass->listCutsOld = $r->data;
        if($ass->save())
            return response()->json(['state' => true]);
        return response()->json(['state' => false]);

    }
    public function actShowBlue(Request $r)
    {
        $filter = str_replace("and i.CourtEscn is null", " ", Session::get('assign')->filter);
        $filter = str_replace("and i.CtaMesAct=2", " ", $filter);
        $filter = str_replace("and i.CtaMesAct >=3", " ", $filter);
        $filter = str_replace("and t.FacEstado=0", " ", $filter);
        $script = "select i.CtaMesActOldEscn as CtaMesActOld,i.StateUserEscn as courtState,t.FacEstado as paid, c.PreMzn as code, c.PreLote as cod,t.InscriNrx as numberInscription, c.Clinomx as client,rz.CalTip as streetType,
        rz.CalTip + ' ' + rz.CalDes as streetDescription,i.Tarifx as rate, T.FMedidor as meter,i.CtaMesAct as monthDebt, i.CtaFacSal as amount, c.CodTipSer as serviceEnterprise, t.FConsumo as consumption
            from TOTFAC t INNER JOIN CONEXION c ON t.InscriNrx=c.InscriNro
            left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
            left outer join rzcalle rz ON rz.calcod = c.precalle
            ".$filter." and i.CourtEscn='".Session::get('assign')->flat."' and i.CtaMesAct=0 and i.StateUserEscn=4 order by c.PreMzn, c.PreLote";

        // dd( $script);
        $conSql = $this->connectionSql();
        $stmt = sqlsrv_query($conSql, $script);
        $data = array();
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
        {   $data[] = $row;}
        return response()->json(['state' => true, 'data' => $data]);
    }
}
