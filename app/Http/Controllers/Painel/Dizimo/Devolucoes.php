<?php

namespace App\Http\Controllers\Painel\Dizimo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Dizimo\Devolucoes_dizimo;
use App\Models\Painel\Dizimo\Q_meus_dizimistas;
use App\Models\Painel\Computadores\Computadores;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
class Devolucoes extends Controller
{
    //
    /*
     * Variaveis Globais
     * 
     */    
    private $devolucao;
    private $dizimista;
    private $fn;
    private $computadores;
    public function __construct(Devolucoes_dizimo $sendBack, Q_meus_dizimistas $query_dizimistas, FuncoesAdicionais $func, Computadores $computers) {
        $this->devolucao = $sendBack;
        $this->dizimista = $query_dizimistas;
        $this->fn = $func;
        $this->computadores = $computers;
    }   
    public function salvar_devolucao(Request $request,$dizimista){
        if(!empty($dizimista)){
            $mes_valor=$this->busca_mes($request);
            $ano = $request->input('id');
            $devolucao = $this->devolucao
                    ->where('mes_ref',$mes_valor['mes'])
                    ->where('ano_ref',$ano)
                    ->where('dizimista',$dizimista)
                    ->first();
            if($devolucao){
               $dados= array('valor'=>$mes_valor['valor']);
                $update=$devolucao->update($dados);
                if(!$update){
                    echo"Deu Bosta";

                }
                
            }else{
               
                $ip=$request->ip();
                $conhecido=$this->computadores->find($ip);
                if(!$conhecido){
                    $this->computadores->create(['ip'=>$ip,'tipo'=>'desconhecido']) ;
                }
                $dados = array(
                  'valor' =>$mes_valor['valor'],
                    'mes_ref'=>$mes_valor['mes'],
                    'ano_ref'=>$ano,
                    'local_dev'=>$ip,
                    'dizimista'=>$dizimista
                    
                    
                );
               $this->devolucao->create($dados);
            }
        }
    }
    public function devolver($dizimista=null){
        if(!empty($dizimista)&& is_numeric($dizimista)){
            //$dados_devolucao= $this->devolucao->all()->last();
            $dados_devolucao = $this->buscar_ficha($dizimista);
            $dados_dizimista = $this->dizimista->find($dizimista);
            if(!empty($dados_dizimista->apartamento)){
                $apartamento = $dados_dizimista->apartamento.', ';
            }else{
                $apartamento='';
            }
            
            $dados = [
                'devolucoes'=>$dados_devolucao,
                'dizimista'=>[
                'id'=>$dizimista,
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
                    $devolucao = 'R$ '.number_format($this->buscar_devolucao($ano, $mes, $dizimista),2,',','.');
                    
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
    private function busca_mes(Request $request){
        $formData=$request->all();
        extract($formData);
        if(!empty($Janeiro)){
            $valor=$Janeiro;
            $mes=1;
        }elseif(!empty($Fevereiro)){
            $valor=$Fevereiro;
            $mes=2;
        }elseif(!empty($Março)){
            $valor=$Março;
            $mes=3;
        }elseif(!empty($Abril)){
            $valor=$Abril;
            $mes=4;
        }elseif(!empty($Maio)){
            $valor=$Maio;
            $mes=5;
        }elseif(!empty($Junho)){
            $valor=$Junho;
            $mes=6;
        }elseif(!empty($Julho)){
            $valor=$Julho;
            $mes=7;
        }elseif(!empty($Agosto)){
            $valor=$Agosto;
            $mes=8;
        }elseif(!empty($Setembro)){
            $valor=$Setembro;
            $mes=9;
        }elseif(!empty($Outubro)){
            $valor=$Outubro;
            $mes=10;
        }elseif(!empty($Novembro)){
            $mes=11;
            $valor=$Novembro;
        }elseif(!empty($Dezembro)){
            $mes=12;
            $valor=$Dezembro;
        }else{
            $mes=0;
            $valor=0;
        }
        $valor = floatval(str_replace(',', '.', $valor));
        $resposta = array('mes'=>$mes,'valor'=>$valor);
        return $resposta;
    }
}
