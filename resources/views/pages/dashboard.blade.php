@extends('essentials/nav')

@section('content')

<head>
  <style>
    .clickFilter{}
    .clickFilter:hover{background-color:#DDD;cursor:pointer}
    .d-flex-alt{display:inline-flex; padding: 5px}
  </style>
</head>

<div class="row p-2" style="font-size:20px">
  <div onclick="$('.pac,.pro,.emp,.adm,.est').show()" class="col-2 p-2 clickFilter text-center text-dark"><b><i class="fas fa-user mr-2"></i>1</b></div>
  <div onclick="$('.pro,.emp,.adm,.est').hide(); $('.pac').show()" class="col-2 p-2 clickFilter text-center text-primary"><i class="fas fa-user-injured mr-2"></i>1</div>
  <div onclick="$('.pac,.emp,.adm,.est').hide(); $('.pro').show()" class="col-2 p-2 clickFilter text-center text-dark"><i class="fas fa-user-md mr-2"></i>1</div>
  <div onclick="$('.pro,.pac,.adm,.est').hide(); $('.emp').show()" class="col-2 p-2 clickFilter text-center text-success"><i class="fas fa-building mr-2"></i>1</div>
  <div onclick="$('.pro,.emp,.pac,.est').hide(); $('.adm').show()" class="col-2 p-2 clickFilter text-center text-warning"><i class="fas fa-user-edit mr-2"></i>1</div>
  <div onclick="$('.pro,.emp,.adm,.pac').hide(); $('.est').show()" class="col-2 p-2 clickFilter text-center text-info"><i class="fas fa-user-clock mr-2"></i>1</div>
</div>

<ul class="collection" style="font-size:18px">

    <select class='form-control' name='action' onchange='this.form.submit()'>
        <option value='' disabled selected>Selecione...</option>
        <option value='a'>Realizar anamnese</option>
        <option value='e'>Realizar evolução</option>
        <option value='p'>Consultar prontuário</option>
        <option value='c'>Consultar/alterar cadastro</option>
    </select>

    <li name="nome1" class="collection-item"><div class="col-6 p-2"><i class="fas fa-building mr-2"></i>NOME1</div><div class="col-6"><form method="post"><input type="hidden" name="user" value="userid"></form></div></li>

    <li name="nome2" class="collection-item"><div class="col-6 p-2"><i class="fas fa-user-md mr-2"></i>NOME2</div><div class="col-6"><form method="post"><input type="hidden" name="user" value="userid"></form></div></li>
    
    <li name="nome3" class="collection-item"><div class="col-6 p-2"><i class="fas fa-user-edit mr-2"></i>NOME3</div><div class="col-6"><form method="post"><input type="hidden" name="user" value="userid"></form></div></li>
    
    <li name="nome4" class="collection-item"><div class="col-6 p-2"><i class="fas fa-user-clock mr-2"></i>NOME4</div><div class="col-6"><form method="post"><input type="hidden" name="user" value="userid"></form></div></li>
    
    <li name="nome5" class="collection-item"><div class="col-6 p-2"><i class="fas fa-user-injured mr-2"></i>NOME5</div><div class="col-6"><form method="post"><input type="hidden" name="user" value="userid"></form></div></li>
    
    <li class="collection-item"><div class="col-6 p-2"><i class="fas fa-user-slash mr-2"></i>NOME</div><div class="col-6"><form method="post"><input type="hidden" name="user" value="userid"></form></div></li>
    
</ul>

@endsection