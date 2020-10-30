<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpresaController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();

        return $this->showAll($empresas);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return $this->showOne($empresa, '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $rules = [
            'S_RazonSocial' => 'max:150',
            'S_RFC' => 'max:13|alpha_num',
            'S_Pais' => 'max:75',
            'S_Estado' => 'max:75',
            'S_Municipio' => 'max:75',
            'S_ColoniaLocalidad' => 'max:75',
            'S_Domicilio' => 'max:100',
            'N_CodigoPostal' => 'digits:5',
            'S_UsoCFDI' => 'max:45',
            'S_UrlRFC' => 'url|max:450',
            'S_UrlActaConstitutiva' => 'url|max:450',
            'S_Activo' => Rule::in([Empresa::ACTIVA, Empresa::INACTIVA]),
            'S_Comentarios' => 'max:255',
        ];

        $this->validate($request, $rules);

        $empresa->fill($request->all());

        if($empresa->isClean()){
            return $this->errorResponse(
                'La empresa debe tener por lo menos un atributo diferente para ser actualizado', 422);  
        }

        $empresa->save();

        return $this->showOne($empresa, 'La empresa ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return $this->showOne($empresa, 'La empresa ha sido eliminada');
    }
}
