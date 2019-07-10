<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class FolhaLivro extends Model
{
    protected  $table ="paginas_livros_registro";
    protected  $fillable=['livro','num_pagina','foto'];
}
