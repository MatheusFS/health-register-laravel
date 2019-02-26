@extends('essentials/nav/master')

@php
$fields = ["endereco","DM","DM_medico","HC","CE","CD","CP","PT","eesp_json","interc_json"];
$fields_as = ["Endereço","Doenças","Médico","História Clinica","Exames Físico-Clinicos","Diagnóstico","Prognóstico","Plano de tratamento","Estado de evolução de saúde do Paciente","Intercorrência(s)"];
$objkeys = ["crm","med","mail","tel","hc1","hc2","hc3","hc4","hc5"];
$objkeys_as = ["CRM","Nome","E-mail","Telefone","Queixa principal","História pregressa e atual da doença","Hábitos de vida","Tratamentos realizados","Antecedentes pessoais e familiares"];
@endphp

@section('content')

<form action="lib/FPDF/generateProntuario.php" method="post">
  <button type="submit" value="{id}" name="exportPDF" class="btn btn-danger mb-2 btn-block">
    <i class="fas fa-file-pdf"></i> Exportar como PDF
  </button>
</form>

<div id='accordion' class="w-100">

    @foreach ($items as $item)

    @php
    $key = $loop->iteration;
    if($key>1){$color="info";$type="Reavaliação";}else{$color="primary";$type="Avaliação";}
    if($item->responsavel==0){$item->cadastro_resp->nome = "Sistema";}
    @endphp
    
    
    <div class='card'>
      <div class='card-header p-0' id='heading{{$key}}'>
        <button class='btn btn-{{$color}} btn-block rounded-0 p-2' data-toggle='collapse' data-target='#collapse{{$key}}' aria-expanded='true' aria-controls='collapse{{$key}}'>
          {{ $type }} ({{ $item->created_at }}) - 
          <span class="badge badge-secondary">{{ $item->cadastro_resp->nome }}</span>  
        </button>
      </div>

      <div id='collapse{{$key}}' class='collapse' aria-labelledby='heading{{$key}}' data-parent='#accordion'>
        <div class='card-body p-1'>
            <?php
            foreach($items as $column=>$value){ 
                if(in_array($column,$fields)&&$value!=""&&$value!="{}"&&$value!="[]"){ 
            ?>
           <h3 class="mb-1 mt-3"><?php echo $fields_as[array_search($column, $fields)] ?></h3>
            
              <?php
                $json = json_decode(str_replace("'","\"",$value), true);
              if($json!=NULL){
                foreach($json as $a=>$item){
                  if(gettype($item)!="array"&&$item!=""){
              ?>
          <div class="input-group mb-1">
              <div class="input-group-prepend">
                <span class="input-group-text"><b><?php if(is_numeric($a)!="number"){echo $objkeys_as[array_search($a, $objkeys)];}else{echo $a;} ?></b></span>
              </div>
                  <input type="text" class="form-control" value="{{$item}}" readonly></div>
              <?php 
                  }else{ ?>
                    <span class="badge badge-primary m-2 fs-15">@json($item)</span>
          <?php
                  }
                }
              }else{ ?>
              <input type="text" class="form-control" value="{{$value}}" readonly>
          <?php }}} ?>
        </div>
      </div>
    </div>

@endforeach

</div>

@endsection