<?php

namespace App\Http\Controllers\Painel\Dizimo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Dizimo\Devolucoes_dizimo;
use App\Models\Painel\Dizimo\Q_meus_dizimistas;

class Devolucoes extends Controller
{
    //
    /*
     * Variaveis Globais
     * 
     */    
    private $devolucao;
    private $dizimista;

    public function __construct(Devolucoes_dizimo $sendBack, Q_meus_dizimistas $query_dizimistas) {
        $this->devolucao = $sendBack;
        $this->dizimista = $query_dizimistas;
      
                
    }   
    public function devolver($dizimista=null){
        if(!empty($dizimista)&& is_numeric($dizimista)){
            //$dados_devolucao= $this->devolucao->all()->last();
            $dados_devolucao = $this->buscar_ficha($dizimista);
            $dados_dizimista = $this->dizimista->find($dizimista)->first();
            if(!empty($dados_dizimista->apartamento)){
                $apartamento = $dados_dizimista->apartamento.', ';
            }else{
                $apartamento='';
            }
            
            $dados = [
                'devolucoes'=>$dados_devolucao,
                'dizimista'=>[
                'nome' => $dados_dizimista->nome,
                'data_nascimento'=> $dados_dizimista->d_nasc,
                'rua'=>$dados_dizimista->rua,
                'bairro'=>$dados_dizimista->bairro,
                'cidade'=>$dados_dizimista->cidade,
                'estado'=>$dados_dizimista->nome_estado,
                'cep'=>$dados_dizimista->cep,
                'apartamento'=>$apartamento,
                'data_cadastro'=>$dados_dizimista->d_cadastro,
                'numero'=>$dados_dizimista->num_casa
                    
                ]
            ];
            
            return view('painel.dizimo.devolucao.form-cadastro-devolucao',compact('dados'));
        }else{
            return "Deu Bosta";
        }
    }
    private function buscar_ficha($dizimista){
        $primeira_devolucao=$this->devolucao->all()
                ->where('dizimista',$dizimista)               
                ->sortby('ano_ref')
                ->first();
        if(!empty($primeira_devolucao)){ // CASO EXISTA ALGUMA DEVOLUÇÃO
            $primeiro_ano = $primeira_devolucao->ano_ref;
             $ultima_devolucao=$this->devolucao->all()
                    ->where('dizimista',$dizimista)               
                    ->sortby('ano_ref')
                    ->last();
            if(($ultima_devolucao->ano_ref) < (date('Y',time()))){            
                $intervalo = (date('Y',time())) - ($ultima_devolucao->ano_ref) ;
            }else{
                $intervalo = ($ultima_devolucao->ano_ref) - ($primeira_devolucao->ano_ref);

            }
            
        }else{ //CASO NUNCA TENHA FEITO UMA DEVOLUÇÃO 
            $intervalo=0;
            $primeiro_ano = date('Y',time());
        }
   
        
        $tabela_devolucoes=[];
        for($i=0;$i<=$intervalo;$i++){            
                 $ano = $primeiro_ano+$i;   
                
            for($j=-1;$j<=12;$j++){                
                $mes=$j;
                if($j>0){
                    $devolucao = $this->buscar_devolucao($ano, $mes, $dizimista);
                    
                    if($devolucao == null){
                        $valor = 'R$ - ';
                    }else{
                        $valor = $devolucao;
                    }
                    $tabela_devolucoes[$primeiro_ano+$i][$j]=$valor;                    
                }else{
                    $tabela_devolucoes[$primeiro_ano+$i][$j]=$ano;                    
                    
                }
                
            }
        }
        return $tabela_devolucoes;
       
    }
    private function buscar_devolucao($ano,$mes,$dizimista){
        $devolucao=$this->devolucao
                ->where('ano_ref','=',$ano)
                ->where('mes_ref','=',$mes)
                ->where('dizimista','=',$dizimista)
                ->first();
        if(empty($devolucao->valor)){
            return null;
        }else{
            return $devolucao->valor;
        }
    }
}
