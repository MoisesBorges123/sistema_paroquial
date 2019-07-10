<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Relacao_Batizados_Paginas extends Model
{
    protected  $table ="registros_batismo_pagina";
        protected  $fillable=[
                                'pagina',
                                'registro_batismo',
                                
                            ];
}
