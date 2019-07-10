<?php

namespace App\Models\Painel\Livros_Registros;

use Illuminate\Database\Eloquent\Model;

class Sacramentos extends Model
{
    //
    protected $table = "sacramentos";
    protected $filable = [
        'nome',
        'descricao'
    ];
    public $timestamps=false;
}
