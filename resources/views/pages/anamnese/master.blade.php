<?php

/*if(isset($_POST["data"])||!isset($_GET["id"])){
  $anam = $anamnese->getAnamnese($_POST["data"]);
  $user = $anamnese->getUser($anam["paciente"]);
  $pacienteId = $user["id"];
  $conta = $anamnese->getConta($anam["paciente"]);
  // Script helper
  $script = "<script type='text/javascript' defer>";
  $script .= "$('#models').html(\"<option id='uniqueModel' value='".str_replace("'","@",$anam["HC"])."' dm='".str_replace("'","@",$anam["doencas"])."' ce='".str_replace("'","@",$anam["CE"])."' cd='".str_replace("'","@",$anam["CD"])."' cp='".str_replace("'","@",$anam["CP"])."' selected disabled>Anamnese Proposta</option>\");";
  $script .= "listaModelos('uniqueModel', '');carregarPT(\"".$anam["PT"]."\");";
  $script .= "$('#submit').attr('onclick','avalizarAnamnese(".$anam["id"].",".$_POST["notif"].")');$('#submit').text('Avalizar anamnese');$('#submit').attr('class','btn btn-warning btn-block');";
  $script .= "setTimeout(()=>{usar('".$anam["endereco"]."')},1000);";
  if($anam["info_medico"]=="{'crm':'','med':'','mail':'','tel':''}"&&$anam["doencas"]=="{}"){$script.="$('#noDM').click();";}
  $script .= "</script>";
  
}*/

?>

@extends('essentials/nav/master')

@section('title','Anamnese ~ '.$paciente->cadastro->nome)

@section('content')

@include('pages.anamnese.partials.header')
<div class="main">
  <div id="controls"></div>
    <center>@include('pages.anamnese.partials.enderecos')</center>
		
		<!---------------------------------------------------------------------------------------------------->
		
		<?php
		
			if(0){ //$_SESSION["loggedAccount"]["cadastro"]["profissao"]=="med"
				include(getcwd()."/lib/modules/anamnese/hda.php");
				include(getcwd()."/lib/modules/anamnese/hpp.php");
				include(getcwd()."/lib/modules/anamnese/historia-familiar.php");
				include(getcwd()."/lib/modules/anamnese/ex-fisico.php");
				include(getcwd()."/lib/modules/anamnese/exs-laboriatoriais.php");
				include(getcwd()."/lib/modules/anamnese/diagnostico-nosologico.php");
				include(getcwd()."/lib/modules/anamnese/prescricao.php");
				include(getcwd()."/lib/modules/anamnese/procedimentos.php"); ?>
      <button id="submit" type="button" class="btn btn-success btn-lg btn-block" onclick="doAnamneseMed()">Realizar anamnese</button>
			<?php
      }else{ ?>
        <div id='accordion'>
          <div class='card'>
            <div class='card-header' id='headingOne'>
              <h5 class='mb-0'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                  Diagnóstico Médico
                </button>
                <label><input id="noDM" type="checkbox" onclick="disableDM(this)" autocomplete="off"> Não tem</label>
              </h5>
            </div>

            <div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/diagnostico-medico')</div>
            </div>
          </div>
          <div class='card'>
            <div class='card-header' id='headingTwo'>
              <h5 class='mb-0'>
                <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'>
                  História Clínica
                </button>
              </h5>
            </div>
            <div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/historia-clinica')</div>
            </div>
          </div>
          <div class='card'>
            <div class='card-header' id='headingThree'>
              <h5 class='mb-0'>
                <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapseThree' aria-expanded='false' aria-controls='collapseThree'>
                  Exame Clínico-Físico
                </button>
              </h5>
            </div>
            <div id='collapseThree' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/ex-clinico-fisico')</div>
            </div>
          </div>
          <div class='card'>
            <div class='card-header' id='heading4'>
              <h5 class='mb-0'>
                <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapse4' aria-expanded='false' aria-controls='collapseThree'>
                  Diagnóstico
                </button>
              </h5>
            </div>
            <div id='collapse4' class='collapse' aria-labelledby='heading4' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/diagnostico')</div>
            </div>
          </div>
          <div class='card'>
            <div class='card-header' id='heading5'>
              <h5 class='mb-0'>
                <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapse5' aria-expanded='false' aria-controls='collapseThree'>
                  Prognóstico
                </button>
              </h5>
            </div>
            <div id='collapse5' class='collapse' aria-labelledby='heading5' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/prognostico')</div>
            </div>
          </div>
          <div class='card'>
            <div class='card-header' id='heading6'>
              <h5 class='mb-0'>
                <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapse6' aria-expanded='false' aria-controls='collapseThree'>
                  Exames complementares
                </button>
              </h5>
            </div>
            <div id='collapse6' class='collapse' aria-labelledby='heading6' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/ex-complementar1')</div>
            </div>
          </div>
          @include('pages/anamnese/partials/fisio/salvar-modelo')
          <div class='card'>
            <div class='card-header' id='heading7'>
              <h5 class='mb-0'>
                <div class="form-row">
                  <div class="col">
                    <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapse7' aria-expanded='false' aria-controls='collapseThree'>
                      Plano Terapêutico
                    </button>
                  </div>
                  <div class="col">
                    <?php
                      $modelo = array();

                      echo "<select class='form-control' onchange=\"carregarPT(this.value)\">";
                      echo "<option value='' disabled selected>Selecione..</option>";
                      foreach($modelo as $v){
                        echo "<option value=\"".str_replace("\"","'",$v["scriptArray"])."\">".$v["nome"]."</option>";
                      }
                      echo "</select>";
                    ?>
                  </div>
                  <div class="col">
                    <input type="number" class="form-control" placeholder="Preço (R$)" id="precoPT" maxlength="5">
                  </div>
                  <div class="col">
                    <button type="button" class="btn btn-primary" onclick="calcularPreco(precoPT.value)">Calcular</button>
                  </div>
                </div>
              </h5>
            </div>
            <div id='collapse7' class='collapse' aria-labelledby='heading7' data-parent='#accordion'>
              <div class='card-body'>@include('pages/anamnese/partials/fisio/plano-terapeutico')</div>
            </div>
          </div>
        </div>
        <button id="submit" type="button" class="btn btn-success btn-lg btn-block" onclick="doAnamnese()">Realizar anamnese</button>
			<?php }
		
		?>
		
		<!---------------------------------------------------------------------------------------------------->
		
</div>

<script type='text/javascript' src='{{ asset('js/anamnese.js') }}'></script>
<script type="text/javascript">
  
  function avalizarAnamnese(id, notif){
    $.post("classes/anamnese.inc.php",{id:id,notif:notif,submit:2},data=>{
      console.log(data);
      doAfterReload("toastr.success('Anamnese realizada!')",null,"dashboard.php");
    },"json");
  }
  
  function doAnamnese(){
    
    var strDM = JSON.stringify(DM).replace(/"/g,"'");
    var strCE = JSON.stringify(CE).replace(/"/g,"'");
    var strCD = JSON.stringify(CD).replace(/"/g,"'");
    var strCP = JSON.stringify(CP).replace(/"/g,"'");
    var DM_medico = "{'crm':'"+DMcrm.value+"','med':'"+DMmed.value+"','mail':'"+DMmail.value+"','tel':'"+DMtel.value+"'}";
    var HC = "{'hc1':'"+hc1.value+"','hc2':'"+hc2.value+"','hc3':'"+hc3.value+"','hc4':'"+hc4.value+"','hc5':'"+hc5.value+"'}";
    var uppedImgsStr = JSON.stringify(uppedImgs).replace(/"/g,"'");
    var PT = JSON.stringify(FASE.filter(limpaArray)).replace(/"/g,"'");
    
    if(endereco.value==""||hc3.value==""||hc1.value==""||precoPT.value==""||CE.filter(limpaArray).length==0||CD.filter(limpaArray).length==0||CP.filter(limpaArray).length==0||FASE.filter(limpaArray).length==0){
      window.top.toastr.error("Preencha a anamnese com os campos mínimos obrigatórios.","Anamnese insuficiente!"); return 0;
    }
    
    var event = {'summary': 'Anamnese realizada', 'location': endereco.value, 'description': 'Anamnese de {{$paciente["cadastro"]["nome"]}}',
      'start': {'dateTime': googleData(), 'timeZone': 'America/Sao_Paulo'},'end': {'dateTime': googleData(), 'timeZone': 'America/Sao_Paulo'},
      'recurrence': [/*'RRULE:FREQ=DAILY;COUNT=2'*/], 'attendees': [{'email': '{{$paciente["login"]}}'}],
      'reminders': {/*'useDefault': false,'overrides': [{'method': 'email', 'minutes': 24 * 60},{'method': 'popup', 'minutes': 10}]*/}
    };
    insertGoogleEvent(event, 'primary');
    
    $.post("classes/anamnese.inc.php",{
    paciente:{{$paciente->id}},
    responsavel:{{Auth::user()->id}},
    avalizado:{{$avalizado}},
    endereco:endereco.value,
    info_medico:DM_medico,
    doencas:strDM,
    hc:HC,
    ce:strCE,
    ce_imgs:uppedImgsStr,
    cd:strCD,
    cp:strCP,
    pt:PT,
    preco:precoPT.value,
    submit:1},data=>{
      if(data.anamnese.data.avalizado){
        doAfterReload("toastr.success('Anamnese realizada!')",null,"dashboard.php");
      }else{
        doAfterReload("toastr.info('Anamnese cadastrada, pendente a avalização do profissional.','Anamnese cadastrada!')",null,"dashboard.php"); 
      }
    },"json");
  }
  
  function doAnamneseMed(){
    $("#hda input, #hpp input, #exf input").each((i,v)=>{
      if(v.value==""){
        toastr.error("Preencha a anamnese com os campos mínimos obrigatórios.","Anamnese insuficiente!"); return 0;
      }
    });
  }

</script>
<?php if(isset($_POST["data"])){echo $script;} ?>

@endsection