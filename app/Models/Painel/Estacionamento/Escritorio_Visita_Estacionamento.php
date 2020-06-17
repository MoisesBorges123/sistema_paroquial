<?php

namespace App\Models\Painel\Estacionamento;

use Illuminate\Database\Eloquent\Model;

class Escritorio_Visita_Estacionamento extends Model
{
    //
    protected $table = 'escritorio_visita_estacioanamento';
    protected $primaryKey = "id_visita";
    protected $fillable = [
        'token',         
        'usuario',
        'tempo_token',
        'ativada'
    ];
    
   public $timestamps=true;
}
