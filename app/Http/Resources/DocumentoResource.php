<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'S_Nombre' => $this->S_Nombre,
            'N_Obligatorio' => $this->N_Obligatorio,
            'S_Descripcion' => $this->S_Descripcion,
            'corporativos' => $this->corporativos()->get()->unique(),
            'tw_documentos_corporativos' => $this->urls
        ];
    }
}
