<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Base_Precos extends Model
{
    //
    protected $table = 'base_de_precos_estacionamento';
     protected $primaryKey = "id_base_preco";
     protected $fillable = [
         'data',
         'descricao'
     ];
     
    public $timestamps=false;
}
