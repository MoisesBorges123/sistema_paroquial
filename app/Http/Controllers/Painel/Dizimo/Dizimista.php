<?php

namespace App\Http\Controllers\Painel\Dizimo;

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
    
    public function index(){
        $ativo = $this->situacao->all()->where('descricao','Registro Ativo');
        $query = $this->meus_dizimistas->all()->where('situacao',$ativo);
        $tituloPagina = "Meus Dizimistas";
        $page_header = "Dizimistas da Catedral";
        $descricao_page_header="";
     
        return view('painel\dizimo\tbl-dizimistas',compact('tituloPagina','page_header','descricao_page_header','query'));
    }//AO INICIAR EXECUTE ESSA FUNÇÃO
    public function update(){
        
    }//ATUALIZAR UM REGISTRO
    public function search_adress($dado){
        /*
         * Essa função irá pesquisar se o logradouro inserido já existe na base
         * de dados, caso positivo irá retornar o id do logradouro caso negativo
         * a função retornará false, essa função consegure pesquisar uma rua ou 
         * um cep.
         */
        if(strlen($dado)==9 && preg_match('-', $dado)){
            $logradouro = $this->logradouro->all()->where('cep',$dado);
        }else{
            $logradouro = $this->logradouro->all()->where('rua',$dado);            
        }
        
        if(!empty($logradouro->id_logradouro)){
            $registro = array(
                'id'=>$logradouro->id_logradouro,
                'rua'=>$logradouro->rua,
                'bairro'=>$logradouro->bairro,
                'cep'=>$logradouro->cep,
                'cidade'=>$logradouro->cidade,
                'estado'=>$logradouro->estado
            );
        }else{
            $registro = false;
        }
        return $registro;
    }//PROCURAR ENDERÇOS
    private function getSituacaoID($situacao){
        $estado = $this->situacao->all()->where('descricao',$situacao);
        return $estado->id_situacao;
    }//BUSCA O ID DE UMA SITUAÇÃO NA TABELA STATUS
    private function insert_telefone($pessoa, $dadosBRUTOS){
        $fn = new FuncoesAdicionais();
        extract($dadosBRUTOS);
        $contador = 0;
        $numerosCadastrados=[];
        foreach($fone as $telefone){
            $valores=[];
            $campos =['dd','numero','pessoa'];
            $valores[] =['value'=>$dd[$contador],'type'=>0];            
            $valores[] =['value'=>$telefone,'type'=>0];
            $valores[] =['value'=>$pessoa,'type'=>0];
            $dadosTRATADOS=$fn->tratamentoDados($valores,$campos);
            $insert = $this->telefone->create($dadosTRATADOS);
            array_push($insert,$numerosCadastrados);
            $contador++;
            unset($valores);
            unset($campos);
            unset($dadosTRATADOS);
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
            $insert = $busca['id'];
        }else{
            $valores = [];
            $valores[]=['value'=>$rua,'type'=>6];
            $valores[]=['value'=>$bairro,'type'=>6];
            $valores[]=['value'=>$cep,'type'=>0];
            $valores[]=['value'=>$cidade,'type'=>6];
            $valores[]=['value'=>$estado,'type'=>0];
            $campos=['rua','bairro','cep','cidade','estado'];
            $dadosTRATADOS=$fn->tratamentoDados($valores, $campos);
            $insert=$this->logradouro->create($dadosLogradouro);             
        }
        
        return $insert;
        
    }//CADASTRAR UMA LOCALIDADE
    private function insert_endereco($dadosBRUTOS){
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
    private function insert_pessoa($dadosBRUTOS){
        $fn = new FuncoesAdicionais();
        extract($dadosBRUTOS);
        $campos=['nome','d_nasc','email','sexo'];
        $valores=[];
        $valores[]=['value'=>$nome,'type'=>6];
        if(!empty($d_nasc))
            $valores[]=['value'=>$d_nasc,'type'=>0];
        
        if(!empty($email))
            $valores[]=['value'=>$email,'type'=>0];
        
        if(!empty($sexo))
            $valores[]=['value'=>$sexo,'type'=>0];
            
        
        $dadosTRATADOS = $fn->tratamentoDados($valores, $campos);
        $insert = $this->pessoas->create($dadosTRATADOS);        
        return $insert;
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
        $validacaoEndreco= validator($dataForm,$this->logradouro->rules);
        $validacaoTelefone = validator($dataForm,$this->pessoas->rules);
        if($validacaoPessoa && $validacaoEndreco && $validacaoTelefone){            
          $pessoa = $this->insert_pessoa($dataForm);
          if(!empty($pessoa->id_pessoa)){//Se cadastrou pessoa cadastre seu telefone
              $telefone = $this->insert_telefone($pessoa, $dataForm);
          }
          if(!empty($telefone)){//Se cadastrou telefone cadastre o endereço
              $endereco = $this->insert_endereco($dataForm);
          }
          if(!empty($endereco->id_endereco)){//Se o endereço foi salvo na tabela endereços insira seu ID na tabela pessoas
              $registroPESSOA = $this->pessoas->find($pessoa);
              $registroPESSOA->update(['endereco'=>$endereco]);
              $dizimista = $this->insert_dizimista($pessoa->id_pessoa);
              if($dizimista->id_dizimista){ //Se o dizimista foi cadastrado com sucesso então retorne o ID de todos os cadastros para ser
                      $resutado = array(    //verificado pe javascript o que foi cadastrado e o que não foi                                            
                      'pessoa'=> $pessoa->id_pessoa,
                      'telefone'=>$telefone->id_telefone,
                      'endereco'=>$endereco->id_endereco,
                      'dizimista'=>$dizimista->id_dizimista
                  );
                  return $resutado;
              }else{
                  return false;
              }
          }
        }
    }//RESPONSÁVEL POR CADASTRAR TODOS OS DADOS PARA INSERIR UM NOVO DIZIMISTA NO SISTEMA
    public function delete(){
        
    }
    public function cadastro(){
        $tituloPagina = "Novo Dizimista";
        $page_header = "Cadastrar Dizimista";
        $descricao_page_header="";
        $estados = $this->estado->all()->sortBy('nome_estado');
        return view('painel\dizimo\form-cadastro-dizimista',compact('tituloPagina','page_header','descricao_page_header','estados'));
    }//DIRECIONA O FORMULARIO PARA CADASTRAR UM NOVO DIZIMISTA
}
