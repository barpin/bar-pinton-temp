<?php


$category = gmp_init($content["p_category"]) & 0b111100;
$title=$content['p_title'];
$margins=0;
$redback=0;
$showauthor= $showauthor ?? 0;
$articleborder=0; //normally managed by feed. Maybe it shoudnt? TODO
$dates=1;
$canedit   = $loggedin && ((gmp_init($_SESSION['perms']) & gmp_init($content['p_category'])) != 0) ;
$isdeleted = (gmp_init($content['p_category']) & 512) != 0;
$isreplaced = $content['t_replaced_at'];
$restore=0;
$viewhist=1;
$viewdetails=1;
$showcategories=1;
$snippetdirection=$snippetdirection ?? "vertical";

$content['t_content']=htmlspecialchars_decode($content['t_content']);
$content['t_css']=isset($content['t_css']) ? htmlspecialchars_decode($content['t_css']): null;

if ($displayas=="fullpage"){
    $viewdetails=0;
    switch ($category){
        case 4:  //estatico
            $title=0;
            $showcategories=0;
            $dates=0;
            break;
        case 8: //post
            $margins=1;
            break;
        case 16: //voto
            $margins=1;
            break;
        case 32: //alerta
            $margins=1;
            $redback=1;
            $articleborder=1;
            break;
    }
} else if ($displayas=="infeed") {
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            break;
    }
} else if ($displayas=="inhist") {
    $showauthor=1;
    $margins=1;
    $articleborder=1;
    $restore=$canedit;
    $canedit=0;
    $viewhist=0;
    
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
} else if ($displayas=="snippet") {
    $shadowcontain=true;
    $shortenstrip=true;

    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
} else if ($displayas=="searchresult") {
    $shadowcontain=true;
    $shortenstrip=true;
    $snippetdirection="horizontal";
    $searchquery=$searchquery ?? null; //this does nothing i think but listing everything passed on is a good idea
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
}

if ($category==16){
    $voteoptions=json_decode($content['p_options']);
    if (new dateTime($content['p_end_date']) < new dateTime() || !$loggedin){
        $votephase=2;
    } else {
        $query="SELECT * FROM votescast WHERE post_id = ${content['p_id']} AND user_id = ${_SESSION['id']}";
        if (qq($link, $query)->num_rows){
            $votephase=2;
        } else {
            $votephase=1;
        }
    }

    if ($votephase==2){ 
        $query="SELECT vote,COUNT(1) as OccurenceValue FROM votesresults WHERE post_id=${content['p_id']} GROUP BY vote ;";
        $votesresults=entries($link, $query);
    }
} else {
    $votephase=0;
}

if ($showcategories){
    $parentcats=0;
    $tempcatassoc=[];
    $showncategoryarr=[];
    foreach ($allcategoriesassoc as $fcatid=>$fcat){
        if ( ((2**gmp_init($fcatid)) & $content['p_category'])!=0 ){
            $parentcats|=$fcat['parents'];
            $tempcatassoc[$fcatid]=$fcat;
        }
    }
    
    foreach ($tempcatassoc as $fcatid=>$fcat){
        //echo "<br> ".$fcatid." ".$fcat." ".$parentcats." ";

        if ( ($parentcats & (2**gmp_init($fcatid))) == 0 ){
            $showncategoryarr[$fcatid]=$fcat;

        }
    }
    $showncategoryarr=$tempcatassoc;
}

include 'partials/post.php';


