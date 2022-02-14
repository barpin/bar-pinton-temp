<?php
$title="Administrador de codigos";
$headertags='';/*
<script src="/js/lib.js"></script>
';*/


require_once 'assets/session_start.php';
require_once 'assets/database.php';


$query=$posts_data_query."WHERE posts.id = ${article} ORDER BY t_replaced_at IS NULL DESC, t_replaced_at DESC";

$posts=entries($link, $query);
if ( count($posts) < 1){
    $_SESSION["msg"]="Este post no se encontro ";
    $_SESSION["icon"]="error";
    header('Location: /404');
    exit;
}

$title = $posts[0]['p_title'];
$displayas="inhist";

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/history.php';
include_once 'partials/footer.php';