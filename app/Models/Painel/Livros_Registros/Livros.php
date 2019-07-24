<?php

namespace App\Models\Painel\Livros_Registros;

use Illuminate\Database\Eloquent\Model;

class Livros extends Model
{
    protected $table = "livros";
    protected $primaryKey = "id_livro";
    protected $fillable = [
      
        'numeracao',
        'data_inicio',
        'data_fim',
        'descricao',
        'quant_paginas',
        'sacramento',
        'igreja'
    ];
    public $timestamps=false;
    public $rules = [
        'numeracao' =>'required|min:1|numeric',
        'data_inicio' =>'required',
        'data_fim' =>'required',
        'descricao' =>'max:500',
        'quant_paginas' =>'numeric',
        'sacramento' =>'numeric',
        'igreja' =>'numeric',
        
    ];
}
