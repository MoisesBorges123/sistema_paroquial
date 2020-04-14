<?php

namespace App\Http\Controllers\Painel\Estacionamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estacionamento\Precos;
use App\Models\Painel\Estacionamento\Base_Precos;
use App\Models\Painel\Computadores\Computadores;
class Preco extends Controller
{
    //
    private $preco;
    private $base_precos;
    private $computador;

    public function __construct(Precos $price, Base_Precos $base_price, Computadores $computer) {
        $this->preco=$price;
        $this->base_precos = $base_price;
        $this->computador = $computer;
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
        $computador_dados=$this->computador->where('ip',$request->ip())->first();
        $computador = $computador_dados->id_computador;
        
        if($computador){
            if(!empty($request->input('obs_tbl')))
                $observacao= $request->input('obs_tbl');  
            else
                $observacao = null;
            
            $insert_base = $this->base_precos->create(['data'=>$data_atual,'descricao'=>$observacao]);
            
            //Se a nova base foi criada cadastre preço por preço
            if($insert_base){
                $insert=[];
                for($i=1;$i<=12;$i++){
                    switch($i){
                        //Inicio Cadastrando Preços de Motos
                        case 1://Hora
                            
                            $insert['moto']['hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('moto_hora')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M','descricao'=>'hora']);                        
                            break;
                        case 2://30 minutos
                                                
                            $insert['moto']['meia_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('moto_15_30')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M','descricao'=>'30min']);                        
                            break;
                        case 3:// 15 minutos
                                                
                            $insert['moto']['quarto_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('moto_01_15')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M','descricao'=>'15min a 30min']);                        
                            break;
                        case 4:// Diária
                            $insert['moto']['diaria']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('diaria_moto')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M','descricao'=>'diaria']);                        
                            
                            break;
                        case 5://Pernoite
                            $insert['moto']['pernoite']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('pernoite_moto')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M','descricao'=>'pernoite']);                                         
                            break;
                        //Fim Cadastrando Preços de Motos   
                        // 
                        //Inicio Cadastrando Preços de Carros
                        case 6://Hora
                            
                            $insert['carro']['hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('carro_hora')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C','descricao'=>'hora']);                        
                            break;
                        case 7://30 minutos
                                                
                            $insert['carro']['meia_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('carro_15_30')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C','descricao'=>'30min']);                        
                            break;
                        case 8:// 15 minutos
                                                
                            $insert['carro']['quarto_hora']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('carro_01_15')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C','descricao'=>'15min a 30min']);                        
                            break;
                        case 9:// Diária
                            $insert['carro']['diaria']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('diaria_carro')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C','descricao'=>'diaria']);                        
                            
                            break;
                        case 10://Pernoite
                            $insert['carro']['pernoite']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('pernoite_carro')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C','descricao'=>'pernoite']);                                         
                            break;
                            //Fim Cadastrando Preços de Motos    

                            //Mensalistas
                            case 11:// carro
                                $insert['carro']['mensalidade']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('mensalidade_carro')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'C','descricao'=>'mensalidade']);                        
                                
                                break;
                            case 12://moto
                                $insert['moto']['mensalidade']=$this->preco->create(['preco'=>floatval(str_replace(',', '.',str_replace('.','',$request->input('mensalidade_moto')))),'computador'=>$computador,'usuario'=>null,'base'=>$insert_base->id_base_preco,'tipo_veiculo'=>'M','descricao'=>'mensalidade']);                                         
                                break;
                    }
                }
                
            }
        }else{
            $insert = array(
                'authorization'=>'negada'
            );
        }
        return $insert;
    }
    public function list($id=0){
        //$tabela_atual = $id==0 ? $this->base_precos->max('id_base_preco') : $id; 
        if($id==0)
            $tabela_atual=$this->base_precos->max('id_base_preco');
        else
            $tabela_atual=$id;

        $dados_body = array(
            'carro'=> array(
                'hora'=>null,
                '30min'=>null,
                '15min a 30min'=>null,
                'diaria'=>null,
                'pernoite'=>null,
                'mensalidade'=>null
            ),
            'moto'=> array(
                'hora'=>null,
                '30min'=>null,
                '15min a 30min'=>null,
                'diaria'=>null,
                'pernoite'=>null,
                'mensalidade'=>null
            ),
        );        
            
            foreach($dados_body as $key1 => $value1){
                foreach($value1 as $modalidades =>$value){                    
                    $registro = $this->base_precos
                    ->where('id_base_preco',$tabela_atual)
                    ->join('precos_estacionamento','base_de_precos_estacionamento.id_base_preco','=','base')
                    ->where('precos_estacionamento.descricao',strtolower($modalidades))
                    ->where('precos_estacionamento.tipo_veiculo',$key1[0])                    
                    ->first();                  
                  
                    $dados_body[$key1][$modalidades] = array(
                        "id"=> $registro->id_preco,
                        "valor"=> number_format($registro->preco,2,',','.')
                    ); 
                }
               
            }
            
            $table_carros = "<table class='table table-striped table-bordered nowrap'>".$this->gerarTBLBody('carro',$dados_body)."</table>";
            $table_motos = "<table class='table table-striped table-bordered nowrap'>".$this->gerarTBLBody('moto',$dados_body)."</table>";
            $resposta = array(
                'tabela_carros'=>$table_carros,
                'tabela_motos'=>$table_motos,                
            );

            return $resposta;
    }
    public function update(Request $request){
        $id = $request->input('cod');
        $computador = $this->computador->where('ip',$request->ip());
        if($computador){
           
            $preco_update = $this->preco->find($id);
        
            $atualizacao=$preco_update->update(['preco'=>str_replace(',','.',str_replace('.','',($request->input('preco'))))]);
            $update = array(
                'update'=>$atualizacao,
                'authorization'=>'permitida'
            );

        }else{
            $update=array('authorization'=>'negada');
        }

        return $update;
    }
    private function gerarTBLBody($veiculo,$dados_body){
        $body=
                "<tr >"            
                    ."<td class='bg-danger text-center'><b>01 Hora</b></td>"
                    ."<td>R$ ".$dados_body[$veiculo]['hora']['valor']."</td>"
                    ."<td><button class='btn btn-primary btn-editar' data-value='".$dados_body[$veiculo]['hora']['valor']."' data-url='".route('Preco.Update')."' data-id='".$dados_body[$veiculo]['hora']['id']."'>Alterar</button>"
                ."<tr>"
                ."<tr >"
                    ."<td  class='bg-warning text-center'><b>30 min.<b/></td>"
                    ."<td>R$ ".$dados_body[$veiculo]['30min']['valor']."</td>"                
                    ."<td><button class='btn btn-primary btn-editar' data-value='".$dados_body[$veiculo]['30min']['valor']."' data-url='".route('Preco.Update')."' data-id='".$dados_body[$veiculo]['30min']['id']."'>Alterar</button>"
                ."</tr>"
                ."<tr >"
                    ."<td  class='bg-success text-center'><b>15 min. - 30 min.</b></td>"
                    ."<td>R$ ".$dados_body[$veiculo]['15min a 30min']['valor']."</td>"
                    ."<td><button class='btn btn-primary btn-editar' data-value='".$dados_body[$veiculo]['15min a 30min']['valor']."' data-url='".route('Preco.Update')."' data-id='".$dados_body[$veiculo]['15min a 30min']['id']."'>Alterar</button>"
                ."</tr>"
                ."<tr class='bg-simples-c-blue'>"
                    ."<td>Diária</td>"
                    ."<td>R$ ".$dados_body[$veiculo]['diaria']['valor']."</td>"
                    ."<td><button class='btn btn-primary btn-editar' data-value='".$dados_body[$veiculo]['diaria']['valor']."' data-url='".route('Preco.Update')."' data-id='".$dados_body[$veiculo]['diaria']['id']."'>Alterar</button>"
                ."</tr>"
                ."<tr class='bg-simples-c-blue'>"
                    ."<td>Pernoite</td>"
                    ."<td>R$ ".$dados_body[$veiculo]['pernoite']['valor']."</td>"
                    ."<td><button class='btn btn-primary btn-editar' data-value='".$dados_body[$veiculo]['pernoite']['valor']."'  data-url='".route('Preco.Update')."' data-id='".$dados_body[$veiculo]['pernoite']['id']."'>Alterar</button>"
                ."</tr>"
                ."<tr class='bg-simples-c-blue'>"
                    ."<td>Mensalidade</td>"
                    ."<td>R$ ".$dados_body[$veiculo]['mensalidade']['valor']."</td>"
                    ."<td><button class='btn btn-primary btn-editar' data-value='".$dados_body[$veiculo]['mensalidade']['valor']."' data-url='".route('Preco.Update')."' data-id='".$dados_body[$veiculo]['mensalidade']['id']."'>Alterar</button>"
                ."</tr>";
                return $body;
    }
    public function buscar_preco(Request $request){
        $modalidade = $request->input('modalidade');
        $tipo_veiculo = $request->input('tipo_veiculo');
        $base_precos = $this->base_precos->max('id_base_preco');
        $preco = $this->preco
        ->where('base',$base_precos)
        ->where('tipo_veiculo',$tipo_veiculo)
        ->where('descricao',$modalidade)
        ->first();
        return $preco;
    }
   
   
}
