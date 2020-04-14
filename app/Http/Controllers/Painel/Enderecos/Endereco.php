<?php

namespace App\Http\Controllers\Painel\Enderecos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Enderecos\Logradouros;
use App\Models\Painel\Enderecos\Enderecos;
use App\Models\Painel\Enderecos\Estado;
use App\Http\Controllers\Painel\Enderecos\Logradouro;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
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
        $dadosBRUTOS = $request->except('_token');
        $endereco = $this->insert_endereco($dadosBRUTOS);
        return $endereco;
    }//CAPAZ DE CADASTRAR O ENDERECO E RETORNA O OBJETO DO CADASTRO
    private function insert_endereco($dadosBRUTOS){
        $fn = new FuncoesAdicionais();
        $fn_logradouro = new Logradouro;
        $logradouro = $fn_logradouro->insert_logradouro($dadosBRUTOS);
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
}
