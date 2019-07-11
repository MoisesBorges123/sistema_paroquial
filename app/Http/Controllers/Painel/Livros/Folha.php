<?php

namespace App\Http\Controllers\Painel\Livros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Livros_Registros\Livros;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use Illuminate\Validation\Validator;



use App\Models\Painel\TipoLivros;
use App\Models\Painel\FolhaLivro;

class Folha extends Controller
{
    //
    private $livro;
    private $tipo_livro;
    private $pagina;
    
    public function __construct(Livros $book,TipoLivros $tipo_livro, FolhaLivro $page) {
        $this->livro = $book;        
        $this->pagina =$page;
        $this->tipo_livro = $tipo_livro;       
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
    
    public function form_cadastro($livro){
        $dado = DB::table('livros_registros')
                ->where('id_livros_registros',$livro)
                ->first();
        $paginasCadastradas =DB::table('paginas_livros_registro')
                ->where('livro',$livro)   
                ->orderBy('paginas_livros_registro.num_pagina','asc')
                ->get();
                
       
        $tituloPagina = "Adicionar Folha";
        $page_header = "Adicinar Folha no Livro ".$dado->numero;
      $descricao_page_header="Paginas Cadastradas: ";
    
        if(!empty($paginasCadastradas)){
            
            foreach ($paginasCadastradas->all() as $pagina){
                $descricao_page_header.=$pagina->num_pagina.", ";
              
            }
            
        }else{
            $descricao_page_header = "Livro em branco.";
        }
      
        return view('painel\livros\form-cadastro-folhas',compact('tituloPagina','page_header','descricao_page_header','dado'));
    }
    
    public function salvarLivroDigital(Request $request, FuncoesAdicionais $fn){
        
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
                                <option value='-1'>Outro Livro</option";
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
                                <textarea class='form-control'  name='obs_folha' rows='10' placeholder='Insira aqui alguma observação referente a página digitalizada, se existe algum erro, ou se está rasgada ou não está integra etc...'></textarea>
                            </div>
                            <div class='col-md-12 m-t-40 resultado1'>                           
                                <input type='file' name='files[]' class='foto' multiple='multiple' required=''>
                            </div>
                            <div class='col-md-6 col-sm-3 text-left resultado1'>
                                <button class='btn btn-danger' type='button' id='btn-sair'>Cancelar</button>   
                            </div>
                            <div class='col-md-6 col-sm-3 text-right resultado1'>
                                <button class='btn btn-success' id='btn-salvar' type='submit'>Cadastrar</button>
                            </div>";
            $dados_folha=ob_get_clean();
            
           
        }
        $dados = array(
                    'resultadoHTML'=>$dados_folha
        );
        return $dados;
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
