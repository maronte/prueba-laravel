<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Corporativo;
use Illuminate\Http\Request;

class CorporativoContactoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Corporativo $corporativo)
    {   

        if(isset($corporativo->contacto)){
            return $this->errorResponse('El corporativo ya tiene un cotacto asociado', 422);
        }

        $rules = [
            'S_Nombre' => 'required|min:1|max:45',
            'S_Puesto' => 'required|min:1|max:45',
            'S_Comentarios' => 'min:1|max:255',
            'N_TelefonoFijo' => 'numeric|min:8|max:12',
            'N_TelefonoMovil' => 'numeric|min:10|max:12',
            'S_Email' => 'required|email',
        ];

        $data = $this->validate($request, $rules);

        $data['tw_corporativos_id'] = $corporativo->id;
        $contacto = Contacto::create($data);

        return $this->showOne($contacto, 'El contacto ha sido creado');
    }

}
