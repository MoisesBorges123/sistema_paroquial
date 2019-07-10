<?php

namespace App\Http\Controllers\Painel\Missa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Painel\Missa\TipoIntencao;
class Tipo_intencao extends Controller
{
    private $tipo_intencao;
    public function __construct(TipoIntencao $type_intentions) {
        $this->tipo_intencao = $type_intentions;
    }
    
    public function index(){
        $query=DB::table("tipos_intencoes")->get();                
        $tituloPagina="Tipos de Intenção";
        $page_header="Meus Tipos de Inteção";
        $descricao_page_header="";
        return view('painel\missas\intencoes\tbl-tipo-intencao',compact('tituloPagina','page_header','descricao_page_header','query'));
    }

    public function cadastro(){
        $tituloPagina="Tipos de Intenção";
        $page_header="Cadastrar Tipo de Inteção";
        $descricao_page_header=".";
        return view('painel\missas\intencoes\form-cadastro-tipo-intencao',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function salvar(Request $request){
       ;
        $insert=$this->tipo_intencao->create($request->except('_token'));
        if($insert){
            return redirect()->route('visualizar.TipoIntencao');
        }else{
            return redirect()
                    ->back();
                    
        }
    }
    public function request_dados(){
        
    }
}
