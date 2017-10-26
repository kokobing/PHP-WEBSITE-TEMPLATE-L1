<?php
require "../../inc/en_productinfo_core.php";
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



<div id="product_contbox">

<div id="about_top">
<div id="about_toptitle">Products</div>
<div id="about_topintro">
<? if(isset($_GET[id1])){echo 'All products';}?>
<? if(isset($_GET[id2])){echo $arrprods[0][name];}?>
</div>
</div>

<div id="case_left">
<ul>
<? for($i=0;$i<sizeof($allproddir2);$i++){?>
<li><a href="/en/product/product.php?id2=<?=$allproddir2[$i][id_proddir]?>" <? if($_GET[id2]==$allproddir2[$i][id_proddir]){echo 'class="curr"';}?>><?=$allproddir2[$i][name];?></a></li>
<? }?>
</ul>
</div>

<div id="product_right">

<h1><?=$oneproduct[title];?></h2>
<p><?php echo $oneproduct[content];?></p>


<div style="clear:both"></div>

</div>


</div>
<div style="clear:both"></div>
</div>

<? require "../footer.php"; ?>





</div>
</body>
</html>
