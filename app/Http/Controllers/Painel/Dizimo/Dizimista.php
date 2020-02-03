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
    public function aviso_morte(){
        

    }//INFORMAR QUE O DIZIMISTA FALECEU
    public function index(){
        $ativo = $this->situacao->all()->where('descricao','Registro Ativo')->first();
        $total_dizimistas = ceil(($this->situacao->all()->where('descricao','Registro Ativo')->first()->count())/10);
        $query = $this->meus_dizimistas->all()->where('situacao',$ativo->id_situacao);
        $tituloPagina = "Meus Dizimistas";
        $page_header = "Dizimistas da Catedral";
        $descricao_page_header="";
        $meses=[];
        for($i=1;$i<=12;$i++){
            $meses[]=['key'=>$i,'mes'=>$this->minhas_funcoes->data_portugues(3, $i)];
        }
        
        
        
        return view('painel\dizimo\tbl-dizimistas',compact('tituloPagina','page_header','descricao_page_header','query','meses'));
    }//AO INICIAR EXECUTE ESSA FUNÇÃO
    public function update(){
        
    }//ATUALIZAR UM REGISTRO
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
        $cep = $request->input('cep');
        $endereco = $this->search_adress($cep);
        if($endereco==false){
            $endereco=$this->minhas_funcoes->getEndereco($cep);
            //var_dump($endereco);echo"\n <br>";
            $estado = $this->estado                   
                    ->where('sigla',$endereco->uf)
                    ->first();   
            
            if(!empty($endereco)){
                $localidade = [ 
                    'cep'=>$endereco->cep,
                    'logradouro'=>$endereco->logradouro,
                    'bairro'=>$endereco->bairro,
                    'cidade'=>$endereco->localidade,
                    'estado'=>$estado->id_estado,
                    'complemento'=>$endereco->complemento
                    ];
                return $localidade;
            }else{
                return $endereco = array('resposta'=>false);
            }
        }else{
            return $endereco;
        }
    }
    private function search_adress($dado){
        /*
         * Essa função irá pesquisar se o logradouro inserido já existe na base
         * de dados, caso positivo irá retornar o id do logradouro caso negativo
         * a função retornará false, essa função consegure pesquisar uma rua ou 
         * um cep.
         */
        if(strlen($dado)==9 && strstr($dado, '-',true)){
            $logradouro = $this->logradouro->all()->where('cep',$dado);
        }else{
            $logradouro = $this->logradouro->all()->where('rua',$dado);            
        }
        
        if(!empty($logradouro->id_logradouro)){
            $registro = array(
                'id_logradouro'=>$logradouro[0]->id_logradouro,
                'rua'=>$logradouro[0]->rua,
                'bairro'=>$logradouro[0]->bairro,
                'cep'=>$logradouro[0]->cep,
                'cidade'=>$logradouro[0]->cidade,
                'estado'=>$logradouro[0]->estado
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
              $telefone = $this->insert_telefone($pessoa->id_pessoa, $dataForm);
          }
          if(!empty($telefone)){//Se cadastrou telefone cadastre o endereço
              $endereco = $this->insert_endereco($dataForm);
          }
          if(!empty($endereco->id_endereco)){//Se o endereço foi salvo na tabela endereços insira seu ID na tabela pessoas
              $this->pessoas->where('id_pessoa',$pessoa->id_pessoa)
                      ->update(['endereco'=>$endereco->id_endereco]);
              $dizimista = $this->insert_dizimista($pessoa->id_pessoa);
              if($dizimista->id_dizimista){ //Se o dizimista foi cadastrado com sucesso então retorne o ID de todos os cadastros para ser
                      $resutado = array(    //verificado pelo javascript o que foi cadastrado e o que não foi                                            
                      'pessoa'=> $pessoa->id_pessoa,
                      'nome'=>$dataForm['nome'],                      
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
