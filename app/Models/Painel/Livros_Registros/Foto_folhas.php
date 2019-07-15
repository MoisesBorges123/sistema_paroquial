<?php

namespace App\Models\Painel\Livros_Registros;

use Illuminate\Database\Eloquent\Model;

class Foto_folhas extends Model
{
   protected $table = "fotos_folhas";
    protected $primaryKey = "id_foto";
    protected $fillable = [
      
        'observacao',
        'foto',
        'tamanho',
        'caminho',
        'folha'
    ];
    public $timestamps=false;
    
    public $rules = [
        'observacao' =>'max:500',
        'foto' =>'required',                        
        'folha' =>'required'      
        
    ];
}
