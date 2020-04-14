<?php

namespace App\Http\Controllers\Painel\Pessoa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Painel\Enderecos\Endereco;
use App\Http\Controllers\Funcoes\FuncoesAdicionais;
use App\Models\Painel\Telefone\Telefones;
use App\Models\Painel\Pessoa\Pessoas;
class Pessoa extends Controller
{
    //
    private $pessoa;
    private $telefone;
    public function __construct(){
        $this->pessoa =  new Pessoas;
        $this->telefone = new Telefones;
    }
    public function getpeople($pessoa){
        if($pessoa){
            if(is_numeric($pessoa)){
                $dadosPessoa = DB::table('registros_pessoas')->where('id_pessoa',$pessoa)->first();
            }else{
                $dadosPessoa = DB::table('registros_pessoas')->where('nome',$pessoa)->first();
            }
            return $dadosPessoa;
        }else{
            return false;
        }
    }
    public function list(){
        $pessoa = DB::table('v_pessoas')->get();
        $total_pessoas = count($pessoa);
        return array('pessoas'=>$pessoa,'total_pessoas'=>$total_pessoas);
        
    }//LOAD ALL PEOPLE IN THE SYSTEM 
    public function salvar_pessoa(Request $request){        
        $fn = new FuncoesAdicionais;
        $nome= !empty($request->input('nome')) ? $fn->tratarNomesProprios($request->input('nome')) : null;
        $endereco= !empty ($request->input('endereco')) ? $request->input('endereco') : null;
        $d_nasc= !empty ($request->input('d_nasc')) ? $request->input('d_nasc') : null;
        $email= !empty ($request->input('email')) ? $request->input('email') : null;
        $sexo= !empty ($request->input('sexo')) ? $request->input('sexo') : null;
        $observacoes_pessoa= !empty ($request->input('observacoes_pessoa')) ? $request->input('observacoes_pessoa') : null;
        $telefone= !empty ($request->input('telefone')) ? $request->input('telefone') : null;       
        if($endereco==null){
            $tentativa_salvar_endereco = $this->salvar_endereco($request);
        }
        $endereco = $tentativa_salvar_endereco==false ? null : $tentativa_salvar_endereco;
        $pessoa = array(
            'nome'=>$nome,
            'endereco'=>$endereco,
            'd_nasc'=>$d_nasc,
            'email'=>$email,
            'sexo'=>$sexo,
            'observacoes_pessoa'=>$observacoes_pessoa
        );
        $insert = $this->pessoa->create($pessoa);

        if($telefone!=null){
            $tentativa_salvar_telefone = $this->salvar_telefone($request,$insert->id_pessoa);
            $telefone = $tentativa_salvar_telefone==false ? null : $tentativa_salvar_telefone;
        }
        return array('insert_pessoa'=>$insert,'insert_telefone'=>$telefone,'insert_endereco'=>$endereco);
    }//SAVE A PEOPLE
    public function atualizar_telefone(Request $request){        
        if(!empty($request->input('telefone')) && !empty($request->input('pessoa'))){
            $telefone =  $request->input('telefone');
            $pessoa =  $request->input('pessoa');
            $dados= array('telefone'=>$telefone,'pessoa'=>$pessoa);
            $update_telefone = $this->update_telefone($dados);
        }else{
            return false;
        }
    }    
    private function salvar_telefone(Request $request,$pessoa){
        if(!empty($request->input('telefone'))){
            $telefone = $request->input('telefone');
            $obs = !empty($request->input('obs_telefone')) ? $request->input('obs_telefone') : null;            
            $dados = array(
                'obs'=>$obs,
                'numero'=>$telefone,
                'pessoa'=>$pessoa
            );            
           $insert= $this->telefone->create($dados);
           return $insert;
        }else{
            return false;
        }
    }
    private function salvar_endereco(Request $request){
        if(!empty($request->input('rua')||!empty($request->input('cep')))){
            $endereco = new Endereco;
           $id_endereco= $endereco->salvar_endereco($request);
           return $id_endereco;
        }else{
            return false;
        }
    }
    public function atualizar_email(Request $request){        
        if(!empty($request->input('email')) && !empty($request->input('pessoa'))){
            $email =  $request->input('email');
            $pessoa =  $request->input('pessoa');
            $dados= array('email'=>$email,'pessoa'=>$pessoa);
            $update_email = $this->update_email($dados);
        }else{
            return false;
        }
    }    
    private function update_telefone($dados){
        extract($dados);        
        $fone=$this->telefone->where('pessoa',$pessoa)->first();
        $obs = !empty($obs) ? $obs:$fone->obs;
        $numero = !empty($numero) ? $numero:$fone->numero;
        $newPhone = array(
            'numero'=>$numero,
            'obs'=>$obs,
        );
        $update=$fone->update($newPhone);
        return $update;

    }
    private function update_email($dados){
        extract($dados);        
        $pessoa=$this->pessoa->find($pessoa);
        $email = !empty($email) ? $email:$pessoa->email;
        
        $newEmail = array(
            'email'=>$email,            
        );
        $update=$fone->update($newEmail);
        return $update;

    }
}
