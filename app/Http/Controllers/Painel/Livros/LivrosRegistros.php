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
        return view("painel/livros/table-livros",compact('tituloPagina','page_header','descricao_page_header'));
        
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
    public function pesquisa(Request $request){
            $livro = $request->input('livro');
            $sacramento = $request->input('sacramento');
            $inicio = $request->input('inicio');
            $fim = $request->input('fim');
            
            $dados=DB::table('livros')
                ->join('sacramentos','livros.sacramento','=','sacramentos.id_sacramento')                
                ->select(
                        'livros.numeracao as numeracao',
                        'livros.data_inicio as inicio',
                        'livros.data_fim as fim',
                        'livros.descricao as descricao',
                        'sacramentos.nome as sacramento'
                        )
                ->when($livro,function($query,$livro){
                                return $query->where('livros.numeracao','=',$livro);
                            }         
                )
                ->when($sacramento,function($query,$sacramento){
                                if(intval($sacramento)<4){
                                    return $query->where('livros.sacramento','=',$sacramento);                                    
                                }
                            }         
                )
                ->when($inicio,function($query,$inicio){
                                return $query->where('livros.data_inicio','>=',$inicio);
                            }         
                )
                ->when($fim,function($query,$fim){
                                return $query->where('livros.data_fim','<=',$fim);
                            }         
                )
               
                ->orderByRaw('livros.numeracao ASC')
                ->get();
                
        ob_start();
            if(!empty($dados[0]->numeracao)){
             
                foreach ($dados as $dado){
                  
                  
                    echo"<div class='col-md-2 col-sm-12'>"
                        ."<div class='thumbnail'>"
                            ."<div class='thumb' >"
                                ."<a href='#' data-lightbox='1' data-title='My caption 1'>"
                                    ."<figure class='text-center'>"
                                        ."<img src='http://127.0.0.1:8000/estilo_painel/assets/images/sistema/agenda.png' alt='' class='listaLivros img-fluid img-thumbnail'>"
                                        ."<figcaption  class='listaLivros'><b>Livro: ".$dado->numeracao."</b></figcaption>"
                                        ."<p>".$dado->sacramento."</p>"
                                        ."<small class='text-center' >Periodo de ".date('d/m/Y',strtotime($dado->inicio))." a ".date('d/m/Y',strtotime($dado->fim))."</small>"
                                    ."</figure>"                                    
                                ."</a>"
                                ."<div class='text-center'>"
                                ."<a class='mytooltip tooltip-effect-9 m-r-10' href='#'>"
                                    . "<button class='btn btn-warning btn-icon'><span class='icofont icofont icofont-plus'></span></button>"
                                    . "<span class='tooltip-content3'>Clique aqui para inserir uma nova página a este livro.</span>"
                                . "</a>"
                                ."<a class='mytooltip tooltip-effect-9 m-r-10' href='#'>"
                                    . "<button class='btn btn-inverse btn-icon'><span class='icofont icofont-eye-alt'></span></button>"
                                    . "<span class='tooltip-content3'>Ver paginas digitais desse livro.</span>"
                                . "</a>"
                                . "<a  class='mytooltip tooltip-effect-9 m-r-10' href='#'>"
                                    ."<button   class='btn btn-danger btn-icon'  ><span class='ion-trash-b'></span></button>"
                                    . "<span class='tooltip-content3'><div class='excluir'>Excluir livro.</div></span>"
                                ."</div>" 
                                
                            ."</div>"
                        ."</div>"
                    ."</div>"; 
                    
                   
                }
            }else{
                echo "<div class='col-md-12 col-sm-12'>"
                        . "<div class='alert alert-info'>"                       
                            . "<p class='h3'>Não foi possível encontrar nenhum registro.</p>"
                        . "</div>"
                    . "</div>";                
            }
                    
         
        $html= ob_get_clean();
        
       $resposta = array(
           'resultadoHtml'=>$html
       );
       return $resposta;
    }
    
}
