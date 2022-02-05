<?php
//returns post information
$cols=getcols($link);
$query="SELECT ${cols} FROM posts INNER JOIN textupdates ON posts.id = textupdates.post_id WHERE textupdates.replaced_at IS NULL AND posts.id = ${post} ";
$articledata=qq($link, $query)->fetch_assoc();
echo json_encode($articledata);