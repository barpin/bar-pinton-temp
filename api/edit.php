<?php

//Creates/edits post
//Inputs:
//  TODO: document this



$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1]; //in case it was changed since last login

assertExitCode(!(isset($_POST['content'])), "400 Bad Request");

if (isset($_POST['css'])){

    if ($_POST['css']==file_get_contents("css/default_article.css") || empty(array_diff( str_split($_POST['css']), str_split("/*CSS:DEFAULT*/")))){
        $css = "'".sanitize("/*CSS:DEFAULT*/")."'";
    } else {

        $css = "'".$_POST['css']."'";
        $query="SELECT id FROM textupdates WHERE css = '${_POST['css']}'";
        if ($equalcss=qq($query)->fetch_assoc()){
            $css = "'".sanitize("/*CSS:${equalcss['id']}*/")."'";
        }
    }
} else {
    $css= "'null'";
}

$query="SELECT id FROM textupdates WHERE content = '${_POST['content']}'";
if ($equalhtml=qq($query)->fetch_assoc()){
    $_POST['content'] = sanitize("<!--HTML:${equalhtml['id']}-->");
}


if (isset($_POST['id'])){ //if editing (not creating new)
    $postdataobj=qq($posts_data_query."WHERE posts.id = ${_POST['id']}", "500 Internal Server Error");

    assertExitCode($postdataobj->num_rows==0, "404 Not Found");
    $postdata=$postdataobj->fetch_assoc();
    assertExitCode(($userperms & gmp_init($postdata['p_category'])) == 0, "403 Forbidden");

    
    $query="UPDATE textupdates SET replaced_at = NOW() WHERE post_id = ${_POST['id']} AND replaced_at IS NULL";
    qq($query, "500 Internal Server Error");
    
    $query="INSERT INTO textupdates VALUES(null, ${_POST['id']}, '${_POST['content']}', ${css},  ${_SESSION['id']}, NOW(), null)";
    qq($query);
    echo $_POST['id'];
} else {
    $globalCategories=entries( "SELECT * FROM categories", false, "id", "500 Internal Server Error");
    
    $addedpostcategories=gmp_init(0); //this one verifies if the user has all the required categories
    $parentcategories=gmp_init(0); //the parent categories of each of the categories

    foreach ($_POST['categories'] as $category){
        $parentcategories |= gmp_init($globalCategories[$category]['parents']); 
        $addedpostcategories |= gmp_init(2)**gmp_init($category); 
        
    }

    assertExitCode(!($addedpostcategories == ($userperms & $addedpostcategories)), "403 Forbidden");
    assertExitCode($addedpostcategories == 0, "403 Forbidden");
    assertExitCode(!(isset($_POST['type']) && isset($_POST['title'])), "400 Bad Request");
    assertExitCode($_POST['type']=='vote' && !( isset($_POST['end_date']) && $_POST['options'] != "[]"  ), "400 Bad Request");
    
    $postTypes=[
        "static"=>4,
        "post"=>8,
        "vote"=>16,
        "alert"=>32,
    ];
    $finalcategories=$addedpostcategories | $parentcategories | gmp_init($postTypes[$_POST['type']]);
    $end_date = isset($_POST['end_date']) ? "'".$_POST['end_date']."'" : "null";

    $postoptions = isset ($_POST['options']) ? "'".json_encode($_POST['options'])."'" : "null" ;

    if ($css== "null" && $_POST['type']=='static'){
        $css = sanitize("'/*CSS:DEFAULT*/'");
    }

    $query= "INSERT INTO posts VALUES(null, '${_POST['title']}', NOW(), null, ${finalcategories}, ${end_date}, ${postoptions} ); ";
    qq($query, "500 Internal Server Error");
    
    $newpostID=qq("SELECT MAX(id)  FROM  posts", "500 Internal Server Error")->fetch_row()[0];

    $query="INSERT INTO textupdates VALUES(null, ${newpostID}, '${_POST['content']}', ${css}, ${_SESSION['id']}, NOW(), null)";
    qq($query, "500 Internal Server Error");

    if (isset ($_POST['options'])){
        for ($x=0;$x<count($_POST['options']);$x++){
            qq("INSERT INTO votesresults VALUES (null, ${newpostID}, ${x})", "500 Internal Server Error");
        }
    }



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


