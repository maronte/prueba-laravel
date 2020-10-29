<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'tw_contactos_corporativo';

    protected $fillable = [
        'S_Nombre',
        'S_Puesto',
        'S_Comentarios',
        'N_TelefonoFijo',
        'N_TelefonoMovil',
        'S_Email',
        'tw_corporativos',
    ];
    
    public function corporativo(){
        return $this->belongsTo('tw_corporativos', 'tw_corporativos');
    }
}
