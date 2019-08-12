<?php

namespace App\Http\Controllers\Painel\Igrejas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Igrejas\Igrejas;
use App\Models\Painel\Igrejas\Padres;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use App\Models\Painel\Pessoa\Pessoas;
use Illuminate\Support\Facades\DB;
class Padre extends Controller
{
    //
    private $pessoa;
    private $padre;
    public function __construct(Padres $prist, Pessoas $people) {
        $this->pessoa = $people;
        $this->padre=$prist;
    }
    public function mostrar(){
        $dadosPadre = DB::table('clero')
                ->join('pessoas','clero.pessoa','=','pessoas.id_pessoa')
                ->get();
        ob_start();
            echo"<select class='form-control' name='padre' id='padre'>";
        
            foreach($dadosPadre as $dado){
                echo"<option value='".$dado->id_clero."'>".$dado->nome."</option>";
            }
            echo"</select>";
        $input_select = ob_get_clean();
        
        return $resposta = array(
            'input_select' =>$input_select
        );
    }
    public function cadastro_rapido(Request $request, FuncoesAdicionais $fn){
        $pessoa=$request->input('nome');

      
        if(!empty($pessoa)){
                $valores3=[];
                $valores3[]=['value'=>$pessoa,'type'=>1];                                              
                $valores3[]=['value'=>1,'type'=>0];                                              
                              
                $campo3=['nome','sexo'];
                $dadosPessoa=$fn->tratamentoDados($valores3, $campo3);
               
                
               $cod_pessoa=$this->pessoa->create($dadosPessoa);
 
                 
                if(!empty($cod_pessoa->id_pessoa)){
                    $valores2=[];
                    $valores2[]=['value'=>$cod_pessoa->id_pessoa,'type'=>0];                
                    $valores2[]=['value'=>1,'type'=>0];                
                    $campos2=['pessoa','titulo'];
                    $dadosPadre=$fn->tratamentoDados($valores2, $campos2);
                    
                    
                    $cod_padre=$this->padre->create($dadosPadre);
                    
                    if(!empty($cod_padre->id_clero)){
                        $erro=0;
                    }else{
                        $erro="<p class='text-danger'>Não foi possível adicionar esse nome a lista de padres</p>";
                    }
                }else{
                    
                    $erro="<p class='text-danger'>Não foi possível salvar o registro.</p>.";
                }
                 
           
        }else{
            $erro="<p class='text-warning'><b>Ops!</b> Não foi possível identificar o nome do padre por favor tente novamente.</p>";
        }
        return $resposta = array(
            'erro'=>$erro
            );
         
    }
}
