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

function entries ($link, $query){
    $entries=qq($link, $query);
    $entryarr=[];
    while($row=$entries->fetch_assoc()){
        $entryarr[]=$row;
    }
    return $entryarr;
}

function sanitize ($text, $link){
    return mysqli_real_escape_string($link, htmlspecialchars($text));
}