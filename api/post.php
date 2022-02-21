<?php
//returns post information

$cols=getcols();
$post = getpost("post");
$query="";
if (count($postlist = explode(",",$post))){
    for ($i=0;$i<count($postlist);$i++){
        $query.=" ${posts_data_query} WHERE posts.id = ${postlist[$i]} ".($i==count($postlist)-1 ? "" : "UNION ALL");
    }
} 
$articledata=entries( $query, false, false, "500 Internal Server Error");
echo json_encode($articledata);