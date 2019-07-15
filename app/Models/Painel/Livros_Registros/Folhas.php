<?php

namespace App\Models\Painel\Livros_Registros;

use Illuminate\Database\Eloquent\Model;

class Folhas extends Model
{
   protected $table = "folhas";
    protected $primaryKey = "id_folha";
    protected $fillable = [      
        'num_folha',
        'num_pagina',
        'livro',
        'observacao'        
    ];
    public $timestamps=false;
    public $rules = [
        'num_folha' =>'required|numeric',
        'livro' =>'required',        
        'observacao' =>'max:500'      
        
    ];
}
