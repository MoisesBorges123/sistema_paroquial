<?php

namespace App\Models\Painel\Perfil;

use Illuminate\Database\Eloquent\Model;

class PerfilUser extends Model
{
    //
    protected $table = 'perifs_usuarios';
    protected $primaryKey = "id_perfil";
    protected $fillable = ['nome','menu'];
     
    public $timestamps=false;
    public $rules =[
      'nome'=>'required',   
      
    ];
}
