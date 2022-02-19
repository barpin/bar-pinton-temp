<?php
if (!debug){header("Content-type: application/json; charset=utf-8");}

require_once 'assets/database.php';

function authenticate($link, $perms=false){ //TODO real authentication (Oauth?)
    require_once 'assets/session_start.php'; 
    
    if (isset($_SESSION['id'])){
        if ($perms){
            return [$_SESSION['id'], gmp_init(qq($link, "SELECT perms FROM users WHERE id = ${_SESSION['id']}")->fetch_assoc()["perms"])];
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



function assertExitCode($assertion, $code){
    if ($assertion){
        header("HTTP/1.1 ${code}");
        //echo "HTTP/1.1 ${code}";
        exit;
    }
}

function recursiveSanitize($link, $arr){
    $returnarr=[];
    foreach ($arr as $varname=>$varval){
        if (is_array($varval)){
            $returnarr[sanitize($link, $varname)]=recursiveSanitize($link, $varval);
        } else {
            $returnarr[sanitize($link, $varname)]=sanitize($link, $varval);
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
        $_POST[$varname] = recursiveSanitize($link, $decodedvar);
        
    } else {
        $_POST[$varname] = sanitize($link, $varval);
        //echo $varname." ".$varval." ".json_decode($varval)."\n";
    }
}

foreach($_GET as $varname=>$varval){
    if (($decodedvar=json_decode($varval))!==null && is_array($decodedvar)){
        $_GET[$varname] = recursiveSanitize($link, $decodedvar);
        
    } else {
        $_GET[$varname] = sanitize($link, $varval);
        //echo $varname." ".$varval." ".json_decode($varval)."\n";
    }
}

require_once "api/${type}.php";
exit;