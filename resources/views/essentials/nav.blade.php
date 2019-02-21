@extends('essentials/global')

@section('nav')

<link href="{{ asset('css/nav.css') }}" rel="stylesheet" />
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="text-dark position-fixed h-100" style="z-index:998; top:80px; background-color:#A5CED1 !important">
            <ul class="list-unstyled components mb-0">
              <p class="text-center text-white bg-primary m-0 py-3">
                <i class='fas fa-"+icon+" mr-2' style='font-size:1.5rem'></i>
                <span class='menuPagesSpan'>NOME</span>
              </p>
                <li id="navDashboard">
                    <a target="ifr_content" href="dashboard.php">
                        <i class="fas fa-home menuPagesIcon"></i>
                        <span class="menuPagesSpan">Dashboard</span>
                    </a>
                </li>
                <li id="navParametros">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-image menuPagesIcon"></i>
                        <span class="menuPagesSpan">Parâmetros</span>
                    </a>
                    <ul class="collapse list-unstyled text-white" id="homeSubmenu">
                        <li>
                            <a target="ifr_content" href="params.php?c=1">Exame Clínico-Físico</a>
                        </li>
                        <li>
                            <a target="ifr_content" href="params.php?c=2">Diagnóstico e Prognóstico</a>
                        </li>
                    </ul>
                </li>
                <li id="navModelos">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy menuPagesIcon"></i>
                        <span class="menuPagesSpan">Modelos</span>
                    </a>
                    <ul class="collapse list-unstyled text-white" id="pageSubmenu">
                        <li>
                            <a target="ifr_content" href="modelsAn.php">Anamnese</a>
                        </li>
                        <li>
                            <a target="ifr_content" href="modelsPT.php">Plano de Tratamento</a>
                        </li>
                    </ul>
                </li>
                <li id="navManager">
                    <a target="ifr_content" href="manager.php">
                        <i class="fas fa-briefcase menuPagesIcon"></i>
                        <span class="menuPagesSpan">Gerenciador</span>
                    </a>
                </li>
                <li id="navFinancas">
                    <a target="ifr_content" href="financas.php">
                        <i class="fas fa-dollar-sign menuPagesIcon"></i>
                        <span class="menuPagesSpan">Financeiro</span>
                    </a>
                </li>
                <li id="navAgenda">
                    <a target="ifr_content" href="calendar.php">
                        <i class="fas fa-calendar-alt menuPagesIcon"></i>
                        <span class="menuPagesSpan">Agenda</span>
                    </a>
                </li>
                <li id="navNotif" class="bg-warning" style="">
                  <a class="text-dark dropdown-toggle" href="#notifSubmenu" data-toggle="collapse">
                      <i class="fas fa-bell text-danger menuPagesIcon"></i>
                    <span class="menuPagesSpan">Notificações</span>
                      <span class="badge badge-pill badge-danger">1</span>
                  </a>
                  <ul class="collapse list-unstyled" id="notifSubmenu">
                    <li><a target='ifr_content' href='manager.php'>ICON NOTIF</a></li>
                  </ul>
                </li>
            </ul>
        </nav>
      
        <div id="content">
          <nav class="navbar row navbar-expand-lg navbar-light bg-light position-fixed w-100" style="z-index:999; margin:0 ;height: 80px">
            <div class="w-100" style="display:contents">
              <div class="col-1">
                <button type="button" id="sidebarCollapse" class="btn btn-light rounded-circle">
                  <i class="fas fa-align-justify"></i>
                </button>
              </div>
              <div class="col-2">
                <img src="imgs/logowhite.png" width="130" class="mr-2">
              </div>
              <div class="col-7">
                <input type="text" class="form-control bg-secondary text-dark" id="procurar" placeholder="Procurar por nome...">
              </div>
              <div class="col-2 text-right collapse navbar-collapse" style="justify-content: flex-end;">
                <ul class="nav navbar-nav">
                  <li class="nav-item mr-2" data-toggle="tooltip" data-placement="bottom" title="Fale conosco">
                    <button data-toggle="modal" data-target="#suggestImprov" class="btn btn-primary btn-block rounded-circle p-0"><img src='imgs/sugestao.png' width="40" height="37"></button>
                  </li>
                  <li class="nav-item mr-2" data-toggle="tooltip" data-placement="bottom" title="Alternar conta">
                    <button data-toggle="modal" data-target="#altAccountModal" class="btn btn-dark btn-block rounded-circle"><i class="fas fa-exchange-alt"></i></button>
                  </li>
                  <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Sair">
                    <a href="sair.php" class="btn btn-danger btn-block rounded-circle" style="text-align:center"><i class="fas fa-sign-out-alt"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div style="top: 80px;height: calc(100% - 80px);">
            @yield('content')         
          </div>
        </div>
</div> 


<script type="text/javascript">

$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});

</script>
@endsection