<?php

namespace App\Http\Controllers;

use App\Corporativo;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CorporativoEmpresaController extends Controller
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
            'S_RazonSocial' => 'required|max:150',
            'S_RFC' => 'required|max:13|alpha_num',
            'S_Pais' => 'max:75',
            'S_Estado' => 'max:75',
            'S_Municipio' => 'max:75',
            'S_ColoniaLocalidad' => 'max:75',
            'S_Domicilio' => 'max:100',
            'N_CodigoPostal' => 'digits:5',
            'S_UsoCFDI' => 'max:45',
            'S_UrlRFC' => 'url|max:450',
            'S_UrlActaConstitutiva' => 'url|max:450',
            'S_Activo' => [Rule::in([Empresa::ACTIVA, Empresa::INACTIVA]), 'required'],
            'S_Comentarios' => 'max:255',
        ];

        $data = $this->validate($request, $rules);

        $data['tw_corporativos_id'] = $corporativo->id;

        $empresa = Empresa::create($data);

        return $this->showOne($empresa, 'La empresa ha sido creada');
    }

}
