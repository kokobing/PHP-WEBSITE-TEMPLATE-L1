<?php
require "../inc/en_index_core.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $setinfo[keywords];?>" />
<meta name="description" content="<?php echo $setinfo[description];?>" />
<title><?php echo $setinfo[title];?></title>
<link href="../inc/css/css1.css" rel="stylesheet" type="text/css">
<link href="../inc/css/homeslidenotext.css" rel="stylesheet" type="text/css">
<script src="/inc/js/jquery-1.6.4.min.js"></script>
<script src="/inc/js/jquery.easing.1.3.js"></script>
<script src="/inc/js/slides.min.jquery.js"></script>
<script src="/inc/js/jcarousellite_1.0.1.pack.js" type="text/javascript"></script>
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
<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: '/inc/pics/loading.gif',
				play: 5000,
				pause: 2500,
				effect: 'fade, fade',
				hoverPause: true
			});
		});
</script>
<script type="text/javascript">
   $(document).ready(function(){
    $(".news_list").jCarouselLite({
     auto: 3000,scroll: 1,speed: 300,visible:1, vertical: true
    }); 
   });
</script>
</head>
<body>

<? require "header.php"; ?>

<div id="banner">

	<div id="container">
       			<div id="slides">
				<div class="slides_container">
                <?
                $getlayoutpicnuminfo=getlayoutpicnuminfo(3,4,'opicname as pic');//取4张图片
				for($i=0;$i<sizeof($getlayoutpicnuminfo);$i++){//for循环4张图片
				?>
					<a href="javascript:void(0)"><img src="/upload/layout/<?=$getlayoutpicnuminfo[$i][pic]?>" width="980" height="340" /></a>
                 <? }//for结束?>  
       
                </div>
			</div>
	</div>
</div>
<div id="bannerbg"><img src="/inc/pics/bannerbg.gif"  /></div>

<div id="news">

<div id="news_listbox">

<div class="news_list">
<ul>

	<li style=" background: url(inc/pics/news.jpg) no-repeat left;"><a href="/about/about.php?pageid=1"> 与江苏温阳律师事务所签约，建立长期合作伙伴关系！</a></li>
	<li style=" background: url(inc/pics/notice.jpg) no-repeat left;"><a href="/about/about.php?pageid=2">公司拥有领先的技术和经验，目前是引领该行业的先锋企业.</a></li>
    
</ul>
</div><!--end new_list!-->

<div class="news_list">
<ul>

	<li style=" background: url(inc/pics/news.jpg) no-repeat left;"><a href="/about/about.php?pageid=1"> 与江苏温阳律师事务所签约，建立长期合作伙伴关系！</a></li>
	<li style=" background: url(inc/pics/notice.jpg) no-repeat left;"><a href="/about/about.php?pageid=2">公司拥有领先的技术和经验，目前是引领该行业的先锋企业.</a></li>
    
</ul>
</div><!--end new_list!-->

</div><!--end new_listbox!-->
</div><!--end news!-->

<div id="contentbox">
<div id="content">

<?
$getlayoutpicnuminfo=getlayoutpicnuminfo(6,4,'title,intro,url');//取4张图片的信息标题 内容 URL
for($i=0;$i<sizeof($getlayoutpicnuminfo);$i++){//for循环4张图片
?>
<div class="newsinfo">
<div class="innerinfo" <? if($i==3){echo 'style="border:none"';}?>>
<h1><?=$getlayoutpicnuminfo[$i][title]?></h1>
<p><?=$getlayoutpicnuminfo[$i][intro]?></p>
<p><a href="<?=$getlayoutpicnuminfo[$i][url]?>"><img src="/inc/pics/more.jpg" /></a></p>
</div>
</div><!--end newsinfo!-->
<? }//for结束?>  


</div><!--end content!-->
</div><!--end contentbox!-->

<div id="content_pic">


<?
$getlayoutpicnuminfo=getlayoutpicnuminfo(7,3,'title,intro,url,opicname as pic');//取4张图片的信息标题 内容 URL
for($i=0;$i<sizeof($getlayoutpicnuminfo);$i++){//for循环4张图片
?>
<div class="onepicbox">
 <a href="<?=$getlayoutpicnuminfo[$i][url]?>"><img src="/upload/layout/<?=$getlayoutpicnuminfo[$i][pic]?>"  /></a>
<div class="picinfo">
<h1><?=$getlayoutpicnuminfo[$i][title]?></h1>
<p><?=$getlayoutpicnuminfo[$i][intro]?></p>
</div>
</div>
<? }//for结束?>  





</div><!--end content_pic!-->


<? require "footer.php"; ?>





</div>
</body>
</html>
