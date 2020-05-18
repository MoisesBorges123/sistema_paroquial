<?php

namespace App\Models\Painel\Configuracoes;

use Illuminate\Database\Eloquent\Model;

class TipoCartas extends Model
{
    
    protected $primaryKey = "id_tipo_carta";
    protected $table = "tipos_carta";
    protected  $fillable = [                          
                           
                            'tipo'
                        ];
    public  $timestamps =false;
}
