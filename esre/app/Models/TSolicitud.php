<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSolicitud extends Model
{
    protected $table='solicitud';
	protected $primaryKey='idSol';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
    	'idSol',
    	
    	'clientec',
        'dnic',
        'rucc',
        'direccionc',
        'urbanizacionc',
        'provinciac',
        'distritoc',
        'telefonoc',

        'representanter',
        'dnir',
        'medidorr',
        'direccionr1',
        'direccionr2',
        'postalr',
        'telefonor',
        'correor',

        'codigor',
        'descripcionr',
        'serier',
        'recibor',
        'fer',
        'importer',
        'fundamentor',

        'cartilla',

        'fecha1f',
        'fecha2f',
        'fecha3f',
        'hora1f',
        'hora2f',

        'estado',
        'fr',
        'fa',
    ];
}
