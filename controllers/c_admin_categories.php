<?php
$title="Administrador de Usuarios";
$headertags='
<link href="/css/codes.css" rel="stylesheet">
<script src="/js/lib.js"></script>
<script src="/js/categories.js" defer></script>
';


require_once 'assets/session_start.php';
require_once 'assets/database.php';

if ((gmp_init($_SESSION['perms']) & 4096) == 0 ){
    $_SESSION["msg"]="No Tenes Permiso para administrar categorias!";
    $_SESSION["icon"]="error";
    header('Location: /');
}
$query="SHOW COLUMNS FROM categories";
$tablehead=array_map(function($x){return $x['Field'];}, entries($link, $query));
$query="SELECT ".join(", ",$tablehead)." FROM categories";
$categorylist=entries($link, $query);

//$jsvars=['userperms'=>$_SESSION['perms']];

$permsdata=entries($link, "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) ");
$isroot=$_SESSION['id']==="0";
$jsvars=['perms'=>$_SESSION['perms'], 'permsdata'=>entries($link, "SELECT * FROM categories", false, 'id')];



require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/admin_categories.php';
include_once 'partials/footer.php';