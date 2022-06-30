<?php
//recibe en get o post a "category". Esto es una, o una lista, de numeros o categorias. "," representa un or, "." un and, "!" un not, y "(", y ")". 
//ejemplo ..../api/v1/feed?Voto.noche   devuelve la lista de todos los votos de la secretaria de turno noche
//ejemplo ..../api/v1/feed?category=2,!(3.Comision.genero).!7  devuelve la lista de todos los posts de categoria 1 (2^1=2), y los que o no son de ni la categoria 3, ni de alguna comisio, ni de de la secretaria de genero  o no son de las categorias 0, 1, o 2 (2^7= 2^0 | 2^1 | 2^2)

define("urlcategoryarr", entries( "SELECT * FROM categories", false, "urlname", "500 Internal Server Error"));
define("namecategoryarr", entries( "SELECT * FROM categories", false, "name", "500 Internal Server Error"));


  
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
 
  return $query;
}



function queryToRank($input){
  $queriedfields=['textupdates.content', 'posts.title']; 
  $input=htmlspecialchars_decode($input);
  $sumterms=[]; 
  $whereterms=[];
  $sepqs=array_filter(explode('"', $input), fn ($x)=>$x);
  foreach($sepqs as $x=>$spval){
    if ($x % 2){
      $sumterms[] = sumTerm($spval);
      $tmpwts=[];
      foreach ($queriedfields as $tmpqf){
        $tmpwts[]=" LOWER(${tmpqf}) LIKE LOWER(\"%${spval}%\") ";
      }
      $whereterms[]=' AND ('.implode(" OR ",$tmpwts).' ) ';
    } else {
      $subinputs=array_filter(explode(' ', $spval), fn ($x)=>$x);
      foreach ($subinputs as $subi){
        $fuzzyterms = getLevenshtein($subi);
        //$fuzzierterms = getLevenshtein($subi,2); too much
        foreach ($queriedfields as $cfield){
          $relevance=(1.2**min(strlen($subi), 10)/1.2**10)-(strlen($subi) <4 ? 0.1 : 0);
          $sumterms[]=makeTerm($cfield, $subi, false, $relevance);
          foreach ($fuzzyterms as $fuzzi){
            if (strlen($fuzzi)>3){
              $sumterms[]=makeTerm($cfield, $fuzzi, true, $relevance**1.7); //TODO relevance hashmap?
            }
          }
          //foreach ($fuzzierterms as $fuzzi){
          //  $sumterms[]=makeTerm($cfield, $fuzzi, $regexp=true, $relevance=0.1);
          //}
        }        //min e^n e^15 / e^15
      }

    }
  }
  return [" SUM( " . implode(" + ", $sumterms) . " ) AS relevance ", implode("",$whereterms)] ;
}


function sumTerm($subqueryval, $regexp=false, $relevance=1){
  GLOBAL $link;
  //$queriedfields=['textupdates.content', 'posts.title', 'users.nickname', 'users.name'];
  $queriedfields=['textupdates.content', 'posts.title']; //searching usernames breaks everything for some reason. TODO?
  
  $resanitizedsqv=mysqli_real_escape_string($link, $subqueryval);
  $repeatedqueryval=array_fill(0, count($queriedfields), $resanitizedsqv);
  $repeatedregexp=array_fill(0, count($queriedfields), $regexp);
  $repeatedrelevance=array_fill(0, count($queriedfields), $relevance);
  
  $summedTerm=array_map('makeTerm', $queriedfields, $repeatedqueryval, $repeatedregexp ,$repeatedrelevance);
  $term=implode(" + ", $summedTerm);
  return $term;
}

function makeTerm($queryfield, $subsubqueryval, $regexp=false, $relevance=1){
  return "(((LENGTH(".($regexp ? "@temptext" : "LOWER(${queryfield})").") - LENGTH(@temptext:=(".($regexp ? "REGEXP_REPLACE" : "REPLACE")."(".($regexp ? "@temptext" : "LOWER(${queryfield})").", LOWER('${subsubqueryval}'), ''))))/LENGTH('${subsubqueryval}'))*${relevance})";
}

function getLevenshtein($inputword, $depth=1){
  $words = [$inputword=>true];

  for ($j = 0; $j < $depth; $j++) {
    foreach ($words as $word=>$truth){
      for ($i = 0; $i < strlen($word); $i++) {
          // insertions
          $words[substr($word, 0, $i) . '.' . substr($word, $i)] = true ;
          // deletions
          $words[substr($word, 0, $i) . substr($word, $i + 1)] = true ;
          // substitutions
          $words[substr($word, 0, $i) . '.' . substr($word, $i + 1)] =  true;
      }
      // last insertion
      $words[$word . '.'] = true;
    }
  }
  return array_keys($words);
}

$categoryquery = $categoryquery ?? getpost("category");
$whereclause= $categoryquery ? parseurl($categoryquery) : "1";
$searchquery = $searchquery ?? getpost("q");
$rankquery=queryToRank($searchquery);
$sumquery=$rankquery[0];
$whereclause.=$rankquery[1];

//no more inline ifs this is hard enough to read on its own.
$query="SET @temptext :='';";
qq($query, "500 Internal Server Error");
$query="SELECT ". ( debug ? getcols() : " posts.id as p_id ");
if ($searchquery){
  $query .= " , ".$sumquery ;
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
  $result=array_filter(entries( $query, false, false, "500 Internal Server Error"), fn ($x)=>floatval($x['relevance']));
} else {
  $result=entries( $query, false, false, "500 Internal Server Error");
}

echo json_encode(array_map( function($x){return $x['p_id'];} , $result )); 

