<?php
//$url = strpos($_SERVER['REQUEST_URI'], "?")===false ? $_SERVER['REQUEST_URI'] :  strstr($_SERVER['REQUEST_URI'],"?",true);
require_once 'assets/database.php';

function getcols($link){
    $colstr="";
    $query="select concat('posts.', column_name, ' as p_', column_name, ', ') AS cols from Information_Schema.columns c where table_name = 'posts' UNION ALL select concat('textupdates.', column_name, ' as t_', column_name, ', ') AS cols from Information_Schema.columns c where table_name = 'textupdates'";
    foreach (entries($link, $query, true) as $scstr ){
        $colstr.=$scstr[0];
    }
    return rtrim($colstr, ", ");
}
$cols=getcols($link);
$query="SELECT ${cols} FROM posts INNER JOIN textupdates ON posts.id = textupdates.post_id ";
if (isset($version)){
    $query.="WHERE textupdates.id = ${version}";
} else {
    $query.="WHERE textupdates.replaced_at IS NULL AND posts.id = ${article}";

}

$result=qq($link, $query);
if ( !$result->num_rows == 1){
    header('Location: /404');
    //echo $query;
    //exit();
}
$content = $result->fetch_assoc(); 
$title = $content['p_title'];    

$headertags="<style>${content['t_css']}</style>";

require_once 'assets/session_start.php';

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/article.php';
include_once 'partials/footer.php';


