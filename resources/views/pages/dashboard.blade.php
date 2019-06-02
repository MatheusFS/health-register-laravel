@extends('essentials/nav/master')

@section('title', 'Dashboard - Health Register')

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

<ul class="list-group" style="font-size:18px">

    @foreach ($childs as $child)
    
    <?php
    
    $cadastro = $child->cadastro;
    
    $selectAcoes = "<select class='form-control' id='{$child->cadastro->id}' onchange=\"window.location.pathname = this.value+'/'+this.id\"><option value='' disabled selected>Selecione...</option>";
    foreach(explode(",","A,B,C,D,E") as $permissao){
    switch($permissao){
      case "A": if($child->cadastro->funcao=="paciente"){$selectAcoes .= "<option value='anamnese/new'>Realizar anamnese</option>";} break;
      case "B": if($child->cadastro->funcao=="paciente"){$selectAcoes .= "<option value='evolucao'>Realizar evolução</option>";} break;
      case "C": if($child->cadastro->funcao=="paciente"){$selectAcoes .= "<option value='prontuario'>Consultar prontuário</option>";} break;
      case "D": $selectAcoes .= "<option value='dados-cadastro'>Consultar/alterar cadastro</option>"; break;
    }
    }
    $selectAcoes .= "</select>";
    
    ?>
    
    <li name="{{mb_strtolower($cadastro->nome)}}" class="list-group-item d-flex-alt el {{substr($cadastro->funcao,0,3)}} text-{{$cadastro->theme('color')}}">
        <div class="col-6 p-2"><i class="fas fa-{{$cadastro->theme('icon')}} mr-2"></i>{{$cadastro->nome}}</div>
        <div class="col-6">{!!$selectAcoes!!}</div>
    </li>
    
    @endforeach
    
</ul>

<script type="text/javascript">

  $("ul.components li[id^='nav']", window.parent.document).attr("class","");
  $("#navDashboard", window.parent.document).attr("class","active");
  
  $("#procurar", window.parent.document).keyup(function(){
    if($(this).val()===""){
      $(".nexist").remove();
      $(".foreign").css("display", "none");
      $(".el:not(.foreign)").css("display","flex");
    }else{
      $("[name^='"+$("#procurar", window.parent.document).val().toLowerCase()+"']").css("display", "flex");
      $(".el:not([name^='"+$("#procurar", window.parent.document).val().toLowerCase()+"'])").css("display", "none");
      if($("[name^='"+$("#procurar", window.parent.document).val().toLowerCase()+"']").length===0){
        var content = "<tr class='el nexist bg-danger text-white'><td colspan='3'>"+$("#procurar", window.parent.document).val()+"</td><td><button class='btn btn-light btn-block' onclick=\"cadastrar('"+$("#procurar", window.parent.document).val()+"')\">Cadastrar</button></td></tr>";
        SmartDashboard(content);
      }else{
        $(".nexist").remove();
      }
    }
  });
  
</script>

@endsection