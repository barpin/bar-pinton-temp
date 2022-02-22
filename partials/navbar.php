<?php include_once 'assets/database.php';$hashero=$hashero??false; ?>
  

<nav class="navbar navbar-expand-lg <?= $hashero ? "navbar-dark" : "navbar-light" ?> bg-faded shadow-5-strong">
  <div class="container-fluid">
    <a href="/" style="height:50px;width:50px;margin-right:10px;">
    <picture>
      <source srcset="/img/school_logo.webp" type="image/webp">
      <source srcset="/img/school_logo.png" type="image/png"> 
      <img src="/img/school_logo.png" alt="Logo">
    </picture>
      
    </a>
    <a class="navbar-brand" href="/">C.E.C.S.</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Informacion
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/info">Que es el centro?</a></li>
            <li><a class="dropdown-item font-sans" href="/participacion">Participacion</a></li>
            <li><a class="dropdown-item font-sans" href="/funcionamiento">Funcionamiento del centro</a></li>
            <li><a class="dropdown-item font-sans" href="/estatuto">Estatuto</a></li>
            <li><a class="dropdown-item font-sans" href="/sitio">Informacion del Sitio</a></li>
            <li><a class="dropdown-item font-sans" href="/contacto">Contacto</a></li>
            <li><a class="dropdown-item font-sans" href="/miembros">Miembros</a></li>
            <li><a class="dropdown-item font-sans" href="/transparencia">Transparencia</a></li>
            <li><a class="dropdown-item font-sans" href="/docs">Informacion Tecnica</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Novedades
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/noticias">Noticias</a></li>
            <li><a class="dropdown-item font-sans" href="/todo">Todo</a></li>
            <li><a class="dropdown-item font-sans" href="/reuniones">Reuniones de Delegados</a></li>
            <li><a class="dropdown-item font-sans" href="/elecciones">Elecciones</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Secretarias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/secretarias">Secretarias</a></li>
            <?php foreach ($allcategoriesassoc as $nsecretaria){ if ((gmp_init($nsecretaria['parents']) & 0b1000000) != 0){ ?>
              <li><a class="dropdown-item font-sans" href="/secretaria/<?= $nsecretaria['urlname'] ?>"><?= $nsecretaria['name'] ?></a></li>
            <?php } } ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Comisiones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/comisiones">Comisiones</a></li>
            <?php foreach ($allcategoriesassoc as $ncomision){ if ((gmp_init($ncomision['parents']) & 0b10000000) != 0){ ?>
              <li><a class="dropdown-item font-sans" href="/comision/<?= $ncomision['urlname'] ?>"><?= $ncomision['name'] ?></a></li>
            <?php } } ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Clubes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/clubes">Clubes</a></li>
            <?php foreach ($allcategoriesassoc as $nclub){ if ((gmp_init($nclub['parents']) & 0b100000000) != 0){ ?>
              <li><a class="dropdown-item font-sans" href="/club/<?= $nclub['urlname'] ?>"><?= $nclub['name'] ?></a></li>
            <?php } } ?>
          </ul>
        </li>
        
        <?php if (!$loggedin){ ?>
        <li class="nav-item">
          <a class="nav-link font-sans" href="/login">Iniciar sesion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="/registrar">Registrarse</a>
        </li>
        <?php } else { ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['user'] ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/logout">Cerrar sesion</a></li>
            <?php $_userperms=gmp_init($_SESSION['perms']); ?>
            <?= ($_userperms) != 0 ? '<li><a class="dropdown-item font-sans" href="/editar">Nuevo Post</a></li>' : "" ?>
            <?= ($_userperms & 0b10000000000) != 0 ? '<li><a class="dropdown-item font-sans" href="/admin/codes">Administrar Codigos</a></li>' : "" ?>
            <?= ($_userperms & 0b100000000000) != 0 ? '<li><a class="dropdown-item font-sans" href="/admin/users">Administrar Usuarios</a></li>' : "" ?>
            <?= ($_userperms & 0b1000000000000) != 0 ? '<li><a class="dropdown-item font-sans" href="/admin/cats">Administrar Categorias</a></li>' : "" ?>
          </ul>
        </li>
        <?php } ?>
      </ul>
      <form class="d-flex" action="/busqueda">
        <input class="form-control bg-white/10 focus:bg-white/25 me-2 <?= $hashero ? "text-white" : "" ?>" name="q" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>