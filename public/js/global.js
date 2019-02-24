var updates = [];
var i_updts = 0;
var theLoader = "<div class='spinner-border text-info ml-2' style='vertical-align:middle;width:1.2rem;height:1.2rem;border-width:.2em;' role='status'><span class='sr-only'>Loading...</span></div>";

window.onload = function () {
	if(window.location.hash == "#dAR"){
		window.top.eval(localStorage.getItem("action"));
		window.location.hash = "";
		localStorage.removeItem("action");
	}
};

/*function loading(bool){
  var style = "width:100px;height:100px;position:fixed;bottom:12px;right:12px;display:none";
  var loader = "<img id='theLoader' src='imgs/loading.gif' style='"+style+"'>";
  window.top.$("body").append(loader);
  if(bool){
    $("#theLoader",window.top.document).show();
  }else{
    $("#theLoader",window.top.document).hide();
  }
}*/

toastr.success = (message, title)=>{toastr('success',message,title)};
toastr.info = (message, title)=>{toastr('info',message,title)};
toastr.warning = (message, title)=>{toastr('warning',message,title)};
toastr.error = (message, title)=>{toastr('error',message,title)};

function toastr(type, message, title){   
    
    if(typeof title === "undefined"){ title = message }
    
    var theme;
    
    switch(type){
        case "success": theme = "bg-success text-light"; break;
        case "info": theme = "bg-info text-light"; break;
        case "warning": theme = "bg-warning text-dark"; break;
        case "error": theme = "bg-danger text-light"; break;
    }

    var style = "z-index:9999;position:absolute;top:5px;width:400px;left:calc(50% - 200px);"
    var structure = "<div class='toast shadow' role='alert' aria-live='assertive' aria-atomic='true' data-autohide='false' style='"+style+"'>";
        structure += "<div class='border-0 toast-header "+theme+"'>";
        structure += "<strong class='mr-auto mt-1' style='letter-spacing: 0.8px;'>"+title+"</strong>";
        //structure += "<small>11 mins ago</small>";
        structure += "<button type='button' class='ml-2 mt-1 close' data-dismiss='toast' aria-label='Close'>";
        structure += "<span aria-hidden='true'>&times;</span>";
        structure += "</button>";
        structure += "</div>";
        if(title != message){
            structure += "<div class='toast-body'>";
            structure += message;
            structure += "</div>";
        }
        structure += "</div>";
    
    $("body").append(structure);
    $(".toast").fadeIn();
    $(".toast").toast("show");
    setTimeout(()=>{$(".toast").fadeOut(600,()=>{$(".toast").remove();});},2000);
    
}

$("nav li[id^=nav]").click(e=>{/**/});

function doAfterReload(action, target, filename){
	if(target==null){target="self";}
	if(target=="opener"){filename = window.opener.location.pathname.substr(1);}
	if(filename==null){filename = window.location.pathname.substr(1);}
	
	localStorage.setItem("action", action);
	window[target].location.href = "/"+filename+"#dAR";
  if(window.location.pathname.substr(1)==filename){
	  window[target].location.reload();
  }
}

function data(){
  var d = new Date();
  var dia = ('0'+d.getDate()).slice(-2);
  var mes = d.getMonth() + 1;
  var hora = ('0'+d.getHours()).slice(-2);
  var minuto = ('0'+d.getMinutes()).slice(-2);
  return dia+"/"+('0'+mes).slice(-2)+"/"+d.getFullYear()+" "+hora+":"+minuto;
}

function googleData(){
  var a = data().split("/");
  var b = a[2].split(" ");
  return b[0]+"-"+a[1]+"-"+a[0]+"T"+b[1]+":00-03:00";
}

function dateToFields(d, id){
  var html = "";
  
  html += "<div class='input-group mb-1'>";
    html += "<div class='input-group-prepend'>";
      html += "<span class='input-group-text'><i class='fas fa-calendar'></i></span>";
    html += "</div>";
    html += "<input id='"+id+"' type='datetime-local' class='form-control' value='"+d+"'>";
  html += "</div>";
  return html;
}

function msToTime(s) {

  // Pad to 2 or 3 digits, default is 2
  function pad(n, z) {
    z = z || 2;
    return ('00' + n).slice(-z);
  }

  var ms = s % 1000;
  s = (s - ms) / 1000;
  var secs = s % 60;
  s = (s - secs) / 60;
  var mins = s % 60;
  var hrs = (s - mins) / 60;

  return pad(hrs) + 'h ' + pad(mins) + 'm ' + pad(secs) + 's '; // + pad(ms, 3) + 'ms'
}

function clockSince(dataStr){
	var data = new Date(dataStr);
	var now = new Date();
	var timeDiff = Math.abs(now.getTime() - data.getTime());
	return msToTime(timeDiff);
}

function listQuery(type, table, column, value, element, id){
	switch(type){
		case 'update': 
			updates[i_updts] = {
				tabela:table,
				coluna:column,
				value:value,
				id:$(element).parent().parent().parent().find("th").find("input[type=hidden]").val()
			}; i_updts++; break;
	}
	if($("#flagSave").length===0){$("body").append("<button class='btn btn-primary btn-block' id='flagSave' onclick='suggestChanges(updates,"+id+")'>Sugerir mudanças</button>");}
}

function suggestChanges(updatesArray, id){
	//updatesArray.toString = function(){arrayToString(this);}
	$.post("/lib/scripts/suggestChanges.php", {id:id,script:JSON.stringify(updatesArray)}, function(){})
		.done(function(){
			doAfterReload("toastr[\"info\"](\"Solicitação de mudanças no cadastro enviada com sucesso.\", \"Solicitado!\")", null,"dashboard.php");
		});
}

function arrayToString(Array){
	var String = "[";
	Array.forEach(function(Object, i){
		/*console.log(Object);
		for(var k in Object){
			if(typeof Object.k == 'string'){
				console.log("k -> "+k+"; Object[k] -> "+Object.k);
			}else if(typeof Object.k == 'object'){
				for(var l in Object.k){
					console.log("l -> "+l+"; Object.k.l -> "+Object.k.l);
				}
			}else if(typeof Object.k == 'array'){
				Object.k.forEach(function(childObject, j){
					console.log("j -> "+j+"; this -> "+childObject);
				});
			}
		}*/
		String += "{tabela:'"+Object.tabela+"', coluna:'"+Object.coluna+"', value:'"+Object.value+"', id:'"+Object.id+"'}";
		if(i+1!=Array.length){String += ", ";}
	});
	String += "]";
	return String;
}

function showFormattedScript(scriptArray, tipo, id, de){
	var theValue = ""; console.log(scriptArray);
	$.each(scriptArray, (i, v)=>{
		if(v.value===""){
			theValue = "<span style='color:#FF7777'><i>Em Branco</i></span>";
		}else{
			theValue = "<span style='color:red'>"+v.value+"</span>";
		}
		$("#meModal table#"+v.tabela+v.id+" td#"+v.coluna).html(theValue);
	});
	$("#meModal").modal("show");
}

function formatColumnName(str){
	switch(str){
		case 'nome': return 'Nome';
		case 'nome_f': return 'Nome fantasia';
		case 'profissao': return 'Profissão';
		case 'email': return 'E-mail';
		case 'numero': return 'Número';
		case 'logradouro': return 'Logradouro';
		case 'complemento': return 'Complemento';
		case 'bairro': return 'Bairro';
		default: return 'Coluna desconhecida ('+str+')';
	}
}

function showInControls(html){
	$("#controls").html(html);
}

function clearControls(){$("#controls").html("");}

function toDim(valor, currency){
  var formated = parseInt(valor).toFixed(2).replace(".",",").replace(/\d(?=(\d{3})+\,)/g, '$&.');
  switch (currency){
    case 'BRL': return "R$"+formated;
    case 'USD': return "US$"+formated;
    case 'EUR': return "€"+formated;
  }
}

function uploadFile(){
	
	var reader = new FileReader();
	
	reader.onload = function(event) {
		var dataUri = event.target.result;
		var fileName = fileToUpload.files[0].name;
		$.post("/lib/scripts/upload.php", { data: dataUri, name: fileName }, function(e){
			$("#controls").html("<img src='/uploads/"+e.serverFile+"'>");
      uppedImgs.push("/uploads/"+e.serverFile);
		}, "json");
	};
	reader.onloadstart = showInControls("<img src='/imgs/loading.gif' style='width:150 !important; height:150 !important'>");
	reader.onloadend = toastr.success("Foto carregada!");
	
	reader.readAsDataURL(fileToUpload.files[0]);
	
}

function get(param){
	var value;
	window.location.search
	.substr(1)
	.split("&").forEach(function(a){
		var b = a.split("=");
		if(b[0]==param){value = b[1];}
	});
	return value;
}

function selectQuery(colunas, tabela, condicoesArr, callback){ // '*', 'table',["(#)column:value"], e => {callback(e)}
	$.ajax({
		url: "/lib/scripts/SELECT.php",
		method: "POST",
		data: {colunas:colunas, tabela:tabela, condicoes:condicoesArr},
    //contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(e){callback(e);}
	});
}

function insertQuery(insertsArray, callback){ // [{tabela: 'q', colunas:['sessionId:i','a:s','b:s'], values: ['x', 'y']},...]
  var counter = insertsArray.length;
	$.each(insertsArray, function(i, v){
    $.ajax({
      url: "/lib/scripts/INSERT.php",
      method: "POST",
      data: v,
      //contentType: "application/json; charset=utf-8",
      //dataType: "json",
      success: function(e){callback(e);}
    });
	});
}

function updateQuery(updatesArray){ // [{tabela: 'q', coluna:'a', value:'b', id:'1'}]
	$.each(updatesArray, function(i, v){
		$.post("/lib/scripts/UPDATE.php", v, function(){});
	});
	
	//toastr["success"]("Informações de cadastro atualizadas com sucesso.", "Salvo!");
}

function deleteQuery(id, tabela){
	$.post("/lib/scripts/DELETE.php", {id:id,tabela:tabela}, function(){});
}

function sendMail(to, assunto, text){
		
	var script_url = "https://script.google.com/macros/s/AKfycbwl6QId9TDqCq-ZmbLMuzp0Y9FZkpRRrhSUEL_ukU-4W7o0NTrg/exec";
	//var script_url = "https://script.google.com/macros/s/AKfycbz3Zxi2KOGGk_gfRLrs_xflx_TVORfPvmPOh1VnDPA4KGd9jw7F/exec";
	//var script_url = "https://script.google.com/macros/s/AKfycbyov5T3PUeX-r6FGQ12yKlEKB-kUan7-QKQBMNY3YUBtLmi89A/exec";
	
	//google scripts request
	var url = script_url+"?callback=ctrlq&msg="+text+"&assunto="+assunto+"&to="+to+"&action=sendMailHR";  

	var request = jQuery.ajax({
	  crossDomain: true,
	  url: url ,
	  method: "GET",
	  dataType: "jsonp"
	});
	
}
	
function ctrlq(e) {	console.log(e); }

function isPers(x, e, i){
	if(e=="pers"){
		var pers = prompt("Opção personalizada","PERSONALIZADO");
		$(x).find("option").eq(i).before("<option id='"+i+"' value='"+pers.toLowerCase()+"'>"+pers+"</option>");
		$(x).val(pers.toLowerCase());
	}
}

function limpaArray(el){
	// keep element if it's not an object, or if it's a non-empty object
	return typeof el != "undefined" && el != null;
}

function toParamsPadrao(i){
  switch(i){
    case '-2': return "Negativo";
    case '-1': return "Positivo";
    case '0': return "Problema ausente";
    case '1': return "Problema leve";
    case '2': return "Problema moderado";
    case '3': return "Problema grave";
    case '4': return "Problema completo";
    case '5': return "Não aplicável";
    default: return "SLI";
  }
}

function addParametro(){
  
}

/*function getActiveParams(type, userId, el, exames, which){
  if(which==null){which="";var excfFilter=1; var diagFilter=1;}
  if(exames[0]=="empty"&&exames.length==1){
    toastr.error("Todos os parâmetros nessa categoria já foram utilizados.","Parâmetros esgotados!");
    return 0
  }else{
    exames = exames.filter(e=>{return e!="empty"});
  }
  var tabela = "parametros_"+type;
  selectQuery('*', tabela,["#id_usuario:"+userId], e => {
    var i = 0;
    var EXAMES = {};
    e.forEach((v,i)=>{
      if(typeof EXAMES[v.nome] === "undefined"){EXAMES[v.nome] = [];}
      if(v.lf!="PERSONALIZAR"){
        var json = v.quantificador+":"+v.lf;
        EXAMES[v.nome].push(json);
      }
      EXAMES[v.nome].sort((a, b) => a.split(":")[0] - b.split(":")[0]);
    });
    if(typeof exames !== 'undefined'&&exames.length!==0){
      var aux = "";
      for(var a in exames){
        aux += ",\""+exames[a]+"\":["; var slaux = "";
        EXAMES[exames[a]].forEach((b,w)=>{
          slaux += ",\""+b+"\"";
        });
        aux += slaux.substr(1)+"]";
      }
      EXAMES = JSON.parse("{"+aux.substr(1)+"}");
    }
    var construct = "<div id='theParams' style='width: inherit'>";
    for(var k in EXAMES){
        construct += "<div class='input-group' id='IG-"+which+k+"'>"; //style='display: inline-flex;width:fit-content;margin: 4px;'
          construct += "<div class='input-group-prepend'>";
            construct += "<label class='input-group-text' for='Select01' style='background-color: #00478e; color: #FFF'>"+k+"</label>";
          construct += "</div>";
          construct += "<select class='custom-select' id='exam"+which+i+"' name='"+k+"' onchange=\"$('#spanSel"+i+"').html('<i>('+value+')</i>')\">";
            construct += "<option value='' selected disabled>Selecione...</option>";
            EXAMES[k].forEach((u,j) => {
              construct += "<option value='"+toParamsPadrao(u.split(":")[0])+"'>"+u.split(":")[0]+": "+u.split(":")[1]+"</option>";
            });
          construct += "</select>";
          construct += "<div class='input-group-append'>";
            construct += "<span id='spanSel"+i+"' class='input-group-text'></span>";
            construct += "<button class='btn btn-secondary' style='padding:1px 5px' type='button' onclick=\"addParam(exam"+which+i+".name,exam"+which+i+".selectedOptions[0].text,'"+type+"')\"><img src='imgs/checkn.png' width='30'></button>";
          construct += "</div>";
        construct += "</div>";
      i++;
      if(!excfFilter&&type=="excf"){excfParamsFilter.push(k);}
      if(!diagFilter&&type=="dp"){diagParamsFilter.push(k);}
    } 
    if(type=="excf"){excfFilter=1}else{diagFilter=1}
    construct += "</div>";
    $(el).html(construct);
  }); return 1;
}*/

function createModal(id,title,bodyHtml,cancelLabel,okLabel,okCallback,noFooter,isLarge){
  var classes;
  if(isLarge){classes="modal-lg"}
  var construct = "";
  construct += "<div class='modal fade' id='"+id+"' tabindex='-1' role='dialog'>";
    construct += "<div class='modal-dialog "+classes+"' role='document'>";
      construct += "<div class='modal-content'>";
        construct += "<div class='modal-header'>";
          construct += "<h5 class='modal-title'>"+title+"</h5>";
          construct += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
        construct += "</div>";
        construct += "<div class='modal-body'>";
          construct += bodyHtml;
        construct += "</div>";
        if(!noFooter){
        construct += "<div class='modal-footer'>";
          construct += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>"+cancelLabel+"</button>";
          construct += "<button type='button' class='btn btn-primary' onclick='"+okCallback+"()'>"+okLabel+"</button>";
        construct += "</div>";
        }
      construct += "</div>";
    construct += "</div>";
  construct += "</div>";
  $("body").append(construct);
}

function createTag(id, content, type, fontSize, isPill, hasCloseBtn, closeBtnOnClick){
  var classes = ""; if(isPill){classes="badge-pill"}
  var construct = "<span id='"+id+"' style='font-size:"+fontSize+";margin: 3px' class=\"badge "+classes+" badge-"+type+"\">";
  construct += content+" ";
  if(hasCloseBtn){construct+="<button type='button' onclick=\""+closeBtnOnClick+"\" style='line-height: 0.6;' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"}
  construct += "</span>";
  return construct;
}

function loadTagsInput(){
  setTimeout((e)=>{
    $("[data-role='tagsinput']",document).tagsinput();
    $("input[data-role='tagsinput']").each(function(i, v){
      $("#"+v.id).tagsinput('add',v.value);
    });
  },100);
}


//-------------------------------------- INPUTS DE PROCEDIMENTOS -----------------------------------------------
  function inputsAddProcedimentos(){
    var html = "";
    html += "<div class='row'><div class='col'>";
    html += "<div class='input-group'><input id='qntf' class='form-control' type='number' placeholder='Quantificador'>";
    html += "<div class='input-group-append'>";
    html += "<select id='ctg' class='form-control rounded-0' onchange='isPers(this, this.value, this.selectedIndex)'>";
    html += "<option value='' disabled selected>CATEGORIA...</option>";
    html += "<option value='series'>SÉRIE(S)</option>";
    html += "<option value='repeticoes'>REPETIÇÕES</option>";
    html += "<option value='minutos'>MINUTOS</option>";
    html += "<option value='pers'>PERSONALIZADO</option>";
    html += "</select>";
    html += "<button type='button' class='btn btn-warning' id='addEsp' onclick='newEsp(0)'><h5 class='mb-0'>+</h5></button>";
    html += "</div></div>";
    html += "</div></div>";
    html += "<div id='qntfs'></div>";
    html += "<div class='row'><div class='col'>";
    html += "<div class='input-group'><input id='qlf' class='form-control' type='text' placeholder='Qualificador'>";
    html += "<div class='input-group-append'><button id='addQlf' onclick='newQlf(0)' type='button' class='btn btn-success'>Confirmar</button></div></div>";
    html += "</div></div>";
    html += "<div id='qlfs'></div>";
    return html;
  }

  function newQlf(i){

    var qlf = $("#qlf");

    if(qlf.val()!==""&&$("[id^='menor-']").length>0){
      var esps = "";
      ESP.forEach(function(obj,i){esps += obj.qntf+" "+obj.ctg;if(ESP[i+1]!=null){esps+=", ";}});
      QLF[i] = {qlf:qlf.val(),esp:ESP};
      $("#qlfs").append(createTag("maior-"+i, "<b>"+qlf.val()+" -</b> "+esps, "info", "16px", 0, 1, "exclQlf("+i+")"));
      $("[id^='menor-']").remove(); ESP = []; i++; qlf.val("");
      $('#addQlf').attr('onclick','newQlf('+i+')');
    }else{alert("Preencha um válido antes.");}

  }

  function exclQlf(i){
    $("#maior-"+i).remove();
    delete QLF[i];
    i--;
    $('#addQlf').attr('onclick','newQlf('+i+')');
  }

  function newEsp(i){

    var qntf = $("#qntf");
    var ctg = $("#ctg");

    if(qntf!==""&&ctg!==null){
      ESP[i] = {qntf:qntf.val(),ctg:ctg.val()};
      $("#qntfs").append(createTag("menor-"+i, qntf.val()+" "+ctg.val(), "secondary", "16px", 0, 1, "exclEsp("+i+")"));
      i++; qntf.val(""); ctg.val("");
      $('#addEsp').attr('onclick','newEsp('+i+')');
    }else{toastr.error("Quantificador ou categoria inválidos.","Preencha corretamente!");}

  }

  function exclEsp(i){
    $("#menor-"+i).remove();
    delete ESP[i];
    i--;
    $('#addEsp').attr('onclick','newEsp('+i+')');
  }

 function getFrete(toCEP){
    if(typeof toCEP !=="undefined"){
      toCEP = toCEP.replace(/[^0-9]/g,"");
      if(toCEP.length==8&&!isNaN(toCEP)){      
        //$("#opFretes").append("<span class='input-group-text tbremoved'><img style='width:52px' src='https://www.healthregister.ml/lv/loader.gif'></span>");
        $.getJSON("https://api.postmon.com.br/v1/cep/"+toCEP,e=>{
          $("#addr_logr").val(e.logradouro);
          $("#addr_city").val(e.cidade);
          $("#addr_nbh").val(e.bairro);
          $("#addr_uf").val(e.estado);
        });
        $(".tbremoved").remove();
        $("#addr_num").focus();
      }
    }
  }

//---------------------------------------------------------------------------------------------------------------

// Client ID and API key from the Developer Console
var CLIENT_ID = '952817600857-95mh0gofavk6flsghg5bidgbfrv4mkqf.apps.googleusercontent.com';
var API_KEY = 'AIzaSyCUN3ldJ4lPkubEliAI78j5IiJrIKnwuHw';

// Array of API discovery doc URLs for APIs used by the quickstart
var DISCOVERY_DOCS = [
  "https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"
];

// Authorization scopes required by the API; multiple scopes can be
// included, separated by spaces.
var SCOPES = "https://www.googleapis.com/auth/calendar profile email";

/**
 *  On load, called to load the auth2 library and API client library.
 */
function handleClientLoad() {
  gapi.load('client:auth2', initClient);
}

/**
 *  Initializes the API client library and sets up sign-in state
 *  listeners.
 */
function initClient() {
  gapi.client.init({
    apiKey: API_KEY,
    clientId: CLIENT_ID,
    discoveryDocs: DISCOVERY_DOCS,
    scope: SCOPES
  }).then(function () {
    // Listen for sign-in state changes.
    gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

    // Handle the initial sign-in state.
    updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
  });
}

function updateSigninStatus(isSignedIn) {
  if (isSignedIn) {
    //
  } else {
    //
  }
}

function insertGoogleEvent(event, calendarId){
  if(event===null){
    event = {'summary': 'Google I/O 2015','location': '800 Howard St., San Francisco, CA 94103',
      'description': 'A chance to hear more about Google\'s developer products.',
      'start': {'dateTime': '2018-11-04T09:00:00-03:00','timeZone': 'America/Sao_Paulo'},
      'end': {'dateTime': '2018-11-05T17:00:00-03:00','timeZone': 'America/Sao_Paulo'},
      'recurrence': [/*'RRULE:FREQ=DAILY;COUNT=2'*/],'attendees': [{'email': 'lpage@example.com'},/*{'email': 'sbrin@example.com'}*/],
      'reminders': {/*'useDefault': false,'overrides': [{'method': 'email', 'minutes': 24 * 60},{'method': 'popup', 'minutes': 10}]*/}
    };
  }

  var request = gapi.client.calendar.events.insert({
    'calendarId': calendarId,
    'resource': event
  });

  request.execute(function(event) {
    console.log('Event created: ' + event.htmlLink);
  });
}