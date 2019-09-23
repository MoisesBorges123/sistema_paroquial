<?php

namespace App\Models\Painel\Telefone;

use Illuminate\Database\Eloquent\Model;

class Telefones extends Model
{
    //
    protected $table="telefones";
    protected $primaryKey="id_telefone";
    protected $fillable=['dd','numero','pessoa'];
    public  $rules=[
        'dd'=>'max:2|min:2',
        'numero'=>'required|min:5|maz:15',
        'pessoa'=>'required|numeric'
        
    ];
    public $timestamps=false;
}
