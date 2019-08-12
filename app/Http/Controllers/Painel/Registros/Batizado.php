<?php

namespace App\Http\Controllers\Painel\Registros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Painel\Igrejas\Igrejas;
use App\Models\Painel\Igrejas\Capelas;
use App\Models\Painel\Registros\Batizando;
use App\Models\Painel\Registros\Batizado;
use App\Models\Painel\Livros_Registros\Folhas;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;

class Batizado extends Controller
{
    private $igreja;
    private $capela;
    private $folha;
    private $batizando;
    private $batizado;
    public function __construct(Batizando $batizand, Batizado $baptismo,Igrejas $church, Capelas $subChurch, Folhas $page) {
        $this->igreja = $church;
        $this->capela = $subChurch;
        $this->folha = $page;
        $this->batizando = $batizand;
        $this->batizado = $baptismo;
    }
    public function form_cadastro(){
      $tituloPagina = "Livro Digital";
      $page_header = "Registrar Batizado";
      $descricao_page_header="Siga o passo a passo para fazer o registro de um novo batizado.";
      $dadosLivro=DB::table('livros')
              ->where('sacramento','1')
              ->orderBy('numeracao','asc')
              ->get();
        return view('painel/doc_registros/batismo/form-cadastro-batizado',compact('tituloPagina','page_header','descricao_page_header','dadosLivro'));
    }
    public function busca_igreja(Request $request){
        #1-Capela / 2-Igreja
        $tipo=$request->input('tipo');
        if($tipo==1){
            $dadosCapela=$this->capela->all();
            ob_start();
            echo"<select class='form-control' name='capela' id='capela'>"
                . "<option value=''> - Seleciona a capela - </option>";
            foreach($dadosCapela as $dado){
                echo"<option value='".$dado->id_capela."'>".str_replace('Capela ','',$dado->nome)."</option>";
            }
            echo"<option value='-1'>Não está na Lista</option> </select>";
            $resultado = ob_get_clean();
        }else{
        
            $dadosIgreja=$this->igreja->all();            
     
            ob_start();
            echo"<select class='form-control' id='igreja' name='igreja'>"
                . "<option value=''> - Seleciona a igreja - </option>";
            foreach($dadosIgreja as $dado){
                echo"<option value='".$dado->id_igreja."'>".str_replace("Paróquia ","", $dado->nome)."</option>";
            }
            echo"<option value='-1'>Não está na Lista</option> </select>";
            $resultado = ob_get_clean();
          
     
        }
        $resposta = array(
            'resultado'=>$resultado
        );
        return $resposta;
    }    
    public function busca_folha(Request $request, FuncoesAdicionais $fn){
        $livro = $request->input('livro');
        $dadosFolhas=DB::table('folhas')
                ->where('livro',$livro)
                ->orderBy('num_pagina','asc')
                ->get();
        ob_start();
            
        echo"<div class='resultado0 col-md-3 col-sm-12'>"
        . "<select class='form-control' name='folha' id='folha'>"
                . "<option value=''>- Selecione uma folha -</option>";
        if(count($dadosFolhas)>0){
                    
            foreach($dadosFolhas as $dado){
                if($fn->converter_numeracaoFolha($dado->num_pagina, 2)!="0"){
                    echo"<option value='".$dado->id_folha."'>".$fn->converter_numeracaoFolha($dado->num_pagina, 2)."</option>";
                }
            }
        }
                echo"<option value='-1'>Não está na Lista</option>"
        . "</select>"
        . "</div>";
        $resultado= ob_get_clean();    
        
        $resposta = array(
            'resultado'=>$resultado
        );
        return $resposta;
    }
    public function salvar(Request $request,FuncoesAdicionais $fn){
        $valores=[];
        $valores[]=['value'=>$request->input('batizando'),'type'=>8];
        $valores[]=['value'=>$request->input('pai'),'type'=>8];
        $valores[]=['value'=>$request->input('mae'),'type'=>8];
        $valores[]=['value'=>$request->input('padrinho'),'type'=>8];
        $valores[]=['value'=>$request->input('madrinha'),'type'=>8];
        $valores[]=['value'=>$request->input('d_nasc'),'type'=>8];
        if($fn->validacoes($valores)=="23"){
            $valores2=[];
            $valores2[]=['value'=>$requst->input('batizando'),'type'=>1];
            $valores2[]=['value'=>$requst->input('pai'),'type'=>1];
            $valores2[]=['value'=>$requst->input('mae'),'type'=>1];
            $valores2[]=['value'=>$requst->input('padrinho'),'type'=>1];
            $valores2[]=['value'=>$requst->input('madrinha'),'type'=>1];
            $valores2[]=['value'=>$requst->input('d_nasc'),'type'=>0];
            $valores2[]=['value'=>$requst->input('sexo'),'type'=>0];
            $campos2=['nome','pai','mae','padrinho','madrinha','data_nasc','sexo'];
            $dadosBatizando = $fn->tratamentoDados($valores, $campos);
        }
        
    }
}
