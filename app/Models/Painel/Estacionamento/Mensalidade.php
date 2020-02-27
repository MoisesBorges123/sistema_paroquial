<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    //
    protected $table = 'mensalidade_carro';
     protected $primaryKey = "id_mensalidade";
     protected $fillable = [
         'data_inicio',
         'data_pagamento',
         'data_termino',
         'desconto',
         'justificar_desconto',
         'situacao',
         'valor'
     ];
     
    public $timestamps=false;
}
