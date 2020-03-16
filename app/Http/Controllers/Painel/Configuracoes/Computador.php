<?php

namespace App\Http\Controllers\Painel\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Computadores\Computadores;
use App\Models\Painel\Configuracoes\Status;

class Computador extends Controller
{
    //
    private $computador;
    private $situacoes;
    public function __construct(Computadores $computers, Status $status) {
        $this->computador =$computers;
        $this->situacoes = $status;
    }
    public function index(){
        $tituloPagina="Configurações-Dispositivos";
        $page_header="Meus Dispositivos";
        
        $query = $this->computador->all();
        //$query = null;
        
        $descricao_page_header=null;
        return view('painel.configuracoes.computadores.tbl-computadores',compact('tituloPagina','page_header','descricao_page_header','query'));
    }
    public function carregaTable(){
         $query = $this->computador->all();
         $linhas='';
         $num_registros = count($query);
         if($num_registros>0){
             
             foreach($query as $q){
                 $linhas.="<tr><td>".$q->ip."</td>"
                         ."<td>".$q->nome."</td>"
                         ."<td>".$q->sistema_operacioanl."</td>"
                         ."<td>".$q->mac."</td>"
                         ."<td>".$q->tipo."</td>"
                         ."<td>".$q->marca."</td>"
                         ."<td>".$q->descricao."</td>"
                         ."<td>"
                         . "<div class='icon-btn'>"
                         . "<button data-id='".$q->id_computador."' class='btn btn-info btn-editar'><i class='icofont icofont-pencil-alt-5'></i></button>"
                         . "<button data-id='".$q->id_computador."' class='btn btn-danger btn-excluir'><i class='icofont icofont-trash'></i></button>"
                         . "</div>"
                         . "</td></tr>";
             }
             $table=$linhas;
         }else{
             $table="<div class='alert'>"
                     . "<div class='alert-default'><h5>Não há nenhum dispositovo cadastrado</h5></div>"
                     . "</div>";
         }
         return $resposta = array(
             'table'=>$table,
             'num_registros'=>$num_registros
         );
         
    }
}



