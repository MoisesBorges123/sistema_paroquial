<?php

namespace App\Models\Painel\Missa;

use Illuminate\Database\Eloquent\Model;

class Intencao extends Model
{
    //
    protected $table = "intencoes";
    protected  $fillable=[
                        'intencao',
                        'data_inicio',
                        'data_fim',
                        'horario',
                        'tipo',
                        'situacao',
                        'solicitado_por',
                        'marcado_por'
                        ];
    
}
