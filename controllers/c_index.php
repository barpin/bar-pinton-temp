<?php
$title="¡Bienvenido a la pagina del centro de estudiantes!";
$headertags='<link href="/css/apithing.css" rel="stylesheet">';

require_once 'assets/session_start.php';

$hashero=true;

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/index.php';
include_once 'partials/footer.php';