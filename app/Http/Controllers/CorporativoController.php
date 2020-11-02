<?php

namespace App\Http\Controllers;

use App\Corporativo;
use App\Http\Resources\CorporativoResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CorporativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporativos = Corporativo::all();

        return $this->showAll($corporativos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'S_NombreCorto' => 'required|min:3|max:45',
            'S_NombreCompleto' => 'required|min:5|max:75',
            'S_LogoURL',
            'S_DBName' => 'required|min:3|max:45',
            'S_DBUsuario' => 'required|min:1|max:45',
            'S_DBPassword' => 'required|min:6|max:150',
            'S_SystemUrl' => 'required|url|max:450',
            'S_Activo' => [Rule::in([Corporativo::ACTIVO, Corporativo::INACTIVO]), 'required'],
            'D_FechaIncorporacion' => 'required|date'
        ];

        $valitatedData = $request->validate($rules);

        $corporativo = Corporativo::create($valitatedData);

        return $this->showOne($corporativo, 'El corporativo ha sido creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corporativo  $corporativo
     * @return \Illuminate\Http\Response
     */
    public function show(Corporativo $corporativo)
    {   
        return new CorporativoResource($corporativo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corporativo  $corporativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corporativo $corporativo)
    {   

        $rules = [
            'S_NombreCorto' => 'min:3|max:45',
            'S_NombreCompleto' => 'min:5|max:75',
            'S_LogoURL',
            'S_DBName' => 'min:3|max:45',
            'S_DBUsuario' => 'min:1|max:45',
            'S_DBPassword' => 'min:6|max:150',
            'S_SystemUrl' => 'url|max:450',
            'S_Activo' => Rule::in([Corporativo::ACTIVO, Corporativo::INACTIVO]),
            'D_FechaIncorporacion' => 'date'
        ];

        $this->validate($request, $rules);

        $corporativo->fill($request->all());

        if($corporativo->isClean()){
            return $this->errorResponse(
                'El corporativo debe tener por lo menos un atributo diferente para ser actualizado', 422);  
        }

        $corporativo->save();

        return $this->showOne($corporativo, 'El corporativo ha sido actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corporativo  $corporativo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corporativo $corporativo)
    {
        $corporativo->delete();

        return $this->showOne($corporativo, 'El corporativo ha sido eliminado');
    }
}
