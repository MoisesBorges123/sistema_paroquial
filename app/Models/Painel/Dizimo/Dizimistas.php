<?php

namespace App\Models\Painel\Dizimo;

use Illuminate\Database\Eloquent\Model;

class Dizimistas extends Model
{
    //
    
    protected $table="dizimistas";
    
    protected $primaryKey = "id_dizimista";
    protected $fillable = [  
        
        'pessoa',
        'd_cadastro',        
        'situacao'        
    ];
    public $timestamps=false;
    
    
}
