<?php
require "../../inc/en_about_core.php";
$str=getpagesetinfo($_GET[pageid],'content,title,pagetitle,keywords,description');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if($str[pagetitle]!=''){echo $str[pagetitle];}else{echo $setinfo[title];}?></title>
<meta name="keywords" content="<?php if($str[keywords]!=''){echo $str[keywords];}else{echo $setinfo[keywords];}?>" />
<meta name="description" content="<?php if($str[description]!=''){echo $str[description];}else{echo $setinfo[description];}?>" />
<link href="../../inc/css/css1.css" rel="stylesheet" type="text/css">
<script src="/inc/js/jquery-1.6.4.min.js"></script>
<script src="../../inc/js/jquery.cycle.js"></script>
<?php if($setinfo[iscopy]=='1'){?>
<script language="JavaScript">
document.oncontextmenu=new Function("event.returnValue=false;");
document.onselectstart=new Function("event.returnValue=false;");
</script>
<?php }?>
<?php if($setinfo[otherheader]!=''){echo $setinfo[otherheader];}?>

<!--[if lt IE 9]>
<script type="text/javascript" src="/inc/js/unitpngfix.js"></script>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

</head>
<body>

<? require "../header.php"; ?>
<div id="about_banner">
<div id="contact_box">
<?=$setinfo[mapcode]?>
</div>
</div>



<div id="contact_contbox">

<div id="about_top">
<div id="about_toptitle">About us</div>
<div id="about_topintro"><?=$str[title];?></div>
</div>

<div id="about_left">
<? require "./leftmenu.php"; ?>
</div>


<div id="about_right">
<?=$str[content];?>
<div style="clear:both"></div>
</div>


<div style="clear:both"></div>
</div>

<? require "../footer.php"; ?>







</body>
</html>
