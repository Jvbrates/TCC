<!doctype html>
<html lang="en">

<head>
  <!--Meta tags requeridas pelo Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <base href="http://localhost/TCC/VIEW/" target="_self">

  <!-- Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

  <!-- CSS próprio-->
  <link href="css/template.css" type="text/css" rel="stylesheet">

  <!--Dark/Light Theme-->
  <script src="js/themeColor.js"></script>

  <title>Catálogo de Cursos</title>
</head>


<body class="container-fluid ">



  <nav class="navbar navbar-expand-lg navbar-dark sticky-top mt-2 bar">
    <div class="container-fluid">
      <!---Logo e nome do sistema com link para a página inicial-->
      <a id="logo" class="navbar-brand" aria-current="page" href="http://localhost/TCC/home">
        <img src="img/SquareFill.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Catálogo de Cursos
      </a>

      <!--- botão menu do modo mobile --->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!--- Opções que serão escondidas no menu-->
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="http://localhost/TCC/user/favoritos" tabindex="-1"><i class="bi bi-heart-fill"></i> Favoritos</a></li>
        </ul>

        <div class=" form-check form-switch">
          <input class="form-check-input" type="checkbox" id="cores">
          <div id="themeColor">
            <i id="sun" class="bi bi-brightness-low-fill" style="color: var(--bar-color);"></i>
            <i id="moon" class="bi bi-moon-stars-fill" style="color: rgb(245, 248, 250);"></i>
          </div>
        </div>
        <a class="navbar-brand " href="http://localhost/TCC/login/login" tabindex="-1" aria-disabled="true">
          Conectar-se
          <i class="bi bi-box-arrow-in-left"></i>
        </a>


      </div>
    </div>
  </nav>



  <!-- Carregamento da página dentro do template-->
  <main class="row m-0">

    <!-- modal Editar dados-->

    <div class="modal" id="senhaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form id="formSenha" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Alterar senha</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="">Senha Atual</label>
              <input type="password" class="form-control" name="senha" placeholder="">

              <label for="">Nova Senha</label>
              <input type="password" class="form-control" name="nsenha" placeholder="">

              <label for="">Repetir Senha</label>
              <input type="password" class="form-control" name="" placeholder="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="nsenhaSubmit" class="btn btn-primary">Salvar</button>
          </div>

        </div>

      </form>
    </div>
    <!-- modal Aviso -->
    <div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>

        </div>
      </div>
    </div>

    <!-- btn modal Aviso -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" id="btn_modalAviso" data-bs-target="#avisoModal">
      Launch demo modal
    </button>
    <!-- Carregamento da página dentro do template-->

    <div class="col-lg conteudo blur px-4 py-2">
      <?php 
      
      $this->carregarViewinTemplate($viewName, $dados, $toJavascript); ?>
    </div>



  </main>


  <script src="js/themeToggle.js"></script>

  <!-- Bootstrap Bundle e Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</body>

</html>