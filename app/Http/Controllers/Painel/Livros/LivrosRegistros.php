<?php

namespace App\Http\Controllers\Painel\Livros;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Livros_Registros\Livros;
use App\Models\Painel\Livros_Registros\Sacramentos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
class LivrosRegistros extends Controller
{
    private $livro;
    private $sacramentos;
    public function __construct(Livros $book, Sacramentos $typebook) {
        $this->livro=$book;
        $this->sacramentos = $typebook;
    }
    
    public function  index(){
        $tituloPagina = "Meus Livros";
        $page_header = "Livros de Registro";
        $descricao_page_header = "Página disponíveis apenas para administradores";        
        
        $dados=DB::table('livros')
                ->join('sacramento','livros.sacramento','=','sacramentos.id_sacramento')
                ->select(
                        'livros.numeracao as numeracao',
                        'livros.data_inicio as inicio',
                        'livros.data_fim as fim',
                        'livros.descricao as descricao',
                        'sacramentos.nome as sacramento'
                        )
                ->orderByRaw('livros.numeracao ASC')
                ->get();
       
        return view("painel/livros/table-livros",compact('tituloPagina','page_header','descricao_page_header','dados'));
        
    }
    public function form_cadastro(){
        $tituloPagina = "Novo Livro";
        $page_header = "Cadastrar Livro";
        $descricao_page_header = "Preencha o formulário abaixo para adicionar um novo livro.";
        $query=$this->sacramentos->all();   
        return view("painel/livros/form-cadastro-livros",compact('tituloPagina','page_header','descricao_page_header','query'));
    }
    

public function salvarLivroDigital(Request $request, FuncoesAdicionais $fn){
        /*
         * Esse Código faz o cadastramento de um novo livro e não de uma nova folha
         * Coloque ele aqui para caso o usuário tente cadastrar uma folha sem cadastrar um livro
         * aí ele manda para esse código para salvar os dados do livro e depois trabalhar com 
         * o cadastramento de uma nova folha.
         */
            $dataForm = $request->all();
            
            //Validação Basica dos Campos
            $validate= validator($dataForm, $this->livro->rules);
            if($validate->fails()){
                
                  return redirect()
                            ->back()
                            ->withInput()
                            ->with('location',-1)
                            ->withErrors($validate);               
                
            }
            
       
            //Segundo nível de validação
            $valores=[];
            $valores[]=['value'=>$dataForm['numeracao'],'type'=>1,'variavel'=>'numeracao'];
            $valores[]=['value'=>$dataForm['sacramento'],'type'=>1];
            if(!empty($dataForm['qtde_paginas'])){
                $valores[]=['value'=>$dataForm['qtde_paginas'],'type'=>1,'variavel'=>'quantidade de paginas'];                
            }
            $valores[]=['value'=>$dataForm['data_inicio'],'type'=>9,'variavel'=>'data inicial'];
            $valores[]=['value'=>$dataForm['data_fim'],'type'=>9,'variavel'=>'data final'];            
            $r=$fn->validacoes($valores);
            
            
            if($r=="23"){  
               
                //Verifica se o intervalo de datas está correto
                if( date('Y-m-d', strtotime($dataForm['data_inicio']))< date('Y-m-d', strtotime($dataForm['data_fim']))){
                    $dado=[];
                    $dado[]=['value'=>$dataForm['numeracao'],'type'=>0];
                    $dado[]=['value'=>$dataForm['data_inicio'],'type'=>0];
                    $dado[]=['value'=>$dataForm['data_fim'],'type'=>0];
                    if(empty($dataForm['descricao'])){
                        $dado[]=['value'=>"-",'type'=>0];                        
                    }else{
                        $dado[]=['value'=>$dataForm['descricao'],'type'=>0];
                        
                    }
                    $dado[]=['value'=>$dataForm['qtde_paginas'],'type'=>0];
                    $dado[]=['value'=>$dataForm['sacramento'],'type'=>0,'variavel'=>'sacramento'];
                    $dado[]=['value'=>1,'type'=>0,'variavel'=>'igreja'];
                    $campos = ['numeracao','data_inicio','data_fim','descricao','quant_paginas','sacramento','igreja'];
                    $dados=$fn->tratamentoDados($dado,$campos);    
                    $insert=$this->livro->create($dados);
                     $sacramentoSelecionado = $this->sacramentos->find($dataForm['sacramento']);
                    return redirect()
                            ->back()
                            ->with('sucesso',"O livro ".$dataForm['numeracao']." de ".$sacramentoSelecionado->nome." foi cadastrado com sucesso.")
                            ->with('sacramento',$dataForm['sacramento'])
                            ->with('livro',$insert->id_livro);
                     
                
                }else{
                   
                    
                    return redirect()
                            ->back()
                            ->withInput()
                            ->with('erro','O periodo selecionado está incorreto, a data final deve ser posterior à data iniial.') ;                           
                  
                 
                     
                    
                }
            }else{
                 
                    return redirect()
                            ->back()
                            ->withInput()
                            ->with('erro',$fn->notificacao1($r));
            
            }
                        
            
        
    }
    
}
