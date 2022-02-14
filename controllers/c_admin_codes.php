<?php
$title="Administrador de codigos";
$headertags='<link href="/css/codes.css" rel="stylesheet"><script src="/js/lib.js"></script>';


require_once 'assets/session_start.php';
require_once 'assets/database.php';

if ((gmp_init($_SESSION['perms']) & 1024) == 0 ){
    $_SESSION["msg"]="No Tenes Permiso para administrar codigos!";
    $_SESSION["icon"]="error";
    header('Location: /');
}
$query="SHOW COLUMNS FROM users";
$tablehead=entries($link, $query);
$query="SELECT * FROM users WHERE users.password IS NULL";
$codeslist=entries($link, $query);

//$jsvars=['userperms'=>$_SESSION['perms']];

$permsdata=entries($link, "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) ");

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/admin_codes.php';
include_once 'partials/footer.php';