<?php

$userdata= authenticate($link, true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode(!isset($_POST['id']), "400 Bad Request");

$postdataobj=qq($link, $posts_data_query."WHERE textupdates.id = ${_POST['id']}");

assertExitCode($postdataobj->num_rows==0, "404 Not Found");
$postdata=$postdataobj->fetch_assoc();

assertExitCode(!$postdata['t_replaced_at'], "400 Bad Request");

assertExitCode(($userperms & gmp_init($postdata['p_category'])) == 0, "403 Forbidden");

$query="UPDATE textupdates INNER JOIN posts ON posts.id = textupdates.post_id SET textupdates.replaced_at = NOW() WHERE textupdates.replaced_at IS NULL AND posts.id = ${postdata['p_id']}";
qq($link, $query);

$query="UPDATE textupdates SET replaced_at = NULL WHERE id = ${_POST['id']}";
qq($link, $query);

echo 1;