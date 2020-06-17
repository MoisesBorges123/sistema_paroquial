<?php

namespace App\Http\Controllers\Painel\Estacionamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estacionamento\Fluxo_Diario;
use App\Models\Painel\Estacionamento\Mensalidade;
use App\Models\Painel\Estacionamento\Horarios;
use App\Models\Painel\Estacionamento\Pagamentos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Painel\Estacionamento\Carros;
class MensalidadeC extends Controller
{
    private $fluxo_diario;
    private $mensalidade;
    private $horarios;
    private $pagamentos;
    public function __construct(Horarios $timers,Pagamentos $payments,Fluxo_Diario $flux, Mensalidade $monthly_payment){
        $this->fluxo_diario=$flux;
        $this->mensalidade = $monthly_payment;
        $this->horarios = $timers;
        $this->pagamentos = $payments;
    }

    
    
    private function salvar_carro(Request $request){
        $fn_carro = new Carros;
        return $fn_carro->salvar_carro($request);
    }
}
