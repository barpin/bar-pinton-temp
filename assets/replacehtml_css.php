<?php
if (!isset($replacecss)){
  $replacecss=function ($matches) use ($link, $category){
      if (strtoupper($matches[1])=="DEFAULT"){
          return file_get_contents('css/default_article.css');
      } else if (ctype_digit($matches[1])){
          $query="SELECT css FROM textupdates WHERE id = ${matches[1]}";
          if ($fcss=qq($link, $query)->fetch_assoc() ){
              return $fcss['css'];
          } 
      } 
      
      return "";
  };
  $replacehtml=function ($matches) use ($link){
      if (ctype_digit($matches[1])){
          $query="SELECT content FROM textupdates WHERE id = ${matches[1]}";
          if ($fcss=qq($link, $query)->fetch_assoc() ){
              return $fcss['content'];
          } 
      }
      return "";
  };
}