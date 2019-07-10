<?php

namespace App\Http\Controllers\Painel\Registros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Batizados;
use App\Models\Painel\Relacao_Batizados_Paginas;
use App\Models\Painel\Livro;
use Illuminate\Support\Facades\DB;

class Batizado extends Controller
{
    private $livro;
    private $batizado; 
    
    public function __construct(Livro $book) {
        $this->livro = $book;
    }
    public function form_cadastro(){
      $tituloPagina = "Registrar Batizado";
      $page_header = "Registrar Batizado";
      $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
      $livros=DB::table('livros_registros')          
          ->get();
      return view(
              'painel\doc_registros\batismo\form-cadastro-batizado',
              compact(
                      'tituloPagina',
                      'page_header',
                      'descricao_page_header',
                      'livros'
                      )
              );
    }
    public function buscarPageLivro(Request $request){
        if(!empty($request->livro)){
            $query = DB::table("livros_registros")
                    ->join('paginas_livros_registro','livros_registros.id_livros_registros','paginas_livros_registro.livro')
                    ->select('paginas_livros_registro.id_pagina as id','paginas_livros_registro.num_pagina as numero','paginas_livros_registro.foto as image')                    
                    ->where('livros_registros.id_livros_registros',$request->livro) 
                    ->orderby('num_pagina','ASC')
                    ->get();
            $linhas=count($query->all());
            if($linhas>0){
                ob_start();
                    echo""
                . "<div class='form-group'>"
                . "<label>Folha</label>"
                . "<select name='folha' class='form-control'>"
                    . "<option value=''>-Folha do registro-</option>";


                    foreach ($query->all() as $linha){
                        if($linha->numero!=0){
                            if($linha->numero%2==0){
                                $numero = ($linha->numero/2)."v";                    
                            }else{
                                $numero= ($linha->numero+1)/2;
                            }
                            echo"<option value='".$linha->id."'>$numero</option>";                                                
                        }
                    }
                    echo"</select></div>";
                $conteudo = ob_get_clean();
            }else{
                $conteudo="<div class='alert alert-info border-info'>Ainda não foi cadastrado nenhuma página desse livro.</div>";
            }
            
            $dados = array(
                        'resultado' => $conteudo
                    );
        }else{
         $dados=array(
                 'resultado' => "<br><div class='alert alert-warning border-warning'>Por favor selecione um livro.</div>"
                 );   
        }
        
        
         
        return $dados;
    }
    
    
    public function salvar(Request $request){
        $dadosForm = $request->all();
        
        if(!empty($dadosForm['batizando'])){
            //Salvar dados
            $insert  = $this->batizado->create($request->except("_token"));
            if(!empty($insert)){
                return redirect()
                ->back()
                ->with('resposta', 'Cadastrado com sucesso!')
                ->with('tipo','success');                
            }else{
                return redirect()
            ->back()
            ->with('resposta', '<b>OPS!</b> Não Foi possível comunicar com o servidor.')
            ->with('tipo','danger');
            }
        }else{
            return redirect()
            ->back()
            ->with('resposta', 'O preenchimento do campo criança é <b>OBRIGATÓRIO</b>')
            ->with('tipo','danger');
        }
    }
}
