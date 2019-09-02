<?php

namespace App\Http\Controllers\Painel\Missa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use App\Models\Painel\Missa\Intencao;
use App\Models\Painel\Missa\TipoIntencao;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Facades\Fpdf;
class Intenção extends Controller
{
    //
    private $intentions;
    private $tipo_intencao;
    public function __construct(Intencao $intentions, TipoIntencao $typeIntentions){
        $this->intentions=$intentions;
        $this->tipo_intencao = $typeIntentions;
        date_default_timezone_set('America/Sao_Paulo');
       setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }
    public function  index(){
         
        $data=date('Y-m-d',time());
        $query=DB::table('intencao')
                ->join('tipos_intencao','intencao.tipo','=','tipos_intencao.id_tipo')
                ->where('intencao.data_inicio','<=',$data)
                ->where('intencao.data_fim','>=',$data)         
                ->select('intencao.solicitante as solicitante','intencao.intencao as nome','intencao.horario as missa','intencao.telefone as telefone','intencao.id_intencao','tipos_intencao.nome as intencao')
                ->get();
       $data = ucfirst(strftime('%A, %d de %B de %Y',strtotime($data)));
        $tituloPagina="Intenção de Missa";
        $page_header="Minhas Inteções";
        $descricao_page_header="";
        return view('painel\missas\intencoes\tbl-intencao',compact('tituloPagina','page_header','descricao_page_header','query','data'));
    }
    public function insert(Request $request, FuncoesAdicionais $fn){
        $dadosForm = $request->except('_token');
        if(empty($dadosForm['data_fim'])){
            $dadosForm['data_fim'] = $dadosForm['data_inicio'];
        }
        $validacao1 = validator($dadosForm, $this->intentions->rules);
        if($validacao1->fails()){
             return redirect()->back()->withErrors($validacao1)->withInput();
        }else{
            
            $valores=[];
            $valores[]=['value'=>$request->input('intencao'),'type'=>8,'variavel'=>'inteção'];
            $valores[]=['value'=>$request->input('data_inicio'),'type'=>8,'variavel'=>'data'];
            $valores[]=['value'=>$request->input('horario'),'type'=>8,'variavel'=>'horário'];
            $valores[]=['value'=>$request->input('tipo'),'type'=>1, 'variavel'=>'tipo de inteção'];            
            $valores[]=['value'=>$request->input('solicitante'),'type'=>8,'variavel'=>'solicitante'];            
            
           $validacao2=$fn->validacoes($valores);
           if($validacao2=='23'){
               
               $insert= $this->intentions->create($dadosForm);
               if($insert){
                   return redirect()->route('visualiza.Intencao');
               }else{
                   return redirect()->back()->with('erro','Erro inesperado.')->withInput();
               }
           }else{
               $mensagem=$fn->notificacao1($validacao2);
               return redirect()->back()->with('erro',$mensagem)->withInput();
           }
        }
    }
    public function update(Request $request, FuncoesAdicionais $fn,$id){
        $dadosForm = $request->except('_token');
        $validacao1 = validator($dadosForm, $this->intentions->rules);
        if($validacao1->fails()){
             return redirect()->back()->withErrors($validacao1)->withInput();
        }else{
            $valores=[];
            $valores[]=['value'=>$request->input('intencao'),'type'=>8,'variavel'=>'inteção'];
            $valores[]=['value'=>$request->input('data_inicio'),'type'=>8,'variavel'=>'data'];
            $valores[]=['value'=>$request->input('horario'),'type'=>8,'variavel'=>'horário'];
            $valores[]=['value'=>$request->input('tipo'),'type'=>1, 'variavel'=>'tipo de inteção'];            
            $valores[]=['value'=>$request->input('solicitante'),'type'=>8,'variavel'=>'solicitante'];            
            
           $validacao2=$fn->validacoes($valores);
           if($validacao2=='23'){
               $dadosDB=$this->intentions->find($id);
               $update= $dadosDB->update($dadosForm);
               if($update){
                   return redirect()->route('visualiza.Intencao');
               }else{
                   return redirect()->back()->with('erro','Erro inesperado.')->withInput();
               }
           }else{
               $mensagem=$fn->notificacao1($validacao2);
               return redirect()->back()->with('erro',$mensagem)->withInput();
           }
        }
    }
    public function delete(Request $request){       
        
     $delete = $this->intentions->find($request->input('cod'))->delete(); 
  
      return array('resultado'=>$delete);
    }    
    public function search(Request $request){
        $pagina=$request->input('posicao');
        
        if($pagina>=0){            
            $data=date('Y-m-d',strtotime("+$pagina days"));            
        }else{
            $pagina*=-1;
            $data=date('Y-m-d',strtotime("-$pagina days"));            
        }
            $dados=$this->intentions->all()
                    ->where('data_inicio','<=',$data)
                    ->where('data_fim','>=',$data)
                    ->sortBy('horario');            
        
        if(count($dados->all())>0){
            ob_start();
            echo" <thead>
                            <tr >
                           
                                <th>Nome</th>
                                <th >Intenção</th>
                                <th >Missa</th>
                                <th>Solicitante</th>                                
                                <th>Telefone</th>                                
                                <th class=\"text-center\">Ações</th>                                
                            </tr>
                        </thead>
                    <tbody>";
            foreach($dados->all() as $dado){
                $intencao = $this->tipo_intencao->find($dado->tipo);
                echo"
                    
                    <tr>                               
                    <td>".$dado->intencao."</td>
                    <td>".$intencao->nome."</td>
                    <td>".$dado->horario."</td>
                    <td>".$dado->solicitante."</td>
                    <td>".$dado->telefone."</td>
                    <td class='text-center'>
                        <a href=".route("Editar.Intencao",$dado->id_intencao)." class=\"icon-btn\">
                            <button class=\"btn btn-info btn-icon alert-success-cancel\" >
                                <i class=\"icofont icofont-refresh\"></i>
                            </button>
                        </a>                                            
                        <span class=\"icon-btn\">                                           
                            <button class=\"btn btn-danger btn-icon excluir\"  data-cod=".$dado->id_intencao." >
                                <i class=\"icofont icofont-trash\"></i>
                            </button>                                                                                                                       
                        </span>
                    </td>
                </tr>
                ";
            }
            echo"</tbody>";
            $html = ob_get_clean();
        }else{
            ob_start();
            echo"<div class=\"alert\">
                            <div class=\"alert-default\">
                                <h5 class=\"text-inverse\">Você não possui nenhuma intenção cadastrada.</h5>
                            </div>
                        </div>";
            $html = ob_get_clean();
        }
        $data = ucfirst(strftime('%A, %d de %B de %Y',strtotime($data)));
        return array('html'=>$html,'date'=>$data,'pagina'=>$pagina);
    }
    public function printer(Request $request, Fpdf $pdf){
        $data = ucfirst(strftime('%A, %d de %B de %Y',strtotime($request->input('data'))));
        $horario = $request->input('horario');
        $tipo_de_intencoes = $this->tipo_intencao->all()->where('situacao','=','1')->sortBy('nome');
       $pdf = new Fpdf();       
        $pdf::AddPage();
        $pdf::SetFont("Arial","B",18);
        $pdf::Cell(190,20,utf8_decode("Paróquia Catedral Imaculada Conceição"),0,1,"C");
        $pdf::SetFont("Arial","B",12);
        $pdf::Cell(190,5,utf8_decode("Inteções $data"),0,1,"C");
        $pdf::Ln(10);
        $pdf::Cell(190,5,utf8_decode("Celebração das $horario"),0,1,"L");
        $pdf::Ln(15);
        foreach ($tipo_de_intencoes as $tipo){
            $intencoes = $this->intentions->all()
                    ->where('tipo','=',$tipo->id_tipo)
                    ->where('horario','=',$horario)
                    ->where('data_inicio','<=',$request->input('data'))
                    ->where('data_fim','>=',$request->input('data'))
                    ->sortBy('intencao');
            if($tipo->linhas_a_mais>0 || count($intencoes)>0){
                $pdf::SetFont("Arial","B",12);
                $pdf::Cell(190,5, utf8_decode($tipo->nome),0,1,"L");
                $pdf::Ln(5);
                $pdf::SetFont("Arial","",12);                
                if(count($intencoes)>0){
                    foreach ($intencoes as $intencao){                
                        $pdf::Cell(50,5,'',0,1,"L");
                        $pdf::Cell(190,5, utf8_decode($intencao->intencao),0,1,"L");  
                        $pdf::Ln(8);

                    }                    
                }
                if($tipo->linhas_a_mais>0){
                    for($i=0;$i<$tipo->linhas_a_mais;$i++){
                        $pdf::Cell(190,1,'','T',1,"L");                
                        $pdf::Ln(8);                    
                    }
                }
            }
            $pdf::Ln(10);
        }
        
        $pdf::Output();
        exit;
 

    }
    
    public function cadastro(){
        $tipos=$this->tipo_intencao->all()->where('situacao','=','1');
        $tituloPagina="Nova Intenção";
        $page_header="Nova Intenção";
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\missas\intencoes\form-cadastro-intencao',compact('tituloPagina','page_header','descricao_page_header','tipos'));
    }
    public function  editar($id){
        $tipos=$this->tipo_intencao->all()->where('situacao','=','1');
        $intencao = $this->intentions->find($id);
        $page_header="Editar Intenção: ".$intencao->intencao;
        $tituloPagina="Editar Intenção";
        $descricao_page_header="Os campos com * são de preenchimento obrigatório.";
        return view('painel\missas\intencoes\form-cadastro-intencao',compact('tituloPagina','page_header','descricao_page_header','tipos','intencao'));
    }
    
}
