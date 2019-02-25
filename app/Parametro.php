<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Parametro extends Model
{
    public static function modelo(){
        $result = DB::table('modelo_excf')->get();
        return json_decode(json_encode($result), true);
    }
}
