<?php

namespace App\Http\Controllers\Painel\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Configuracoes\Status;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
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
    public function delete($id){
        $delete=$this->situacao->find($id)->delete();
        if($delete){
            return redirect()->back();            
        }else{
            return redirect()->back()->withErrors();
        }
    }
    public function editar($id){
        $situacao=$this->situacao->find($id);
        $tituloPagina="Configurações do Sistema";
        $page_header="Editar Status: $id";
        $descricao_page_header=$situacao->descricao;
        return view('painel\configuracoes\situacoes\form-cadastro-situacao',compact('tituloPagina','page_header','descricao_page_header','situacao'));
    }
    public function update(Request $request,$id){
        $dadosDB=$this->situacao->find($id);
        $update=$dadosDB->update($request->except('_token'));
        if($update){
            return redirect()->route("visualizar.Situacoes");
        }else{
            return redirect()
            ->back()
            ->withInput()
            ->withErrors();
        }
    }
    public function insert(Request $request){
        $insert=$this->situacao->create($request->except('_token'));
        if($insert){
            return redirect()->route("visualizar.Situacoes");
        }else{
            return redirect()
            ->back()
            ->withInput()
            ->withErrors();
        }
    }
}
