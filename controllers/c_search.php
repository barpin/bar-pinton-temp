<?php
$title="Busqueda";
$headertags="<link href='/css/feed.css' rel='stylesheet'><script src='/js/dropdownfuncs.js' defer>";
/*
function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    var_dump( curl_getinfo($ch));
    curl_close($ch);

    return $data;
}*/

function stripos_any($needles, $haystack, $offset=0){
  
  if (strlen($haystack)<=$offset){
    return [false,""];
  } else {
    $lowestneedle="";
    $lowestneedlepos=strlen($haystack);
    foreach($needles as $needle){
        if (((($nstripos=stripos($haystack, $needle, $offset))!==false) && $nstripos<$lowestneedlepos) || ($nstripos==$lowestneedlepos && strlen($needle)>strlen($lowestneedle))){
            $lowestneedlepos=$nstripos;
            $lowestneedle=$needle;
        } 
    }

    if ($lowestneedlepos==strlen($haystack)){
        $lowestneedlepos=false;
    }
    return [$lowestneedlepos,$lowestneedle];
  }
}

function mb_stripos_any($needles, $haystack, $offset=0){
  
  if (mb_strlen($haystack)<=$offset){
    return [false,""];
  } else {
    $lowestneedle="";
    $lowestneedlepos=mb_strlen($haystack);
    foreach($needles as $needle){
        if (((($nstripos=mb_stripos($haystack, $needle, $offset))!==false) && $nstripos<$lowestneedlepos) || ($nstripos==$lowestneedlepos && mb_strlen($needle)>mb_strlen($lowestneedle))){
            $lowestneedlepos=$nstripos;
            $lowestneedle=$needle;
        } 
    }

    if ($lowestneedlepos==mb_strlen($haystack)){
        $lowestneedlepos=false;
    }
    return [$lowestneedlepos,$lowestneedle];
  }
}

require_once 'assets/session_start.php';
require_once 'assets/database.php';

$categoryquery=sanitize($link, getpost('c'));
$searchquery=sanitize($link, getpost('q'));
$showreplaced=false;
ob_start();
include('api/feed.php');
$apijson = ob_get_contents();
ob_end_clean();

$posts=json_decode($apijson);

$templatequery=$posts_data_query."WHERE posts.id =  ";
$querylist=[];
foreach ($posts as $ipost){
  $querylist[]=$templatequery." ${ipost} ".($showreplaced ? "" : " AND replaced_at IS NULL ");
}
$resultsquery=implode(" UNION ALL ", $querylist);
$results=entries($link, $resultsquery);
$displayas="searchresult";

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/search.php';
include_once 'partials/footer.php';