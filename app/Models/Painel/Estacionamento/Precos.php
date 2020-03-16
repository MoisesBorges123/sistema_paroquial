<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Precos extends Model
{
    //
    protected $table = 'precos_estacionamento';
     protected $primaryKey = "id_preco";
     protected $fillable = [
         'base',
         'computador',
         'descricao',
         'preco',
         'usuario',
         'tipo_veiculo'
     ];
     
    public $timestamps=true;
}
