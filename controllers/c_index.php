<?php
$title="¡Bienvenido a la pagina del centro de estudiantes!";
$headertags='<link href="/css/apithing.css" rel="stylesheet">';

require_once 'assets/session_start.php';
require_once 'assets/database.php';

$hashero=true;



$notcategory = 2**2 | 2**5;  //TODO FUNNY STUFF WITH CATEGORIES HERE PLEASE FIX & |
$votecategory = 2 | 2**4;    
$alertcategory = 2 | 2**5;
$query=$posts_data_query."WHERE textupdates.replaced_at IS NULL AND posts.category ";
$queryend=" AND posts.deleted_at IS NULL ORDER BY posts.created_at DESC";
$alerts = entries( $query."& ${alertcategory} = ${alertcategory}".$queryend);
$votes  = entries( $query."& ${votecategory} = ${votecategory} AND posts.end_date > NOW()".$queryend);
$posts  = entries( $query."& ${notcategory} = 0 AND posts.category & 2 = 2 AND ( posts.end_date < NOW() OR posts.end_date IS NULL)".$queryend);
$preentries = array_merge($alerts, $votes, $posts);
$displayas="snippet";
//echo "<script>console.log(`";var_dump($entries);echo "`)</script>";
$entries1=array_slice($preentries,0,4); //usort(, fn ($x)=>"");
$entries2=array_slice($preentries,4);
usort($entries1, fn($x)=>mb_strlen($x['t_content']));
usort($entries1, fn($y, $x)=>$y);
usort($entries2, fn($x)=>mb_strlen($x['t_content']));
$entries=array_merge($entries1, $entries2);

$sccentries=entries($posts_data_query."WHERE textupdates.replaced_at IS NULL AND ( posts.category & 56 ) != 0 AND ( posts.category & 2 ) = 0 AND ( posts.category & 448 ) != 0 ");

$nxtarticle = function (&$entries, $sniplen=400) use ($loggedin, $displayas, $allcategoriesassoc){
  if ($content=current($entries)){
    next($entries);
    include 'controllers/c_partial_article.php';
}
};


require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/index.php';
include_once 'partials/footer.php';