@extends('essentials/nav')

@section('title','Evolução ~ '.$paciente->cadastro->nome)

@section('content')
<pre>{{print_r($anamnese->toArray())}}</pre>
@endsection