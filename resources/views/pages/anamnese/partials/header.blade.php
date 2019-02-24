<nav class="navbar navbar-dark bg-dark">
  <span style='color:white'>
      Você está realizando a anamnese de <b><?php echo $paciente["cadastro"]["nome"]; ?> (</b><?php echo $paciente["cadastro"]["cpf_cnpj"]; ?><b>)</b>
  </span>
  <select id="models" class="form-control" style="width: 20%" onchange="listaModelos(selectedOptions[0].id, value)">
    <option value="" disabled selected>Selecione um modelo...</option>
    <option value="">Modelo limpo</option>
  </select>
</nav>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text"><b>Endereço</b></span>
  </div>
  <input class="form-control" type="text" id="endereco" placeholder="Escolha um endereço" readonly>
  <div class="input-group-append">
    <span class="input-group-text">
        <i class="fas fa-edit" onclick="$('#modalEnde').modal('show')"></i>
    </span>
  </div>
</div>

<script type="text/javascript">
  
//------------------------------------- LIST MODELOS -------------------------------------------
  
function listaModelos(action, arr){
  if(action=="list"){
    arr.forEach(function(item, i){
      var num = i+1;
      var itemLista = "<option id='model"+i+"' value=\""+item.scriptArray+"\" DM=\""+item.DM+"\" CE=\""+item.CE+"\" CD=\""+item.CD+"\" CP=\""+item.CP+"\">"+num+" - "+item.nome+"</option>";
      $("#models").append(itemLista);
    });
  }else if(action.value!=""){
    var value = $("#"+action).val().replace(/@/g,"'").replace(/'/g,"\"");
    var ce = $("#"+action).attr("ce").replace(/@/g,"'").replace(/'/g,"\"");
    var cd = $("#"+action).attr("cd").replace(/@/g,"'").replace(/'/g,"\"");
    var cp = $("#"+action).attr("cp").replace(/@/g,"'").replace(/'/g,"\"");
    var scriptArray = JSON.parse(value);
    
    //Put values by ID
    for(k in scriptArray){
      $("#"+k).val(scriptArray[k]);
    }
    
    //Put tags by value (data-role='tagsinput')
    $("input[data-role='tagsinput']").each(function(i, v){
      $("#"+v.id).tagsinput('add',v.value);
    });
    
    if(scriptArray[endereco]!=""){$("#lblEnd").text($("#endereco").val());}
    //DM = JSON.parse($("#"+action).attr("dm").replace(/'/g,"\""));
    JSON.parse(ce).forEach(function(Obj, j){activeParamReceptor="CE";addParam(Obj.exam,Obj.n+": "+Obj.lf,'')});
    JSON.parse(cd).forEach(function(Obj, j){activeParamReceptor="CD";addParam(Obj.exam,Obj.n+": "+Obj.lf,'')});
    JSON.parse(cp).forEach(function(Obj, j){activeParamReceptor="CP";addParam(Obj.exam,Obj.n+": "+Obj.lf,'')});
  }else{
    $("input").val("");
    $("#lblEnd").text($("#endereco").val());
  }
}
//----------------------------------------------------------------------------------------------
  
</script>