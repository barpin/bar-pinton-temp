<?php
//accepts numbers and category names separated by `,`, `+` and `!` marks representing ands, ors, and nots. these can be encased in () f  

function parseurl ($url){
    $matches=[];
    preg_match_all('#\(.*?\)|[^ ]+#', $url, $matches);
    if (count($matches) > 1){
        return implode('', array_map($matches, function(x){parseurl(x)}))
    }
}

if (($category=getpost('category'))===false){
    header("HTTP/1.1 400 Bad Request");
}
$query="SELECT posts.id FROM posts WHERE ";

var_dump ($category);
/*
$cats=array_map(function($x){return explode(",",$x);}, explode(";", $category));
foreach($cats[0] as $cat){
    if (is_numeric($cat)){
        $query.=""
    }
}

//$query="SELECT ${cols} FROM posts INNER JOIN textupdates ON posts.id = textupdates.post_id WHERE textupdates.replaced_at IS NULL AND posts.id = ${post} ";
//$articledata=qq($link, $query)->fetch_assoc();
echo json_encode($cats); */