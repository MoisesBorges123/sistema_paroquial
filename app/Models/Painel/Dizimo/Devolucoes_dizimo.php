<?php

namespace App\Models\Painel\Dizimo;

use Illuminate\Database\Eloquent\Model;

class Devolucoes_dizimo extends Model
{
    //
   protected $table="devolucoes";
    
    protected $primaryKey = "id_devolucao";
    protected $fillable = [  
        
        'dizimista',
        'data_dev',        
        'valor',
        'ano_ref',
        'mes_ref',
        'local_dev'
    ];
    public $timestamps=true;
    
    public $rules =[  
        'dizimista'=>'required|numeric',
        'data_dev'=>'required|date',
        'valor'=>'required|numeric',
        'ano_ref'=>'required|numeric',
        'mes_ref'=>'required'
        
    ];

    
}
