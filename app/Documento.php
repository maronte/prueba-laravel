<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documento extends Model
{   
    public const OBLIGATORIO = 1;
    public const NO_OBLIGATORIO = 0;

    protected $table = 'tw_documentos';

    protected $fillable = [
        'S_Nombre',
        'N_Obligatorio',
        'S_Descripcion',
    ];

    protected $hidden = [
        'pivot'
    ];

    public $timestamps = false;

    public function corporativos()
    {
        return $this->belongsToMany('App\Corporativo', 'tw_documentos_corporativos',
        'tw_corporativos_id', 'tw_documentos_id');
    }

    public function urls()
    {
        return $this->hasMany('App\DocumentoArchivo', 'tw_documentos_id');
    }
}
