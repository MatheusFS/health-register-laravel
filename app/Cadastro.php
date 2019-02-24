<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    protected $icon = 'user';
    
    public function theme($prop){
        switch($this->funcao){
            case 'empresa': $this->color = 'success'; $this->icon = 'building'; break;
            case 'profissional': $this->color = 'dark'; $this->icon = 'user-md'; break;
            case 'administrativo': $this->color = 'warning'; $this->icon = 'edit'; break;
            case 'estagiario': $this->color = 'info'; $this->icon = 'clock'; break;
            case 'paciente': $this->color = 'primary'; $this->icon = 'user-injured'; break;
        }
        switch($prop){
            case 'color': return $this->color;
            case 'icon': return $this->icon;
            default: return 'SLI';
        }
        
    }
    
    public function enderecos(){
        return $this->hasMany('App\Enderecos','id_usuario');
    }
}
