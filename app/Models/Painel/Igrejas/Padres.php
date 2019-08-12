<?php

namespace App\Models\Painel\Igrejas;

use Illuminate\Database\Eloquent\Model;

class Padres extends Model
{
    
    protected  $table="clero";
    protected $primaryKey = "id_clero";
     protected $fillable = ['pessoa','carro','titulo','observacao'];
   public $timestamps=false;
}
