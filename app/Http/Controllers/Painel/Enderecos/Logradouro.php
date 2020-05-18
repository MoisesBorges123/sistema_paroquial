<?php

namespace App\Http\Controllers\Painel\Enderecos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Enderecos\Logradouros;
use App\Models\Painel\Enderecos\Enderecos;
use App\Models\Painel\Enderecos\Estado;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
class Logradouro extends Controller
{
    //
    private $endereco;
    private $logradouro;
    private $estado;
    private $minhas_funcoes;
    public function __construct(){
        $this->endereco= new Enderecos;
        $this->logradouro = new Logradouros;
        $this->estado = new Estado;
        $this->minhas_funcoes = new FuncoesAdicionais;
    }
    public function insert_logradouro($dadosBRUTOS){
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
    }//PESQUISA ENDEREÇO INFORMANDO RUA OU CEP PARA QUALQUER CLASSE
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
    }//PROCURAR ENDERÇOS (JÁ CADASTRADOS)
    
}
