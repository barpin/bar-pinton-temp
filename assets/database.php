<?php

require_once('credentials.php');
$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($link, "utf8");
if(!$link){
    echo "Connection error" . "<br>";
    echo mysqli_connect_error() ;
    exit();
}

function qq ($link, $query){
    if(!($tres = mysqli_query($link, $query))){exit(mysqli_error($link)." , in query ".$query);}
    return $tres;
}

function entries ($link, $query, $fetchrow = false, $assoc=false){
    $entries=qq($link, $query);
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

function sanitize ($text, $link){
    return mysqli_real_escape_string($link, htmlspecialchars($text));
}

function getcols($link){
    $colstr="";
    $query="select concat('posts.', column_name, ' as p_', column_name, ', ') AS cols from Information_Schema.columns c where table_name = 'posts' UNION ALL select concat('textupdates.', column_name, ' as t_', column_name, ', ') AS cols from Information_Schema.columns c where table_name = 'textupdates'";
    foreach (entries($link, $query, true) as $scstr ){
        $colstr.=$scstr[0];
    }
    return rtrim($colstr, ", ");
}