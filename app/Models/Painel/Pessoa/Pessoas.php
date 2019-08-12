<?php

namespace App\Models\Painel\Pessoa;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    //
    protected $table = 'pessoas';
   protected $primaryKey = "id_pessoa";
     protected $fillable = ['nome','endereco','d_nasc','email','email','sexo'];
     
    public $timestamps=false;
}
