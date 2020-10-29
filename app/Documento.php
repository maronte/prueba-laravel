<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'tw_documentos';

    protected $fillable = [
        'S_Nombre',
        'N_Obligatorio',
        'S_Descripción',
    ];

    protected function corporativos()
    {
        return $this->belongsToMany('App\Corporativo', 'tw_documentos_corporativos',
        'tw_corporativos_id', 'tw_documentos_id');
    }
}
