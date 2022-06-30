<?php
//Creates a new code and corresponding user. 
//Inputs: name: new user name
//        perms: a json list of all permissions
//Reurns: 1 if success. 
//
//TODO: make it return a json of the new code as so to not have to refresh the codes page.


$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode( ($userperms & 1024 ) == 0 , "403 Forbidden");


if (isset($_POST['id'])){
  if (isset($_POST['delete'])){
    $query= "DELETE FROM users WHERE id = ${_POST['id']} AND password IS NULL";
    $result=qq($query, "500 Internal Server Error");
    assertExitCode( !$result , "400 Bad Request");

    echo $_POST['id'];
  } else {
    assertExitCode( !(isset($_POST['perms']) && isset($_POST['name'])), "400 Bad Request");

    $oldrowobj = $link->query("SELECT * FROM users WHERE id = ${_POST['id']} AND password IS NULL");
    assertExitCode( !$oldrowobj || !$oldrowobj->num_rows, "400 Bad Request");
    $oldrow=$oldrowobj->fetch_assoc();
    $changedperms=gmp_init($_POST['perms']) ^ gmp_init($oldrow['perms']);
    assertExitCode( !(($userperms & $changedperms) == $changedperms), "403 Forbidden");

    $query= "UPDATE users SET name = '${_POST['name']}' , perms = ${_POST['perms']} WHERE id = ${_POST['id']} AND password IS NULL";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];
  }

} else {
  $globalPerms=entries( "SELECT * FROM categories", false, "id", "500 Internal Server Error");
    
  $submittedPerms=gmp_init(0); //this one verifies if the user has all the required categories

  foreach ($_POST['perms'] as $category){
    $submittedPerms |= gmp_init(2)**gmp_init($category);   
  }

  assertExitCode(!($submittedPerms == ($userperms & $submittedPerms)), "403 Forbidden");
  assertExitCode(!(isset($_POST['name']) && $_POST['name']!=""), "400 Bad Request");

  $code= substr(md5(rand()),0,8);
  while (qq("SELECT code FROM users WHERE code = '${code}'", "500 Internal Server Error")->num_rows !=0){
    $code=substr(md5(rand()),0,8);
  }

  $query="INSERT INTO users VALUES(null, '${_POST['name']}', null, ${submittedPerms}, null, null, null, null, NOW(), '${code}')";
  $result=qq($query, "500 Internal Server Error");
  echo true;

}