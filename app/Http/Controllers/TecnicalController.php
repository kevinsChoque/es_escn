<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TTecnical;
use App\Models\TAssign;
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
        $list = TTecnical::all();
        return response()->json(['state' => true, 'data' => $list]);
    }
    public function actAssign(Request $r)
    {
        // dd($r->all());
        $flat = $r->idTec.'_'.strtolower(Session::get('nameMonth')).'_'.Carbon::now()->year;
        $r->merge(['month' => strtolower(Session::get('nameMonth'))]);
        $r->merge(['flat' => $flat]);
        $r->merge(['filter' => Session::get('lastFilter')]);
        $ass=TAssign::create($r->all());
        if($ass)
        {
            $conSql = $this->connectionSql();
            if($conSql)
            {
                $script = "UPDATE INSCRIPC
                    SET CourtEscn = '".$flat."'
                    FROM INSCRIPC i
                    INNER JOIN CONEXION c ON i.InscriNro = c.InscriNro
                    INNER JOIN TOTFAC t ON t.InscriNrx = c.InscriNro ".Session::get('lastFilter');
                $stmt = sqlsrv_query($conSql, $script);
                if($stmt)
                    return response()->json(['state' => true, 'message' => 'Se realizó la asignación correctamente']);
                else
                    return response()->json(['state' => false, 'message' => 'Error al momento de actualizar CORTES: ' . print_r(sqlsrv_errors(), true)]);
            }
            else
            {
                return response()->json(['state' => false, 'message' => 'Ocurrio un error en la conexion al sistema.']);
            }

        }
        else
            return response()->json(['state' => false, 'message' => 'No fue posible crear una asignacion.']);
    }
    public function actCourtUser(Request $r)
    {
        // dd($r->all());
        $conSql = $this->connectionSql();
        if($conSql)
        {
            $script = "select * from TOTFAC where InscriNrx='".$r->inscription."' and FacFecFac='".$this->month[ucfirst(Session::get('assign')->month)]."' ";
            // dd($script);


            $stmtVerify = sqlsrv_query($conSql, $script);
            $rowVerify = sqlsrv_fetch_array( $stmtVerify, SQLSRV_FETCH_ASSOC);
            // dd($row['FacEstado']);
            if ($stmtVerify === false)
                return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error al momento de verificar pago.']);// die(print_r(sqlsrv_errors(), true)); // Manejar errores en la consulta
            // if (!($row = sqlsrv_fetch_array($stmtVerify, SQLSRV_FETCH_ASSOC)))
            //     return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error, no se encuentra pago asociado.']);
            if ($r->state=='true' && $rowVerify['FacEstado']=='1')
                return response()->json(['state' => false, 'according' => 'paid', 'paid' => false, 'checked' => false, 'message' => 'No es posible cancelar corte, recibo pagado despues de corte.']);
            if ($rowVerify['FacEstado']=='1')
                return response()->json(['state' => false, 'according' => 'paid', 'paid' => true, 'checked' => false, 'message' => 'No es posible realizar el corte, RECIBO PAGADO.']);
            $stateTotFac = $rowVerify['FacEstado'];
            $fcTotFac = $rowVerify['FConsumo'];//only verify
            // dd($fcTotFac,$stateTotFac, $stateTotFac=='1'?true:false);
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
                    $script = "select top 1 CargoNro from cargos order by CargoNro desc";
                    $stmt = sqlsrv_query($conSql, $script);

                    if ($stmt === false)
                        return response()->json(['state' => false, 'checked' => false, 'message' => 'Ocurrio un error interno al asignar codigo al cargo.']);
                    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                    $id = $row['CargoNro']+1;

                    // dd($row['CargoNro'],$row['CargoNro']+1,gettype($row['CargoNro']));

                    $script = "INSERT INTO [dbo].[CARGOS]([OfiCod],[OfiAgeCod],[CargoNro],[CargoFecha],[InscriNro],[CargoEstad],[CargoMonto],[DigCod],[FacConCod],[CargoDoc],[FlagId])
                    VALUES (1,1,'$id',GETDATE(),'$r->inscription','I',26.69,50,805,'escn: corte de servicio de agua',1)";
                    $stmt = sqlsrv_query($conSql, $script);
                    // dd($script);
                    if($stmt)
                    {
                        $court=TCourt::create([
                            'idAss' => Session::get('assign')->idAss,
                            'cargoNro' => $id,
                            'inscription' => $r->inscription,
                            'dateCourt' => Carbon::now()->format('Y-m-d H:i:s'),
                        ]);
                        if($court)
                        {
                            return response()->json(['state' => true,
                                'checked' => $r->state=='true'?false:true,
                                'message' => $r->state=='true'?'Se cancelo el corte: con numero de inscripcion '.$r->inscription.'.':'Se guardo el registro de corte: con numero de inscripcion '.$r->inscription.'.'
                            ]);
                        }
                        else
                        {
                            return response()->json(['state' => false, 'checked' => false, 'message' => 'Se guardo el registro del CARGO, pero mop se registro el cortre en la BD de apoyo.']);
                        }
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
}
