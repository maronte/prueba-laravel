<?php

namespace App\Http\Controllers;

use App\Corporativo;
use App\Documento;
use App\Http\Resources\DocumentoResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all();

        return $this->showAll($documentos);
    }

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {   
        $documento->corporativos;
        return new DocumentoResource($documento);
        //return $this->showOne($documento, '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        $rules = [
            'S_Nombre' => 'min:1|max:45',
            'N_Obligatorio' => Rule::in([Documento::OBLIGATORIO, Documento::NO_OBLIGATORIO]),
            'S_Descripción' => 'min:1|max:255',
        ];

        $this->validate($request, $rules);

        $documento->fill($request->all());

        if(!$documento->isDirty()){
            return $this->errorResponse('Debe haber por lo menos un campo diferente del documento', 422);
        }

        $documento->save();

        return $this->showOne($documento, 'El documento ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {   
        $documento->delete();
        return $this->showOne($documento, 'El documento ha sido eliminado');
    }
}
