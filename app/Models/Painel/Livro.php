<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table="livros_registros";
    protected $fillable = ['numero','observacao','tipo'];    
    
}
