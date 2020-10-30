<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporativo extends Model
{

    use SoftDeletes;

    const ACTIVO = 1;
    const INACTIVO = 0;

    protected $table = 'tw_corporativos';

    protected $fillable = [
        'S_NombreCorto',
        'S_NombreCompleto',
        'S_LogoURL',
        'S_DBName',
        'S_DBUsuario',
        'S_DBPassword',
        'S_SystemUrl',
        'S_Activo',
        'D_FechaIncorporacion'
    ];

    public function contacto()
    {
        return $this->hasOne('App\Contacto','tw_corporativos_id');
    }

    public function empresas()
    {
        return $this->hasMany('App\Empresa', 'tw_corporativos_id');
    }

    protected function documentos()
    {
        return $this->belongsToMany('App\Documento', 'tw_documentos_corporativos',
        'tw_documentos_id', 'tw_corporativos_id');
    }
}
