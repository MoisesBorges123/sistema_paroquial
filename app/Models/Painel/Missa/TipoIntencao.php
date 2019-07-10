<?php

namespace App\Models\Painel\Missa;

use Illuminate\Database\Eloquent\Model;

class TipoIntencao extends Model
{
    //
    protected $table = "tipos_intencoes";
    protected  $fillable = [                            
                            'tipo',
                            'linhas',
                            'descricao'
                        ];
    public  $timestamps =false;
}
