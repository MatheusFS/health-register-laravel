<div class="modal fade" id="modalEnde" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Escolha o endereço da consulta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="endes" class='list-group' style="text-align: justify;">
        <?php
        $enderecos = array_merge($paciente->cadastro->enderecos->toArray(), Auth::user()->cadastro->enderecos->toArray());
        foreach($enderecos as $ende){ 
          if($ende["complemento"]==""){$compl="";}else{$compl = " (".$ende["complemento"].")";}
          $str = $ende["logradouro"].", ".$ende["numero"].$compl." ".$ende["bairro"]." - ".$ende["cidade"]." - ".$ende["uf"];
        ?>
          <a href='javascript:void(0)' onclick="usar('<?php echo $str ?>')" class='list-group-item list-group-item-action list-group-item-info'><?php echo $str ?></a>
        <?php 
        } ?>
          <a href='#' onclick="$('#endeOutro').slideDown()" class='list-group-item list-group-item-action list-group-item-warning'>Outro</a>
        </div>
        <form method="post">
          <div class="p-2 list-group-item-warning" id='endeOutro' style="display:none">
            <div class="form-row mb-2">
              <div class="col-6">
                <select name="tipo" id="addr_type" class="form-control" onchange="isPers(this, this.value, this.selectedIndex)">
                  <option value="" disabled selected>Selecione...</option>
                  <option value="residencial">Residencial</option>
                  <option value="comercial">Comercial</option>
                  <option value="pers">Personalizado</option>
                </select>
              </div>
              <div class="col-6"><input type="text" class="form-control" name="cep" placeholder="CEP" onkeyup="getFrete(this.value)"></div>
            </div>
            <div class="form-row mb-2">
              <div class="col-7"><input type="text" class="form-control" name="logr" id="addr_logr" placeholder="Logradouro"></div>
              <div class="col-2"><input type="text" class="form-control" name="num" id="addr_num" placeholder="Número"></div>
              <div class="col-3"><input type="text" class="form-control" name="compl" id="addr_compl" placeholder="Complemento"></div>
            </div>
            <div class="form-row mb-2">
              <div class="col-4"><input type="text" class="form-control" name="bairro" id="addr_nbh" placeholder="Bairro"></div>
              <div class="col-6"><input type="text" class="form-control" name="cidade" id="addr_city" placeholder="Cidade"></div>
              <div class="col-2"><input type="text" class="form-control" name="uf" id="addr_uf" placeholder="UF"></div>
            </div>
            <div class="form-row">
              <div class="col-4"></div>
              <div class="col-4"><button name="submit" value="addEnd" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Salvar</button></div>
              <div class="col-4"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  $("#modalEnde").modal("show");

  function usar(str){
    if(str!==0){
      $("#endereco").val(str);
      $("#modalEnde").modal("hide");
    }else{
      var child = window.open("addEnd.php", "_blank", "toolbar=no,scrollbars=no,resizable=no,top=50,left=250,width=470,height=450");
      var timer = setInterval(() => { if (child.closed) {location.reload(); clearInterval(timer);} }, 500);
    }
  }
  
</script>