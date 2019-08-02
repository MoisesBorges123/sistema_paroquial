<?php

namespace App\Http\Controllers\Painel\Registros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Batizado extends Controller
{
    public function form_cadastro(){
      $tituloPagina = "Livro Digital";
      $page_header = "Siga o passo a passo para adicionar novas folhas ao livro digital";
      $descricao_page_header="";
        return view('painel/doc_registros/batismo/form-cadastro-batizado',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function busca_igreja(Request $request){
        
    }
}
