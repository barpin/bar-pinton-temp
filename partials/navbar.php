<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
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
            <li><a class="dropdown-item font-sans" href="funcionamientodelcentro.php">Funcionamiento del centro</a></li>
            <li><a class="dropdown-item font-sans" href="#">Estatuto</a></li>
            <li><a class="dropdown-item font-sans" href="#">Informacion del Sitio</a></li>
            <li><a class="dropdown-item font-sans" href="#">Noticias</a></li>
            <li><a class="dropdown-item font-sans" href="#">Contacto</a></li>
            <li><a class="dropdown-item font-sans" href="#">Miembros</a></li>
            <li><a class="dropdown-item font-sans" href="#">Informacion Tecnica</a></li>

          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="comisiones.php">Comisiones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="clubes.php">Clubes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Secretarias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="#">Secretaria de asuntos internos</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria de finanzas</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria de género</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria de cultura</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria de nota y asuntos estudiantiles</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria de asuntos edilicios</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria de prensa y difusión</a></li>
            <li><a class="dropdown-item font-sans" href="#">Secretaria del turno noche</a></li>
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
        <li class="nav-item">
          <a class="nav-link font-sans" href="/logout">Cerrar sesion</a>
        </li>
      <?php } ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>