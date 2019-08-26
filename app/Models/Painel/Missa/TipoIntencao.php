<?php

namespace App\Models\Painel\Missa;

use Illuminate\Database\Eloquent\Model;

class TipoIntencao extends Model
{
    //
    protected $primaryKey = "id_tipo";
    protected $table = "tipos_intencao";
    protected  $fillable = [                            
                            'nome',
                            'descricao',
                            'linhas_a_mais',
                            'situacao'
                        ];
    public  $timestamps =false;
}
