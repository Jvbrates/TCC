<!doctype html>
<html lang="en">
  <head>
    <!--Meta tags requeridas pelo Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <base href="http://localhost/TCC/VIEW/" target="_self">
    <link href="css/template.css" type="text/css" rel="stylesheet">
    <!-- CSS próprio-->
   

    <title>Sistema</title>
  </head>


  <body class="container-fluid">



<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <!---Logo e nome do sistema com link para a página inicial-->
    <a class="navbar-brand" aria-current="page" href="http://localhost/TCC/home">
    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
              Sistema
    </a>

    <!--- botão menu do modo mobile --->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!--- Opções que serão escondidas no menu-->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="http://localhost/TCC/user/favoritos" tabindex="-1">Favoritos</a></li>
        <li class="nav-item"><a class="nav-link" href="http://localhost/TCC/user/perfil" tabindex="-1">Meu Dados</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gerenciar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="http://localhost/TCC/cidades/admin">Cidades</a></li>
            <li><a class="dropdown-item" href="http://localhost/TCC/cursos/admin">Cursos</a></li>
            <li><a class="dropdown-item" href="http://localhost/TCC/instituicoes/admin">Instituições</a></li>
          </ul>
        </li>
      </ul>
      
      
      <a class="navbar-brand " href="http://localhost/TCC/login/logoff" tabindex="-1" aria-disabled="true">
          Desconectar-se 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"></path>
            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
          </svg>
      </a>
      

    </div>
  </div>
</nav>



    <!-- Carregamento da página dentro do template-->
    <main class="p-10">

    <?php $this->carregarViewinTemplate($viewName, $dados, $toJavascript);?>
    </main>

    <!-- Bootstrap Bundle e Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    tipo 1 ==> moderador logado
  </body>
</html>

