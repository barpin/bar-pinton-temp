<?php
if (!debug){header("Content-type: application/json; charset=utf-8");}

require_once 'assets/database.php';

function authenticate(){ //TODO real authentication
    require_once 'assets/session_start.php'; 
    
    if (isset($_SESSION['id'])){
        return $_SESSION['id'];
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit('{"error":"No estas logueado"}');
    }
}

function queryAndPush($link, $query){
    $json=[];
    $result=qq($link, $query);
    while ($row=mysqli_fetch_assoc($result)){
        $json[]=$row;
    }
    echo json_encode($json);
};

function getpost($varname){
    return $_GET[$varname] ?? $_POST[$varname] ?? false;
}

/* risky
foreach($_POST as $varname=>$varval){
    $$varname=$varval;
}

foreach($_GET as $varname=>$varval){
    $$varname=$varval;
}
*/

require_once "api/${type}.php";
exit;