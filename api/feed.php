<?php
//recibe en get o post a "category". Esto es una, o una lista, de numeros o categorias. "," representa un or, "." un and, "!" un not, y "(", y ")". 
//ejemplo ..../api/v1/feed?Voto.noche   devuelve la lista de todos los votos de la secretaria de turno noche
//ejemplo ..../api/v1/feed?category=2,!(3.Comision.genero).!7  devuelve la lista de todos los posts de categoria 1 (2^1=2), y los que o no son de ni la categoria 3, ni de alguna comisio, ni de de la secretaria de genero  o no son de las categorias 0, 1, o 2 (2^7= 2^0 | 2^1 | 2^2)

define("urlcategoryarr", entries($link, "SELECT * FROM categories", false, "urlname"));
define("namecategoryarr", entries($link, "SELECT * FROM categories", false, "name"));


  
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
  //$counter=100;
  	$separatorvals=["."=>" AND ",","=>" OR ","("=>" ( ",")"=>" ) ","!"=>" NOT "];
  	$query=" ( ";
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
  $query.= segmenttonumber($url) . " ) ";
  //echo "<b>${query}</b>";
 
  return $query;
}



function queryToRank($link, $input){
  $input=htmlspecialchars_decode($input);
  $sumterms=[]; 
  $sepqs=array_filter(explode('"', $input), fn ($x)=>$x);
  for ($x=0;$x<count($sepqs);$x++){
    if ($x % 2){
      $sumterms[] = sumTerm($link, $sepqs[$x]);
    } else {

      $subinputs=array_filter(explode(' ', $sepqs[$x]), fn ($x)=>$x);
      $repeatedlink=array_fill(0, count($subinputs), $link);
      $sumterms[] = implode(" + ", array_map('sumterm', $repeatedlink, $subinputs) );
    }
  }
  return " SUM( " . implode(" + ", $sumterms) . " ) AS relevance " ;
}

function sumTerm($link, $subqueryval){
  //$queriedfields=['textupdates.content', 'posts.title', 'users.nickname', 'users.name'];
  $queriedfields=['textupdates.content', 'posts.title']; //searching usernames breaks everything for some reason. TODO?
  $resanitizedsqv=mysqli_real_escape_string($link, $subqueryval);
  $repeatedqueryval=array_fill(0, count($queriedfields), $resanitizedsqv);
  
  $summedTerm=array_map('makeTerm', $queriedfields, $repeatedqueryval );
  $term=implode(" + ", $summedTerm);
  return $term;
}

function makeTerm($queryfield, $subsubqueryval){
  return "((LENGTH(LOWER(${queryfield})) - LENGTH(REPLACE(LOWER(${queryfield}), LOWER('${subsubqueryval}'), '')))/LENGTH('${subsubqueryval}'))";
}

$whereclause= getpost("category") ? parseurl(getpost("category")) : "1";
$searchquery= getpost("q") ?? false;


//no more inline ifs this is hard enough to read on its own.

$query="SELECT ". ( debug ? getcols($link) : " posts.id  ");
if ($searchquery){
  $query .= " , ".queryToRank($link, $searchquery) ;
}
$query .= $posts_data_inners;
$query .= " WHERE textupdates.replaced_at IS NULL AND ${whereclause} ";
if ($searchquery){
  $query .= " GROUP BY textupdates.id " ;
}
$query .= " ORDER BY ". ( getpost("orderBy") ? getpost("orderBy") : ($searchquery ? "relevance" : "p_created_at" ) ). " ";
$query .= getpost("direction") ? " ".getpost("direction")." " : " DESC " ;


function idecho($y){
  echo $y;
  return $y;
}

if ($searchquery){
  $result=array_filter(entries($link, $query), fn ($x)=>floatval($x['relevance']));
} else {
  $result=entries($link, $query);
}

echo json_encode(array_map( function($x){return $x['p_id'];} , $result )); 

echo "<br>";
echo "<br>";
echo $query;