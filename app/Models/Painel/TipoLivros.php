<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class TipoLivros extends Model
{
    //
    protected $table="tipos_livros_registros";
    protected $fillable = ['nome'];
    public $timestamps = false;
}
