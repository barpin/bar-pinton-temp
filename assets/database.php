<?php

require_once('credentials.php');
GLOBAL $link;
$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($link, "utf8");
if(!$link){
    echo "Connection error" . "<br>";
    echo mysqli_connect_error() ;
    exit();
}


function qq ($query, $exitCode=false){
    GLOBAL $link;
    if(!($tres = mysqli_query($link, $query))){
        if ($exitCode){
            header("HTTP/1.1 ${exitCode}");
            exit;
        } else {
            exit(mysqli_error($link)." , in query ".$query);
        }
    }
    return $tres;
}

function entries ($query, $fetchrow = false, $assoc=false, $exitCode=false){
    $entries=qq($query, $exitCode);
    $entryarr=[];
    while($row= $fetchrow ? $entries->fetch_row() : $entries->fetch_assoc()){
        if ($assoc){
            $entryarr[$row[$assoc]]=$row;
        } else {
            $entryarr[]=$row;
        }
    }
    return $entryarr;
}

function sanitize ( $text){
    GLOBAL $link;
    return str_replace("\r\n", "\n", mysqli_real_escape_string($link, htmlspecialchars($text)));
}

function getcols(){
    $colstr="";
    $query="select concat('posts.', column_name, ' as p_', column_name, ', ') AS cols from Information_Schema.columns c where table_name = 'posts' UNION ALL select concat('textupdates.', column_name, ' as t_', column_name, ', ') AS cols from Information_Schema.columns c where table_name = 'textupdates'";
    foreach (entries( $query, true) as $scstr ){
        $colstr.=$scstr[0];
    }
    
    return rtrim($colstr, ", ").", users.id as u_id, IFNULL(users.nickname, users.name) as u_name ";
}

function getpost($varname){
    return $_GET[$varname] ?? $_POST[$varname] ?? false; //this should have been null but its too late now
}

$posts_data_inners= " FROM posts INNER JOIN textupdates ON posts.id = textupdates.post_id INNER JOIN users ON users.id = textupdates.author_id ";

$posts_data_query="SELECT ".getcols().$posts_data_inners;

$allcategoriesassoc=entries( "SELECT * FROM categories", false, "id");

