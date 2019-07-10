<?php

namespace App\Http\Controllers\Painel\Livros;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Livro;
use App\Models\Painel\TipoLivros;
use Illuminate\Support\Facades\DB;
class LivrosRegistros extends Controller
{
    private $livros;
    private $tipolivro;
    public function __construct(Livro $book, TipoLivros $typebook) {
        $this->livros=$book;
        $this->tipolivro=$typebook;
    }
    
    public function  index(){
        $tituloPagina = "Meus Livros";
        $page_header = "Livros Catedral";
        $descricao_page_header = "Página disponíveis apenas para administradores";
        //$dados=$this->livros->all();    
        
        $dados=DB::table('livros_registros')
                ->join('tipos_livros_registros','livros_registros.tipo','=','tipos_livros_registros.id_tipos_livros_reg')
                ->select('livros_registros.numero as livro','livros_registros.observacao as observacao',
                        'tipos_livros_registros.nome as categoria','livros_registros.id_livros_registros')
                ->orderByRaw('livros_registros.numero ASC')
                ->get();
       
        return view("painel/livros/table-livros",compact('tituloPagina','page_header','descricao_page_header','dados'));
        
    }
    public function form_cadastro(){
        $tituloPagina = "Novo Livro";
        $page_header = "Cadastrar Livro";
        $descricao_page_header = "Preencha o formulário abaixo para adicionar um novo livro.";
        $dados=$this->tipolivro->all();   
        return view("painel/livros/form-cadastro-livros",compact('tituloPagina','page_header','descricao_page_header','dados'));
    }
    

    public function salvar(Request $request){
        //Pega dados do formulario
         
        if(!empty($request)){
            $dadosForm=$request->all(); 
            $insert = $this->livros->create($dadosForm);

            if(!empty($insert)){
                /*
                 * Por enquanto vai redirecionar para o index, más de pois colocar para
                 * redirecionar para o cadastro de folhas                
                 */
                
                return redirect()->route('Visualizar.Livro');            
            }else{
                return redirect()->route('FormCadastro.Livro');                    
            }            
        }else{
            return redirect()->back();
        }
        
        
    }
    
}
