<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    //
    protected  $table="carro";
     
   protected $primaryKey = "id_carro";
     protected $fillable = ['modelo','placa','cor','pessoa','descricao','isencao','situacao'];
     
    public $timestamps=false;
    public $rules =[
      'placa'=>'required|min:2|max:10',
      'isencao'=>'required',
      
    ];
}
