<?php

//Creates/edits post
//Inputs:
//  TODO: document this



$userdata= authenticate($link, true);
$userid=$userdata[0];
$userperms=$userdata[1]; //in case it was changed since last login

if (isset($_POST['id'])){
    $postdataobj=qq($link, $posts_data_query."WHERE posts.id = ${_POST['id']}");

    assertExitCode($postdataobj->num_rows==0, "404 Not Found");
    $postdata=$postdataobj->fetch_assoc();
    assertExitCode(($userperms & gmp_init($postdata['p_category'])) == 0, "403 Forbidden");
    assertExitCode(!(isset($_POST['content'])), "400 Bad Request");

    $css = isset($_POST['css']) ? "'".$_POST['css']."'" : "null";
    
    $query="UPDATE textupdates SET replaced_at = NOW() WHERE post_id = ${_POST['id']} AND replaced_at IS NULL";
    qq($link, $query);
    
    $query="INSERT INTO textupdates VALUES(null, ${_POST['id']}, '${_POST['content']}', ${css},  ${_SESSION['id']}, NOW(), null)";
    qq($link, $query);
    echo $_POST['id'];
} else {
    $globalCategories=entries($link, "SELECT * FROM categories", false, "id");
    
    $addedpostcategories=gmp_init(0); //this one verifies if the user has all the required categories
    $parentcategories=gmp_init(0); //the parent categories of each of the categories

    foreach ($_POST['categories'] as $category){
        $parentcategories |= gmp_init($globalCategories[$category]['parents']); 
        $addedpostcategories |= gmp_init(2)**gmp_init($category); 
        
    }

    assertExitCode(!($addedpostcategories == ($userperms & $addedpostcategories)), "403 Forbidden");
    assertExitCode($addedpostcategories == 0, "403 Forbidden");
    assertExitCode(!(isset($_POST['content']) && isset($_POST['type']) && isset($_POST['title'])), "400 Bad Request");
    assertExitCode($_POST['type']=='vote' && !( isset($_POST['end_date']) && $_POST['options'] != "[]"  ), "400 Bad Request");
    
    $postTypes=[
        "static"=>4,
        "post"=>8,
        "vote"=>16,
        "alert"=>32,
    ];
    $finalcategories=$addedpostcategories | $parentcategories | gmp_init($postTypes[$_POST['type']]);
    $end_date = isset($_POST['end_date']) ? "'".$_POST['end_date']."'" : "null";
    $css = isset($_POST['css']) ? "'".$_POST['css']."'" : "null";
    $postoptions = isset ($_POST['options']) ? "'".json_encode($_POST['options'])."'" : "null" ;

    $query= "INSERT INTO posts VALUES(null, '${_POST['title']}', NOW(), null, ${finalcategories}, ${end_date}, ${postoptions} ); ";
    qq($link, $query);
    
    $newpostID=qq($link, "SELECT MAX(id)  FROM  posts")->fetch_row()[0];

    $query="INSERT INTO textupdates VALUES(null, ${newpostID}, '${_POST['content']}', ${css}, ${_SESSION['id']}, NOW(), null)";
    qq($link, $query);
    echo $newpostID;
}







//if loggedin

//if id (old only )

//if categories (always, but empty if old )

// title (new only)

// content

//if css

//if type (new only)

//if end_date (vote only)

//if options //vote only*/


