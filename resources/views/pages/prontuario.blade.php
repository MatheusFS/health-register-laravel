@extends('essentials/nav')

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

    @foreach ($anamneses as $anamnese)

    @php
    $key = $loop->iteration;
    if($key>1){$color="info";$type="Reavaliação";}else{$color="primary";$type="Avaliação";}
    if($anamnese->responsavel==0){
    //$usr["nome"] = "Sistema";
    }
    @endphp
    
    
    <div class='card'>
      <div class='card-header p-0' id='heading{{$key}}'>
        <button class='btn btn-{{$color}} btn-block rounded-0 p-2' data-toggle='collapse' data-target='#collapse{{$key}}' aria-expanded='true' aria-controls='collapse{{$key}}'>
          {{ $type }} {{ $anamnese->data }} - 
          <span class="badge badge-secondary">{{ $anamnese->responsavel_fk->nome }}</span>  
        </button>
      </div>

      <div id='collapse{{$key}}' class='collapse' aria-labelledby='heading{{$key}}' data-parent='#accordion'>
        <div class='card-body p-1'>
            <?php
            foreach($anamneses as $column=>$value){ 
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
                  <input type="text" class="form-control" value="<?php echo $item ?>" readonly></div>
              <?php 
                  }else{
                    $str = "";
                    foreach($item as $sitem){
                      if(gettype($sitem)!="array"){
                        $str .= $sitem." ";
                      }else{
                        foreach($sitem as $ssitem){
                          if(gettype($ssitem)!="array"){
                            $str .= $ssitem." ";
                          }else{
                            foreach($ssitem as $sssitem){
                              if(gettype($ssitem)!="array"){
                                $str .= $sssitem." ";
                              }else{
                                foreach($sssitem as $ssssitem){
                                  if(gettype($ssssitem)!="array"){
                                    $str .= $ssssitem." ";
                                  }else{
                                    foreach($ssssitem as $sssssitem){
                                      if(gettype($sssssitem)!="array"){
                                        $str .= $sssssitem." ";
                                      }else{
                                        $str = "WTF!";
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    } ?>
                    <span class="badge badge-primary m-2 fs-15"><?php echo $str ?></span>
          <?php
                  }
                }
              }else{ ?>
              <input type="text" class="form-control" value="<?php echo $value ?>" readonly>
          <?php }}} ?>
        </div>
      </div>
    </div>

@endforeach

</div>

@endsection