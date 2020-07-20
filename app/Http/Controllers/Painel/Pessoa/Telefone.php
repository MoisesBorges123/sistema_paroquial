<?php

namespace App\Http\Controllers\Painel\Pessoa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Telefone\Telefones;
class Telefone extends Controller
{
    //
    private $telefone;
    public function __construct(){
        $this->telefone = new Telefones;
    }
    private function store($pessoa,$telefone){

        if(!empty($request->input('telefone'))){
            $telefones = $telefone['telefone'];   
            $numeros=explode(',',$telefones);         
                foreach($numeros as $numero){
                    if(!empty($numero)){
                        $obs = !empty($request->input('obs_telefone')) ? $request->input('obs_telefone') : null;            
                        $dados = array(
                            'obs'=>$obs,
                            'numero'=>$numero,
                            'pessoa'=>$pessoa
                        );            
                        $insert= $this->telefone->create($dados);
                    }
                }            
           return $insert;
        }else{
            return false;
        }
    }
}
