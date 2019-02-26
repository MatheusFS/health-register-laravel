<!-- Modal -->
<div class="modal fade" id="altAccountModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contas disponíveis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id='accounts' class='list-group'>
              
              <a href='javascript:void(0)' class='list-group-item list-group-item-action list-group-item-dark'><i class='fas fa-"+icon+" mr-2' style='font-size:2.0rem'></i>nome</a>
          </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  var accounts = [];
  var script = ""; if("{{Auth::user()->cadastro->funcao}}"=="empresa"){script="Child"}else{script="Parent"}
  
  $.getJSON("lib/scripts/return"+script+"s.php",(parents)=>{
    parents.forEach((v,i)=>{
      if(v.id != {{Auth::user()->id}}){
        v.style="primary";
        accounts.push(v);
      }
    });
    $.getJSON("lib/scripts/returnMe.php",(me)=>{
      if(me.id != {{Auth::user()->id}}){
        me.style="success";
        accounts.push(me);
      }
      $.each(accounts, (i, account)=>{
        var icon = ""; if(account.funcao=="profissional"){icon = "user-md"}else if(account.funcao=="empresa"){icon = "building"}else{icon="user"}
        $("#accounts").append("<a href='javascript:void(0)' onclick=\"muda"+script+"("+account.id+")\" class='list-group-item list-group-item-action list-group-item-"+account.style+" '><i class='fas fa-"+icon+" mr-2' style='font-size:2.0rem'></i>"+account.nome+"</a>");
      });
    });
  });
  
  

  
  function mudaParent(parent){
    var data = new Date();
    var hora = data.getHours()+":"+data.getMinutes()+":"+data.getSeconds();

    $.post("lib/scripts/returnMe.php",function(me){
      $.post("lib/scripts/returnPermissions.php", {id:parent}, function(perm){
        if(perm.hrs[0]<=hora&&perm.hrs[1]>=hora){
          var senha = prompt("Digite sua senha:");
          if(senha==me.senha){
            $.post("lib/scripts/actParent.php",{parent: parent},function(data){location.reload();});
          }else{
            alert("Senha incorreta!");
          }
        }else{
            if(confirm("Você não tem permissão neste horário! Deseja solicitar acesso (sessão temporária)?")){
              $.post("lib/scripts/requestOvrlHr.php",{para:parent},function(data){alert(data);});
            }
        }
      }, "json");
    });
  }

</script>