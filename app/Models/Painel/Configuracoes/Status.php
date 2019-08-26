<?php

namespace App\Models\Painel\Configuracoes;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $primaryKey = "id_situacao";
    protected $table = "situacoes";
    protected  $fillable = [                            
                            'id_situacao',
                            'descricao'
                        ];
    public  $timestamps =false;
}
