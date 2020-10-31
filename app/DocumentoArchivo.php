<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DocumentoArchivo extends Pivot
{
    protected $table = 'tw_documentos_corporativos';

    protected $fillable = [
        'tw_corporativos_id',
        'tw_documentos_id',
        'S_ArchivoUrl'
    ];

    public $timestamps = false;
}
