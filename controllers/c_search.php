<?php
$title="Busqueda";
$headertags="<link href='/css/feed.css' rel='stylesheet'><script src='/js/dropdownfuncs.js' defer>";

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
}

require_once 'assets/session_start.php';
require_once 'assets/database.php';

$categoryquery=getpost('c');
$searchquery=getpost('q');
ob_start();
include('api/feed.php');
$apijson = ob_get_contents();
ob_end_clean();

$posts=json_decode($apijson);

$resultsquery=$posts_data_query."WHERE ";
foreach ($posts as $ipost){
  $resultsquery.=" posts.id = ${ipost} OR ";
}
$resultsquery.=0;
$results=entries($link, $resultsquery);
$displayas="infeed";

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/search.php';
include_once 'partials/footer.php';