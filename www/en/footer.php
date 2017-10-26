<div id="footer">

<div id="footer_info">
<p>
<?
$footertext=getlayoutinfo(8,'content');
echo $footertext[content];
?>
</p>


</div>

</div>
<?php if(trim($setinfo[statistics])!=''){echo $setinfo[statistics];}//统计代码?>