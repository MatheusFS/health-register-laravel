<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; // Authentication Class
use App\User; // Model
use App\Anamnese; // Model
use App\Evolucao; // Model
use App\Assoc;
use App\Parametro;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */    
    public function index()
    {
        $childs = Assoc::where('parent',Auth::user()->id)->get();
        return view('pages/dashboard')->with('childs', $childs);
    }
    
    public function anamnese($action, $paciente_id){
        $avalizado = (Auth::user()["cadastro"]["funcao"]!="profissional");
        $paciente = User::find($paciente_id);
        switch($action){
            case 'new': return view('pages/anamnese/master',['paciente'=>$paciente, 'avalizado'=>$avalizado]);
            case 'see': return view('pages/anamnese/master')->with('anamnese',$anamnese);
            default: abort(403, 'Ação não autorizada');
        }
    }
    
    public function evolucao($anamnese_id){
        $anamnese = Anamnese::where('paciente',$anamnese_id)->latest()->first();
        if($anamnese){
            $paciente = User::find($anamnese->paciente);
            return view('pages/evolucao/master',['anamnese'=>$anamnese,'paciente'=>$paciente]);
        }else{
            return view('pages/errors/general',['message'=>'Usuário sem anamnese, impossível realizar evolução.']);
        }
    }
    
    public function prontuario($user_id){
        $anamneses = Anamnese::where('paciente',$user_id)->get();
        $evolucoes = Evolucao::where('paciente',$user_id)->get();
        return view('pages/prontuario',['items'=>$anamneses->merge($evolucoes)]);
    }
    
    public function dados_cadastro($user_id){
        return view('pages/dados-cadastro',['user'=>User::find($user_id)]);
    }
    
    public function params($type){
        if($type<3){
            $parametros = Parametro::where(['id_usuario'=>Auth::user()->id, 'type'=>$type])->get();
            $modelo = Parametro::modelo();
            $exames = array();
            if(count($parametros)){
                foreach($parametros as $parametro){
                    $exames[$parametro['exame']][$parametro['quantificador']] = $parametro['lf'];
                }
            }
            return view('pages/params',['type'=>$type,'parametros'=>$parametros,'exames'=>$exames,'modelo'=>$modelo]);
        }else{
            abort(403, 'Ação não autorizada');
        }
        
    }
}
