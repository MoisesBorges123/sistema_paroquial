<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    //
    protected  $table="veiculos";
     
   protected $primaryKey = "id_veiculo";
     protected $fillable = ['modelo','placa','cor','pessoa','descricao','isencao','situacao','tipo'];
     
    public $timestamps=false;
    public $rules =[
      'placa'=>'required|min:2|max:10',
      'isencao'=>'required',
      
    ];
}
