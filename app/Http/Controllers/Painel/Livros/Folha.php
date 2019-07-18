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
    
    public function form_folha_via_cadas_livro($livro,$sacramento){
      $tituloPagina = "Adicionar Folha";
      $dadosLivro= $this->livro->find($livro);
      $dadosSacramento = $this->sacramento->find($sacramento);
      $page_header = "Adicinar Folhas ao Livro ".$dadosLivro->numeracao." de ".$dadosSacramento->nome.".";
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
                                <input class='form-control' type='number' id='numeracao_pagina' name='numeracao_pagina'  placeholder='Ex. 1,2,3,4,...' required=''>
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
        $dados_VALIDACAO[]=['value'=>$request->input("numeracao_pagina"),'type'=>8,'variavel'=>'numeração da página'];
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
    
    public function salvar_folha2(Request $request,$livroSelect){
            
            $dadosForm = $request->except('_token');
            $buscaFolha = $this->pagina->where('num_pagina',$dadosForm['numero_folha']);
            if(empty($buscaFolha->id_folha)){
                if(!empty($dadosForm['foto'])){
                    $extencao=$dadosForm['foto']->extension();
                    $tamanho=$dadosForm['foto']->getClientSize();
                    $nameFile= uniqid(time()).".".extencao;
                    $caminho="Imagens/Livro_".$dadosForm['livro']."/Folhas/";
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
                                           ->with('success2','Ok! Folha cadastrada com sucess.')
                                           ->withInput();
                               }
                    }else{
                        return redirect()
                               ->back() 
                                ->with('erro2','Ops! Erro ao cadastrar dados referentes a imagem selecionada.')
                                -withInput();
                    }
                        
                    }else{
                        return redirect()
                                ->back()
                                ->withInput()
                                ->with('erro2','Ops! Ocorreu um erro ao fazer o upload do seu arquivo.');
                                
                    }
                    
                }
            }else{
                /*
                 * Os dados digitados pelo usuário já foram cadastrados (Essa pagina já existe)
                 */
                ob_start();
                echo"<div class=\"bd-example bd-example-modal\" >
                    <div class=\"modal\" style='background:none'>
                        <div class=\"modal-dialog\" role=\"document\">
                            <div class=\"modal-content\">
                                <div class=\"modal-header bg-warnning\">
                                    <h5 class=\"modal-title\">Duplicação de dados!</h5>
                                   
                                </div>
                                <div class=\"modal-body\">

                                    <p><b>Ops!</b>Os dados que você inseriu já foram cadastrados no sistema, deseja sobrescrever os dados ou apenas adicionar mais uma foto 
                                    à página em .</p>
                                </div>
                                <div class=\"modal-footer\">
                                    <a href=".route('FormCadastro.Livro')." class=\"btn btn-secondary mobtn\" data-dismiss=\"modal\">Cadastrar Mais Livros</button>
                                    <a href=".route('FormCadastro2.Folha',['livro' =>session('livro'),'sacramento'=> session('sacramento')])." class=\"btn btn-primary mobtn\">Adicionar Folhas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
                $alerta= ob_get_clean();
            }
        
          
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
}
