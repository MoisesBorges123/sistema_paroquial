<?php

namespace App\Http\Controllers\Painel\Dizimo;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Dizimo\Dizimistas;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use App\Models\Painel\Dizimo\Q_meus_dizimistas;
use App\Models\Painel\Configuracoes\Status;
use App\Models\Painel\Pessoa\Pessoas;
use App\Models\Painel\Enderecos\Logradouros;
use App\Models\Painel\Enderecos\Enderecos;
use App\Models\Painel\Telefone\Telefones;
use App\Models\Painel\Enderecos\Estado;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Painel\Pessoa\Pessoa;
class Dizimista extends Controller
{
    //
    private $dizimistas;
    private $meus_dizimistas;
    private $situacao;
    private $minhas_funcoes;
    private $pessoas;
    private $logradouro;
    private $telefone;
    private $endereco;
    private $estado;
    
    
    public function __construct(Dizimistas $tithing, Q_meus_dizimistas $query_dizimistas, Status $status, FuncoesAdicionais $my_functions, Pessoas $people, Logradouros $adress, Telefones $phone, Enderecos $location, Estado $state) {
        $this->dizimistas = $tithing;
        $this->meus_dizimistas = $query_dizimistas;
        $this->situacao = $status;
        $this->minhas_funcoes = $my_functions;
        $this->pessoas = $people;
        $this->logradouro = $adress;
        $this->telefone = $phone;
        $this->endereco = $location;        
        $this->estado = $state;
        
    }
    public function buscar_dizimista(Request $request){
        $cadastro=$this->meus_dizimistas->where('id_dizimista',$request->input('dizimista'))->first();
        $telefone = $this->telefone->where('pessoa',$cadastro->pessoa)->get();
        $total_telefones = count($telefone);
        return array('dados'=>$cadastro,'telefones'=>$telefone,'total_telefones'=>$total_telefones);
    }
    public function meus_dizimistas(Request $request){
        if(!empty($request->input('query'))){            
            $ativo = $this->situacao->where('descricao',$request->input('query'))->first();
            $query = $this->meus_dizimistas->where('situacao',$ativo->id_situacao)->get();
        }else{
            $query = $this->meus_dizimistas->all(); 
            
        }
        
        if(count($query)>0){
            $dados=[];            
            foreach($query as $q){
                if(!empty($q->rua)) {
                    $endereco = $q->rua.", ".$q->num_casa.", ".$q->bairro.", ".$q->cidade.", cep: ".$q->cep;
                    
                }else{
                    $endereco = '';
                }               
                $telefone=DB::table('telefones')->where('pessoa',$q->id_pessoa)->first();
                $id_telefone = empty($telefone->id_telefone) ? '' : $telefone->id_telefone;
                $numero = empty($telefone->numero) ? '' : $telefone->numero;
               $dados[]=[
                   'url_excluir'=>route('Deleta.Dizimista',$q->id_dizimista),
                   'url_restaurar'=>route('Restaura.Dizimista',$q->id_dizimista),
                   'situacao'=>$q->situacao,
                   'nome'=>$q->nome,
                   'endereco'=>$endereco,
                   'd_nasc'=>date('d/m/Y',strtotime($q->d_nasc)),
                   'id_dizimista'=>$q->id_dizimista,
                   'id_pessoa'=>$q->id_pessoa,
                   'id_telefone'=> $id_telefone,
                   'telefone'=>$numero];
            }
        }else{
            $dados=null;
        }
        
        
        return array(
            'total_registros'=>count($query),
            'dados'=>$dados,            
        );
    }
    public function index(){
        //Registro Ativo
            $ativo = $this->situacao->all()->where('descricao','Registro Ativo')->first();
            $query = $this->meus_dizimistas->all()->where('situacao',$ativo->id_situacao);
        
        //$total_dizimistas = ceil(($this->situacao->all()->where('descricao','Registro Ativo')->first()->count())/10);
        
        $tituloPagina = "Meus Dizimistas";
        $page_header = "Dizimistas da Catedral";
        $descricao_page_header="";
        $meses=[];
        for($i=1;$i<=12;$i++){
            $meses[]=['key'=>$i,'mes'=>$this->minhas_funcoes->data_portugues(3, $i)];
        }
        
        
        
        return view('painel\dizimo\tbl-dizimistas',compact('tituloPagina','page_header','descricao_page_header','query','meses'));
    }//AO INICIAR EXECUTE ESSA FUNÇÃO       
    private function getSituacaoID($situacao){
        $estado = $this->situacao->all()->where('descricao',$situacao)->first();
        return $estado->id_situacao;
    }//BUSCA O ID DE UMA SITUAÇÃO NA TABELA STATUS
    private function insert_pessoa(Request $request){
        $fn_pessoa = new Pessoa;
        if($request->input('pessoa')){
            $dadosPessoa=$fn_pessoa->getpeople($request->input('pessoa'));
            $dadosPessoa = $dadosPessoa==false ? $fn_pessoa->salvar_pessoa($request) : $dadosPessoa;
            
        }else if($request->input('nome')){
            $dadosPessoa=$fn_pessoa->getpeople($request->input('nome'));
            $dadosPessoa = $dadosPessoa==false ? $fn_pessoa->salvar_pessoa($request) : $dadosPessoa;
        }
        
        return $dadosPessoa;
    }//CADASTRAR UMA PESSOA
    private function insert_dizimista($pessoa){
        $data=date('Y-m-d',time());
        $situacao = $this->getSituacaoID("Registro Ativo");
        $insert = $this->dizimistas->create(['pessoa'=>$pessoa,'d_cadastro'=>$data,'situacao'=>$situacao]);
        return $insert;
    }//CADASTRA UM DIZIMISTA
    public function salva_dizimista(Request $request, FuncoesAdicionais $fn){
        $dataForm = $request->except("_token");
        $validacaoPessoa = validator($dataForm,$this->pessoas->rules);
        
        if($validacaoPessoa ){            
          $pessoa = $this->insert_pessoa($request);         
          
          $dizimista = $this->insert_dizimista($pessoa['insert_pessoa']->id_pessoa);
          
          if($dizimista->id_dizimista){ //Se o dizimista foi cadastrado com sucesso então retorne o ID de todos os cadastros para ser
                  return array(                                                
                  'pessoa'=> $pessoa,                                          
                  'dizimista'=>$dizimista->id_dizimista,                      
                  'insert'=>true,
                );
                
              
          }else{
              return array(
                
                'pessoa'=> $pessoa,                                          
                'dizimista'=>$dizimista->id_dizimista,                    
                'insert'=>false,
              );
          }      
              
          
        }
    }//RESPONSÁVEL POR CADASTRAR TODOS OS DADOS PARA INSERIR UM NOVO DIZIMISTA NO SISTEMA
    public function delete($id_dizimista){
        
        $dizimista = $this->dizimistas->find($id_dizimista);
       $status_deletado=$this->situacao->where('descricao','Deletado')->first();
       
            $update=$dizimista->update(['situacao'=>$status_deletado->id_situacao]);
          
        
        
        if(empty($update)){
            return array('resposta'=>false);
        }else{
            return array('resposta'=>true);
        }
    }
    public function restore($id_dizimista){
        
        $dizimista = $this->dizimistas->find($id_dizimista);
       $status_ativo=$this->situacao->where('descricao','Registro Ativo')->first();
        
            $update=$dizimista->update(['situacao'=>$status_ativo->id_situacao]);
            if(empty($update)){
                return array('resposta'=>false);
            }else{
                return array('resposta'=>true);
            }
    }
    public function cadastro(){
        $tituloPagina = "Novo Dizimista";
        $page_header = "Cadastrar Dizimista";
        $descricao_page_header="";
        $estados = $this->estado->all()->sortBy('nome_estado');
        return view('painel\dizimo\form-cadastro-dizimista',compact('tituloPagina','page_header','descricao_page_header','estados'));
    }//DIRECIONA O FORMULARIO PARA CADASTRAR UM NOVO DIZIMISTA
    public function verificaDadosCadastrais($dizimista){
        $dizimista = DB::table('meus_dizimistas')->where('id_dizimista',$dizimista)->first();
        if(empty($dizimista->cep)){
            $mensagem="Esse dizimista não possui endereço cadastrado.";
            $status = 'danger';
        }else{
            if($dizimista->situacao_endereco==4){
                $mensagem = "O endereço desse dizimista está incorreto";
                $status = 'warning';
            }else{
                $numero_de_nomes = count(explode(' ',$dizimista->nome));
                if($numero_de_nomes==1){
                    $mensagem = "Para que tenhamos informações mais precisas, informe o nome completo do dizimista";
                    $status= 'info';
                }else{
                    $mensagem = null;
                    $status = null;
                }
            }
        }

        return array('mensagem'=>$mensagem,'status'=>$status);
        

    }//Função usada para verificar se os dados do dizimista estão todos preenchidos e se existe alguma irregularidade em seu cadastro 
//===========================================================================================================================================
    public function update(Request $request){            
        $id_dizimista=$request->input('dizimista');
        $cadastro = $this->meus_dizimistas->where('id_dizimista',$id_dizimista)->first();
        $pessoa = $cadastro->pessoa;
        $fn_pessoa = new Pessoa;        
        $update_pessoa = $fn_pessoa->atualizar_pessoa($request,$pessoa);
        
        $new_cadastro = $this->meus_dizimistas->where('id_dizimista',$id_dizimista)->first();
        
        $resposta= array(
            'update_pessoa'=>$update_pessoa,
            'new_cadastro'=>array('dados'=>$new_cadastro,'telefone'=>$this->telefone->where('pessoa',$new_cadastro->pessoa)->get()),
            'old_cadastro'=>$cadastro
        );
    
        return $resposta;
    
    }    
    private function update_contato($cadastro, Request $request){
        if(!empty($request->input('telefone')) && !empty($request->input('dd'))){
            $newDD = $request->input('dd');
            $newFONE = $request->input('telefone');
            $dados=[
                'dd'=>$newDD,
                'telefone'=>$newFONE
            ];
        $linha = $this->telefone->find($cadastro->id_telefone);
        $update = $linha->update($dados);
        if($update){
            return true;
        }else{
            return false;
        }
            
        }else{
            return false;
        }
    } 
}   
