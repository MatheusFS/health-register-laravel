<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assoc extends Model
{
    protected $table = "associacoes";
    
    public function user(){
        return $this->belongsTo('App\User','child');
    }   
    
    public function cadastro(){
        return $this->belongsTo('App\Cadastro','child');
    }
}
