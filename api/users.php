<?php
//Modifies a user. 
//
//Reurns: 1 if success. 
//
//TODO: make it return a json of the new code as so to not have to refresh the codes page.


$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode( ($userperms & 2048 ) == 0 , "403 Forbidden");

if (isset($_POST['purge'])){


}
assertExitCode( !(isset($_POST['id']) ) , "400 Bad Request");
assertExitCode( $_POST['id']==="0"  , "403 Forbidden");



  if (isset($_POST['purge'])){ //permanently delete, only as root
    assertExitCode( $_SESSION['id']!=="0"  , "403 Forbidden");
    $query= "DELETE FROM users WHERE id = ${_POST['id']} ";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];

  } else if (isset($_POST['delete'])) { //actually toggles delete but keep this name for consistency
    $query= "SELECT * FROM users WHERE id = ${_POST['id']} ";
    
    $query= "UPDATE users SET deleted_at = ".(qq($query, "500 Internal Server Error")->fetch_assoc()['deleted_at'] ? "NULL" : "NOW()").", updated_at = NOW() WHERE id = ${_POST['id']} ";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];

  } else if (isset($_POST['refresh'])) { //refresh a user after year ends and it gets auto-deleted.

    $query= "UPDATE users SET deleted_at = NULL, updated_at=NOW() WHERE id = ${_POST['id']} ";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];

  } else {
    assertExitCode( !(isset($_POST['name']) && isset($_POST['nickname']) && isset($_POST['perms']) && isset($_POST['email']) ) , "400 Bad Request");

    $oldrowobj = $link->query("SELECT * FROM users WHERE id = ${_POST['id']}");
    assertExitCode( !$oldrowobj || !$oldrowobj->num_rows, "400 Bad Request");
    $oldrow=$oldrowobj->fetch_assoc();
    $changedperms=gmp_init($_POST['perms']) ^ gmp_init($oldrow['perms']);
    assertExitCode( !(($userperms & $changedperms) == $changedperms), "403 Forbidden");

    $query= "UPDATE users SET name = '${_POST['name']}' , perms = ${_POST['perms']}, nickname = '${_POST['nickname']}', email = '${_POST['email']}' , updated_at = NOW() WHERE id = ${_POST['id']} ";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];
  }

