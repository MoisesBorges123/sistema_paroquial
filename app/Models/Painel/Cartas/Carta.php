<?php

namespace App\Models\Painel\Cartas;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    //
    protected $table="cartas";
    
    protected $primaryKey = "id_carta";
    protected $fillable = [  
        
        'cod_rastreio',               
        'cod_sistema',
        'tipo_carta',
        'situacao',
        'valor',
        'descricao',
        'destinatario'       
    ];
    public $timestamps=true;
    
}
