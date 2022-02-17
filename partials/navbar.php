<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a href="/" style="height:50px;width:50px">
      <img src="/img/logo.jpg" alt="">
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
            <li><a class="dropdown-item font-sans" href="/noticias">Noticias</a></li>
            <li><a class="dropdown-item font-sans" href="/todo">Todo</a></li>
            <li><a class="dropdown-item font-sans" href="/contacto">Contacto</a></li>
            <li><a class="dropdown-item font-sans" href="/miembros">Miembros</a></li>
            <li><a class="dropdown-item font-sans" href="/reuniones">Reuniones de Delegados</a></li>
            <li><a class="dropdown-item font-sans" href="/elecciones">Elecciones</a></li>
            <li><a class="dropdown-item font-sans" href="/transparencia">Transparencia</a></li>
            <li><a class="dropdown-item font-sans" href="/docs">Informacion Tecnica</a></li>

          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="/comisiones">Comisiones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="/clubes">Clubes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Secretarias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-sans" href="/secretarias">Secretarias</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/internos">Secretaria de asuntos internos</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/finanzas">Secretaria de finanzas</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/genero">Secretaria de género</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/cultura">Secretaria de cultura</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/estudiantiles">Secretaria de nota y asuntos estudiantiles</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/edilicios">Secretaria de asuntos edilicios</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/prensa">Secretaria de prensa y difusión</a></li>
            <li><a class="dropdown-item font-sans" href="/secretaria/noche">Secretaria del turno noche</a></li>
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
            <?= ($_userperms & 0b10000000000) == 0b10000000000 ? '<li><a class="dropdown-item font-sans" href="/admin/codes">Administrar Codigos</a></li>' : "" ?>
            <?= ($_userperms & 0b100000000000) == 0b100000000000 ? '<li><a class="dropdown-item font-sans" href="/admin/users">Administrar Usuarios</a></li>' : "" ?>
            <?= ($_userperms & 0b1000000000000) == 0b1000000000000 ? '<li><a class="dropdown-item font-sans" href="/admin/cats">Administrar Categorias</a></li>' : "" ?>
          </ul>
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