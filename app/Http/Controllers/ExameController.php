<?php

namespace App\Http\Controllers;

use App\Exame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExameController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $exames = Exame::where('user_id', Auth::id())->get();
        foreach ($exames as $exame) {
            $modelViews[] = $this->show($exame);
        }
        return view('Exame.index')->with('exames', $modelViews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exame  $exame
     * @return \Illuminate\Http\Response
     */
    public function show(Exame $exame) {

        return view('Exame.show')->with('exame', $exame);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exame  $exame
     * @return \Illuminate\Http\Response
     */
    public function edit(Exame $exame) {

        return view('Exame.edit')->with('exame', $exame);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exame  $exame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exame $exame)
    {
        return view('Exame.update')->with('request', $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exame  $exame
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exame $exame)
    {
        return view('Exame.destroy')->with('exame', $exame);
    }
}
