<?php

namespace App\Http\Controllers\Painel\Estacionamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estacionamento\Carro;
use App\Models\Painel\Estacionamento\Fluxo_Diario;
use App\Models\Painel\Estacionamento\Mensalidade;
use App\Models\Painel\Estacionamento\Precos;

class Estacionamento extends Controller
{
    //
    private $carro;
    private $fluxo_diario;
    private $mensalidade;
    private $preco;
    public function __construct(Carro $car, Fluxo_Diario $flux, Mensalidade $monthly_payment, Precos $price) {
        $this->carro=$car;
        $this->fluxo_diario=$flux;
        $this->mensalidade = $monthly_payment;
        $this->preco = $price;
    }
    
    public function index(){
        return view('painel.estacionamento.fluxo_diario.entrada_saida');
    }    
    public function carros_estacionados(Request $request){
        $output = array(
          "draw"  => intval($request->input('draw'))
        );
    }
    public function entrada_carro(Request $request){
        $carro_conhecido=$this->carro->where('placa',$request->placa);
        if(!$carro_conhecido){
            $carro=salvar_carro($request);
        }else{
            $carro=$carro_conhecido->id_carro;
        }
        $tbl_preco_base = $this->preco->max('id_preco');
        $hora_entrada = date('H',time());
        $min_entrada = date('i',time());
        $dados = array(
            'carro'=>$carro,
            'hora_entrada'=>$hora_entrada,
            'min_entrada'=>$min_entrada,
            'valor'=>$tbl_preco_base
        );
        
        $insert_fluxo_diario = $this->fluxo_diario->create($dados);
    }
    private function salvar_carro(Request $request){
        
        $insert=$this->carro->create(['placa'=>$request->input('placa'),'isencao'=>0]);
        if($insert){
            $resposta=$insert->id_carro;
        }else{
            $resposta=false;
        }
            
        return $resposta;
        
    }
}
