<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<style>
  ion-icon{
    margin-top: 5px;
    font-size: 24px;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link font-sans" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="funcionamientodelcentro.php">Funcionamiento del centro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="comisiones.php">Comisiones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-sans" href="clubes.php">Clubes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle font-sans" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Contacto secretarias
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
      <li class="nav-item">
        <a class="nav-link font-sans" href="login.php">Iniciar sesion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-sans" href="register.php">Registrarse</a>
      </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>