<?php

namespace App\Http\Controllers\Painel\Igrejas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Igrejas\Capelas;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;

class Capela extends Controller
{
    private $capela;
    public function __construct(Capelas $subChurch) {
        $this->capela = $subChurch;
    }
    
    public function cadastro_rapido(Request $request, FuncoesAdicionais $fn){
        $capela = $request->input('nome');
        if(!empty($capela)){
                $valores=[];
                $valores[]=['value'=>$capela,'type'=>1];                
                $campos=['nome'];
                $dados=$fn->tratamentoDados($valores, $campos);
                $cadastro=$this->capela->create($dados);
                if($cadastro){
                    $erro=0;
                }else{
                    $erro="<p class='text-danger'><b>Ops!</b> Não foi possível salvar o registro.</p>";
                }
        }else{
            $erro="<p class='text-warning'><b>Ops!</b> Não foi possível identificar o nome da paroquia por favor tente novamente.</p>";
        }
        
        return $resposta = array(
            'erro'=>$erro
            );
    }
}
