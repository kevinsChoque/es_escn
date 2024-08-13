<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\TObs;

class ObsController extends Controller
{
    public function actShowObs(Request $r)
    {
        // dd($r->all());
        //  inscription
        $obs = TObs::where('idAss', Session::get('assign')->idAss)->where('inscription', $r->inscription)->first();
        // dd($obs);
        return response()->json(['state' => true, 'obs' => $obs]);
    }
    public function actSaveObs(Request $r)
    {
        // dd($r->all());
        $obs = TObs::where('idAss', Session::get('assign')->idAss)->where('inscription', $r->inscription)->first();
        $r->merge(['idAss' => Session::get('assign')->idAss]);
        $r->merge(['inscription' => $r->inscription]);
        if($obs!=null)
        {
            $obs->update($r->all());
            return response()->json(['state' => true, 'obs' => $obs]);
        }
        else
        {
            $obs=TObs::create($r->all());
            return response()->json(['state' => true, 'obs' => $obs]);
        }

    }
}
