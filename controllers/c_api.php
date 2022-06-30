<?php
if (!debug){header("Content-type: application/json; charset=utf-8");}

require_once 'assets/database.php';

function authenticate($perms=false){ //TODO real authentication (Oauth?)
    require_once 'assets/session_start.php'; 
    
    if (isset($_SESSION['id'])){
        if ($perms){
            return [$_SESSION['id'], gmp_init(qq("SELECT perms FROM users WHERE id = ${_SESSION['id']}")->fetch_assoc()["perms"])];
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
    $result=qq($query);
    while ($row=mysqli_fetch_assoc($result)){
        $json[]=$row;
    }
    echo json_encode($json);
};



function assertExitCode($assertion, $code){
    if ($assertion){
        header("HTTP/1.1 ${code}");
        //echo "HTTP/1.1 ${code}";
        exit;
    }
}

function recursivesanitize($arr){
    $returnarr=[];
    foreach ($arr as $varname=>$varval){
        if (is_array($varval)){
            $returnarr[sanitize($varname)]=recursivesanitize($varval);
        } else {
            $returnarr[sanitize($varname)]=sanitize($varval);
        }
    }
    return $returnarr;
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
    if (($decodedvar=json_decode($varval))!==null && is_array($decodedvar)){
        $_POST[$varname] = recursivesanitize($decodedvar);
        
    } else {
        $_POST[$varname] = sanitize($varval);
        //echo $varname." ".$varval." ".json_decode($varval)."\n";
    }
}

foreach($_GET as $varname=>$varval){
    if (($decodedvar=json_decode($varval))!==null && is_array($decodedvar)){
        $_GET[$varname] = recursivesanitize($decodedvar);
        
    } else {
        $_GET[$varname] = sanitize($varval);
        //echo $varname." ".$varval." ".json_decode($varval)."\n";
    }
}
$type=str_replace(["/","."],"",$type);
require_once "api/${type}.php";
exit;