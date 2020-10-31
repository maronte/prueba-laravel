<?php

namespace App\Http\Controllers;

use App\Corporativo;
use App\Documento;
use App\DocumentoArchivo;
use App\Http\Resources\DocumentoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CorporativoDocumentoController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Corporativo $corporativo)
    {   
        $rules = [
            'S_ArchivoUrl' => 'url',
            'S_Nombre' => 'required|min:1|max:45',
            'N_Obligatorio' => ['required', Rule::in([Documento::OBLIGATORIO, Documento::NO_OBLIGATORIO])],
            'S_Descripcion' => 'min:1|max:255',
        ];

        $this->validate($request, $rules);

        $documento = Documento::create($request->all(['S_Nombre', 'N_Obligatorio', 'S_Descripcion']));

        $url = $request->get('S_ArchivoUrl');

        $documento->corporativos()->attach($corporativo->id, ['S_ArchivoUrl' => $url]);

        return new DocumentoResource($documento);
    }

}
