<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Escritorio_Visita_Estacionamento extends Model
{
    //
    protected $table = 'escritorio_visita_estacionamento';
    protected $primaryKey = "id_fluxo";
    protected $fillable = [
        'token',         
        'usuario'
    ];
    
   public $timestamps=false;
}
