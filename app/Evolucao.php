<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    protected $table = "evolucoes";
    
    public function cadastro_resp(){
        return $this->belongsTo('App\Cadastro', 'responsavel');
    }
    
    public function cadastro_pac(){
        return $this->belongsTo('App\Cadastro', 'paciente');
    }
}
