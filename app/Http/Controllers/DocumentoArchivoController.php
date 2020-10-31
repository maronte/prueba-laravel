<?php

namespace App\Http\Controllers;

use App\Corporativo;
use App\Documento;
use App\DocumentoArchivo;
use Illuminate\Http\Request;

class DocumentoArchivoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Corporativo $corporativo, Documento $documento)
    {   
        $rules = [
            'S_ArchivoUrl' => 'url'
        ];

        $this->validate($request, $rules);

        $url = $request->get('S_ArchivoUrl');

        $data = [
            'tw_corporativos_id' => $corporativo->id,
            'tw_documentos_id' => $documento->id,
            'S_ArchivoUrl' => $url,
        ];

        $documentoArchivo = DocumentoArchivo::create($data);

        return $this->showOne($documentoArchivo, '');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $documentoArchivo)
    {
        $rules = [
            'S_ArchivoUrl' => 'url'
        ];

        $this->validate($request, $rules);

        // El modelo de tipo pivot no hace inyección de dependencias correctamente
        $documentoArchivo = DocumentoArchivo::findOrFail($documentoArchivo);

        $url = $request->get('S_ArchivoUrl');

        $documentoArchivo->S_ArchivoUrl = $url;

        if($documentoArchivo->isClean()){
            return $this->errorResponse('La url no es diferente del valor actual', 422);  
        }

        $documentoArchivo->save();

        return $this->showOne($documentoArchivo, '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($documentoArchivo)
    {   

        // El modelo de tipo pivot no hace inyección de dependencias correctamente
        $documentoArchivo = DocumentoArchivo::findOrFail($documentoArchivo);

        $relaciones = Documento::find($documentoArchivo->tw_documentos_id)->urls->count();

        if($relaciones == 1){
            return $this->errorResponse('La operación que intentas no es posible, debes ' .
            'eliminar el documento asociado a este recurso', 422);  
        }

        $documentoArchivo->delete();

        return $this->showOne($documentoArchivo, 'El documentoArchivo ha sido eliminado correctamente');
    }
}
