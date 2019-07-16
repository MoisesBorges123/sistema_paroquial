<?php

namespace App\Http\Controllers\Painel\Livros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Livros_Registros\Livros;
use App\Models\Painel\Livros_Registros\Folhas;
use App\Models\Painel\Livros_Registros\Foto_folhas;
use App\Models\Painel\Livros_Registros\Sacramentos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use Illuminate\Validation\Validator;





class Folha extends Controller
{
    //
    private $livro;
    private $fotos;
    private $pagina;
    private $sacramento;
    
    public function __construct(Livros $book, Folhas $paper, Foto_folhas $picture, Sacramentos $holyActivities) {
        $this->livro = $book;        
        $this->pagina =$paper;
        $this->fotos = $picture;
        $this->sacramento = $holyActivities;
    }
    public function index(){
        
      $tituloPagina = "Livro Digital";
      $page_header = "Siga o passo a passo para adicionar novas folhas ao livro digital";
      $descricao_page_header="";
      $query = DB::table ('livros')
              ->orderBy('numeracao','asc')
              ->get();
      $query2 = DB::table ('sacramentos')
              ->orderBy('nome','asc')
              ->get();
        return view('painel\livros\ver-livro-registro',compact('tituloPagina','page_header','descricao_page_header','query','query2'));
    }
    

    
    public function salva_folha_via_cadas_livro($livo,$sacramento){
      $tituloPagina = "Adicionar Folha";
      $page_header = "Adicinar Folhas ao Livro ".$this->livro-find($livro)->numeracao." de ".$this->sacramento->find($sacramento)->nome.".";
      $descricao_page_header="Paginas Cadastradas: ";

      $dados= array(
          'livro'=>$livro,
          'sacramento'=>$sacramento          
      );
      return view('painel\livros\ver-livro-registro',compact('tituloPagina','page_header','descricao_page_header','dados'));
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
                    return redirect()
                            ->back()
                            ->with('livro',$insert->id_livro);
                }else{
                   
                    
                    return redirect()
                            ->back()
                            ->withInput()
                            ->with('erro','O periodo selecionado está incorreto, a data final deve ser posterior à data iniial.')                            
                            ->with('location',-1);
                 
                     
                    
                }
            }else{
                 
                    return redirect()
                            ->back()
                            ->withInput()
                            ->with('erro',$fn->notificacao1($r))
                            ->with('location',-1);
            }
                        
            
        
    }
    
    public function buscar_livros(Request $request){
        $sacramento = $request->only("sacramento");        
         $livros = DB::table ('livros')
              ->where('sacramento',$sacramento)
              ->orderBy('numeracao','asc')
              ->get();
       
        if(empty($livros)){
            ob_start();
               echo"<div class='col-md-12 col-sm-12 resultado1'><div class='alert alert-warning'>Não existe nenhum livro desse sacramento em nossos registros"
            . "por favor <a href='".route('FormCadastro2.Livro',$request->only("sacramento")).
            "'>CLIQUE AQUI</a> para adicionar um NOVO LIVRO.</div></div>";         
       
            $dados_folha= ob_get_clean();
          
        }else{
            
            ob_start();
            echo"<div class='col-md-6 col-sm-12 resultado1'>
                            <label>Digitalizar Livro:</label>
                            <select class='form-control' name='livro' id='livro'>
                                <option value=''>Selecione um livro</option>
                                <option value='-1'>Outro Livro</option>";
                                foreach($livros as $livro){
                                    echo"<option value='".$livro->id_livro."'>".$livro->numeracao."</option>";
                                }                          
                            echo"</select>
                        </div>

                            <div class='col-md-5 resultado1'>
                                <label>*Numero da Página</label>
                                <input class='form-control' type='number' name='numeracao_pagina'  placeholder='Ex. 1,2,3,4,...' required=''>
                            </div>

                            <div class='col-md-12 resultado1'>
                                <label>Observações</label>
                                <textarea class='form-control' id='observacoes'  name='obs_folha' rows='10' placeholder='Insira aqui alguma observação referente a página digitalizada, se existe algum erro, ou se está rasgada ou não está integra etc...'></textarea>
                            </div>
                            
                            <div class='col-md-6 col-sm-3 text-left resultado1'>
                                <button class='btn btn-danger sair' type='button' >Cancelar</button>   
                            </div>
                            <div class='col-md-6 col-sm-3 text-right resultado1 ' id='btn-step2'>
                                <button class='btn btn-inverse' id='btn-salvar' type='button'>Avançar</button>
                            </div>";
            $dados_folha=ob_get_clean();
            
           
        }
        $dados = array(
                    'resultadoHTML'=>$dados_folha
        );
        return $dados;
    }   
    
    public function validaStep1(Request $request, FuncoesAdicionais $fn){
      
        $dados_VALIDACAO=[];
        $dados_VALIDACAO[]=['value'=>$request->input("livro"),'type'=>1,'variavel'=>'livro'];
        $dados_VALIDACAO[]=['value'=>$request->input("numeracao_pagina"),'type'=>0,'variavel'=>'numeração da página'];
        if(!empty($request->input("obs_folha"))){
            $dados_VALIDACAO[]=['value'=>$dataForm['obs_folha'],'type'=>8,'variavel'=>'observações'];
        }
        
        $r=$fn->validacoes($dados_VALIDACAO);
        if($r=="23"){
            ob_start();
                echo""
            . "<div class='col-md-12 col-sm-12 resultado2'>"
                . "<div id='mostra-foto'><i class=\"icofont icofont-cloud-upload\" style='font:35px;'></i> <div style='font:35px;'>Fazer Upload</div></div>"
                . "<div class='icon-btn fade buttons'>"
                
                . "<button id='btn-deleta-foto' type='button' class=\"btn btn-danger btn-icon\"><i class=\"icofont icofont-trash\"></i></button>"
                . "<button id='btn-upload-foto' type='submit' class=\"btn btn-success btn-icon\"><i class=\"icofont icofont icofont-ui-check\"></i></button>"
                . "</div>"
                . "<input type='file' name='foto' class='form-control fade' accept='image/*' id='foto-livro'>"
                . "</div>"
                . "<div class='col-md-6 col-sm-3 text-left resultado2'>
                    <button class='btn btn-danger sair' type='button' >Cancelar</button>   
                </div>";
            $dadosHTML= ob_get_clean();
            $resposta=1;
        }else{
            $mensagem = $fn->notificacao1($r);
            ob_start();
                echo"<div class='col-md-12 com-sm-12 resultado2'>"
                    . "<div class='alert alert-warning'>"
                        . "$mensagem"                      
                    . "</div>"
                . "</div>";
            $dadosHTML = ob_get_clean();
            $resposta=0;
                
            
        }
           
        $dados = array(
            'html' =>$dadosHTML,
            'resposta'=>$resposta
        );
        return $dados;
    }
    
    public function salvar_folha(Request $request, FuncoesAdicionais $fn){
     
        $dadosForm = $request->except('_token');
        if(!empty($dadosForm)){
            
            $extencao=$dadosForm['foto']->extension();
            $tamanho=$dadosForm['foto']->getClientSize();
            $nameFile=uniqid(time()).".".$extencao;
            $caminho = "Imagens/Livro_".$dadosForm['livro']."/Folhas/";
            $upload=$dadosForm['foto']->storeAs($caminho,$nameFile);

            if($upload){
                $campos=['num_pagina','livro','observacao'];
                $valores=[];      
                $valores[]=['value'=>$dadosForm['numeracao_pagina'],'type'=>0];
                $valores[]=['value'=>$dadosForm['livro'],'type'=>0];
                $valores[]=['value'=>$dadosForm['obs_folha'],'type'=>0];
                $dadosTratados=$fn->tratamentoDados($valores, $campos);
                $r=$this->pagina->create($dadosTratados);
                $folha = $r->id_folha;

                if($r){
                   $dados=[
                       'foto'   => $nameFile,
                       'tamanho'=>$tamanho,
                       'caminho'=>$caminho,
                       'folha'  =>$folha
                   ];

                   $r2=$this->fotos->create($dados);

                   if($r2){
                       return redirect()
                        ->back()
                        ->with('success','OK! Folha adicionada com sucesso.');

                   }
                }else{
                    return redirect()
                        ->back()
                        ->with('erro','Erro ao salvar os dados verifique se estão corretos.')
                        ->withInput();
                }
            }else{
                return redirect()
                        ->back()
                        ->with('erro','Não foi possível fazer o upload do arquivo.')
                        ->withInput();
            }
            
        }else{
            return redirect()
                        ->back()
                        ->with('erro','Não foi possível encontrar o arquivo selecionado.')
                        ->withInput();
        }
        
    }
    
    public function salvar(Request $request,$livroSelect){
        //Pega dados do formulario         
        if(!empty($request)){
            $dadosForm=$request->all(); 
            $dados_livro=DB::table('livros_registros')->where('id_livros_registros',$livroSelect)->first();
            $file=$dadosForm['foto'];
            $qtdeFotos=count($file);
          
            for($i=0;$i<$qtdeFotos;$i++){
                $extencao=$dadosForm['foto'][$i]->extension();
                $nameFile=uniqid(time()).".".$extencao;
                $upload=$dadosForm['foto'][$i]->storeAs("public/Livros/".$dados_livro->numero,$nameFile);
                if($upload){
                    
                    $insert = DB::table('paginas_livros_registro')
                            ->insert([
                                'livro'=> $livroSelect,
                                'num_pagina'=>$dadosForm['num_pagina'],
                                'foto'=>$nameFile,
                                'observacao'=> $dadosForm['observacao']
                                ]);
                    if($insert){
                        return redirect()->route("FormCadastro.Folha",$livroSelect)
                                ->with('mensagem','Folha adicionada com sucesso!')
                                ->with('tipo','success');
                        
                    }else{
                        return redirect()->route("FormCadastro.Folha",$livroSelect)
                                ->with('mensagem','Ops! Não foi possivel adicionar essa folha ao livro.')
                                ->with('tipo','danger');
                    }
                    
                }else{
                    return redirect()->back()
                            ->with('mensagem','Não foi possivel fazer o upload desse arquivo ao servidor, por favor verifique a sua conexão.')
                            ->with('tipo','warning');
                }
            }
            
           
    }else{
        return redirect()->back()-with('mensagem','Não foi possivel concectar ao servidor por favor verifique sua conexão.');
    }
    
    
    
    }
}
