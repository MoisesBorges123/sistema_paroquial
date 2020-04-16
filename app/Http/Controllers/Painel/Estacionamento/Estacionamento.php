<?php

namespace App\Http\Controllers\Painel\Estacionamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estacionamento\Carro;
use App\Models\Painel\Estacionamento\Fluxo_Diario;
use App\Models\Painel\Estacionamento\Mensalidade;
use App\Models\Painel\Estacionamento\Base_Precos;
use App\Models\Painel\Estacionamento\Horarios;
use App\Models\Painel\Estacionamento\Pagamentos;
use App\Models\Painel\Estacionamento\Escritorio_Visita_Estacionamento;
use App\Models\Painel\Estacionamento\Precos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Painel\Estacionamento\Carros;
use App\Http\Controllers\Painel\Pessoa\Pessoa;
class Estacionamento extends Controller
{
    //
    private $carro;
    private $fluxo_diario;
    private $mensalidade;
    private $preco;
    private $base_precos;
    private $horarios;
    private $pagamentos;
    private $visita_escritorio;
    
    public function __construct(Horarios $timers,Pagamentos $payments,Escritorio_Visita_Estacionamento $visit,Base_Precos $base_of_price, Carro $car, Fluxo_Diario $flux, Mensalidade $monthly_payment, Precos $price) {
        $this->carro=$car;
        $this->fluxo_diario=$flux;
        $this->mensalidade = $monthly_payment;
        $this->preco = $price;
        $this->base_precos = $base_of_price;
        $this->horarios = $timers;
        $this->pagamentos = $payments;
        $this->visita_escritorio = $visit;
        date_default_timezone_set('America/Sao_Paulo');
    }    
    public function index(){
        return view('painel.estacionamento.fluxo_diario.entrada_saida');
    }    
    public function carros_estacionados(){
        $v_estacionados = DB::table('carros_estacionamento')
        ->where('hora_saida',null)
        ->get();
        $dados=[];
        $num_mensalistas=0;
        $num_free=0;
        $num_rotativo=0;
        if($v_estacionados){
            
            foreach($v_estacionados as $registro){
                
                $carro = $this->carro->find($registro->carro);
                if($registro->modalidade=='hora'){
                    $modalidade="Rotativo";
                }else if($registro->modalidade=='diaria'){
                    $modalidade="Diária";                    
                }else if($registro->modalidade=='pernoite'){
                    $modalidade="Pernoite";
                }else if($registro->modalidade=='free'){
                    $modalidade="<i>Grátis</i>";

                }
                $dados_calc=array(
                    'data_entrada'=> $registro->data_entrada,
                    'hora_entrada'=>$registro->hora_entrada,
                    'min_entrada'=>$registro->min_entrada,
                    'modalidade'=>$registro->modalidade,
                    'base_calculo'=>$registro->base_calculo,
                    'tipo_veiculo'=>$carro->tipo,
                    'tolerancia'=>0,
                );
                $valor = $this->calc_estacionamento($dados_calc);                          
                $placa = $carro->placa;
                if(isset($carro->pessoa)){
                    $pessoa = DB::table('pessoas')->where('id_pessoa',$carro->pessoa)->first();
                    $telefone = DB::table('telefones')->where('pessoa',$carro->pessoa)->first();        
                    $nome = $pessoa->nome;
                    if(isset($telefone->id_telefone)){
                        $fone = $telefone->numero;
                        $obs_ligacao = $telefone->obs;
                    } else{
                        $nome="Desconhecido";
                        $fone="Desconhecido";
                        $obs_ligacao = null;
                    }                 
                    
                }else{
                    $nome="Desconhecido";
                    $fone="Desconhecido";
                    $obs_ligacao = null;
                }
                $dados[] = [
                    'id_fluxo'=>$registro->id_fluxo,
                    'modalidade'=>$modalidade,
                    'modalidade2'=>$registro->modalidade,
                    'tipo_veiculo'=>$carro->tipo,
                    'carro'=>$placa,
                    'id_carro'=>$carro->id_veiculo,
                    'valor'=>$valor['valor'],
                    'horario_entrada'=>sprintf("%02d",$registro->hora_entrada).":".sprintf("%02d",$registro->min_entrada),
                    'dono'=>$nome,
                    'telefone'=>$fone,
                    'obs_ligar'=>$obs_ligacao,
                    'tempo'=>$valor['duracao'],
                ];
                if($valor['mensalista']){
                    $num_mensalista++;    
                }else if($valor['free']){
                    $num_free++;    
                    
                }else if($valor['rotativo']){
                    $num_rotativo++;    

                }
            }
            return  array(
                'busca'=>true,
                'dados'=>$dados,
                'total_registros'=>count($dados),
                'num_mensalista'=>$num_mensalistas,
                'num_rotativo'=>$num_rotativo,
                'num_free'=>$num_free,
            );
        }else{
            return array(
                'busca'=>false,
                'dados'=>$dados,
                'total_registros'=>0,
                'num_mensalista'=>$num_mensalistas,
                'num_rotativo'=>$num_rotativo,
                'num_free'=>$num_free,
            );
        }

    }
    private function calc_estacionamento($carro){
            
        //=============================================ENTRADAS==============================||
        /*||*/    $hora_saida = date('H',time());/*                                          ||*/
        /*||*/    $min_saida = date('i',time());/*                                           ||*/
        /*||*/    $hora_entrada = $carro['hora_entrada'];/*                                  ||*/
        /*||*/    $min_entrada = $carro['min_entrada'];/*                                    ||*/
        /*||*/    $modalidade = $carro['modalidade'];/*                                      ||*/
        /*||*/    $base_calculo = $carro['base_calculo'];/*                                  ||*/
        /*||*/    $tipo_veiculo = $carro['tipo_veiculo'];/*                                  ||*/
        /*||*/    $tolerancia = isset($carro['tolerancia']) ? $carro['tolerancia']:0 ;/*     ||*/
        /*||*/    $mensalista = false; $rotativo = false; $free =false;               /*     ||*/
        /*||*/    $data_entrada = $carro['data_entrada'];/*                                  ||*/
        /*||*/    $data_atual = date('Y-m-d',time());/*                                      ||*/
        /*||*/    $valor = 0;/*                                                              ||*/
        //===================================================================================||

        
        //====================PROCESSAMENTO=================================================||
            //CASO A PESSOA ENTROU NO DIA ANTERIO    
            if($data_entrada<$data_atual){
                $hora_saida=18;
                $min_saida=0;
            }

            //CALCULADO MINUTOS ESTACIONADO (INICIO)
            if ($min_saida < $min_entrada) {
                $min_saida = $min_saida + 60;
                $hdif = 1;
                $mins_estacionado = $min_saida - $min_entrada;
            } else {
                $mins_estacionado = $min_saida - $min_entrada;
                $hdif = 0;
            }
            //CALCULADO MINUTOS ESTACIONADO (FIM)

            //CALCULO DE HORAS ESTACIONADAS
            $horas_estacionado = $hora_saida-$hora_entrada-$hdif;



            //O CARRO SE ENCONTRA EM QUAL MODALIDADE?       
            switch ($modalidade) {
                    //1.O CARRO ESTÁ COMO DIARISTA?            
                    case "diaria":
                        $preco=$this->preco
                        ->where('base',$base_calculo)
                        ->where('tipo_veiculo',$tipo_veiculo)
                        ->where('descricao',$modalidade)
                        ->first();
                        $valor=$preco->preco;
                        $rotativo = true;
                        
                    break;
                    //2.O CARRO ESTÁ COMO MENSALISTA?
                    case "mensalidade":
                        $valor=0;
                        $mensalista = true;
                       
                    break;
                    //3.O CARRO ESTÁ COMO PERNOITE?
                    case "pernoite":
                        $preco=$this->preco
                        ->where('base',$base_calculo)
                        ->where('tipo_veiculo',$tipo_veiculo)
                        ->where('descricao',$modalidade)
                        ->first();
                        $valor=$preco->preco;
                        $rotativo = true;
                        $duracao = "Pernoite";
                    break;
                    //4.O CARRO ESTÁ POR HORA?
                    case "hora":
                        //4.1 O carro ficou mais de 1h?
                        if($horas_estacionado>0){//=======SIM (O CARRO FICOU MAIS DE 1H ESTACIONADO)
                            $preco=$this->preco
                            ->where('base',$base_calculo)
                            ->where('tipo_veiculo',$tipo_veiculo)
                            ->where('descricao','hora')
                            ->first();                           
                            $valor+= $preco->preco*$horas_estacionado;                           
                            
                        }else{//==========================NÃO (O CARRO NÃO FICOU MAIS DE 1H ESTACIONADO)

                        }
                         //4.2 O carro ficou algum minuto estacionado?
                         if($mins_estacionado>0){//=======SIM (O CARRO FICOU ALGUNS MINS ESTACIONADO)
                            if($mins_estacionado>$tolerancia && $mins_estacionado<=$tolerancia+15){
                                $preco=$this->preco
                                ->where('base',$base_calculo)
                                ->where('tipo_veiculo',$tipo_veiculo)
                                ->where('descricao','15min a 30min')
                                ->first();
                                $valor+= $preco->preco;
                            }else if($mins_estacionado>$tolerancia+15 && $mins_estacionado<=$tolerancia+30){
                                $preco=$this->preco
                                ->where('base',$base_calculo)
                                ->where('tipo_veiculo',$tipo_veiculo)
                                ->where('descricao','30min')
                                ->first();
                                $valor+= $preco->preco;
                            }else if($mins_estacionado>$tolerancia+30){
                                $preco=$this->preco
                                ->where('base',$base_calculo)
                                ->where('tipo_veiculo',$tipo_veiculo)
                                ->where('descricao','hora')
                                ->first();
                                $valor+= $preco->preco;
                            }
                        }else{//=====================NÃO (O CARRO NÃO FICOU ALGUNS MINS ESTACIONADO)
                            $valor+=0;
                        }
                    $rotativo = true;
                    break;
                    case "free":
                        $free=true;
                        //$duracao = "<i>Grátis</i>";
                    break;
            }
            if(!isset($duracao)){
                $duracao = sprintf("%02d",$horas_estacionado)."h ".sprintf("%02d",$mins_estacionado)."min(s)";
            }
                


        //  ||======================================RETORNO============================================================||           
        /*  ||      */  return array('valor'=>"R$ ".number_format($valor,2,',','.'),'duracao'=>$duracao,'mensalista'=>$mensalista,'free'=>$free,'rotativo'=>$rotativo);//             ||
        //  ||=========================================================================================================||
    }
    public function estacionar(Request $request){
        //1.Eu conheço esse carro?
        $carro_conhecido=$this->carro->where('placa',$request->placa)->first();
        if(!isset($carro_conhecido->id_veiculo)){//CASO NÃO
            $carro=$this->salvar_carro($request);
        }else{//===================================CASO SIM
            $carro=$carro_conhecido->id_veiculo;
        }

        
        //2.Esse carro já está estacionado?        
            $carro_estacionado = $this->fluxo_diario->where('carro',$carro)->first();
            if(!isset($carro_estacionado->id_fluxo)){ //================================CASO NÃO (CARRO NÃO ESTÁ ESTACIONADO)
                $mensalista=DB::table('mensalistas')->where('carro',$carro)->first();

            //3.Esse carro é de algum mensalista?
                if(!isset($mensalista->id_fluxo)){//CASO NÃO
                    $tbl_preco_base = $this->base_precos->max('id_base_preco');
                    $hora_entrada = date('H',time());
                    $min_entrada = date('i',time());
                    $dados = array(
                        'carro'=>$carro,
                        'hora_entrada'=>$hora_entrada,
                        'min_entrada'=>$min_entrada,
                        'base_calculo'=>$tbl_preco_base,
                        'modalidade'=>$request->input('modalidade'),
                        'data_entrada'=>date('Y-m-d',time())
                    ); 
                    $insert_pagamento = $this->pagamentos->create($dados);
                    $insert_horario = $this->horarios->create($dados);            
                    $insert_fluxo_diario = $this->fluxo_diario
                    ->create([
                        'horario'=>$insert_horario->id_horario,
                        'pagamento'=>$insert_pagamento->id_pagamento,
                        'carro'=>$carro
                        ]);
                //4.Eu conheço quem é o dono desse carro?        
                    if(isset($carro->pessoa)){//CASO SIM
                        $registro_pessoa=DB::table('pessoa')
                        ->where('id_pessoa',$carro->pessoa)
                        ->join('telefones','pessoa.id_pessoa','=','telefones.pessoa')
                        ->get();
                        $pessoa = array(
                            'nome'=>$registro_pessoa->nome,
                            'fone'=>"(".$registro_pessoa->dd.") ".$registro_pessoa->numero,
                            'sexo'=>$registro_pessoa->sexo
                        );
                    }else{//=============CASO NÃO (NÃO CONHEÇO O DONO DO CARRO)
                        $pessoa = null;
                    }
                    
        //  ||======================================RETORNO============================================================||           
        /*  ||      */  return array('insert'=>true,'cod_fluxo'=>$insert_fluxo_diario->id_fluxo,'pessoa'=>$pessoa);//  ||
        //  ||=========================================================================================================||

                }else{//============================CASO SIM (É MENSALISTA)
                    $dados_horario = array(
                        'hora_entrada'=>date('H',time()),
                        'min_entrada'=>date('i',time()),
                        'data_entrada'=>date('Y-m-d',time()),
                    );                    
                    $insert_horario = $this->horarios->create($dados_horario);
                    $dados = array(
                        'carro'=>$carro,
                        'horario'=>$insert_horario->id_horario,
                        'pagamento'=>$mensalista->pagamento

                    );
                    $insert_fluxo = $this->fluxo_diario->create($dados);
                    $registro_pessoa=DB::table('pessoa')
                        ->where('id_pessoa',$carro->pessoa)
                        ->join('telefones','pessoa.id_pessoa','=','telefones.pessoa')
                        ->get();
                        $pessoa = array(
                            'nome'=>$registro_pessoa->nome,
                            'fone'=>"(".$registro_pessoa->dd.") ".$registro_pessoa->numero,
                            'sexo'=>$registro_pessoa->sexo
                        );

                    //  ||======================================RETORNO============================================================||           
                    /*  ||      */  return array('insert'=>true,'cod_fluxo'=>$insert_fluxo_diario->id_fluxo,'pessoa'=>$pessoa);//  ||
                    //  ||=========================================================================================================||
                    
                }                       
            }else{ //================================== CASO SIM (CARRO JÁ ESTÁ ESTACIOANDO)

                //  ||=============================================================RETORNO============================================================||
                /*  ||  */return array('insert'=>false,'carro_estacionado'=>$carro_estacionado->id_fluxo,'tipo'=>$request->input('tipo_veiculo'));//  ||
                //  ||================================================================================================================================||
            }
        
    }
    private function salvar_carro(Request $request){        
        $fn_carro = new Carros;
        return $fn_carro->salvar_carro($request);
    }
    public function delete(Request $request){
        $v_estacionados = DB::table('carros_estacionamento')
        ->where('id_fluxo',$request->input('id'))
        ->first();
        $registro_fluxo = $this->fluxo_diario->find($request->input('id'));
        $registro_pagamento = $this->pagamentos->find($v_estacionados->pagamento);
        $registro_horario = $this->horarios->find($v_estacionados->horario);
        $delete1=$registro_fluxo->delete();
        $delete2=$registro_pagamento->delete();
        $delete3=$registro_horario->delete();


        $resposta = $delete1 ? true:false;
        return array('result'=>$resposta);

    }
    public function update(Request $request){

        //1.Eu conheço esse carro?
        $carro_conhecido=$this->carro->where('placa',$request->placa)->where('tipo',$request->input('tipo_veiculo'))->first();
        if(!isset($carro_conhecido->id_veiculo)){//CASO NÃO (NÃO CONHEÇO O CARRO)
            $carro=$this->carro->find($this->salvar_carro($request));
        }else{//===================================CASO SIM (EU CONHEÇO O CARRO)
            $carro=$carro_conhecido;
        }
        /*
            *TEM QUE VERIFICAR SE O CARRO É FREE OU SE É MENSALISTA E COLOCAR DENTRO DA VARIAVEL MODALIDE
            *TEM QUE ATUALIZAR O CARRO NA TABELA FLUXO DIARIO
        */

        //2. ESSE CARRO É UM MENSALISTA?
        $mensalistas = DB::table('mensalistas')
                        ->where('carro',$carro->id_veiculo)
                        ->first();
        $modalidade = isset($mensalistas->id_fluxo) ? "mensalidade":$request->input('modalidade');

        //3.ESSE CARRO É ISENTO?
        $modalidade = $carro->isencao==1 ? "Free": $modalidade;

        $registro_fluxo = $this->fluxo_diario->find($request->input('id'));
        
        $v_estacionados = DB::table('carros_estacionamento')->where('id_fluxo',$request->input('id'))->first();
        
        $registro_pagamento = $this->pagamentos->find($v_estacionados->pagamento);
        $registro_horario = $this->horarios->find($v_estacionados->horario);
        
        //ESSA NOVA PLACA SE ENCONTRA JA CADASTRADA NOS CARROS ESTACIONADOS?
        if($carro->id_veiculo!=$registro_fluxo->carro){ // new car e old car são iguais? (Não são diferentes)
            $v_estacionados = DB::table('carros_estacionamento')
             ->where('carro',$carro->id_veiculo)
             ->where('modalidade',$request->input('modalidade'))
            ->first();
            $existe = isset($v_estacionados->id_fluxo) ? true : false;
        }else{
            $existe =false;
        }

        if($existe==false){
            $tempo = explode(':',$request->input('horario'));
            $u1=$registro_pagamento->update(['modalidade'=>$modalidade]);
            $u2=$registro_horario->update(['hora_entrada'=>$tempo[0],'min_entrada'=>$tempo[1]]);
            $u3=$registro_fluxo->update(['carro'=>$carro->id_veiculo]);
            if($u1 && $u2 && $u3){
                $resposta = array('update'=>true,'duplicidade'=>false);
            }else{
                $resposta = array('update'=>false,'duplicidade'=>false);
            }
        }else{
            $resposta = array('update'=>false,'duplicidade'=>true);
        }

        return $resposta;

        

    }
    public function pagarMensalidade(Request $request){        
        $valor = $request->input('valor');
        $id_preco = $request->input('id_preco');
        $pago=$request->input('pago');
        $desconto=$request->input('desconto');
        $data_entrada=$request->input('data_entrada');
        $data_saida=$request->input('data_saida');
        $obs = !empty($request->input('obs')) ? $request->input('obs') : null;
        $data = date('Y-m-d',time());
        $fn_carros = new Carros;
        $dadosVeiculos = $fn_carros->busca_carro($request);
        if($dadosVeiculos['cad_carro'] != false){
            $veiculo = $dadosVeiculos['dados']->id_veiculo;
            if($dadosVeiculos['cad_pessoa']==false){//=======O VEICULO JÁ FOI CADASTRADO, MAS NÃO TEM OS DADOS DO PROPRIETÁRIO
                $fn_carro->update($request);
            } 
        }else{
            if(empty($request->input('carro'))){//===========SE NUNCA ESTACIONOU NA CATEDRAL                
                $veiculo = $this->salvar_carro($request);
            }
        }
        $dados = array(
            'valor'=>$valor,
            'desconto'=>$desconto,
            'justificativa_desconto'=>$obs,
            'base_calculo'=>$id_preco,
            'pago'=>$pago,
            'data_pagamento'=>$data,
            'modalidade'=>'mensalidade',
            'veiculo'=>$veiculo,
            'data_entrada'=>$data_entrada,
            'data_saida'=>$data_saida,
            'hora_entrada'=>'8',
            'hora_saida'=>'18',
            'min_entrada'=>'0',
            'min_saida'=>'0'
        );






        
        
        
        //A MENSALIDADE JÁ VENCEU?

        
    }
    


    
   
}
