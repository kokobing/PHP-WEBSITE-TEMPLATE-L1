<?php

function cutstr($string,$length,$tag) {//php utf-8 字符串截取 0不带后缀 1带...后缀
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);  
        for($i=0; $i<count($info[0]); $i++) {
                $wordscut .= $info[0][$i];
                $j = ord($info[0][$i]) > 127 ? $j + 2 : $j + 1;
                if ($j > $length - 3) {
                        if($tag==0){
						    return $wordscut;
						}elseif($tag==1)
						{
						    return $wordscut."......";
						}
                }
        }
        return join('', $info[0]);
}


//时间转换
function time_tran($the_time){
   $now_time = date("Y-m-d H:i:s",time()+8*60*60); 
   $now_time = strtotime($now_time);
   $show_time = strtotime($the_time);
   $dur = $now_time - $show_time;
   if($dur < 0){
    return $the_time; 
   }else{
    if($dur < 60){
     return $dur.'秒前'; 
    }else{
     if($dur < 3600){
      return floor($dur/60).'分钟前'; 
     }else{
      if($dur < 86400){
       return floor($dur/3600).'小时前'; 
      }else{
       if($dur < 259200){//3天内
        return floor($dur/86400).'天前';
       }else{
        return $the_time; 
       }
      }
     }
    }
   }
}
?>