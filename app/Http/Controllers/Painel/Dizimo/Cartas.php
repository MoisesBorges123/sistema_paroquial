<?php

namespace App\Http\Controllers\Painel\Dizimo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Dizimo\Q_meus_dizimistas;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Facades\Fpdf;
use App\Models\Painel\Cartas\Carta;
use Illuminate\Support\Facades\URL;
use Keygen\Keygen;
class Cartas extends Controller
{
    //
    private $meus_dizimistas;
    private $cartas;
    public function __construct(Q_meus_dizimistas $my_dizimistas,Carta $letter) {
        $this->meus_dizimistas = $my_dizimistas;
        $this->cartas = $letter;
        date_default_timezone_set('America/Sao_Paulo');
       setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }
    
    
    public function index(){
        
        $tituloPagina="Cartas Anivesário";
        $page_header="Cartas Dizimistas";
        $descricao_page_header="";
        $query=$this->meus_dizimistas->all();        
        return view('painel.dizimo.cartas.tbl-dizimistas-aniversariantes',compact('query','page_header','tituloPagina'));
    }    
    public function montaTable(){   
       
        //$mes = date('m',time());
        //$mes =str_pad($mes , 2 , '0' , STR_PAD_LEFT);
        //$query = $this->meus_dizimistas->where('d_nasc','like','%-'.$mes.'-%')->get();
        $query = $this->meus_dizimistas->all();
        $fn = new FuncoesAdicionais;
        if(count($query)>0){            
            $dados=[];            
            foreach($query as $q){                
                //$mes = ucfirst(strftime('%B',strtotime($q->d_nasc))); 
                $mes = $fn->nomeMes(date('m',strtotime($q->d_nasc)));           
                $telefone=DB::table('telefones')->where('pessoa',$q->id_pessoa)->first();
                $id_telefone = empty($telefone->id_telefone) ? null : $telefone->id_telefone;
                $numero = empty($telefone->numero) ? null: $telefone->numero;
                $dados[]=[                   
                   'situacao'=>$q->situacao,
                   'mes_aniversario'=>$mes,
                   'nome'=>$q->nome,      
                   'd_nasc'=>date('d/m/Y',strtotime($q->d_nasc)),
                   'id_dizimista'=>$q->id_dizimista,
                   'id_pessoa'=>$q->id_pessoa,
                   'id_telefone'=> $id_telefone,
                   'telefone'=>$numero
                ];
                
            }
        }else{
            $dados=null;
        }
           
        
        return array(
            'total_registros'=>count($query),
            'dados'=>$dados,            
        );
    }
    public function printer(Request $request){
        $fn = new FuncoesAdicionais();
        
        $imagem = 'imagens/mala_direta.png';
        $mes= $request->input('mes');
        
        $registros = $this->meus_dizimistas
        ->where('d_nasc','like',"%-".str_pad($mes , 2 , '0' , STR_PAD_LEFT)."-%")
        //->where('situacao_endereco','5')
        ->get();
        $registros_all = $this->meus_dizimistas
        ->where('d_nasc','like',"%-".str_pad($mes , 2 , '0' , STR_PAD_LEFT)."-%")                    
        ->get();
        $total_registros = count($registros);
        $total_registros_incorretos = count($registros_all)-$total_registros;
        if($total_registros==0){            
            if($total_registros_incorretos==0){
                $mensagem = "Não foi possível imprimir nenhum selo, não existe nenhum dizimista anivesariante no mês de <b>".$fn->nomeMes($mes)."</b>";
            }else{
                $mensagem = "Não foi possível imprimir nenhum selo, o endereço dos seus dizimsta estão <b>INCORRETOS</b>.";
            }            
            return redirect()->route('Visualizar.Dizimistas.Aniversariantes')->with('mensagem',$mensagem)->with('tipo','warning');
        }
        $pdf = new Fpdf();    
        $i=1;
        $proxima_pg=8;
        $nome_mes=$fn->nomeMes($mes);
        $pdf::AddPage('P','A4');                  
        $pdf::SetFont('Times','B',11);     
        
        foreach($registros as $registro){   
            $codigo=Keygen::alphanum(9)->prefix('CT-')->suffix('.DZ')->generate();         
            
            $dados_carta = array(
                'cod_sistema'=>$codigo,
                'tipo_carta'=>1,
                'situacao'=>6,
                'destinatario'=>$registro->pessoa                
            );
            $carta=$this->cartas->create($dados_carta);
            if(!empty($registro->complemento)){
                $complemento="\nComplemento: $complemento";
                if(($i%2)==0){
                    $kx=148;
                    $ky=25;
                }else{
                $kx=53;
                    $ky=28; 
                }
                
                $espaco="\n\n\n\n\n\n";
            }else{
                if(($i%2)==0){
                    $kx=148;
                    $ky=15;
                }else{
                    $kx=53;
                    $ky=15; 
                }
                
                $espaco="\n\n\n\n";
            }       
        
            if($i>$proxima_pg){//Se preencher uma pagina execute esse código
                $pdf::AddPage();            
                $proxima_pg+=8;
                unset($y2);
                unset($x2);
            }
            

            if(($i%2)==0){
                $pdf::SetXY($x+95, $y);
                $x3=$x+$kx;
                $y3=$y+$ky;
                $pdf::MultiCell(95, 6,
                utf8_decode("Destinatário: ") .utf8_decode($registro->nome).
                "\nRua: ".$registro->rua.", ".$registro->numero.
                "\nBairro: ".$registro->bairro."\nCEP: ".$registro->cep.
                "\nCidade: ".$registro->cidade."/".$registro->sigla."\n".utf8_decode("Código: ").$codigo.$espaco.$pdf::Image($imagem,$x3,$y3,40,30,'PNG')." ", 1, 'L', FALSE);            
            }else{
                $y=$pdf::GetY();
                $x=$pdf::GetX();
                if(isset($y2)&&isset($x2)){
                    $pdf::SetY($y2);
                    $x3=$x2+$kx;
                    $y3=$y2+$ky;
                }else{
                    $x3=$x+$kx;
                    $y3=$y+$ky; 
                }
                    
                $pdf::MultiCell(95, 6,
                utf8_decode("Destinatário: ") .$registro->nome.
                " \nRua: ".$registro->rua.", ".$registro->numero.
                "\nBairro: ".$registro->bairro."\nCEP: ".$registro->cep.
                "\nCidade: ".$registro->cidade."/".$registro->sigla."\n".utf8_decode("Código: ").$codigo.$espaco.$pdf::Image($imagem,$x3,$y3,40,30,'PNG')." ", 1, 'L', FALSE);
            
                $x2=$pdf::GetX();
                $y2=$pdf::GetY();
            
            }            
            $i++;
            unset($dados_carta);                        
        }

        $pdf::Ln(5);
        $pdf::SetFont('Times','B',14); 
        $pdf::Cell(190,5,"Total de selos: ".$total_registros.utf8_decode(" / Anivesários do mês ").$fn->nomeMes($mes).utf8_decode("/ Registros com o endereço incorreto: ").$total_registros_incorretos,0,'L');
        $pdf::Output();
    }
    public function cartaDevolvida(Request $request){
        if(!empty($request->input('cod_carta'))){
            $carta = $this->cartas->where('cod_sistema',$request->input('cod_carta'))->first();          
            $update_carta=$carta->update(['situacao'=>7]);
            $pessoa = DB::table('pessoas')->where('id_pessoa',$carta->destinatario)->first();            
            $endereco = DB::table('enderecos')->where('id_endereco',$pessoa->endereco)->first();            
            $update_endereco = empty($endereco) ? false : $endereco->update(['situacao_endereco'=>4]);
                    
            return array('update_endereco'=>$update_endereco,'update_carta'=>$update_carta);
        }else{
            return array('update_endereco'=>false,'update_carta'=>false);
            
        }
    }
    public function dashboard(){
        $dados_ultimas_cartas = $this->boxEmail();
        $dados_grafico=$this->grafico($dados_ultimas_cartas['dt_last_letter']);
    }
    private function grafico($ultima_emissao){
        $fn = new FuncoesAdicionais();
        $mes = date('m',strtotime($ultima_emissa));
        $ano_passado=date('Y',strtotime($ultima_emissa))-1;
        $dados=[];
        for($i=1;$i<=12;$i++){
            if($mes>0){
                $ct_devolvidas=$this->cartas
                ->where('created_at','like',"%-".str_pad($mes , 2 , '0' , STR_PAD_LEFT)."-%")
                ->where('situacao',7)            
                ->get()
                ->count();
                $mes--;
                $dados[]=['mes'=>$fn->nomeMes($mes),'valor'=>$ct_devolvidas];
            }else{
                $mes2=12;
                $ct_devolvidas=$this->cartas
                ->where('created_at','like',"%".$ano_passado."-".str_pad($mes2 , 2 , '0' , STR_PAD_LEFT)."-%")
                ->where('situacao',7)            
                ->get()
                ->count();
                $dados[]=['mes'=>$fn->nomeMes($mes2),'valor'=>$ct_devolvidas];
            }

        }

    }
    private function boxEmail(){
        $ultima_emissao=$this->cartas->all()->max('created_at');        
        $dados=$this->cartas->where('created_at',$dados_ultimas_cartas)->get();
        $total_cartas = count($dados);
        $dados_ct_devolvidas=$this->cartas
        ->where('created_at',$dados_ultimas_cartas)
        ->where('situacao',7)
        ->get();
        $total_cartas_devolvidas = count($dados_ct_devolvidas);
        $tatal_cartas_not_devolvidas = $total_cartas-$total_cartas_devolvidas;
        return array('dt_last_letter'=>$ultima_emissao,'cartas'=>$dados,'n_ct_devolvidas'=>$total_cartas_devolvidas,'n_ct_total'=>$total_cartas);
    }


}
