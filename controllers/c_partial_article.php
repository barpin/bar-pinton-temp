<?php


$category = gmp_init($content["p_category"]) & 0b111100;
$title=$content['p_title'];
$margins=0;
$redback=0;
$showauthor= $showauthor ?? 0;
$articleborder=0; //normally managed by feed. Maybe it shoudnt? TODO
$dates=1;
$canedit   = $loggedin && ((gmp_init($_SESSION['perms']) & gmp_init($content['p_category'])) != 0) ;
$isdeleted = (gmp_init($content['p_category']) & 512) != 0;
$isreplaced = $content['t_replaced_at'];
$restore=0;
$viewhist=1;
$viewdetails=1;
$showcategories=1;
$snippetdirection="";
$vsnippet=false;
$hsnippet=false;
$shadowcontain=false;
$shortenstrip=false;
$showversion=0;
$hidedots=0;
$crop=0;

$content['t_content']=isset($content['t_content']) ? htmlspecialchars_decode($content['t_content']):null;
$content['t_css']=isset($content['t_css']) ? htmlspecialchars_decode($content['t_css']): null;

include 'assets/replacehtml_css.php';

while ($content['t_content']!=($tempcontent=htmlspecialchars_decode(preg_replace_callback("/<!--HTML:(.*)-->/mi", $replacehtml, $content['t_content'])))){
    $content['t_content']=$tempcontent;
}




while ($content['t_css']!=($tempcss=htmlspecialchars_decode(preg_replace_callback("/\/\*CSS:(.*)\*\//mi", $replacecss, ($content['t_css'] ?? ""))))){
    $content['t_css']=$tempcss;
}

if (empty(array_diff( str_split(($content['t_css']  ?? "")), str_split("/*CSS:DEFAULT*/")))){
    $content['t_css']=file_get_contents('css/default_article.css');
}


if ($displayas=="fullpage"){
    $viewdetails=0;
    switch ($category){
        case 4:  //estatico
            $title=0;
            $showcategories=0;
            $dates=0;
            break;
        case 8: //post
            $margins=1;
            break;
        case 16: //voto
            $margins=1;
            break;
        case 32: //alerta
            $margins=1;
            $redback=1;
            $articleborder=1;
            break;
    }
} else if ($displayas=="infeed") {
    $crop=1;
    $articleborder=1;
    $sniplen=10000;
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
} else if ($displayas=="inhist") {
    $sniplen=10000;
    $crop=1;
    $showauthor=1;
    $margins=1;
    $articleborder=1;
    $restore=$canedit;
    $canedit=0;
    $viewhist=0;
    $showversion=1;
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
} else if ($displayas=="snippet") {
    $crop=1;
    $dates=-1;
$hidedots=1;
$shortenstrip=true;

    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
} else if ($displayas=="searchresult") {
    $shadowcontain=true;
    $shortenstrip=true;
    $hsnippet=true;
    $snippetdirection="horizontal";
    $searchquery=$searchquery ?? null; //this does nothing i think but listing everything passed on is a good idea
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
}
if ($crop){
    $sniplen=$sniplen ?? 400;
    if ($category==0b10000){
        $sniplen-=50;
    }
    $snippetviable=htmlspecialchars_decode( strip_tags($content['t_content']));
    $content['t_content']=mb_substr($snippetviable,0,$sniplen).(mb_substr($snippetviable,$sniplen) ? "...<br><a href='/articulo/${content['p_id']}".($content['t_replaced_at'] ? "/historia/" . $content['t_id']  : "")."' class='text-blue-600 hover:underline'>Ver mas</a>" : "");
}
if ($category==16){
    $voteoptions=json_decode($content['p_options']);
    if (new dateTime($content['p_end_date']) < new dateTime() || !$loggedin){
        $votephase=2;
    } else {
        $query="SELECT * FROM votescast WHERE post_id = ${content['p_id']} AND user_id = ${_SESSION['id']}";
        if (qq($query)->num_rows){
            $votephase=2;
        } else {
            $votephase=1;
        }
    }

    if ($votephase==2){ 
        $query="SELECT vote,COUNT(1) as OccurenceValue FROM votesresults WHERE post_id=${content['p_id']} GROUP BY vote ;";
        $votesresults=entries( $query);
    }
} else {
    $votephase=0;
}

if ($showcategories){
    $parentcats=0;
    $tempcatassoc=[];
    
    $showncategoryarr=[];
    foreach ($allcategoriesassoc as $fcatid=>$fcat){
        if ( ((2**gmp_init($fcatid)) & $content['p_category'])!=0 ){
            $parentcats|=$fcat['parents'];
            $tempcatassoc[$fcatid]=$fcat;
        }
    }
    /*
    foreach ($tempcatassoc as $fcatid=>$fcat){
        //echo "<br> ".$fcatid." ".$fcat." ".$parentcats." ";

        if ( ($parentcats & (2**gmp_init($fcatid))) == 0 ){
            $showncategoryarr[$fcatid]=$fcat;

        }
    }*/
    $showncategoryarr=$tempcatassoc;
}

//if (!function_exists('savepost')){
//    function savepost(){
    
//    }
//}

if ($shadowcontain){
    $displaysnippet = function() use ($content, $loggedin, $allcategoriesassoc, $replacehtml, $replacecss){
        $displayas="fullpage";
        include 'controllers/c_partial_article.php';
    };
    $snippetlength=400;
    $strippedtags= htmlspecialchars_decode( strip_tags($content['t_content']));
    $shadowcontent=$content['t_content'];
    $shadowstyle=$content['t_css'];
    if (isset($searchquery)){
        
        

        $matches=[];
        $subqueries=[];
        $tempcontent=$strippedtags;
        $tempcontent2=$strippedtags;
        foreach (explode('"', $searchquery) as $subqid=>$subqval){
            if ($subqval){
                if ($subqid % 2 == 0){
                    foreach (explode(' ', $subqval) as $ssubqval){
                        if ($ssubqval){
                            $subqueries[]=$ssubqval;
                        }
                    }
            } else {
                    $subqueries[]=$subqval;
                }
            }
        }

        

        $offset=0;
        $submatches=[];

        
        while (($tpos=mb_stripos_any($subqueries, $tempcontent2, $offset))[0]!==false){
            $submatches[]=$tpos;
            $offset+=$tpos[0]+mb_strlen($tpos[1]);
        }
        

        if (0 < count($submatches)){
            $originaloffset=100;
            $wordsaccounted=0;
            $tbcarr=[$tempcontent2];
            while ($wordsaccounted < count($submatches) &&  ($snippetlength-$originaloffset)/(++$wordsaccounted)/2>25){
                //$tmpstr=array_reduce($tbcarr, fn ($x,$y)=>$x.$y,"");
                $offset=$originaloffset;
                $tbcarr=[mb_substr($tempcontent2,0,$offset)." ... "];
                $subcounter=0;
				
                while (($tpos=mb_stripos_any($subqueries, $tempcontent2,$offset))[0] && $subcounter++<6){
                    $subsnippetlength=(($snippetlength-$originaloffset-mb_strlen(array_reduce(array_slice($submatches,0,$wordsaccounted), fn ($x,$y)=>$x.$y[1],"") ) )/$wordsaccounted/2 );
                    $startat=intval(max($offset,$tpos[0]-$subsnippetlength)); //sometimes offset becomes a float. this seems to fix it. theres probably some data loss oh well.
                    $combinedlength=intval($subsnippetlength*2+mb_strlen($tpos[1]));
                    $tbcarr[]=mb_substr($tempcontent2, $startat,$combinedlength )." ... ";
                    $offset=$startat+$combinedlength+5;
                }

                
            }
            $tempcontent=array_reduce($tbcarr, fn ($x,$y)=>$x.$y,"");
            
        } else {
            $tempcontent=mb_substr($strippedtags,0,$snippetlength).(mb_substr($strippedtags,$snippetlength) ? "..." : "");
        }
        /*
        $nummatches="";
        foreach($subqueries as $subquery){
            $nummatches+=substr_count(strtoupper( $tempcontent),strtoupper($subquery));
        }

        $sumtempcontent="";
        $nummatches=min($nummatches,8);
        $charcounter=0;
        $matchcounter=0;
        while (($tpos=stripos_any($subqueries, $tempcontent2, $charcounter))[0]!==false){
            $charcounter+=$tpos[0]+strlen($tpos[1]); //TOTALLY UNFINISHED, QUERY GIGHLIGHTRER AND EMPTY SPACE DELETER, THIS IS PROBABLY A BAD APPROACH
            $sumtempcontent+=substr($tempcontent, max(0, $tpos[0]-$snippetlength/$nummatches/2), $snippetlength/$nummatches/2+$tpos[0])   
        }
        //for ($x=0;$x<min($nummatches, 6);$x++){
        //    ;
        //}

        */
        //$content['t_content']=mb_str_ireplace($subqueries, array_map(fn ($x)=>"<b>${x}</b>", $subqueries), $tempcontent);
        $content['t_content']=preg_replace(array_map(fn ($x)=>"/".preg_quote($x)."/ui", $subqueries), array_map(fn ($x)=>"<b>${x}</b>", $subqueries), $tempcontent);
        
//exit;

        //$a=substr_count(strtoupper($haystack), strtoupper($needle));
    } else {
        $content['t_content']=mb_substr($strippedtags,0,$snippetlength).(mb_substr($strippedtags,$snippetlength) ? "..." : "");
    }
    $content['t_css']="";
}



include 'partials/post.php';


