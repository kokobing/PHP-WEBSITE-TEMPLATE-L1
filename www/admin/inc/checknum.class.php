<?php 
/* 
 *   Filename: authimg.php 
 *   Author:   hutuworm 
 *   Date:     2003-04-28 
 *   @Copyleft hutuworm.org 
 */ 
//
session_start(); 
$authnum=strval(rand("1111","9999"));
$_SESSION["login_check_num"]=$authnum;


//生成验证码图片 
Header("Content-type: image/PNG");  
srand((double)microtime()*1000000); 
$im = imagecreate(56,20); 
//$black = ImageColorAllocate($im, 0,0,0); 
$white = ImageColorAllocate($im, 243,247,232); 
$txt = ImageColorAllocate($im, 0,0,0); 
imagefill($im,68,30,$white); 


//将四位整数验证码绘入图片 
imagestring($im, 5, 10, 3, $authnum, $txt); 

//加入干扰象素 
for($i=0;$i<200;$i++)   
{ 
    $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
} 
ImagePNG($im); 
ImageDestroy($im); 
?>
