<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\TEvidence;
use App\Models\TCourt;
use App\Models\TActivation;

class EvidenceController extends Controller
{
    public function actSendEvidence_delete(Request $r)
    {
        dd('evidence');
    }
    public function actSendEvidence(Request $r)
    {
        // dd($r->all());
        if($r->type=='activate')
        {
            $act = TActivation::where('inscription',$r->inscription)->first();
            if($act === null)
                return response()->json(['state' => false, 'message' => 'No se encontró el registro de la activacion, no se guardaron las evidencias.']);
        }
        else
        {
            $cou = TCourt::where('inscription',$r->inscription)->first();
            if($cou === null)
                return response()->json(['state' => false, 'message' => 'No se encontró el corte, no se guardaron las evidencias.']);
        }
        if ($r->hasFile('files'))
        {
            $uploadedFiles = $r->file('files');
            $storedFiles = [];
            foreach ($uploadedFiles as $file)
            {
                $filename = time() . '_' . $file->getClientOriginalName();
                $dir = 'evidences/'.$r->type.'/'.Session::get('assign')->idAss.'-'.$r->inscription;
                $path = $file->storeAs($dir, $filename, 'public');
                // $storedFiles[] = $path;
                if ($path)
                {
                    if($r->type=='activate')
                        $r->merge(['idAct' => $act->idAct]);
                    if($r->type=='court')
                        $r->merge(['idCou' => $cou->idCou]);
                    $r->merge(['inscription' => $r->inscription]);
                    $r->merge(['type' => $r->type]);
                    $r->merge(['path' => $path]);
                    $r->merge(['dateEvidence' => Carbon::now()->format('Y-m-d')]);
                    $r->merge(['hour' => Carbon::now()->format('H:i:s')]);
                    $evi=TEvidence::create($r->all());
                    if(!$evi)
                        return response()->json(['state' => false, 'message' => 'No fue posible crear el registro.']);
                    // $storedFiles[] = $path;
                } else {
                    return response()->json(['state' => false, 'message' => 'Ocurrió un error al guardar la evidencia.']);
                }
            }
            return response()->json(['state' => true, 'paths' => $storedFiles, 'message' => 'La evidencia se guardo exitosamente.']);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrio un error']);
    }
    public function actShowEvidences(Request $r)
    {
        // dd($r->all());
        $list = TEvidence::where('inscription',$r->inscription)
            ->where('type',$r->type)->get();
        return response()->json(['state' => true, 'data' => $list]);
    }
    public function actDeleteEvidence_b(Request $r)
    {
        $evi = TEvidence::find($r->idEvi);
        if($evi->delete())
        {
            $filePath = storage_path('app/public/'.$evi->path);
            if (file_exists($filePath))
            {
                if(unlink($filePath))
                    return response()->json(["message"=>"Se elimino la evidencia","state"=>true]);
                return response()->json(["message"=>"No fue posible eliminar la evidencia","state"=>false]);
            }
            else
                return response()->json(["message"=>"No fue posible eliminar la evidencia","state"=>false]);
        }
        else
            return response()->json(["message"=>"No fue posible eliminar la evidencia","state"=>false]);
    }
    public function actDeleteEvidence(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $evi = TEvidence::find($r->idEvi);

            if ($evi->delete())
            {
                $filePath = storage_path('app/public/' . $evi->path);
                if (file_exists($filePath))
                {
                    if (unlink($filePath))
                    {
                        DB::commit();
                        return response()->json(["message" => "Se eliminó la evidencia", "state" => true]);
                    }
                    else
                        throw new \Exception("No fue posible eliminar el archivo de evidencia.");
                }
                else
                    throw new \Exception("El archivo de evidencia no existe.");
            }
            else
                throw new \Exception("No fue posible eliminar el registro de evidencia.");
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(["message" => $e->getMessage(), "state" => false, "cath" => 'cath']);
        }
    }

}
