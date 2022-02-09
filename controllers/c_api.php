<?php
if (!debug){header("Content-type: application/json; charset=utf-8");}

require_once 'assets/database.php';

function authenticate($perms=false){ //TODO real authentication (Oauth?)
    require_once 'assets/session_start.php'; 
    
    if (isset($_SESSION['id'])){
        if ($perms){
            return [$_SESSION['id'], qq($link, "SELECT perms FROM users WHERE id = ${_SESSION['id']}")[0]["perms"]];
        } else {
            return $_SESSION['id'];
        }
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

function assertExitCode($assertion, $code){
    if ($assertion){
        header("HTTP/1.1 ${code}");
        exit;
    }
}

/* risky
foreach($_POST as $varname=>$varval){
    $$varname=$varval;
}

foreach($_GET as $varname=>$varval){
    $$varname=$varval;
}
*/

foreach($_POST as $varname=>$varval){
    $_POST[$varname] = sanitize($link, $varval);
}

foreach($_GET as $varname=>$varval){
    $_GET[$varname] = sanitize($link, $varval); //TODO test this it might not be doing anything
}

require_once "api/${type}.php";
exit;