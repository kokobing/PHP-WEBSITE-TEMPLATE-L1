<?php 
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");

//取出信息
$strSQL="SELECT id_proddir,name,lang,ordernum FROM productdir WHERE level='1' and dele='1' order by ordernum ASC";
$objDB->Execute($strSQL);
$arrnewsdir1=$objDB->GetRows();

$newsdir1='<select name=ajax_newsdir1 id=ajax_newsdir1 >';
for($i=0;$i<sizeof($arrnewsdir1);$i++){
$newsdir1=$newsdir1.'<option value='.$arrnewsdir1[$i][id_proddir].'>'.$arrnewsdir1[$i][name].'</option>';
}
$newsdir1=$newsdir1.'</select>';//在AJAX弹窗生成一级目录下拉菜单
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
			$(document).ready( function() {
			 <?php if($onuserperm_addprem=='1'){?>
			/////
				$("#txt_addnewsdir1").click(function() {
					popprompt('输入字符:', '', '请输入一级目录名称','', function(passmessage) {
						  if (passmessage) {$.post('ajax_addnewsdir.php',{passmessage: passmessage},function(data) {
                             var myjson = '';eval('myjson=' + data + ';');
                             popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                          };
					   
					});
				});
				
			/////	
				$("#txt_addnewsdir2").click(function() {
					popprompt_addnewsdir2('请选择一级目录:', '<?php echo $newsdir1;?>', '请输入二级目录名', function(val1,val2) {
						  if (val1) {$.post('ajax_addnewsdir2.php',{val1:val1,val2:val2},function(data) {
                             var myjson = '';eval('myjson=' + data + ';');
                             popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                          };
					   
					});
				});
				
            ////
			<?php }?>
				
				
			});//$(document).ready
			
			//popmessage(myjson.menuid_ajaxpreedit+'<br />'+myjson.name, '友情提醒!');
function newsdiredit(val1,val2,val3,val4,lang) {//val1＝点击的新闻id，val2判断是一级新闻目录还是二级新闻目录 val3 isdele 
	  if (val2=='2') {$.post('ajax_prenewsedit.php',{val1:val1,val3:val3,val4:val4,lang:lang},function(data) {//ajax_prenews1edit.php 处理回传
                             var myjson = '';eval('myjson=' + data + ';');
							 popprompt_editnewsdir2('请选择一级目录:', myjson.newsid_ajaxpreedit, '请编辑语言菜单及菜单顺序', myjson.name, myjson.selectid,'2',myjson.isdelperm,myjson.intro,myjson.menuorder,myjson.lang, function(newsdir2name,fatherid,newsid,isdel,intro,menuorder,lang) {
						        if (newsdir2name) {$.post('ajax_newsdirfinaledit.php',{newsdir2name:newsdir2name,fatherid:fatherid,newsid:newsid,isdel:isdel,intro:intro,menuorder:menuorder,lang:lang},function(data) {
                                   var myjson = '';eval('myjson=' + data + ';');
                                    popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                                  };
					        });
							 
					 }); // ajax_prenews1edit.php 处理回传
       };//if end
	  if (val2=='1') {$.post('ajax_prenewsedit.php',{val1:val1,val3:val3,val4:val4,lang:lang},function(data) {//ajax_preedit.php 处理回传
                             var myjson = '';eval('myjson=' + data + ';');
							 popprompt_editnewsdir2('请编辑目录名称:', myjson.newsid_ajaxpreedit, '请编辑语言菜单及菜单顺序', myjson.name, myjson.selectid,'1',myjson.isdelperm,myjson.intro,myjson.menuorder,myjson.lang, function(newsdir2name,fatherid,newsid,isdel,intro,menuorder,lang) {
						        if (newsdir2name) {$.post('ajax_newsdirfinaledit.php',{newsdir2name:newsdir2name,fatherid:fatherid,newsid:newsid,isdel:isdel,intro:intro,menuorder:menuorder,lang:lang},function(data) {
                                   var myjson = '';eval('myjson=' + data + ';');
                                    popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                                  };
					        });
							 
					 }); // ajax_preedit.php 处理回传
       };//if end	   
	   
	   
}			
</script>

</head>
<body>
<?php require "../header.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="87.9%">
  <tr> 
    <td width="15%" align="left" valign="top" bgcolor="#E7F1F8">
	<?php require "../leftmenu.php"; ?>
      </td>
    <td width="75%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="right">
        <?php if($onuserperm_addprem=='1'){?>
        <span  id="txt_addnewsdir1" style="cursor:pointer">添加一级目录</span>&nbsp;&nbsp;<span class="txt_vline">|</span>&nbsp;&nbsp;<span id="txt_addnewsdir2"  style="cursor:pointer">添加二级目录</span><?php }else{?>
        <span class="txt_addnewsdir" style="cursor:pointer">添加一级目录</span>&nbsp;&nbsp;<span class="txt_vline">|</span>&nbsp;&nbsp;<span class="txt_addnewsdir" style="cursor:pointer">添加二级目录</span><?php }?>
        </td>
      </tr>
    </table>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">产品分类</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
		   <?php  for($i=0;$i<sizeof($arrnewsdir1);$i++){?>
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu"><table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tr>
                    <td class="txt_lanmu">
					<?php if($onuserperm_editprem=='1'){echo '<span onclick=newsdiredit('.$arrnewsdir1[$i][id_proddir].',"1",'.$onuserperm_deleprem.','.$arrnewsdir1[$i][ordernum].','.$arrnewsdir1[$i][lang].'); style="cursor:pointer">'.$arrnewsdir1[$i][name].'</span>';} else{ echo $arrnewsdir1[$i][name];}?>
                    </td>
                  </tr>
                  <tr>
                    <td align="center"><table width="88%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" class="txt_leftmenu">
						<?php
						$strSQL="SELECT name,id_proddir,lang,ordernum FROM productdir WHERE level='2' and dele='1' and fatherid='".$arrnewsdir1[$i][id_proddir]."' order by ordernum ASC";
                        $objDB->Execute($strSQL);
                        $arrnewsdir2=$objDB->GetRows();
						for($j=0;$j<sizeof($arrnewsdir2);$j++){if($onuserperm_editprem=='1'){
echo '<span onclick=newsdiredit('.$arrnewsdir2[$j][id_proddir].',"2",'.$onuserperm_deleprem.','.$arrnewsdir2[$j][ordernum].','.$arrnewsdir2[$j][lang].');  style="cursor:pointer">'.$arrnewsdir2[$j][name].'</span>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{echo $arrnewsdir2[$j][name];}
						}
						
						?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
            </tr>
			<?php }?>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
	  </td>
  </tr>
</table>


<?php require "../footer.php"; ?>
</body>
</html>

