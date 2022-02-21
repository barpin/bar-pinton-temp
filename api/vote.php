<?php

$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode( !isset($_POST['id']) || !isset($_POST['vote']), "400 Bad Request");
$query="SELECT * FROM posts WHERE id = ${_POST['id']}";
$votepostobj=qq($query, "500 Internal Server Error");
$votepost=$votepostobj->fetch_assoc();
assertExitCode( !($votepostobj->num_rows==1) || ( ($votepost['category'] & 16 ) == 0 ), "400 Bad Request");

assertExitCode( new dateTime($votepost['end_date']) < new dateTime(), "403 Forbidden");


$hasvoted=qq("SELECT * FROM votescast WHERE post_id = ${_POST['id']} AND user_id = ${_SESSION['id']}", "500 Internal Server Error")->num_rows;
assertExitCode( $hasvoted, "403 Forbidden");

$query="INSERT INTO votescast VALUES (${_SESSION['id']}, ${_POST['id']})";
qq($query, "500 Internal Server Error");
$query="INSERT INTO votesresults VALUES (null, ${_POST['id']}, ${_POST['vote']})";
qq($query, "500 Internal Server Error");

echo 1;