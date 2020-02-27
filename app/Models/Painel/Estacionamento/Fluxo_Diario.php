<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Fluxo_Diario extends Model
{
    //
    
     protected $table = 'fluxo_diario';
     protected $primaryKey = "id_fluxo";
     protected $fillable = [
         'carro',
         'hora_entrada',
         'min_entrada',
         'hora_saida',
         'min_saida',
         'valor',
         'situacao',
         'modalidade',
         'desconto',
         'justificar_desconto',
         'pago'
     ];
     
    public $timestamps=false;
    
}
