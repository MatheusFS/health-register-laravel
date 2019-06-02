function addProc() {
    QLF.forEach((v, i) => {
        interc_json.proc[v.qlf] = [];
        v.esp.forEach((u, j) => {
            interc_json.proc[v.qlf].push(u.qntf + ' ' + u.ctg)
        })
    });
    $("#theProcsTags").html(toTagss(interc_json.proc));
    $(".proc-close").click(removeProc);
    $(".proc-close").show();
    $(".proc").click(ableToEdit);
    $(".maior").remove();
    QLF = [];
    $('#regInterc').modal('hide');
}

function removeProc(e) {
    delete interc_json.proc[$(e.currentTarget).parent().attr("proc")];
    interc_json.proc = interc_json.proc.filter(limpaArray);
    $(e.currentTarget).parent().remove();
}

function updtProc() {
    var idx = $("#procBeingEdited").val();
    var qlf = $("#editing_qlf").val();
    var esp = [];
    $("[id*='editing_qntf'").each((i, v) => {
        esp.push({
            qntf: $("#editing_qntf" + i).val(),
            ctg: $("#editing_ctg" + i).val()
        })
    });

    interc_json.proc[idx] = {
        qlf: qlf,
        esp: esp
    };
    $("#theProcsTags").html(toTags(interc_json.proc));
    $(".proc-close").click(removeProc);
    $(".proc-close").show();
    $(".proc").click(ableToEdit);
    $('#editProc').modal('hide');
}