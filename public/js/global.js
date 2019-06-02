var updates = [];
var i_updts = 0;
var theLoader = "<div class='spinner-border text-info ml-2' style='vertical-align:middle;width:1.2rem;height:1.2rem;border-width:.2em;' role='status'><span class='sr-only'>Loading...</span></div>";

window.onload = function () {
    if (window.location.hash == "#dAR") {
        window.top.eval(localStorage.getItem("action"));
        window.location.hash = "";
        localStorage.removeItem("action");
    }
};

function loading(bool) {
    $("#theLoader", window.top.document).remove();
    if (bool) {
        var loader = "<div id='theLoader' style='position:absolute;right:10px;bottom:10px;width: 3rem; height: 3rem;' class='spinner-border text-info' role='status'><span class='sr-only'>Loading...</span></div>";
        window.top.$("body").append(loader);
    }
}

toastr.success = (message, title) => {
    toastr('success', message, title)
};
toastr.info = (message, title) => {
    toastr('info', message, title)
};
toastr.warning = (message, title) => {
    toastr('warning', message, title)
};
toastr.error = (message, title) => {
    toastr('error', message, title)
};

function toastr(type, message, title) {

    if (typeof title === "undefined") {
        title = message
    }

    var theme;

    switch (type) {
        case "success":
            theme = "bg-success text-light";
            break;
        case "info":
            theme = "bg-info text-light";
            break;
        case "warning":
            theme = "bg-warning text-dark";
            break;
        case "error":
            theme = "bg-danger text-light";
            break;
    }

    let style = "z-index:9999;position:absolute;top:5px;width:400px;left:calc(50% - 200px);";
    let structure = `
    <div class='toast shadow' role='alert' aria-live='assertive' aria-atomic='true' data-autohide='false' style='${style}'>
        <div class='border-0 toast-header ${theme}'>
            <strong class='mr-auto mt-1' style='letter-spacing: 0.8px;'>${title}</strong><small></small>
            <button type='button' class='ml-2 mt-1 close' data-dismiss='toast' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        ${(title !== message) ? `<div class='toast-body'>${message}</div>` : ''}
    </div>`;

    $("body").append(structure);
    $(".toast").fadeIn();
    $(".toast").toast("show");
    setTimeout(() => {
        $(".toast").fadeOut(600, () => {
            $(".toast").remove();
        });
    }, 2000);

}

$("nav li[id^=nav]").click(e => {/**/
});

function doAfterReload(action, target, filename) {
    if (target == null) {
        target = "self";
    }
    if (target == "opener") {
        filename = window.opener.location.pathname.substr(1);
    }
    if (filename == null) {
        filename = window.location.pathname.substr(1);
    }

    localStorage.setItem("action", action);
    window[target].location.href = "/" + filename + "#dAR";
    if (window.location.pathname.substr(1) == filename) {
        window[target].location.reload();
    }
}

Array.prototype.diff = function (a) {
    return this.filter(function (i) {
        return a.indexOf(i) === -1;
    });
};

function pluck(prop, collection) {
    var result = [];
    collection.forEach((item) => {
        result.push(item[prop]);
    });
    return result;
}

function data() {
    var d = new Date();
    var dia = ('0' + d.getDate()).slice(-2);
    var mes = d.getMonth() + 1;
    var hora = ('0' + d.getHours()).slice(-2);
    var minuto = ('0' + d.getMinutes()).slice(-2);
    return dia + "/" + ('0' + mes).slice(-2) + "/" + d.getFullYear() + " " + hora + ":" + minuto;
}

function googleData() {
    var a = data().split("/");
    var b = a[2].split(" ");
    return b[0] + "-" + a[1] + "-" + a[0] + "T" + b[1] + ":00-03:00";
}

function dateToFields(d, id) {
    var html = "";

    html += "<div class='input-group mb-1'>";
    html += "<div class='input-group-prepend'>";
    html += "<span class='input-group-text'><i class='fas fa-calendar'></i></span>";
    html += "</div>";
    html += "<input id='" + id + "' type='datetime-local' class='form-control' value='" + d + "'>";
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

function clockSince(dataStr) {
    var data = new Date(dataStr);
    var now = new Date();
    var timeDiff = Math.abs(now.getTime() - data.getTime());
    return msToTime(timeDiff);
}

function listQuery(type, table, column, value, element, id) {
    switch (type) {
        case 'update':
            updates[i_updts] = {
                tabela: table,
                coluna: column,
                value: value,
                id: $(element).parent().parent().parent().find("th").find("input[type=hidden]").val()
            };
            i_updts++;
            break;
    }
    if ($("#flagSave").length === 0) {
        $("body").append("<button class='btn btn-primary btn-block' id='flagSave' onclick='suggestChanges(updates," + id + ")'>Sugerir mudanças</button>");
    }
}

function suggestChanges(updatesArray, id) {
    //updatesArray.toString = function(){arrayToString(this);}
    $.post("/lib/scripts/suggestChanges.php", {id: id, script: JSON.stringify(updatesArray)}, function () {
    })
        .done(function () {
            doAfterReload("toastr[\"info\"](\"Solicitação de mudanças no cadastro enviada com sucesso.\", \"Solicitado!\")", null, "dashboard.php");
        });
}

function showFormattedScript(scriptArray, tipo, id, de) {
    var theValue = "";
    console.log(scriptArray);
    $.each(scriptArray, (i, v) => {
        if (v.value === "") {
            theValue = "<span style='color:#FF7777'><i>Em Branco</i></span>";
        } else {
            theValue = "<span style='color:red'>" + v.value + "</span>";
        }
        $("#meModal table#" + v.tabela + v.id + " td#" + v.coluna).html(theValue);
    });
    $("#meModal").modal("show");
}

function formatColumnName(str) {
    switch (str) {
        case 'nome':
            return 'Nome';
        case 'nome_f':
            return 'Nome fantasia';
        case 'profissao':
            return 'Profissão';
        case 'email':
            return 'E-mail';
        case 'numero':
            return 'Número';
        case 'logradouro':
            return 'Logradouro';
        case 'complemento':
            return 'Complemento';
        case 'bairro':
            return 'Bairro';
        default:
            return 'Coluna desconhecida (' + str + ')';
    }
}

function clearControls() {
    $("#controls").html("");
}

function toDim(valor, currency) {
    var formated = parseInt(valor).toFixed(2).replace(".", ",").replace(/\d(?=(\d{3})+\,)/g, '$&.');
    switch (currency) {
        case 'BRL':
            return "R$" + formated;
        case 'USD':
            return "US$" + formated;
        case 'EUR':
            return "€" + formated;
    }
}

function get(param) {
    var value;
    window.location.search
        .substr(1)
        .split("&").forEach(function (a) {
        var b = a.split("=");
        if (b[0] == param) {
            value = b[1];
        }
    });
    return value;
}

/*function selectQuery(colunas, tabela, condicoesArr, callback){ // '*', 'table',["(#)column:value"], e => {callback(e)}
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
}*/

function uploadFile() {

    function loaded() {
        window.top.toastr.success("Foto carregada!");
        $('.spinner-border').remove()
    }

    var reader = new FileReader();
    reader.onload = function (event) {
        var dataUri = event.target.result;
        var fileName = fileToUpload.files[0].name;
        $.post("/lib/upload.php", {data: dataUri, name: fileName}, function (e) {
            uppedImgs.push("/uploads/" + e.serverFile);
        }, "json");
    };
    reader.onloadstart = $('#uploadFile').after("<div class='ml-1 spinner-border text-primary' role='status'></div>");
    reader.onloadend = loaded;
    reader.readAsDataURL(fileToUpload.files[0]);

}

function sendMail(to, assunto, text) {

    var script_url = "https://script.google.com/macros/s/AKfycbwl6QId9TDqCq-ZmbLMuzp0Y9FZkpRRrhSUEL_ukU-4W7o0NTrg/exec";
    //var script_url = "https://script.google.com/macros/s/AKfycbz3Zxi2KOGGk_gfRLrs_xflx_TVORfPvmPOh1VnDPA4KGd9jw7F/exec";
    //var script_url = "https://script.google.com/macros/s/AKfycbyov5T3PUeX-r6FGQ12yKlEKB-kUan7-QKQBMNY3YUBtLmi89A/exec";

    //google scripts request
    var url = script_url + "?callback=ctrlq&msg=" + text + "&assunto=" + assunto + "&to=" + to + "&action=sendMailHR";

    var request = jQuery.ajax({
        crossDomain: true,
        url: url,
        method: "GET",
        dataType: "jsonp"
    });

}

function isPers(x, e, i) {
    if (e == "pers") {
        var pers = prompt("Opção personalizada", "PERSONALIZADO");
        $(x).find("option").eq(i).before("<option id='" + i + "' value='" + pers.toLowerCase() + "'>" + pers + "</option>");
        $(x).val(pers.toLowerCase());
    }
}

function limpaArray(el) {
    // keep element if it's not an object, or if it's a non-empty object
    return typeof el != "undefined" && el != null;
}

function pluck(prop, array) {
    let result = [];
    array.forEach((v, i) => {
        result.push(v[prop]);
    });
    return result;
}

function toParamsPadrao(i) {
    switch (i) {
        case '-2':
            return "Negativo";
        case '-1':
            return "Positivo";
        case '0':
            return "Problema ausente";
        case '1':
            return "Problema leve";
        case '2':
            return "Problema moderado";
        case '3':
            return "Problema grave";
        case '4':
            return "Problema completo";
        case '5':
            return "Não aplicável";
        default:
            return "SLI";
    }
}

function verifyDiagnostico() {
    if (window.location.pathname == '/anamnese.php') {
        let parametros = [];
        $("[name='CE[]']").each((i, v) => {
            $.post('../../../classes/parametros.inc.php', {submit: 'getParametroById', param_id: v.value}, e => {
                parametros.push(e);
                if (i == $("[name='CE[]']").length - 1) {
                    let total_qnt = pluck('quantificador', parametros).reduce((t, v) => {
                        return parseInt(t) + parseInt(v)
                    });
                    let maximum = (100 / 5);
                    let percentual = maximum / $("[name='CE[]']").length;
                    let current = total_qnt * percentual;

                    console.log(`Quantidade total: ${total_qnt}`);
                    console.log(`Percentual atual: ${percentual}%`);

                    $("[name='CD']").val(current);
                    $('#diagnostico_percentage').text(current + '%');
                    $('#prognostico_percentage').text(current + '%');
                    $('#prognostico_range').attr({'min': current, 'step': percentual});
                    $('#prognostico_range').val(current);
                    $('#prognostico_range').change((e) => {
                        $('#prognostico_percentage').text(e.target.value + '%')
                    });
                }
            }, 'json');
        });
    } else {
        return false;
    }

}

function renderParams(which, modelId, data, filter) {
    //if(data=="[]"){data = ""}else{data = JSON.parse(data)}
    $("#edit" + which + modelId + " .modal-title").append(theLoader);
    $.post("classes/parametros.inc.php", {
        renderParams: 1,
        which: which,
        data: data,
        modelId: modelId,
        filter: filter
    }, response => {
        $(".spinner-border").remove();
        $("#edit" + which + modelId + " .modal-body").html(response.html);
        $('.params_preview_' + which).remove();
        $("[data-target='#edit" + which + modelId + "']").before(response.preview);
        $("#managers" + which).html(response.managerModals);
        verifyDiagnostico();
    }, "json");
}

function addExame(nome, which, modelId, data, filter) {
    $("#edit" + which + modelId + " .modal-title").append(theLoader);
    $.post("classes/parametros.inc.php?c=1", {submit: "insert", parametro: nome}, e => {
        $(".spinner-border").remove();
        eval(e.replace(/<script>|<\/script>/g, ""));
        renderParams(which, modelId, data, filter);
    });
}

function updateExame(nome) {
    let data = [];
    $("#manage" + nome + " [name='data[]']").each((i, v) => {
        data.push(v.value)
    });
    $("#manage" + nome + " .modal-title").append(theLoader);
    $.post("classes/parametros.inc.php?c=1", {submit: "save", parametro: nome, data: data}, e => {
        $(".spinner-border").remove();
        eval(e.replace(/<script>|<\/script>/g, ""));
    });
}

function createModal(id, title, bodyHtml, cancelLabel, okLabel, okCallback, noFooter, isLarge) {
    let classes;
    if (isLarge) {
        classes = "modal-lg"
    }
    let construct = "";
    construct += "<div class='modal fade' id='" + id + "' tabindex='-1' style='z-index:1041' role='dialog'>";
    construct += "<div class='modal-dialog " + classes + "' role='document'>";
    construct += "<div class='modal-content'>";
    construct += "<div class='modal-header'>";
    construct += "<h5 class='modal-title'>" + title + "</h5>";
    construct += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    construct += "</div>";
    construct += "<div class='modal-body'>";
    construct += bodyHtml;
    construct += "</div>";
    if (!noFooter) {
        construct += "<div class='modal-footer'>";
        construct += "<button type='button' class='btn btn-danger' data-dismiss='modal'>" + cancelLabel + "</button>";
        construct += "<button type='button' class='btn btn-primary' onclick='" + okCallback + "()'>" + okLabel + "</button>";
        construct += "</div>";
    }
    construct += "</div>";
    construct += "</div>";
    construct += "</div>";
    $("body").append(construct);
}

function createTag(id, content, type, fontSize, isPill, hasCloseBtn, closeBtnOnClick) {
    var classes = "";
    if (isPill) {
        classes = "badge-pill"
    }
    var construct = "<span id='" + id + "' style='font-size:" + fontSize + ";margin: 3px' class=\"badge " + classes + " badge-" + type + "\">";
    construct += content + " ";
    if (hasCloseBtn) {
        construct += "<button type='button' onclick=\"" + closeBtnOnClick + "\" style='line-height: 0.6;' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
    }
    construct += "</span>";
    return construct;
}

function loadTagsInput() {
    setTimeout((e) => {
        $("[data-role='tagsinput']", document).tagsinput();
        $("input[data-role='tagsinput']").each(function (i, v) {
            $("#" + v.id).tagsinput('add', v.value);
        });
    }, 100);
}

function calcularPreco(precoPT) {
    if (precoPT == '' || isNaN(precoPT)) {
        $('[name=precoPT]').focus();
        return 0
    }
    let total = parseInt(precoPT);
    let html = "";

    $.post('lib/modules/anamnese/plano-terapeutico.php', {calcPT: 1, data: $('#newAnamnese').serialize()}, e => {
        html = e.html;
        $('#modalHONORARIO .modal-body').html(html);
        $('#modalHONORARIO').modal('show');
    }, 'json');
}

function renderPT(data = dboPT) {
    if (typeof data !== 'object') {
        data = JSON.parse(data.replace(/\\"/g, "\""))
    }
    ;
    $.post('classes/modelos.inc.php', {'api': 'renderPT', 'dbo': data}, e => {
        $('#PT').html(e.html)
    }, 'json');
}

function doFase() {
    if ($('.accordionPT [id^=phase-]').length > 0) {
        currentFase = $('.accordionPT [id^=phase-]').length + 1;
    }
    var html = `
        <div id='set-OBJ' class='bg-light'></div>
        <button class='btn btn-primary btn-block mb-2' type='button' data-toggle='modal' data-target='#editOBJ0'>Editar objetivos</button>
        <div class='set'></div>
        ${inputsAddProcedimentos()}
    `;
    var num = currentFase;
    $("#modalFASE .modal-title").css("width", "100%");
    $("#modalFASE .modal-title").html("<div class='row'><div class='col-4'>Fase " + ("0" + num).slice(-2) + "</div><div class='col-8'><input id='qtda' class='form-control' type='number' min='1' placeholder='Quantidade de atendimentos'></div>");
    $("#modalFASE .modal-body").html(html);
    $("#modalFASE").modal("show");
}

function newFase() { //currentFase

    if ($("#modalFASE #qtda").val() === "" || $("[id^='maior-']").length === 0) {

        window.top.toastr.error(`
        <ul>
            <li>Confirme os procedimentos</li>
            <li>Informe a quantidade prevista de atendimentos</li>
        </ul>
        `, 'Preencha corretamente');
    } else {

        OBJ = [];
        $('[name="OBJ[]"]').each((i, v) => {
            OBJ.push(v.value);
        });
        dboPT[currentFase] = {"objetivos": OBJ, "qualificadores": QLF, "qtd_atendimentos": $("#modalFASE #qtda").val()};
        renderPT();
        $("[id^='maior-']").remove();
        $("[id^='menor-']").remove();
        QLF = {};
        ESP = [];
        currentFase++;
        $("#modalFASE").modal("hide");
    }

}

function exclFase(fase_id) {
    $("#phase-" + fase_id).remove();
    currentFase--;
}


//-------------------------------------- INPUTS DE PROCEDIMENTOS -----------------------------------------------
function inputsAddProcedimentos() {
    return `
        <div class='row'>
            <div class='col'>
                <div class='input-group'>
                    <input id='qlf' class='form-control' type='text' placeholder='Qualificador'>
                </div>
            </div>
        </div>
        </div>
        <div id='qlfs'></div>
        <div class='row'>
            <div class='col'>
                <div class='input-group'>
                    <input id='qntf' class='form-control' type='number' placeholder='Quantificador'>
                    <div class='input-group-append'>
                        <select id='ctg' class='form-control rounded-0' onchange='isPers(this, this.value, this.selectedIndex)'>
                            <option value='' disabled selected>CATEGORIA...</option>
                            <option value='series'>SÉRIE(S)</option>
                            <option value='repeticoes'>REPETIÇÕES</option>
                            <option value='minutos'>MINUTOS</option>
                            <option value='pers'>PERSONALIZADO</option>
                        </select>
                        <button type='button' class='btn btn-warning' id='addEsp' onclick='newEsp(0)'><h5 class='mb-0'>+</h5></button>
                    </div>
                </div>
            </div>
        </div>
        <div id='qntfs'></div>
        <button id='addQlf' onclick='newQlf(0)' type='button' class='btn btn-success'>Confirmar</button>
    `;
}

function renderQlf() {

    let html = "";
    let i = 0;

    for (let qlf in QLF) {

        let esps = "";
        QLF[qlf].forEach(function (v, i) {
            esps += v;
            if (ESP[i + 1] != null) {
                esps += ", ";
            }
        });
        html += createTag("maior-" + i, `<b>${qlf} -</b> ${esps}`, "info", "16px", 0, 1, "exclQlf('" + qlf + "')");
        i++;
    }

    $("#qlfs").html(html);
}

function newQlf() {

    let qlf = $("#qlf");

    if (qlf.val() === "" || $("[id^='menor-']").length === 0) {

        window.top.toastr.error("Preencha um qualificador válido.");
    } else {

        QLF[qlf.val()] = ESP;
        $("[id^='menor-']").remove();
        ESP = [];
        qlf.val("");
        renderQlf();
    }

}

function exclQlf(espec) {
    delete QLF[espec];
    renderQlf();
}

function renderEsp() {
    html = "";
    ESP.forEach((v, i) => {
        html += createTag("menor-" + i, v, "secondary", "16px", 0, 1, "exclEsp(" + i + ")")
    });
    $("#qntfs").html(html);
}

function newEsp() {

    let qntf = $("#qntf");
    let ctg = $("#ctg");

    if (qntf.val() === "" || ctg.val() === null) {

        window.top.toastr.error("Quantificador ou categoria inválidos.", "Preencha corretamente!");
    } else {

        ESP.push(qntf.val() + " " + ctg.val());
        qntf.val("");
        ctg.val("");
        renderEsp();
    }

}

function exclEsp(i) {
    ESP.splice(i, 1);
    renderEsp();
}

function getFrete(toCEP) {
    if (typeof toCEP !== "undefined") {
        toCEP = toCEP.replace(/[^0-9]/g, "");
        if (toCEP.length === 8 && !isNaN(toCEP)) {
            //$("#opFretes").append("<span class='input-group-text tbremoved'><img style='width:52px' src='https://www.health-register.com/lv/loader.gif'></span>");
            $.getJSON("https://api.postmon.com.br/v1/cep/" + toCEP, e => {
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

function sendSuggest(subject, message){
    if(subject.value!=""&&message.value!=""){
      sendMail("falecom@contactus-br.com", "Sugestão HR - "+subject, message);
      doAfterReload("toastr.success('Sugestão sobre <i>"+subject.value+"</i> foi enviada com sucesso.','Enviada!')");
    }else{
      toastr.error("Inválido!");
    }
  }

  function icon(name){
      return `<i class='fas fa-${name}'></i>`;
  }

//---------------------------------------------------------------------------------------------------------------

// Client ID and API key from the Developer Console
var CLIENT_ID = '952817600857-euvojfp0idiiubi4e4c0117rh0uf6nvb.apps.googleusercontent.com';
var API_KEY = 'AIzaSyBQGaP4kw2aSSTPn3njA_Eh3TXQcxntEXg';

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

function insertGoogleEvent(event, calendarId) {

    return new Promise((resolve, reject)=>{

        loading(1);
        let request = gapi.client.calendar.events.insert({
            'calendarId': calendarId,
            'resource': event
        });
        request.execute(res => res.status == 'confirmed' ? resolve(res) : reject(res));
    });
}