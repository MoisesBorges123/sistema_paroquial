<?php

namespace App\Models\Painel\Missa;

use Illuminate\Database\Eloquent\Model;

class Intencao extends Model
{
    //
    protected $table = "intencao";
    protected $primaryKey = "id_intencao";
    public $timestamps=true;
    protected  $fillable=[
                        'intencao',
                        'data_inicio',
                        'data_fim',
                        'horario',
                        'tipo',                    
                        'solicitante',
                        'marcado_por',
                        'telefone'
                        ];
    public $rules=[
                    'intencao'=>'required|min:3|max:50',
                    'data_inicio'=>'required',
                    'horario'=>'required|min:4|max:6',
                    'tipo'=>'required|numeric',                    
                    'solicitante'=>'required|string|min:3',        
                    'telefone'=>'required|string|min:12'        
                   ];
    
}
