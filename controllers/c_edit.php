<?php
$title="Editando articulo";
$headertags=<<<EOF
    <link href="/css/edit.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>

EOF;
require_once 'assets/database.php';
require_once 'assets/session_start.php';

if (!$loggedin){
    $_SESSION["msg"]="No estas logueado";
    $_SESSION["icon"]="error";
    header('Location: /');
    exit();
}

if (isset($article)){
    $cols=getcols($link);
    $query="SELECT ${cols} FROM posts INNER JOIN textupdates ON posts.id = textupdates.post_id WHERE textupdates.replaced_at IS NULL AND posts.id = ${article} ";
    $articledata=qq($link, $query)->fetch_assoc();
    $jsvars = array_merge($articledata, ['isnew'=>0]); 
    $new=0;
    $query=<<<EOF
    WITH RECURSIVE UsedCategories AS (
        (SELECT * FROM categories WHERE POWER(2, id) & ${articledata['p_category']} = POWER(2, id))
        
        UNION 
        (SELECT categories.* FROM UsedCategories, categories WHERE UsedCategories.parents & POWER(2,categories.parents) = POWER(2,categories.parents))) 
    
    SELECT * FROM UsedCategories;
    EOF; //all this just to avoid doing it in js which ill have to do later anyway.
    $permsdata=entries($link,$query);
} else {
    $jsvars = ['isnew'=>1,];
    $new=1;
    $permsdata=entries($link, "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) OR id = 0");

}
//echo "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) OR id = 0";

//TODO might remove this later, i think this is all done with php directly 
$jsvars=array_merge($jsvars, ['perms'=>$_SESSION['perms'], 'permsdata'=>entries($link, "SELECT * FROM categories")]);



require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/edit.php';
include_once 'partials/footer.php';