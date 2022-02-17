<?php
$title="Administrador de Usuarios";
$headertags='
<link href="/css/codes.css" rel="stylesheet">
<script src="/js/lib.js"></script>
<script src="/js/users.js" defer></script>
';


require_once 'assets/session_start.php';
require_once 'assets/database.php';

if ((gmp_init($_SESSION['perms']) & 2048) == 0 ){
    $_SESSION["msg"]="No Tenes Permiso para administrar usuarios!";
    $_SESSION["icon"]="error";
    header('Location: /');
}
$query="SHOW COLUMNS FROM users WHERE Field != 'password'";
$tablehead=array_map(function($x){return $x['Field'];}, entries($link, $query));
$query="SELECT ".join(", ",$tablehead)." FROM users WHERE created_at IS NOT NULL";
$userlist=entries($link, $query);

//$jsvars=['userperms'=>$_SESSION['perms']];

$permsdata=entries($link, "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) ");
$isroot=$_SESSION['id']==="0";

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/admin_users.php';
include_once 'partials/footer.php';