<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{   

    use SoftDeletes;

    const ACTIVA = 1;
    const INACTIVA = 0;

    protected $table = 'tw_empresas_corporativos';

    protected $fillable = [
        'S_RazonSocial',
        'S_RFC',
        'S_Pais',
        'S_Estado',
        'S_Municipio',
        'S_ColoniaLocalidad',
        'S_Domicilio',
        'N_CodigoPostal',
        'S_UsoCFDI',
        'S_UrlRFC',
        'S_UrlActaConstitutiva',
        'S_Activo',
        'S_Comentarios',
        'tw_corporativos_id'

    ];

    public function corporativo()
    {
        return $this->belongsTo('App\Corporativo', 'tw_corporativos_id');
    }
}
