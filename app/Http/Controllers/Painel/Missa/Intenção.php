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
    public function __construct(Intencao $intentions, TipoIntencao $typeIntentions){
        $this->intentions=$intentions;
        $this->tipo_intencao = $typeIntentions;
        date_default_timezone_set('America/Sao_Paulo');
        
    }
    public function  index(){
        $query0=$this->intentions->all()->where('data_inicio','=',date('Y-m-d',time()));
        $query=[];
        foreach ($query0 as $value){            
            $dadosTipoIntencao = $this->tipo_intencao->find($value->tipo);
            $intencao = $dadosTipoIntencao->nome;
            $query[]=['id_intencao'=>$value->id_intencao,'falecido'=>$value->falecido,'solcitante'=>$value->solicitante,'telefone'=>$value->telefone,'data_inicio'=>$value->data_incio,'data_fim'=>$value->data_fim,'horario'=>$value->horario,'intencao'=>$intencao];            
        }
        $tituloPagina="Intenção de Missa";
        $page_header="Minhas Inteções";
        $descricao_page_header="";
        return view('painel\missas\intencoes\tbl-intencao',compact('tituloPagina','page_header','descricao_page_header','query'));
    }
    public function insert(Request $request, FuncoesAdicionais $fn){
        
    }
    public function update($id){
        
    }
    public function delete($id){
        
    }
    public function cadastro(){
        $tituloPagina="Inteção";
        $page_header="Nova Inteção";
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\missas\intencoes\form-cadastro-intencao',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function  editar(){
        
    }
    
}
