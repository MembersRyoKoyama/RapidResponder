<?php
function strcut($text,$limit){
  if(mb_strlen($text) > $limit) { 
    $title = mb_substr($text,0,$limit);
    return $title. ･･･ ;
  } else {
    return $text;
  }
}