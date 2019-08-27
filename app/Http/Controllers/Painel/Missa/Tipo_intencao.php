<?php

namespace App\Http\Controllers\Painel\Missa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Painel\Missa\TipoIntencao;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
class Tipo_intencao extends Controller
{
    private $tipo_intencao;
    public function __construct(TipoIntencao $type_intentions) {
        $this->tipo_intencao = $type_intentions;
    }
    
    public function index(){
        $query=$this->tipo_intencao->all()->where('situacao','=','1');                
        $tituloPagina="Tipos de Intenção";
        $page_header="Meus Tipos de Inteção";
        $descricao_page_header="";
        return view('painel\missas\tipo_intencoes\tbl-tipo-intencao',compact('tituloPagina','page_header','descricao_page_header','query'));
    }

    public function cadastro(){
        $tituloPagina="Configurações - Tipo de Inteção";
        $page_header="Cadastrar Tipo de Inteção";
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\missas\tipo_intencoes\form-cadastro-tipo-intencao',compact('tituloPagina','page_header','descricao_page_header'));
    }
    public function salvar(Request $request, FuncoesAdicionais $fn){
        
       $valores=[] ;
       $valores[]=['value'=>$request->input('tipo'),'type'=>6];       
       if(!empty($request->input('descricao'))){
           $valores[]=['value'=>$request->input('descricao'),'type'=>8];
           $campos=['nome','descricao','linhas_a_mais','situacao'];
       }else{
           $campos=['nome','linhas_a_mais','situacao'];
           
       }
       $valores[]=['value'=>$request->input('linhas'),'type'=>0];
       $valores[]=['value'=>$request->input('situacao'),'type'=>0];
       $verificacao=$fn->validacoes($valores);
        if($verificacao=="23"){
            $dados=$fn->tratamentoDados($valores, $campos);
            $insert=$this->tipo_intencao->create($dados);

            if($insert){
                return redirect()->route('visualizar.TipoIntencao');
            }else{
                return redirect()
                        ->withInput()
                        ->withErrors()
                        ->back();

            }            
        }else{
            return redirect()
                        ->withInput()
                        ->with('erro','Ocorreu um problema ao salvar esses dados <b>código '.$verificacao)
                        ->back();
        }
    }
    public function deletar($id){
      
        $deletar=$this->tipo_intencao->find($id)->delete();
        if($deletar){
            return redirect()
            ->back();            
        }else{
            
            $update=$this->tipo_intencao->find($id)->update(['situacao'=>0]);
            return redirect()
            ->back(); 
        }
        
      
    }
    public function editar($id){
        $tipoIntencao = $this->tipo_intencao->find($id);
        $tituloPagina="Configurações - Tipo de Inteção";
        $page_header="Editar Intenção: ".$tipoIntencao->nome;
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\missas\tipo_intencoes\form-cadastro-tipo-intencao',compact('tituloPagina','page_header','descricao_page_header','tipoIntencao' ));
    }
    public function update(Request $request, $id, FuncoesAdicionais $fn){
          
       $valores=[] ;
       $valores[]=['value'=>$request->input('tipo'),'type'=>6];       
       if(!empty($request->input('descricao'))){
           $valores[]=['value'=>$request->input('descricao'),'type'=>8];
           $campos=['nome','descricao','linhas_a_mais'];
       }else{
           $campos=['nome','linhas_a_mais'];
           
       }
       $valores[]=['value'=>$request->input('linhas'),'type'=>0];
       
       $verificacao=$fn->validacoes($valores);
        if($verificacao=="23"){
            
            $dados=$fn->tratamentoDados($valores, $campos);
            
            $dadosBD=$this->tipo_intencao->find($id);
            $update=$dadosBD->update($dados);

            if($update){
                return redirect()->route('visualizar.TipoIntencao');
            }else{
                return redirect()
                        ->withInput()
                        ->withErrors()
                        ->back();

            }            
        }else{
            return redirect()
                        ->withInput()
                        ->with('erro','Ocorreu um problema ao salvar esses dados <b>código '.$verificacao)
                        ->back();
        }
    }
}
