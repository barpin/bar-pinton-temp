<?php
//$url = strpos($_SERVER['REQUEST_URI'], "?")===false ? $_SERVER['REQUEST_URI'] :  strstr($_SERVER['REQUEST_URI'],"?",true);
include 'assets/ver.php';
require_once 'assets/database.php';

$query=$posts_data_query;
if (isset($version)){
    $query.="WHERE textupdates.id = ${version} AND posts.id = ${article}";
    $showauthor=1;
} else {
    $query.="WHERE textupdates.replaced_at IS NULL AND posts.id = ${article}";

}

$result=qq($query);
if ( !$result->num_rows == 1){
    $_SESSION["msg"]="Este post no se encontro (o se encontro mas de 1). Asegurese de que tenga un texto relacionado"; // El usuario y/o contraseña esta mal
    $_SESSION["icon"]="error";
    header('Location: /404');
    //echo $query;
    //exit();
}
$content = $result->fetch_assoc(); 
$title = $content['p_title'];    



$headertags="<script src='/js/dropdownfuncs.js?version=${ver}' defer></script>"."<style>${content['t_css']}</style>";
$displayas="fullpage";
require_once 'assets/session_start.php';

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'controllers/c_partial_article.php';
include_once 'partials/footer.php';


