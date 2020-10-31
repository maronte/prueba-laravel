<?php

namespace App\Http\Controllers;

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
