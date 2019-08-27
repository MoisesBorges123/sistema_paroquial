<?php

namespace App\Http\Controllers\Painel\Missa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use App\Models\Painel\Missa\Intencao;
use App\Models\Painel\Missa\TipoIntencao;
class Intenção extends Controller
{
    //
    private $intentions;
    private $tipo_intencao;
    public function __construct(Intecao $intentions, TipoIntencao $typeIntentions){
        $this->intentions=$intentions;
        $this->tipo_intencao = $typeIntentions;
        date_default_timezone_set('America/Sao_Paulo');
        
    }
    public function  index(){
        $query=$this->intentions->all()->where('data_inicio','=',date('Y-m-d',time()));
        $tituloPagina="Intenção de Missa";
        $page_header="Minhas Inteções";
        $descricao_page_header="";
        return view('painel\missas\intencoes\tbl-tipo-intencao',compact('tituloPagina','page_header','descricao_page_header','query'));
    }
    public function insert(Request $request, FuncoesAdicionais $fn){
        
    }
    public function update($id){
        
    }
    public function delete($id){
        
    }
    public function cadastrar(){
        
    }
    public function  editar(){
        
    }
    
}
