<?php

namespace App\Http\Controllers\Painel\Livros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\TipoLivros;
use Illuminate\Support\MessageBag;

class TiposLivros extends Controller
{
    private $tipo_livros;

    public function __construct(TipoLivros $tipos){
        $this->tipo_livros = $tipos;
    }

    public function form_cadastro(){
        $tituloPagina="Tipos de Livro";
        $page_header = "Nova Categoria";
        $descricao_page_header = "Página disponíveis apenas para administradores";        
        return view("painel/livros/form-cadastro-tipos",compact('tituloPagina','page_header','descricao_page_header'));        
    }
    
    
    public function salvar(Request $request){
        //Pega dados do formulario
         
        if(!empty($request)){
            $dadosForm=$request->all(); 
            $insert = $this->tipo_livros->create($dadosForm);

            if(!empty($insert)){
                return redirect()->route('Visualizar.TipoLivro');            
            }else{
                return redirect()->route('FormCadastro.tipolivro');                    
            }            
        }else{
            return redirect()->back();
        }
        
        
    }
    public function index(){
        $tituloPagina = "Minhas Categorias de Livro";
        $page_header = "Categorias";
        $descricao_page_header = "Página disponíveis apenas para administradores";
        $dados=$this->tipo_livros->all();
        return view("painel/livros/table-tipos-livros",compact('tituloPagina','page_header','descricao_page_header','dados'));
    }
    public function exclui_tipo(){
        return view("painel/livros/excluir-tipos-livros");
    }
    public function edita_tipo(){
        return view("painel/livros/editar-tipos-livros");
    }
}
