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

use App\Controller\Painel\Pessoa\Pessoa;
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
        return $cadastro;
    }
    public function mostrar_Cadastros_Dizimistas($registros=1){
        if($registros==1){
            $ativo = $this->situacao->all()->where('descricao','Registro Ativo')->first();
            $query = $this->meus_dizimistas->all()->where('situacao',$ativo->id_situacao);
        }elseif($registros==2){
            $ativo = $this->situacao->all()->where('descricao','Deletado')->first();
            $query = $this->meus_dizimistas->all()->where('situacao',$ativo->id_situacao);
        }elseif($registros==3){
            $query = $this->meus_dizimistas->all();
            
        }else{
            $query = null;
        }
        $buttoes=[];
        if(count($query)>0){
            foreach($query as $q){
                
                $butao='<button data-toggle="tooltip" id="excluir_cadastro" data-url="'.route('Deleta.Dizimista',$q->id_dizimista).'" data-placement="top" data-original-title="Excluir Cadastro" class="btn btn-danger btn-icon bt-table" data-dizimista="'.$q->id_dizimista.'">
                            <i class="icofont icofont-trash"></i>
                        </button>';
                array_push($buttoes, $butao);
            }
        }
        
        
        return array(
            'qtde_registros'=>count($query),
            'query'=>$query,
            'butao_excluir'=>$buttoes
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
    public function update(Request $request, $dizimista=0){
            
            $id_dizimista = $request->input('id_dizimista');
            $cadastro = $this->meus_dizimistas->where('id_dizimista',$request->input('id_dizimista'))->first();
            $update_endereco = $this->update_endereco($cadastro, $request);
            $update_contato = $this->update_contato($cadastro, $request);
            $update_pessoa = $this->update_pessoa($cadastro, $request);
            if($update_pessoa && $update_contato && $update_pessoa){
                $update = true;
            }else{
                $update=false;
            }
            $new_cadastro = $this->meus_dizimistas->where('id_dizimista',$id_dizimista)->first();
            
            $resposta= array(
                'resposta'=>$update,
                'cadastro'=>$new_cadastro
            );
        
        return $resposta;
        
    }
    private function update_pessoa($cadastro, Request $request){
        if(!empty($request->input('nome')) && !empty($request->input('d_nasc')) && !empty($request->input('email'))){
            $newNOME=$request->input('nome');
            $newNascimento = $request->input('d_nasc');
            $newEMAIL = $request->input('email');
            $dados = [
                'nome'=>$newNOME,
                'd_nasc'=>$newNascimento,
                'email'=>$newEMAIL
                    
            ];
            $registro = $this->pessoas->find($cadastro->id_pessoa);
            $update = $registro->update($dados);
            if($update){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
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
    private function update_endereco($cadastro,Request $request){
        
        if(!empty($request->input('apartamento'))){
            $apto=$request->input('apartamento');
        }else{
            $apto = null;
        }
        if($cadastro->cep != $request->input('cep')){
            $busca_cep=$this->pesquisar_endereco($request);
            if(empty($busca_cep->id_logradouro)){                
                $id_logradouro=$this->insert_logradouro($busca_cep);               
            }else{
                $id_logradouro = $busca_cep->id_logradouro;
            }
           
            //ATUALIZAR NA TABELA ENDEREÇO
            $dados = [
                'logradouro'=> $id_logradouro,
                'num_casa'=> $request->input('num_casa'),
                'apartamento'=>$apto
                
            ];
            
        }else{
            $dados = [                
                'num_casa'=> $request->input('num_casa'),
                'apartamento'=>$apto                
            ];
        }
        
        $endereco = $this->endereco->find($cadastro->id_endereco);
        $update = $endereco->update($dados);
        
        if($update){
            return true;
        }else{
            return false;
        }
    }    
    public function transformar_em_dizimista_dados_adicionais(Request $request){
        
        if(!empty($request->input('txt_telefone'))){
            $inputs  = explode(')',trim($request->input('txt_telefone')));
            $dd = str_replace("(", null, $inputs[0]);
            $numero = $inputs[1];
            $dados=[
                'dd'=>$dd,
                'numero'=>$numero,
                'pessoa'=>$request->input('pessoa')
            ];
            
            $valida_telefone = validator($dados, $this->telefone->rules);
            if($valida_telefone->fails()){
                $erro= $valida_telefone->fails();
            }else{
                $insert_telefone = $this->telefone->create($dados);
                
                if($insert_telefone->id_telefone){
                    $insert_dizimista=$this->dizimistas->create(['pessoa'=>$request->input('pessoa'),'d_cadastro'=>date('Y-m-d',time()), 'situacao'=>1]);
                    $erro=0;
                }
            }
            
            
        }
      
        if(!empty($request->input('cep'))){ // Não está Testado
            
            $logradouro=$this->pesquisar_endereco($request);
            if(!$logradouro){
                $erro=1;
            }else{
                $dados_logradouro = [
                    'rua'=>$logradouro->rua,
                    'bairro'=>$logradouro->bairro,
                    'cep'=>$logradouro->cep,
                    'cidade'=>$logradouro->cidade,
                    'estado'=>$logradouro->estado                  
                    
                ];
                $valida_logradouro = validator($dados_logradouro,$this->logradouro->rules);
            }   if(!$valida_logradouro->fails()){
                    $erro= $valida_logradouro->fails;
                }else{
                    $insert_logradouro = $this->logradouro->create($dados_logradouro);
                    if(!$insert_logradouro->id_logradouro){
                        $erro=1;
                    }else{
                        $dados_endereco = [
                            'logadouro'=>$insert_logradouro->id_logradouro,
                            'num_casa'=>$request->input('num_casa'),
                            'apartamento'=>$request->input('apartamento'),
                            'complemento'=>$request->input('complemento'),
                            'observacoes'=>$request->input('observacoes'),
                            ];
                        $valida_endereco = validator($dados_endereco,$this->endereco->rules);
                        if($valida_endereco->fails()){
                            $erro=1;
                        }else{
                            $insert_endereco = $this->endereco->create($dados_endereco);
                            if($insert_endereco->id_endereco){
                                $pessoa = $this->pessoas->find($request->input('pessoa'));
                                $update = $pessoa->update(['endereco'=>$insert_endereco->id_endereco]);
                                
                            }
                        }
                        
                    }
                }
               
        }
        
        
        if(!empty($request->input('d_nasc'))){
            $pessoa = $this->pessoas->find($request->input('pessoa'));
            $update = $pessoa->update(['d_nasc'=>$request->input('d_nasc')]);
        }
         if(empty($erro)){
                    return array('erro'=>0);
                }else{
                    return array('erro'=>$erro);
                    
                }
    }
    public function transformar_em_dizimista(Request $request){
        $pessoa = $request->input('pessoa');
        $dizimista = $this->insert_dizimista($pessoa);
        if(!empty($dizimista->id_dizimista)){
            $resposta = array(
              'id'  => $dizimista->id_dizimista,
              'cadastro' => true
            );
        }else{
            $resposta = array(
              'id'  => 0,
              'cadastro' => false
            );
            
        }
        return $resposta;
    }    
    public function pessoas_iguais(Request $request){
        extract($request->except('_token'));
        $existe_pessoa=DB::table('pessoas')
                ->where('nome','=',$nome)
                ->join('enderecos','pessoas.endereco','=','enderecos.id_endereco')
                ->join('logradouros','enderecos.logradouro','=','logradouros.id_logradouro')               
                ->get(); 
        if(!empty($existe_pessoa[0]->id_pessoa)){
        $existe_dizimista=DB::table('dizimistas')->where('pessoa','=',$existe_pessoa[0]->id_pessoa)->get();
        $telefone = $this->telefone->all()->where('pessoa','=',$existe_pessoa[0]->id_pessoa)->first();
            if(!empty($existe_dizimista[0]->id_dizimista)){
                $dizimista=1;
                
            }else{
                $dizimista=0;                
            }
            
            if(!empty($telefone->numero))
                $numero = $telefone->numero;
            else
                $numero = null;
            
            $resposta = array(
                'nome'=>$existe_pessoa[0]->nome,
                'id'=>$existe_pessoa[0]->id_pessoa,
                'rua'=>$existe_pessoa[0]->rua,
                'bairro'=>$existe_pessoa[0]->bairro,
                'cep'=>$existe_pessoa[0]->cep,
                'cidade'=>$existe_pessoa[0]->cidade,
                'data_nascimento'=>$existe_pessoa[0]->d_nasc,
                'telefone'=>$numero,
                'dizimista'=>$dizimista,
                'num_casa'=>$existe_pessoa[0]->num_casa
            );
        }else{
            $resposta = array(
                'nome'=>'Não Existe',
                'id'=>0
            );
        }
        return $resposta;
    }
    public function pesquisar_endereco(Request $request){
        /*
         * Quando o Cep não encontrado o array retorna vazio
         */
        if(empty($request->input('cep'))){
            exit();
            return false;
        }
        
        $cep = $request->input('cep');
        
        $localidade = $this->search_adress($cep);
        if($localidade==false){ // Se não achar no banco de dados local faça uma pesquisa online
            $localidade=$this->minhas_funcoes->getEndereco($cep);
            //var_dump($endereco);echo"\n <br>";
            $estado = $this->estado                   
                    ->where('sigla',$localidade->uf)
                    ->first();   
           
            if(!empty($localidade)){
                
                $endereco = array( 
                    'resposta'=>true,
                    'cep'=>$localidade->cep[0],                    
                    'logradouro'=>$localidade->logradouro[0],
                    'bairro'=>$localidade->bairro,
                    'cidade'=>$localidade->localidade,
                    'estado'=>$estado->id_estado,
                    'nome_estado'=>$estado->nome_estado,
                    'complemento'=>$localidade->complemento
                    );                 
            }else{
                $endereco = array('resposta'=>false);
            }
        }else{ // Caso foi encontrado no banco de dados o endereço carregue os dados para um array
            $estado = $this->estado->find($localidade['estado']);
            $endereco = array(
                'resposta'=>true,
                'cep'=>[$localidade['cep']],                
                'logradouro'=>[$localidade['rua']],
                'bairro'=>[$localidade['bairro']],
                'cidade'=>[$localidade['cidade']],
                'estado'=>$localidade['estado'],
                'nome_estado'=>$estado->nome_estado,
                'complemento'=>null
            );
        }
        
        return $endereco;
    }
    private function search_adress($dado){
        /*
         * Essa função irá pesquisar se o logradouro inserido já existe na base
         * de dados, caso positivo irá retornar o id do logradouro caso negativo
         * a função retornará false, essa função consegure pesquisar uma rua ou 
         * um cep.
         */
        if(strlen($dado)==9 && strstr($dado, '-',true)){
            $logradouro = $this->logradouro->where('cep',$dado)->first();
        }else{
            $logradouro = $this->logradouro->where('rua',$dado)->first();            
        }
        
        if(!empty($logradouro->id_logradouro)){
            $registro = array(  
                'id_logradouro'=>$logradouro->id_logradouro,
                'rua'=>$logradouro->rua,
                'bairro'=>$logradouro->bairro,
                'cep'=>$logradouro->cep,
                'cidade'=>$logradouro->cidade,
                'estado'=>$logradouro->estado
            );
        }else{            
            $registro =false;
        }
        return $registro;
    }//PROCURAR ENDERÇOS
    private function getSituacaoID($situacao){
        $estado = $this->situacao->all()->where('descricao',$situacao)->first();
        return $estado->id_situacao;
    }//BUSCA O ID DE UMA SITUAÇÃO NA TABELA STATUS
    private function insert_telefone($pessoa, $dadosBRUTOS){
        $fn = new FuncoesAdicionais();
        extract($dadosBRUTOS);
        $contador = 0;
        $numerosCadastrados=[];
        foreach($fone as $telefone){
            if(!empty($telefone) && !empty($dd[$contador])){
                $valores=[];
                $campos =['dd','numero','pessoa','obs'];
                $valores[] =['value'=>$dd[$contador],'type'=>0];            
                $valores[] =['value'=>$telefone,'type'=>0];
                $valores[] =['value'=>$pessoa,'type'=>0];

                if(!empty($obs_telefone))
                    $valores[] =['value'=>$obs_telefone,'type'=>0];
                else
                    $valores[] =['value'=>null,'type'=>0];

                $dadosTRATADOS=$fn->tratamentoDados($valores,$campos);
                $insert = $this->telefone->create($dadosTRATADOS);
                $contador++;
                $numerosCadastrados[]=['id'=>$insert->id_telefne,'telefone'=>$telefone,'posicao'=>$contador];            
                unset($valores);
                unset($campos);
                unset($dadosTRATADOS);
            
            }
            
        }
        
        return $numerosCadastrados;
    }//CADASTRAR UM TELEFONE
    private function insert_logradouro($dadosBRUTOS){
        
        $fn = new FuncoesAdicionais();

        extract($dadosBRUTOS);
        if(!empty($cep)){
            $busca = $this->search_adress($cep);
        }else{
            $busca = $this->search_adress($rua);
        }
        
        if($busca!=false){
            $logradouro = $busca['id_logradouro'];
        }else{
            $valores = [];
            $valores[]=['value'=>$rua,'type'=>6];
            $valores[]=['value'=>$bairro,'type'=>6];
            $valores[]=['value'=>$cep,'type'=>0];
            $valores[]=['value'=>$cidade,'type'=>6];
            $valores[]=['value'=>$estado,'type'=>0];
            $campos=['rua','bairro','cep','cidade','estado'];
            $dadosTRATADOS=$fn->tratamentoDados($valores, $campos);           
            $insert=$this->logradouro->create($dadosTRATADOS);  
            $logradouro=$insert->id_logradouro;
        }
        
        return $logradouro;
        
    }//CADASTRAR UMA LOCALIDADE
    private function insert_endereco($dadosBRUTOS){
        $fn = new FuncoesAdicionais();
        $logradouro = $this->insert_logradouro($dadosBRUTOS);                
        extract($dadosBRUTOS);
        $campos=['logradouro','num_casa','apartamento','complemento','obsercacoes'];
        $valores=[];
        $valores[]=['value'=>$logradouro,'type'=>0];
        $valores[]=['value'=>$num_casa,'type'=>0];
        if(!empty($apartamento))
            $valores[]=['value'=>$apartamento,'type'=>0];
        
        if(!empty($complemento))
            $valores[]=['value'=> ucfirst($complemento),'type'=>0];
        
        if(!empty($observacoes))
            $valores[]=['value'=> ucfirst($observacoes),'type'=>0];
            
        
        $dadosTRATADOS = $fn->tratamentoDados($valores, $campos);
        $insert = $this->endereco->create($dadosTRATADOS);
        return $insert;
    }//CADASTRA UM ENDEREÇO
    private function insert_pessoa(Request $request){
        $fn_pessoa = new Pessoa;
        if($request->input('pessoa')){
            $dadosPessoa=$fn->getpeople($request->input('pessoa'));
            $dadosPessoa = $dadosPessoa==false ? $fn_pessoa->salvar_pessoa($request) : $dadosPessoa;
            
        }else if($request->input('nome')){
            $dadosPessoa=$fn->getpeople($request->input('nome'));
            $dadosPessoa = $dadosPessoa==false ? $fn_pessoa->salvar_pessoa($request) : $dadosPessoa;
        }
        
        return $$dadosPessoa;
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
          $dizimista = $this->insert_dizimista($pessoa->id_pessoa);
          
          if($dizimista->id_dizimista){ //Se o dizimista foi cadastrado com sucesso então retorne o ID de todos os cadastros para ser
                  $resutado = array(                                                
                  'pessoa'=> $pessoa,                                          
                  'dizimista'=>$dizimista->id_dizimista,                      
                  'erro'=>false,
                );
                
              return $resultado;
          }else{
              return array(                                                
                'pessoa'=> $pessoa,                                          
                'dizimista'=>$dizimista->id_dizimista,                    
                'erro'=>true,
              );
          }      
              
          
        }
    }//RESPONSÁVEL POR CADASTRAR TODOS OS DADOS PARA INSERIR UM NOVO DIZIMISTA NO SISTEMA
    public function delete($id_dizimista){
        
        $dizimista = $this->dizimistas->find($id_dizimista);
       $status_deletado=$this->situacao->where('descricao','deletado')->first();
        if($dizimista->situacao==1){
            $update=$dizimista->update(['situacao'=>$status_deletado->id_situacao]);
            $status=false;
        }else if($dizimista->situacao==3){
            $status = true;
        }else{
            $status = false;
        }
        if(empty($update)){
            return array('resposta'=>false,'excluido'=>$status);
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
}   
