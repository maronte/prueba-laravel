<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos = Contacto::all();

        return $this->showAll($contactos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        return $this->showOne($contacto, '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        $rules = [
            'S_Nombre' => 'min:1|max:45',
            'S_Puesto' => 'min:1|max:45',
            'S_Comentarios' => 'min:1|max:255',
            'N_TelefonoFijo' => 'numeric|min:8|max:12',
            'N_TelefonoMovil' => 'numeric|min:10|max:12',
            'S_Email' => 'email',
        ];

        $this->validate($request, $rules);

        $contacto->fill($request->all());

        if($contacto->isClean()){
            return $this->errorResponse(
                'El contacto debe tener por lo menos un atributo diferente para ser actualizado', 422);  
        }

        $contacto->save();

        return $this->showOne($contacto, 'Contacto actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        $contacto->delete();

        return $this->showOne($contacto, 'El contacto se ha eliminado');
    }
}
