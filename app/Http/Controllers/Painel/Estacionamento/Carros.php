<?php

namespace App\Http\Controllers\Painel\Estacionamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Painel\Pessoa\Pessoa;
use App\Models\Painel\Estacionamento\Carro;
use Illuminate\Support\Facades\DB;
class Carros extends Controller
{
    //

    private $carro;

    
    public function __construct() {
        $this->carro = new Carro;      
        date_default_timezone_set('America/Sao_Paulo');
    }   
    public function busca_carro(Request $request){
        if(is_numeric($request->input('carro'))){
            $carro = $this->carro->find($request->input('carro'));
        }else{
            $carro = $this->carro->where('placa',$request->input('carro'))->first();
        }
        if(empty($carro->id_veiculo)){
            $cad_carro=false;
            $cad_pessoa=false;
            $veiculo = null;
            $pessoa = null;
            $dados = null;
        }else{
            $cad_carro=true;
            $cad_pessoa= !empty($carro->pessoa) ? true:false;
            $veiculo= $carro->id_veiculo;
            $pessoa = $carro->pessoa;
            $telefone=DB::table('telefones')->where('pessoa',$pessoa)->first();
            $fn_pessoa = new Pessoa;
            $dadosPessoa=$fn_pessoa->getpeople($pessoa);
            $numero = !empty($telefone->numero)? $telefone->numero : '';
            $dados = array(
                'id_pessoa'=>$pessoa,
                'nome'=>$dadosPessoa->nome,
                'numero'=>$numero,
                'id_carro'=>$veiculo,
                'tipo_veiculo'=>$carro->tipo,
                'modelo_veiculo'=>$carro->modelo,
                'cor'=>$carro->cor

            );

        }
        return array('cad_carro'=>$cad_carro,'cad_pessoa'=>$cad_pessoa,'dados'=>$dados);
    }
    public function salvar_carro(Request $request){
        
        $insencao = empty($request->input('isencao')) ? 0 : 1;
        $modelo = !empty($request->input('modelo_veiculo')) ? $request->input('modelo_veiculo') : null;
        $cor = !empty($request->input('cor_veiculo')) ? $request->input('cor_veiculo') : null;
        $pessoa = !empty($request->input('pessoa')) ? $request->input('pessoa') : null;
        $id_pessoa = is_numeric($pessoa) ? $pessoa : $this->salvar_pessoa($request);
        $insert=$this->carro->create(['placa'=>strtoupper($request->input('placa')),'pessoa'=>$id_pessoa,'isencao'=>$insencao,'tipo'=>$request->input('tipo_veiculo'),'modelo'=>$modelo,'cor'=>$cor]);        
        if($insert){
            $resposta=$insert->id_veiculo;
        }else{
            $resposta=false;
        }
            
        return $resposta;
        
    }//SAVE NEW CAR IN THE SYSTEM
    private function salvar_pessoa(Request $request){
        $fn_pessoa = new Pessoa;
        $pessoa = $fn_pessoa->salvar_pessoa($request);
    }//CARREGA FUNÇÃO DA CLASSE PESSOA E REALIZA O CADASTRO
    public function update(Request $request){
        if(!$request->input('id_carro')){
            $placa = $request->input('placa');
            $carro = $this->carro->where('placa',$placa)->first();            
        
        }else{
            $carro = $this->carro->find($request->input('id'));
        }        
        if($request->input('pessoa')){
            $pessoa = is_numeric($request->input('pessoa')) ? $request->input('pessoa') : null;
            $pessoa = $pessoa==null ? $request->input('pessoa') : $pessoa; 
            if(is_string($pessoa)){                                
                $busca_pessoa=$this->busca_pessoa($request);
                if($busca_pessoa['insert']==true){
                    $pessoa= $busca_pessoa['dados']['insert_pessoa']->id_pessoa;
                }else{            
                    $pessoa= $busca_pessoa['dados']->id_pessoa;
                }
            }           

        }else{
            $pessoa=$carro->pessoa;
        }
        if($request->input('telefone')){

        }
        if($request->input('email')){

        }
        $modelo = !$request->input('modelo') ? $request->input('modelo'):null;
        $modelo = $modelo==null ? $carro->modelo: $modelo;
        $tipo = !$request->input('tipo') ? $request->input('tipo'):null;
        $tipo = $tipo==null ? $carro->tipo: $tipo;
        $cor = !$request->input('cor') ? $request->input('cor'):null;
        $cor = $cor==null ? $carro->cor: $cor;
        $descricao = !$request->input('descricao') ? $request->input('descricao'):null;
        $descricao = $descricao==null ? $carro->descricao: $descricao;
        $isencao = !$request->input('isencao') ? $request->input('isencao'):null;
        $isencao = $isencao==null ? $carro->isencao: $isencao;
        $placa = !empty($request->input('placa_new')) ? $request->input('placa_new'):null;
        $placa = $placa==null? $carro->placa : $placa;
        if($placa!=$carro->placa){            
            $carro2= $this->carro->where('placa',$placa)->first();
            $duplicidade = $carro2->id_veiculo ? $carro2->id_veiculo:false;
        }else{
            $duplicidade = false;

        }        

        $dados = array(
            'pessoa'=>$pessoa,
            'modelo'=>$modelo,
            'tipo'=>$tipo,
            'cor'=>$cor,
            'placa'=>$placa,
            'descricao'=>$descricao,
            'isencao'=>$isencao,

        );
        
        $update = $carro->update($dados);
        return array('update'=>$update,'duplicidade'=>$duplicidade);

    }
    private function busca_pessoa(Request $request){
        $fn_pessoa = new Pessoa;        
        $existe_pessoa = $fn_pessoa->getpeople($request->input('nome'));
        if($existe_pessoa==false){
            $pessoa = $fn_pessoa->salvar_pessoa($request);
            return array('insert'=>true,'dados'=>$pessoa);
        }else{
            $pessoa = $existe_pessoa;            
            return array('insert'=>false,'dados'=>$pessoa);
        }        
        

    }
}
