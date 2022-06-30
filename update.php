<?php

ob_start();
exec("git pull origin main", $o);
$line=ob_get_contents();
ob_end_clean();
echo "<br><br>".$line."hi";
var_dump($o);

/*foreach($repos as $repo){
	//ob_start();
	$line=shell_exec("/var/www/update/repos/".$repo[1]);
	//ob_end_clean();
	echo "<br><br>".$repo[0].": <br>".$line;
}*/


echo $line;
