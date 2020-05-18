<?php

namespace App\Http\Controllers\Painel\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Configuracoes\TipoCartas;
class TipoCarta extends Controller
{
    //
    private $tipo_carta;
    public function __construct(TipoCartas $letterType){
        $this->tipo_carta = $letterType;
    }
    public function index(){
        $query=$this->tipo_carta->all();                
        $tituloPagina="Configurações do Sistema";
        $page_header="Tipo de Cartas";
        $descricao_page_header="Tabela do tipo de cartas que a paroquia tem o costume de enviar";
        return view('painel\configuracoes\tipo_carta\tbl-tipo-carta',compact('tituloPagina','page_header','descricao_page_header','query'));
      
    }
    public function cadastra(){
         $tituloPagina="Configurações do Sistema";
        $page_header="Adicionar um novo Tipo de Carta";
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\configuracoes\tipo_carta\form-cadastro-tipo-carta',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function delete($id){
        $delete=$this->tipo_carta->find($id)->delete();
        if($delete){
            return redirect()->back();            
        }else{
            return redirect()->back()->withErrors();
        }
    }
    public function editar($id){
        $tipo=$this->tipo_carta->find($id);
        $tituloPagina="Configurações do Sistema";
        $page_header="Editar Tipo de Carta: $id";
        $descricao_page_header=$situacao->descricao;
        return view('painel\configuracoes\tipo_carta\form-cadastro-tipo-carta',compact('tituloPagina','page_header','descricao_page_header','tipo'));
    }
    public function update(Request $request,$id){
        $dadosDB=$this->tipo_carta->find($id);
        $update=$dadosDB->update($request->except('_token'));
        if($update){
            return redirect()->route("visualizar.TipoCarta");
        }else{
            return redirect()
            ->back()
            ->withInput()
            ->withErrors();
        }
    }
    public function insert(Request $request){
        $insert=$this->tipo_carta->create($request->except('_token'));
        if($insert){
            return redirect()->route("visualizar.TipoCarta");
        }else{
            return redirect()
            ->back()
            ->withInput()
            ->withErrors();
        }
    }

}
