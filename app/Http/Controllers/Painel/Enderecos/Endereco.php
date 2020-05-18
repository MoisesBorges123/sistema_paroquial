<?php

namespace App\Http\Controllers\Painel\Enderecos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Enderecos\Logradouros;
use App\Models\Painel\Enderecos\Enderecos;
use App\Models\Painel\Enderecos\Estado;
use App\Http\Controllers\Painel\Enderecos\Logradouro;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use Illuminate\Support\Facades\DB;
class Endereco extends Controller
{
    //
    private $endereco;
    private $logradouro;
    private $estado;

    public function __construct(){
        $this->endereco = new Enderecos;
        $this->logradouro = new Logradouros;
        $this->estado = new Estado;
    }

    //MINHAS FUNÇÕES

    public function salvar_endereco(Request $request){      
        $endereco = $this->buscaEndereco($request);
        if($endereco==false){
            $dadosBRUTOS = $request->except('_token');
            $endereco = $this->insert_endereco($dadosBRUTOS);
        }
        return $endereco;
    }//CAPAZ DE CADASTRAR O ENDERECO E RETORNA O OBJETO DO CADASTRO
    private function buscaEndereco(Request $request){
        if(!empty($request->input('num_casa'))){
            $endereco=$this->endereco->where('num_casa',$request->input('num_casa'))->first();
            if($endereco==null){
                return false;
            }else{
                return $endereco;
            }
        }
    }
    private function insert_endereco($dadosBRUTOS){
        
        $fn = new FuncoesAdicionais();
        $fn_logradouro = new Logradouro;
        $logradouro = $fn_logradouro->insert_logradouro($dadosBRUTOS);
        extract($dadosBRUTOS);
        $campos=['logradouro','num_casa','situacao_endereco'];
        $valores=[];
        $valores[]=['value'=>$logradouro,'type'=>0];
        $valores[]=['value'=>$num_casa,'type'=>0];
        $valores[]=['value'=>'5','type'=>0];
        if(!empty($apartamento)){
            array_push($campos,'apartamento');
            $valores[]=['value'=>$apartamento,'type'=>0];
        }
        if(!empty($complemento)){
            array_push($campos,'completo');
            $valores[]=['value'=> ucfirst($complemento),'type'=>0];
        }
        if(!empty($observacoes)){ 
            array_push($campos,'observacoes');
            $valores[]=['value'=> ucfirst($observacoes),'type'=>0];
        }
        $dadosTRATADOS = $fn->tratamentoDados($valores, $campos);
        $insert = $this->endereco->create($dadosTRATADOS);
        return $insert;
    }//CADASTRA UM ENDEREÇO
    public function update_endereco(Request $request,$id_endereco,$pessoa=null){
        if(empty($id_endereco) && !empty($pessoa)){
            $endereco=$this->salvar_endereco($request);
            
            $update = DB::table('pessoas')->where('id_pessoa',$pessoa)->update(['endereco'=>$endereco->id_endereco]);
            return $update;
        }else if(!empty($id_endereco)){
            
            $endereco = $this->endereco->find($id_endereco);
            $old_logradouro = $this->logradouro->find($endereco->logradouro);
            if($request->input('cep')!=$old_logradouro->cep){
                $dadosEndereco= array(
                    'cep'=>$request->input('cep'),
                    'rua'=>$request->input('rua'),
                    'bairro'=>$request->input('bairro'),
                    'cidade'=>$request->input('cidade'),
                    'estado'=>$request->input('estado'),
                );
                $fn_logradouro = new Logradouro;
                $logradouro=$fn_logradouro->insert_logradouro($dadosEndereco);
            }else{
                $logradouro = $old_logradouro;
            }
            $num_casa = $request->input('num_casa');
            $apartamento = $request->input('aparatamento');
            $complemento = $request->input('complemento');
            $observacoes = $request->input('observacoes');

            $dadosUpdate = array(
                'logradouro'=>$logradouro->id_logradouro,
                'num_casa'=>$num_casa,
                'apartamento'=>$apartamento,
                'complemento'=>$complemento,
                'observacoes'=>$observacoes
            
            );
            $update = $endereco->update($dadosUpdate);
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
