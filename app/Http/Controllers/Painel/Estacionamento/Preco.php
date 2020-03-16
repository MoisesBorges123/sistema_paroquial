<?php

namespace App\Http\Controllers\Painel\Estacionamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estacionamento\Precos;
use App\Models\Painel\Estacionamento\Base_Precos;
class Preco extends Controller
{
    //
    private $preco;
    private $base_precos;
    public function __construct(Precos $price, Base_Precos $base_price) {
        $this->preco=$price;
        $this->base_precos = $base_price;
        date_default_timezone_set("America/Sao_Paulo");
    }
    
    public function cadastrarPreco(){
        return view('painel.estacionamento.preco.form-cadastro-tbl-preco');
    }
    public function index(){
        
        return view('painel.estacionamento.preco.tbl-preco');
    }
            
    public function salvarPreco(Request $request){
        //Cria uma nova base de preços
        $data_atual = date('Y-m-d',time()); 
        
        if(!empty($request->input('obs_tbl')))
            $observacao= $request->input('obs_tbl');  
        else
            $observacao = null;
        
        $insert_base = $this->base_precos->create(['data'=>$data_atual,'descricao'=>$observacao]);
        
        //Se a nova base foi criada cadastre preço por preço
        if($insert_base){
            $insert=[];
            for($i=0;$i<10;$i++){
                switch($i){
                    //Inicio Cadastrando Preços de Motos
                    case 1://Hora
                        
                        $insert['moto']['hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('moto_hora'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M']);                        
                        break;
                    case 2://30 minutos
                                              
                        $insert['moto']['meia_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('moto_15_30'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M']);                        
                        break;
                    case 3:// 15 minutos
                                              
                        $insert['moto']['quarto_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('moto_01_15'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M']);                        
                        break;
                    case 4:// Diária
                        $insert['moto']['diaria']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('diaria_moto'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M']);                        
                        
                        break;
                    case 5://Pernoite
                        $insert['moto']['pernoite']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('pernoite_moto'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M']);                                         
                        break;
                    //Fim Cadastrando Preços de Motos   
                    // 
                    //Inicio Cadastrando Preços de Carros
                    case 6://Hora
                        
                        $insert['carro']['hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('carro_hora'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C']);                        
                        break;
                    case 7://30 minutos
                                              
                        $insert['carro']['meia_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('carro_15_30'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C']);                        
                        break;
                    case 8:// 15 minutos
                                              
                        $insert['carro']['quarto_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('carro_01_15'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C']);                        
                        break;
                    case 9:// Diária
                        $insert['carro']['diaria']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('diaria_carro'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C']);                        
                        
                        break;
                    case 10://Pernoite
                        $insert['carro']['pernoite']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',$request->input('pernoite_carro'))),'computador'=>$request->ip(),'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C']);                                         
                        break;
                    //Fim Cadastrando Preços de Motos    
                }
            }
            
        }
       return $insert;
    }
    
   
   
}
