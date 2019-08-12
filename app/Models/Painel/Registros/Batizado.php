<?php

namespace App\Models\Painel\Registros;

use Illuminate\Database\Eloquent\Model;

class Batizado extends Model
{
    //
     protected $table = 'barizado';
     protected $primaryKey = "id_batizado";
     protected $fillable = ['batizando','data_batismo','celebrante','local','folha','num_registro'];
     
    public $timestamps=false;
}
