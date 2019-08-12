<?php

namespace App\Models\Painel\Registros;

use Illuminate\Database\Eloquent\Model;

class Batizando extends Model
{
    //
     protected $table = 'batizando';
     protected $primaryKey = "id_batizando";
     protected $fillable = ['nome','pai','mae','data_nasc','padrinho','madrinha','sexo'];
     
    public $timestamps=false;
}
