<?php

namespace App\Models\Painel\Enderecos;

use Illuminate\Database\Eloquent\Model;

class Logradouros extends Model
{
    //
    protected  $table ="logradouros";
    protected $primaryKey ="id_logradouro";
    protected $fillable=[
        'rua',
        'bairro',
        'cep',
        'cidade',
        'estado'
    ];
    public $timestamps = false;
    public $rules = [
        'rua'=>'required|min:5',
        'bairro'=>'required|min:2',
        'cep'=>'min:9|max:9',
        'cidade'=>'required|min:2',
        'estado'=>'required'
        
    ];
}
