<?php
//recibe en get o post a "category". Esto es una, o una lista, de numeros o categorias. "," representa un or, "." un and, "!" un not, y "(", y ")". 
//ejemplo ..../api/v1/feed?Voto.noche   devuelve la lista de todos los votos de la secretaria de turno noche
//ejemplo ..../api/v1/feed?category=2,!(3.Comision.genero).!7  devuelve la lista de todos los posts de categoria 1 (2^1=2), y los que o no son de ni la categoria 3, ni de alguna comisio, ni de de la secretaria de genero  o no son de las categorias 0, 1, o 2 (2^7= 2^0 | 2^1 | 2^2)

define("urlcategoryarr", entries($link, "SELECT * FROM categories", false, "urlname"));
define("namecategoryarr", entries($link, "SELECT * FROM categories", false, "name"));

/*
GLOBAL $counter;
$counter=100;
function parseurl ($url){
    GLOBAL $counter;
  	$matches=[];
  
  	if ($counter > 0){
    	echo "<br><br>".$url;
      $counter--;
    }
//      if ($counter > 0){echo "<br>"; var_dump($matches); }
  	if (count($matches=explode("(", $url)) > 1){

    } else if (count($matches=explode(" ", $url)) > 1) {
      if ($counter > 0){echo "<br>stuck on or";}
        return implode('', array_map("parseurl",$matches));
  		    	
    } else if (count($matches=explode(",", $url)) > 1) {
      if ($counter > 0){echo "<br>stuck on and";}
        return implode('', array_map("parseurl",$matches));
    } else if (strpos($url, "!")===0){
      if ($counter > 0){echo "<br>stuck on not";}
        return parseurl(substr(1,-1));
    } else if (is_numeric($url)){
      if ($counter > 0){echo "<br>stuck on numeric";}
        return $url;
    } else if (isset(urlcategoryarr[$url])){
      if ($counter > 0){echo "<br>stuck on url";}
        return 2**urlcategoryarr[$url]['id'];
    } else if (isset(namecategoryarr[$url])){
      if ($counter > 0){echo "<br>stuck on name";}
        return 2**namecategoryarr[$url]['id'];
    } else {
      if ($counter > 0){echo "<br>stuck on bad request";}
        header("HTTP/1.1 400 Bad Request");
        exit;    
    }
}
*/
  
function closestSeparator($url){
	$closestSeparator="";
  	$separatorPos=strlen($url);
  	$separators=[".",",","(",")","!"];
  	foreach ($separators as $separator){
    	if (($strpos=strpos($url, $separator))!==false && $strpos < $separatorPos) {
        	$separatorPos=$strpos;
            $closestSeparator=$separator;
        }
    }
  	return [$closestSeparator, $separatorPos];
}

function segmenttonumber($segment){
	if (!$segment){
        return "";
        
    } else if  (is_numeric($segment)){
      	$reqcat=$segment;
    	return "posts.category & ${reqcat} = ${reqcat}";
      
    } else if (isset(namecategoryarr[$segment])){
      	$reqcat=2**namecategoryarr[$segment]['id'];
    	return "posts.category & ${reqcat} = ${reqcat}";
      
    } else if (isset(urlcategoryarr[$segment])){
      	$reqcat=2**urlcategoryarr[$segment]['id'];
    	return "posts.category & ${reqcat} = ${reqcat}";
      
    } else {
    	header("HTTP/1.1 400 Bad Request");
        exit;
    }
}

function parseurl($url){
  $counter=100;
  	$separatorvals=["."=>" AND ",","=>" OR ","("=>" ( ",")"=>" ) ","!"=>" NOT "];
  	$query="SELECT posts.id FROM posts WHERE ";
  	while (($csp=closestSeparator($url))[0]){
      //if ($counter > 0){echo "<br>".$url."   ".$csp[0]."   ".$csp[1]."<br>".$query;$counter--;}
      if ($csp[1]==0){
		$query.=$separatorvals[$csp[0]];
        $url=substr($url, 1);
      } else {
		$query.= segmenttonumber(substr($url,0,$csp[1]));
        $url=substr($url, $csp[1]);
      }
    }
  $query.= segmenttonumber($url);
  //echo "<b>${query}</b>";
 
  return $query;
}

$query=parseurl($url);
if ($category=getpost("category")){
  if ($orderBy=getpost("orderBy")){
    if ($order=getpost("direction")){
      $query.=" ORDER BY ${orderBy} ${order}";
      
    } else {
      $query.=" ORDER BY ${orderBy} DESC";
    }
  } else {
    $query.=" ORDER BY p_created_at DESC";
  } 
} else {
  header("HTTP/1.1 400 Bad Request");
  exit;
}



echo json_encode(array_map( function($x){return $x['id'];} , entries($link, $query))); 