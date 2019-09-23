<?php

namespace App\Models\Painel\Enderecos;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $table = "estado";
    protected $primaryKey="id_estado";
    protected $fillable = [
        'nome_estado',
        'sigla'
    ];
    public $timestamps = false;
    public $rules=[
        'nome_estado'=>'required|min:3',
        'sigla'=>'required|'
    ];
}
