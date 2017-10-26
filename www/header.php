<div id="header_box">
<div id="header" >
<div id="header_logo"><a href="/"><img src="/upload/layout/<?=getlayoutpic(1,0)?>" width="132" height="27" /></a></div>
<div id="header_menubox">
<div id="header_language"><a href="/">中文</a> | <a href="/en/">English</a></div>

<div id="header_menu" style="position: relative">
<ul  id="menu">
<li><a href="/" id="n1"  <? if(getcurrentfilename()=='index.php'){echo ' class="curr"';}?>>首页</a></li>
<li><a href="/about/about.php?pageid=1" id="n2"  <? if(getcurrentfilename()=='about.php'){echo ' class="curr"';}?>>关于我们</a></li>
<li><a href="/news/news.php" id="n3"  <? if(getcurrentfilename()=='news.php'){echo ' class="curr"';}?>>新闻动态</a></li>
<li><a href="/product/product.php?id1=1" id="n4"  <? if(getcurrentfilename()=='product.php'){echo ' class="curr"';}?>>产品中心</a></li>
<li><a href="/case/case.php" id="n5"  <? if(getcurrentfilename()=='case.php'){echo ' class="curr"';}?>>案例展示</a></li>
<li><a href="/about/hr.php?pageid=7" id="n6"  <? if(getcurrentfilename()=='hr.php'){echo ' class="curr"';}?>>人才招聘</a></li>
<li><a href="javascript:void(0)"  onclick="needsendmail2();" id="n7"  >留言反馈</a></li>
<li style="border-right: none;"><a href="/about/contact.php?pageid=6" id="n8"  <? if(getcurrentfilename()=='contact.php'){echo ' class="curr"';}?>>联系我们</a></li>
</ul>

<div class="children">

<ul id="subNav2"  style="margin-left:-100px;" <? if(getcurrentfilename()=='about.php'){echo 'style="display:block;"';}?>>
	<li><a href="/about/about.php?pageid=1">公司简介</a></li>
	<li><a href="/about/about.php?pageid=2">发展历程</a></li>
	<li><a href="/about/about.php?pageid=3">解决方案</a></li>
	<li><a href="/about/about.php?pageid=4">企业文化</a></li>
	<li><a href="/about/about.php?pageid=5">合作伙伴</a></li>
</ul>
<ul id="subNav3" <? if(getcurrentfilename()=='news.php'){echo 'style="display:block"';}?>>
<? for($i=0;$i<sizeof($getnewsdir2);$i++){?>
	<li style="width:120px;"><a style="width:120px;" href="/news/news.php?ndir=<?=$getnewsdir2[$i][id_newsdir]?>"><?=$getnewsdir2[$i][name]?></a></li>
<? }?>  
</ul>
<ul id="subNav4" <? if(getcurrentfilename()=='product.php'){echo 'style="display:block"';}?>>
<? for($i=0;$i<sizeof($allproddir2);$i++){?>
<li><a href="/product/product.php?id2=<?=$allproddir2[$i][id_proddir]?>" ><?=$allproddir2[$i][name];?></a></li>
<? }?>
</ul>
<ul id="subNav5" <? if(getcurrentfilename()=='case.php'){echo 'style="display:block"';}?>>
<? for($i=0;$i<sizeof($getcasedir2);$i++){?>
<li><a href="/case/case.php?ndir=<?=$getcasedir2[$i][id_newsdir];?>" ><?=$getcasedir2[$i][name];?></a></li>
<? }?>
</ul>
</div>


</div>
</div><!--end header_menubox!-->
</div><!--end header!-->
</div><!--end header_box!-->

<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("#menu a").mouseover(function(){
		$("#menu a").attr("class","");
		$("#"+this.id).attr("class","curr");
		var currentMenuNo = parseInt(this.id.substring(1));
		$(".children ul").each(function(){
			$(this).hide();
			$("#subNav"+currentMenuNo).show();
		});
	});
});
</script>
