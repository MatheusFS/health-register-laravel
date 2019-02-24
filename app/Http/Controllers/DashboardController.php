<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; // Authentication Class
use App\User; // Model
use App\Anamnese; // Model
use App\Assoc;

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
        if(Auth::user()["cadastro"]["funcao"]!="profissional"){$avalizado = 0;}else{$avalizado = 1;}
        $paciente = User::find($paciente_id);
        switch($action){
            case 'new': return view('pages/anamnese/master',['paciente'=>$paciente, 'avalizado'=>$avalizado]);
            case 'see': return view('pages/anamnese/master')->with('anamnese',$anamnese);
            default: return view('pages/anamnese/master');  
        }
    }
    
    public function prontuario($user_id){
        $anamneses = Anamnese::where('paciente',$user_id)->get();
        //$evolucoes = Evolucao::all();
        return view('pages/prontuario')->with('anamneses', $anamneses); //->with('evolucoes', $evolucoes);
    }
}
