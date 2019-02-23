<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model
{
    protected $table = 'anamneses';
    
    public function responsavel_fk(){
        return $this->belongsTo('App\Cadastro', 'responsavel');
    }
}
