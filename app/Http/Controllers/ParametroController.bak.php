<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Parametro;

class ParametroController extends Controller
{
    
    public function post(Request $request, $type){
        //dd($request->all());
        switch($request->submit){
            case 'insert': $this->insert($type,$request->parametro); break;
            case 'save': $this->save($type,$request->parametro, $request->data); break;
            case 'delete': $this->delete($type, $request->parametro); break;
            default: return 'SLI => ParametroController@post(switch)'; break;
        }
    }
    
    public function insert($type, $exame){
        if(preg_match("/[A-z]{3,12}/i",$exame)){
            $result = 0;
            for($i=-2;$i<=5;$i++){
                $parametro = new Parametro;
                $parametro->id_usuario = Auth::user()->id;
                $parametro->exame = $exame;
                $parametro->quantificador = $i;
                $parametro->lf = 'Personalizar';
                $parametro->type = $type;
                $result += $parametro->save();
            }
            if($result==8){
                return redirect('params/'.$type); // TODO -> REDIRECT WITH MESSAGE
            }
        }else{
            echo "Null 'exame'";
        }
    }
    
    public function save($type, $exame, $data){
        $i = -2; $flag = 0; $result = 0;
        foreach($data as $lf){
            $parametro = Parametro::where(['quantificador'=>$i,'type'=>$type,'id_usuario'=>Auth::user()->id,'exame'=>$exame])->first();
            if($lf != $parametro->lf){
                $flag++;
                echo "$parametro->id($i) => <font color='red'>{$parametro->lf}</font> <font color='green'>$lf</font><br>";
                $parametro->lf = $lf;
                $result += $parametro->save();
            }else{
                echo "$parametro->id($i) => {$parametro->lf}<br>";
            }
            $i++;
        }
        echo $result;
        echo $flag;
        if($result==$flag){
           return redirect('params/'.$type); // TODO -> REDIRECT WITH MESSAGE
        }
    }
    
    public function delete($type, $exame){
        $parametros = Parametro::where(['type'=>$type,'id_usuario'=>Auth::user()->id,'exame'=>$exame])->pluck('id');
        $result = Parametro::destroy($parametros);
        if($result==8){
            return redirect('params/'.$type); // TODO -> REDIRECT WITH MESSAGE
        }
    }
    
}
