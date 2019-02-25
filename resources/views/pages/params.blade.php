@extends('essentials/nav')

@section('content')

<form method="post">
  <div class="row p-2 bg-dark">
    <div class="col-6">
        <p class="fs-20 mt-2 mb-0 text-light">
            @if($type==1)
            Exame Clínico-Físico
            @else
            Diagnóstico e Prognóstico
            @endif
        </p>
      </div>
    <div class="col-6">
      <div class="input-group">
        <input type="text" class="form-control" name="parametro" placeholder="Nome da tabela">
        <div class="input-group-append">
          <button name="submit" value="insert" class="btn btn-primary"><i class="fas fa-plus-square mr-2"></i>Criar</button>
        </div>
       </div>
    </div>
  </div>
</form>

<div class="row">
	<?php foreach ($exames as $exam => $tbl){ ?>
  <div class="card col-12 col-lg-6">
    <form method="post" action="">
    <input type="hidden" name="parametro" value="<?php echo $exam ?>">
    <div class="card-header"><h3 class="m-0 p-2"><?php echo $exam ?></h3></div>
    <ul class="list-group list-group-flush">
	  <?php foreach ($modelo as $item){ ?>
      <li class="list-group-item d-flex"><div class="col-2"><?php echo $item["qnt"] ?></div><div class="col-4"><?php echo $item["qlf"] ?></div><div class="col-6"><input type="text" class="form-control" name="data[]" value="<?php echo $tbl[$item["qnt"]] ?>"></div></li>
	  <?php } ?>
    </ul>
    <div class="card-body text-center">
      <button name="submit" value="delete" class="btn btn-danger mr-3"><i class="fas fa-trash mr-1"></i> Excluir</button>
      <button name="submit" value="save" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Salvar</button>
    </div>
   </form>
  </div>
	<?php } ?>
</div>

<!--<script type="text/javascript" src="params.js"></script>-->
<script type="text/javascript">

  $("ul.components li[id^='nav']", window.parent.document).attr("class","");
  $("#navParametros", window.parent.document).attr("class","active");

</script>

@endsection