<?php

namespace App\Http\Controllers\Painel\Dizimo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Dizimo\Q_meus_dizimistas;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Facades\Fpdf;
use Keygen\Keygen;
class Cartas extends Controller
{
    //
    private $meus_dizimistas;
    public function __construct(Q_meus_dizimistas $my_dizimistas) {
        $this->meus_dizimistas = $my_dizimistas;
        date_default_timezone_set('America/Sao_Paulo');
       setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }
    
    
    public function index(){
        $x=Keygen::alphanum(7)->prefix('CT-')->suffix('.DZ')->generate();
        $tituloPagina="Cartas Anivesário";
        $page_header="Cartas Dizimistas";
        $descricao_page_header="";
        $query=$this->meus_dizimistas->all();        
        return view('painel.dizimo.cartas.tbl-dizimistas-aniversariantes',compact('query','page_header','tituloPagina'));
    }
    
    public function montaTable(){        
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
        $pdf =new FPDF();
        $mes=$request->input('mes');
        $registros = $this->meus_dizimistas
        ->where('d_nasc','like','%'.$mes.'%')
        ->where('situacao_endereco','5')
        ->get();

        $i=1;
        $proxima_pg=8;
        $nome_mes=$fn->nomeMes($mes);
        $pdf::AddPage('P','A4');                  
        $pdf::SetFont('Times','B',11);   
        foreach($registros as $registro){            
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
                $pdf::MultiCell(95, 5,
                utf8_decode("Destinatário: ") .$registro->nome.
                " \nRua: ".$registro->rua.", ".$registro->numero.
                "\nBairro: ".$registro->bairro." CEP: ".$registro->cep.
                "\nCidade: ".$registro->cidade.$espaco.$pdf::Image(asset('imagens/mala_direta.png'),$x3,$y3,40,30,'PNG')." ", 1, 'L', FALSE);            
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
                    
                $pdf::MultiCell(95, 5,
                utf8_decode("Destinatário: ") .$registro->nome.
                " \nRua: ".$registro->rua.", ".$registro->numero.
                "\nBairro: ".$registro->bairro." CEP: ".$registro->cep.
                "\nCidade: ".$registro->cidade.$espaco.$pdf::Image(asset('imagens/mala_direta.png'),$x3,$y3,40,30,'PNG')." ", 1, 'L', FALSE);
            
                $x2=$pdf::GetX();
                $y2=$pdf::GetY();
            
            }            
            $i++;            
        }
        $pdf::Output();
    }




}
