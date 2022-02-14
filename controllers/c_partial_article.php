<?php


$category = gmp_init($content["p_category"]) & 0b111100;
$title=$content['p_title'];
$margins=0;
$redback=0;
$articleborder=0;
$dates=1;
$canedit   = $loggedin && ((gmp_init($_SESSION['perms']) & gmp_init($content['p_category'])) != 0) ;
$isdeleted = (gmp_init($content['p_category']) & 512) != 0;

if ($displayas=="fullpage"){
    switch ($category){
        case 4:  //estatico
            $title=0;
            $dates=0;
            include 'partials/post.php';
            break;
        case 8: //post
            $margins=1;
            include 'partials/post.php';
            break;
        case 16: //voto
            $margins=1;
            include 'partials/post.php';
            break;
        case 32: //alerta
            $margins=1;
            $redback=1;
            $articleborder=1;
            break;
    }
} else if ($displayas=="infeed") {
    switch ($category){
        case 8: //post
            include 'partials/post.php';
            break;
        case 16: //voto
            include 'partials/post.php';
            break;
        case 32: //alerta
            $redback=1;
            include 'partials/post.php';
            break;
    }
}



