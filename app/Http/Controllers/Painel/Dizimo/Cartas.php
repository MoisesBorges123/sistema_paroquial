<?php

namespace App\Http\Controllers\Painel\Dizimo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Dizimo\Q_meus_dizimistas;

class Cartas extends Controller
{
    //
    private $meus_dizimistas;
    public function __construct(Q_meus_dizimistas $my_dizimistas) {
        $this->meus_dizimistas = $my_dizimistas;
    }
    
    
    public function index(){
        $query=$this->meus_dizimistas->all();
        return view('painel.dizimo.cartas.tbl-dizimistas-aniversariantes',compact('query'));
    }
    
    public function search_anivesariantes(){
        
    }
}
