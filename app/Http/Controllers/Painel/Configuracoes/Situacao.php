<?php

namespace App\Http\Controllers\Painel\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Configuracoes\Status;
class Situacao extends Controller
{
    //
     private $situacao;
    public function __construct(Status $status){
        $this->situacao=$status;
    }
    public function index(){
        $query=$this->situacao->all();                
        $tituloPagina="Configurações do Sistema";
        $page_header="Tabela de Status";
        $descricao_page_header="Essa tabela traduz os códigos de situações de cada registro no sistema";
        return view('painel\configuracoes\situacoes\tbl-situacao',compact('tituloPagina','page_header','descricao_page_header','query'));
      
    }
    public function cadastra(){
         $tituloPagina="Configurações do Sistema";
        $page_header="Adicionar um novo Status";
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\configuracoes\situacoes\form-cadastro-situacao',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function delete(){
        
    }
    public function editar(){
        
    }
    public function update(){
        
    }
    public function inset(){
        
    }
}
