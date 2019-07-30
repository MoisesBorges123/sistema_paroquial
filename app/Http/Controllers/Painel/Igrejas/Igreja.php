<?php

namespace App\Http\Controllers\Painel\Igrejas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Igrejas\Igrejas;
use Illuminate\Support\Facades\DB;
class Igreja extends Controller
{
 private $igrejas;
    public function __construct(Igrejas $church) {
        $this->igrejas = $church;
    }
    public function index(){
        return  view('painel/igreja/table-igrejas');
    }
    public function busca(Request $request){
        $search_for = $request->input('igreja');
        $dadosIgreja=DB::table('igrejas')
                ->join('enderecos', 'enderecos.id_endereco', '=', 'igrejas.endereco')
                ->join('logradouros', 'logradouros.id_logradouro', '=', 'enderecos.logradouro')                
                ->when($search_for,function($query,$search_for){
                    return $query->where('igrejas.nome','like',$search_for.'%');
                })
                ->orderBy('igrejas.nome','asc')
                ->get();
        if(count($dadosIgreja)>0){
            foreach($dadosIgreja as $dado){
                
            }
        }
    }
}
