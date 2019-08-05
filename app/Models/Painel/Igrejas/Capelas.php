<?php

namespace App\Models\Painel\Igrejas;

use Illuminate\Database\Eloquent\Model;

class Capelas extends Model
{
     //
    protected $table = "capelas";
    protected $primaryKey = "id_capela";
    protected $fillable = [      
        
        'nome',
        'criada_em',
        'fim',
        'igreja'
    ];
    public $timestamps=false;
   
}
