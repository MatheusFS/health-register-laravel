@extends('essentials/global')

@section('title','Início - Health Register')

<head>
  <link rel="stylesheet" type="text/css" href="{{asset('css/multiple-slide-carousel.css')}}">
  <style>
    html,
    body {
      height: 100vh;
    }

    #modulos-accordion>.card {
      background-color: #ddddddaa
    }

    .modulos-container {
      padding-left: 6em
    }

    .img-stacked {
      width: 99%;
      margin-top: 80px
    }

    @media screen and (max-width: 600px) {

      .modulos-container {
        padding: 0;
      }

      #modulos-adicionais {
        padding: 20px
      }

      .img-stacked {
        margin-top: 0px
      }

      .display-4 {
        font-size: 2.5rem
      }

      .fs-25 {
        font-size: 18px !important
      }
    }
  </style>
</head>

@if (Route::has('login')&&0)
<div class="top-right links">
  @auth
  <a href="{{ url('/home') }}">Home</a>
  @else
  <a href="{{ route('login') }}">Login</a>

  @if (Route::has('register'))
  <a href="{{ route('register') }}">Register</a>
  @endif
  @endauth
</div>
@endif

<body>
  <div id="start" class="bg-image">
    <nav id='indexNav' class="navbar navbar-expand-md navbar-dark fixed-top row" style='transition: all 0.6s linear'>

      <a class="navbar-brand p-0 p-md-2 mr-0 col-2 col-sm-4 col-md-3 col-lg-3" href="#start">
        <img src="{{asset('png/logowhite.png')}}" class="d-inline-block align-top p-2 p-md-0" style="max-height:60px" alt="Health Register">
      </a>

      <div class="collapse navbar-collapse col-md-6 col-lg-6" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
          <a class="nav-item nav-link" href="#modulos">MÓDULOS</a>
          <a class="nav-item nav-link" href="#modulos-adicionais"> ADICIONAIS</a>
          <a class="nav-item nav-link" href="#pages-carousel">TRANSFORME SEU NEGÓCIO</a>
          <a class="nav-item nav-link" href="#video-institucional">VIDEO INSTITUCIONAL</a>
          <a class="nav-item nav-link" href="#planos">PLANOS</a>
        </div>
      </div>

      <span class="navbar-text p-0 p-sm-2 p-md-3 col-8 col-sm-4 col-md-3 col-lg-3 text-center">
        <div class="btn-group">
          <button type="button" class="btn btn-link text-light dropdown-toggle p-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sign-in-alt"></i>
            Entrar
          </button>
          <div class="dropdown-menu dropdown-menu-md-right center-x shadow" style="width:19em; background-color: #ffffffee">
            <form method="POST" class="p-3" action="{{ route('login') }}">
              @csrf
              <h5>{{ __('index_login_title') }}</h5>
              <p>{{ __('index_login_subtitle') }}</p>
              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-at"></i></span>
                </div>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('login_email_placeholder') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>

              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('login_password_placeholder') }}" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <button name="logar" class="btn btn-primary btn-block">{{ __('login_do') }}</button>
            </form>
            <div class="dropdown-divider"></div>
            @if (Route::has('register'))
              <a class="dropdown-item bg-primary" href="{{ route('register') }}">{{ __('index_login_register') }}</a>
            @endif
          </div>
        </div>
      </span>

      <button class="navbar-toggler p-0 p-sm-2 col-2 col-sm-3" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style='width:1.2em'></span>
      </button>

    </nav>

    <div class="jumbotron mb-0">
      <div class="container">
        <h1 class="display-4">{{ __('index_title') }}</h1>
        <p class="lead">{{ __('index_subtitle') }}</p>
        <hr class="my-4">
        <button class="btn btn-outline-light fs-25 rounded-pill w-25" style="min-width: 140px">
          <p class='m-0'>Teste grátis</p>
        </button>
        <button class="btn btn-outline-light fs-25 rounded-pill w-25" style="min-width: 140px">
          <p class='m-0'>Outro</p>
        </button>
      </div>
    </div>
  </div>

  <div id='modulos' class="container py-5 text-center">
    <b class="fs-40">ADMINISTRAÇÃO COMPLETA DO SEU NEGÓCIO</b>
    <p class="fs-15">Mais controle e gestão otimizada do tempo</p>
    <hr>
    <div id='card-collection'></div>
  </div>

  <div id='modulos-adicionais' style="background-image: linear-gradient(135deg,#027777,#149999,#A5CED1); min-height: 550px">
    <div class="row">
      <div class="col-12 col-md-7">
        <div class="container py-md-5 text-light modulos-container">

          <b class="fs-40">MÓDULOS ADICIONAIS</b>
          <p class="fs-15">Contrate funcionalidades adicionais e transforme seu dia a dia para melhor</p>
          <hr>
          <div class="accordion" id="modulos-accordion">
            <div class="card mb-3">
              <div class="card-header p-0" id="headingOne">
                <button class="btn fs-20 p-3 w-100 text-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <b class="mb-0">Módulo #1</b>
                  <i class="fas fa-chevron-down float-right"></i>
                </button>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#modulos-accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header p-0" id="headingTwo">
                <button class="btn fs-20 p-3 w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <b class="mb-0">Módulo #2</b>
                  <i class="fas fa-chevron-down float-right"></i>
                </button>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#modulos-accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header p-0" id="headingThree">
                <button class="btn fs-20 p-3 w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <b class="mb-0">Módulo #3</b>
                  <i class="fas fa-chevron-down float-right"></i>
                </button>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#modulos-accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-5">
        <img src="{{asset('png/examples/exemplo-pages-stacked.png')}}" class='img-stacked'>
      </div>
    </div>
  </div>

  <div id='pages-carousel' class="py-5 text-center">
    <div class="container">
      <b class="fs-40">TRANSFORME SEU NEGÓCIO</b>
      <p class="fs-15">Veja na prática como o Health Register pode ajudar no seu dia a dia</p>
      <hr class="my-4">
    </div>
    <div class="row">
      <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel" data-slide-to="0" class="active"></li>
          <li data-target="#carousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="d-none d-lg-block">
              <div class="slide-box">
                <img src="{{asset('png/examples/realize_anamneses.png')}}" height="250" alt="First slide">
                <img src="{{asset('png/examples/realize_evolucoes.png')}}" height="250" alt="First slide">
                <img src="{{asset('png/examples/integre_agenda.png')}}" height="250" alt="First slide">
                <!-- <img src="{{asset('png/examples/administre_financas.png')}}" height="200" alt="First slide"> -->
              </div>
            </div>
            <div class="d-none d-md-block d-lg-none">
              <div class="slide-box">
                <img src="{{asset('png/examples/realize_anamneses.png')}}" height="200" alt="First slide">
                <img src="{{asset('png/examples/realize_evolucoes.png')}}" height="200" alt="First slide">
                <!-- <img src="{{asset('png/examples/integre_agenda.png')}}" height="200" alt="First slide"> -->
              </div>
            </div>
            <div class="d-none d-sm-block d-md-none">
              <div class="slide-box">
                <img src="{{asset('png/examples/realize_anamneses.png')}}" height="200" alt="First slide">
                <img src="{{asset('png/examples/realize_evolucoes.png')}}" height="200" alt="First slide">
              </div>
            </div>
            <div class="d-block d-sm-none">
              <img class="d-block w-100" src="{{asset('png/examples/realize_anamneses.png')}}" height="200" alt="First slide">
            </div>
          </div>
          <div class="carousel-item">
            <div class="d-none d-lg-block">
              <div class="slide-box">
                <img src="{{asset('png/examples/administre_financas.png')}}" height="250" alt="Second slide">
                <img src="{{asset('png/examples/integre_agenda.png')}}" height="250" alt="Second slide">
                <img src="{{asset('png/examples/realize_evolucoes.png')}}" height="250" alt="Second slide">
                <!-- <img src="https://picsum.photos/285/200/?image=7&random" alt="Second slide"> -->
              </div>
            </div>
            <div class="d-none d-md-block d-lg-none">
              <div class="slide-box">
                <img src="{{asset('png/examples/administre_financas.png')}}" height="250" alt="Second slide">
                <img src="{{asset('png/examples/integre_agenda.png')}}" height="250" alt="Second slide">
                <!-- <img src="https://picsum.photos/240/200/?image=5&random" alt="Second slide"> -->
              </div>
            </div>
            <div class="d-none d-sm-block d-md-none">
              <div class="slide-box">
                <img src="{{asset('png/examples/administre_financas.png')}}" height="200" alt="Second slide">
                <img src="{{asset('png/examples/integre_agenda.png')}}" height="200" alt="Second slide">
              </div>
            </div>
            <div class="d-block d-sm-none">
              <img class="d-block w-100" src="{{asset('png/examples/administre_financas.png')}}" height="200" alt="Second slide">
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>

  <div id="video-institucional" class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
  </div>

  <div id="planos" class="container py-5 text-center">
    <b class="fs-40">ESCOLHA O SEU PLANO IDEAL</b>
    <p class="fs-15">
      Disponível em três modelos de planos que irão organizar de forma
      rápida e fácil a produtividade e lucratividade do seu negócio
    </p>
    <hr>
    <div id="card-collection2"></div>
  </div>

  <footer class="footer mt-auto py-3 px-2 bg-image text-light" style="background-image: linear-gradient(#13707daa, #13707daa), url('{{asset('png/index-bg-old.jpg')}}') !important;">
    <div class="container">
      <b class="fs-25">HEALTH REGISTER</b>
      <p>O melhor software de gerenciamento para clínicas e consultórios médicos.</p>
    </div>
    <div class="row">
      <div class="col-6 text-left">© Copyright 2019</div>
      <div class="col-6 text-right">Desenvolvido por
        <a class='text-dark' href="mailto:matheusfs97@gmail.com"><b>Matheus Ferreira</b></a>
        <a target="_blank" href="https://github.com/MatheusFS"><img src="{{asset('png/github.webp')}}" width="25" alt="MatheusFS - GitHub"></a>
        <a target="_blank" href="https://www.workana.com/freelancer/21adfebbf9ca6e933232c6ff40cd2623"><img src="{{asset('png/workana-icon.webp')}}" width="20" alt="MatheusFS - Workana"></a>
      </div>
    </div>
  </footer>

  <?php if (isset($msgflag)) echo "<script>toastr.error('" . lang('login_error_msg_text') . "', '" . lang('login_error_msg_title') . "');</script>"; ?>
</body>

<script type="text/javascript" src="{{asset('js/pages/index.js')}}" defer></script>