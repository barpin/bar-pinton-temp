<?php
//Modifies a category. 
//
//Reurns: 1 if success. 
//
//TODO: make it return a json of the new code as so to not have to refresh the codes page.


$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1];
assertExitCode( ($userperms & 4096 ) == 0 , "403 Forbidden");
assertExitCode( !(isset($_POST['id']) ) , "400 Bad Request");
assertExitCode( $_POST['id']<20  , "403 Forbidden");
assertExitCode( $_POST['id']>63  , "400 Bad Request");



 if (isset($_POST['delete'])) { //actually toggles delete but keep this name for consistency
  $query= "SELECT * FROM categories WHERE id = ${_POST['id']} ";
  
  $query= "UPDATE categories SET disabled_at = ".(qq($query, "500 Internal Server Error")->fetch_assoc()['disabled_at'] ? "NULL" : "NOW()")." WHERE id = ${_POST['id']} ";
  qq($query, "500 Internal Server Error");
  echo $_POST['id'];

} else {
  assertExitCode( !( isset($_POST['name']) )  , "400 Bad Request");
  $urlname = (isset($_POST['urlname']) && $_POST['urlname']) ? "'${_POST['urlname']}'" : 'NULL';
  $oldrowobj = $link->query("SELECT * FROM categories WHERE id = ${_POST['id']}");
  $postexists=$oldrowobj && $oldrowobj->num_rows;
  if (isset($_POST['perms'])){ // si es nuevo

    assertExitCode( !(  !$postexists && isset($_POST['type']) )  , "400 Bad Request");

    $catTypes=[
      "secretaria"=>64,
      "comision"=>128,
      "club"=>256,
      "otra"=>0,
    ];

    $globalCategories=entries( "SELECT * FROM categories", false, "id", "500 Internal Server Error");
    
    $addedpostcategories=gmp_init(0); 
    $parentcategories=gmp_init(0); //the parent categories of each of the categories

    foreach ($_POST['perms'] as $category){
        $parentcategories |= gmp_init($globalCategories[$category]['parents']); 
        $addedpostcategories |= gmp_init(2)**gmp_init($category); 
    }

    $posttypeperms=gmp_init($catTypes[$_POST['type']]);
    $finalcategories=$addedpostcategories | $parentcategories | $posttypeperms | $globalCategories[log(gmp_intval($posttypeperms),2)]['parents'] | 1;

    $query= "INSERT INTO categories VALUES(${_POST['id']}, '${_POST['name']}', ${urlname}, ${finalcategories}, null ); ";
    qq($query, "500 Internal Server Error");
    
    echo 1;



  } else { //si no es nuevo

    assertExitCode( !( isset($_POST['parents']) && $postexists )  , "400 Bad Request");

    $query= "UPDATE categories SET name = '${_POST['name']}' , urlname = ${urlname}, parents = '${_POST['parents']}' WHERE id = ${_POST['id']} ";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];
  }

}

