<?php

namespace App\Models\Painel\Igrejas;

use Illuminate\Database\Eloquent\Model;

class Igreja extends Model
{
    protected $table = "igrejas";
    protected $primaryKey = "id_igreja";
    protected $fillable = [      
        
        'nome',
        'endereco',
    ];
    public $timestamps=false;
    public $rules = [
        'nome' =>'required|max:200|min:11',        
        'endereco'=>'required'
        
    ];
}
