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
         'pagamento',
         'horario'
     ];
     
    public $timestamps=false;
    
}
