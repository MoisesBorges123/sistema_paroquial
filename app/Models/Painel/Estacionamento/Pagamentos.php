<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    //
    protected $table = 'pagamentos_estacionamento';
    protected $primaryKey = "id_pagamento";
    protected $fillable = [
        'valor',         
        'desconto',
        'justificar_desconto',
        'base_calculo',
        'pago',
        'modalidade'
        
    ];
    
   public $timestamps=false;
}
