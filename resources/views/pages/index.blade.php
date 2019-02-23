@extends('essentials/global')

<head>
  <script type="text/javascript" src="index.js"></script>
  <title>Health Register ~ Início</title>
</head>

<body class="bg-info">
  <form method="post">
    <h1 class="m-3 fs-25 text-light">Health Register</h1>
    <div class="container col-lg-6">
      <div class="bg-light border rounded p-3">
        <h5>Entrar no aplicativo</h5>
        <p>Por favor insira seu e-mail e senha</p>
        <div class="input-group mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-at"></i></span>
          </div>
          <input type="email" class="form-control" name="login" placeholder="Endereço de e-mail">
        </div>

        <div class="input-group mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Senha">
        </div>

        <div class="forgot">
          <a href="cadastro.php">Ainda não é cadastrado?</a>
        </div>
        <button name="logar" class="btn btn-primary">Entrar</button>
      </div>
    </div>
  </form>
    
            @if (Route::has('login'))
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
    
</body>