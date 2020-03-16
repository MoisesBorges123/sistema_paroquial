<?php

namespace App\Http\Controllers\Errors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Errors extends Controller
{
    //
    public function pagenotfound(){
        return view('painel.errors.404');
    }
    public function manutencao(){
        return view('painel.errors.manutencao');
    }
}
