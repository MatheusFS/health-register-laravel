@extends('essentials/nav/master')

@section('content')

@foreach($user->cadastro->toArray() as $column=>$value)
<input type='text' class='form-control' name='{{$column}}' placeholder='{{$column}}' value='{{$value}}'>
@endforeach

@endsection