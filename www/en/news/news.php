<?php
require "../../inc/en_news_core.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $setinfo[keywords];?>" />
<meta name="description" content="<?php echo $setinfo[description];?>" />
<title><?php echo $setinfo[title];?></title>
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
<div id="about_box"><img src="../../inc/pics/about_banner.jpg" /></div>
</div>



<div id="news_contbox">

<div id="about_top">
<div id="about_toptitle">News center</div>
<div id="about_topintro"><? if(isset($_GET[ndir])){echo $arrnews[0][name];}else{echo 'All news';}?></div>
</div>

<div id="about_left">
<ul>
<? for($i=0;$i<sizeof($getnewsdir2);$i++){?>
<li><a href="/en/news/news.php?ndir=<?=$getnewsdir2[$i][id_newsdir];?>" <? if($_GET[ndir]==$getnewsdir2[$i][id_newsdir]){echo 'class="curr"';}?>><?=$getnewsdir2[$i][name];?></a></li>
<? }?>
</ul>
</div>

<div id="news_right">

<div class="newspicbox">


<?php for($i=0;$i<sizeof($arrnews);$i++){?>
<div class="newspicboxsmall">
<a href="/en/news/newspage.php?newsid=<?=$arrnews[$i][id_newsinfo]?>"><img src="/upload/news/<?=getnewspic($arrnews[$i][id_newsinfo]);?>" /></a>
<h1><?=$arrnews[$i][title]?></h1>
<p>
<span><a href="/en/news/newspage.php?newsid=<?=$arrnews[$i][id_newsinfo]?>">></a></span>
<a href="/en/news/newspage.php?newsid=<?=$arrnews[$i][id_newsinfo]?>">
<?=$arrnews[$i][intro]?></a>
</p>
</div><!--end newspicboxsmall!-->
<?php }?>



</div><!--end newpicbox!-->

<div id="nvai"> <?php if(substr(trim($strNavigate),-46)!='#494949"><strong>1</strong></font>&nbsp;&nbsp;'){echo $strNavigate;}?></div>

<div style="clear:both"></div>
</div><!--end news_right!-->
<div style="clear:both"></div>
</div>


<? require "../footer.php"; ?>

</body>
</html>
