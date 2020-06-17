<?php

namespace App\Models\Painel\Pessoa;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    //
    protected $table = 'pessoas';
    protected $primaryKey = "id_pessoa";
    protected $fillable = ['nome','endereco','d_nasc','email','sexo'];
     
    public $timestamps=false;
    public $rules =[
      'nome'=>'required|min:2|max:100',
      'endreco'=>'numeric',
      'email'=>'email'
    ];
}
