<!doctype html>
<html lang="en">

<head>
  <!--Meta tags requeridas pelo Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <link href="../VIEW/css/resetA.css" rel="stylesheet">
  <link href="../VIEW/css/login.css" rel="stylesheet">


  <title>Conectar-se</title>
</head>

<body class="container-fluid">

  <main class="row">
    <div id="alert_wrapper">

    </div>


    <div id="img-login" class="col-sm-5 px-0 d-none d-xl-block">
      <img src="../VIEW/img/loginimg.jpg" alt="login image">
      <span class="cred">Photo by <a href="https://unsplash.com/@martinadams">Martim Adams</a> on <a href="https://unsplash.com/">Unsplash</a></span>
    </div>

    <div class="col-xl-7 form-container">
      <div class="form-wrapper">

        <h1>Conectar-se</h1>
        <hr class="hr">

        <form id="formLogin" method="POST">

          <input type="text" name="user" class="form-control" placeholder="Nome de Usuário">

          <input type="password" name="password" class="form-control" placeholder="Senha">


          <button name="login" id="login" class="btn">ENTRAR</button>
        </form>

        <a href="#!" id="r_senha">Recuperar senha</a><br>
        <a href="#!" id="cadastro">Ainda não possui login? Cadastrar-se</a></p>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../VIEW/js/login.js"></script>


</body>

</html>