<?php

namespace App\Models\Painel\Enderecos;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    //
    
    protected  $table = "enderecos";
     protected $primaryKey = "id_endereco";
    protected $fillable = [      
        
        'logradouro',
        'num_casa',
        'apartamento',        
        'complemento',        
        'obeservacoes'        
    ];
    public $timestamps=false;
    
    public $rules =[
        'logradouro'=>'required',
        'num_casa'=>'required',
        'complemento'=>'min:5|max:5000',
        'observacoes'=>'min:10'
    ];
    
    /*
     *CAMPOS DO BANCO DE DADOS
     * id_endereco
     * logradouro
     * num_casa
     * apartamento
     * complemento
     * observacoes
     */
    
}
