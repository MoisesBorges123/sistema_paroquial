<?php

namespace App\Http\Controllers\Painel\Configuracoes\Perfil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    //
    public function create(){
        $tituloPagina="Novo Perfil";
        $page_header="Cadastrar Perfil";        
        $descricao_page_header=null;
        return view('painel.configuracoes.perfis.form-cadastro-perfil',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function store(Request $request){
        $data = array(  
            'nome_perfil'=>$request->input(['nome_perfil']),
            'menu'=>null
        );
    }
    public function delete($perfil){

    }

}
