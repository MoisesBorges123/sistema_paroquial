<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Batizados extends Model
{
        protected  $table ="registros_batismos";
        protected  $fillable=[
                                'batizando',
                                'pai',
                                'mae',
                                'padrinho',
                                'madrinha',
                                'data_batrismo',
                                'data_nascimento'            
                            ];
}
