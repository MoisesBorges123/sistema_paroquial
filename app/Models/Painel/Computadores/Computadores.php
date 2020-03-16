<?php

namespace App\Models\Painel\Computadores;

use Illuminate\Database\Eloquent\Model;

class Computadores extends Model
{
    //
    protected $table="computadores";
    
    protected $primaryKey = "id_computador";
    protected $fillable = [  
        
        'ip',               
        'nome',
        'senha',
        'descricao',
        'mac',
        'sistema_operacional',
        'tipo',
        'marca'
    ];
    public $timestamps=false;
    
    /*
    public $rules =[  
        'ip'=>'required',               
        'nome'=>'',
        'senha',
        'descricao',
        'mac',
        'sistema_operacional',
        'tipo',
        'marca'        
        
        
    ];
    */
    
}
