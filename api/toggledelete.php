<?php

$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode(!isset($_POST['id']), "404 Not Found");

$postdataobj=qq($posts_data_query."WHERE posts.id = ${_POST['id']}", "500 Internal Server Error");

assertExitCode($postdataobj->num_rows==0, "404 Not Found");
$postdata=$postdataobj->fetch_assoc();

assertExitCode(($userperms & gmp_init($postdata['p_category'])) == 0, "403 Forbidden");

if ((($postdata['p_category'] & 512) == 512) && $postdata['p_deleted_at']){
  $query="UPDATE posts SET deleted_at = NULL, category = category ^ 512 WHERE id = ${_POST['id']}";
} else if ((($postdata['p_category'] & 512) == 0) && !$postdata['p_deleted_at']){
  $query="UPDATE posts SET deleted_at = NOW(), category = category ^ 512 WHERE id = ${_POST['id']}";
} else {
  assertExitCode(1, "409 Conflict");
}

qq($query, "500 Internal Server Error");
echo 1;