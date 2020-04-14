<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    //
    protected $table = 'horario_estacionamento';
    protected $primaryKey = "id_horario";
    protected $fillable = [
        'hora_entrada',         
        'hora_saida',
        'min_entrada',
        'min_saida',
        'data_entrada',
        'data_saida',
        'escritorio',
    ];
    
   public $timestamps=false;
}
