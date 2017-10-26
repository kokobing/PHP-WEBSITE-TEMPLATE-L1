<?php 
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");

//取出信息 生成一级目录下拉菜单
$strSQL="SELECT id_backmenu,name FROM backmenu WHERE level='1' and dele='1' order by ordernum ASC";
$objDB->Execute($strSQL);
$arrMenu1list=$objDB->GetRows();

$menuid1='<select name=ajax_menuid1 id=ajax_menuid1 >';
for($i=0;$i<sizeof($arrMenu1list);$i++){
$menuid1=$menuid1.'<option value='.$arrMenu1list[$i][id_backmenu].'>'.$arrMenu1list[$i][name].'</option>';
}
$menuid1=$menuid1.'</select>';//在AJAX弹窗生成一级目录下拉菜单

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
			/////
				$("#txt_addmenu").click(function() {
					popprompt('输入字符:', '', '请输入主菜单名称','', function(passmessage) {
						  if (passmessage) {$.post('ajax_addmenu.php',{passmessage: passmessage},function(data) {
                             var myjson = '';eval('myjson=' + data + ';');
                             popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                          };
					   
					});
				});
				
			/////	
				$("#txt_addmenu2").click(function() {
					popprompt_addmenu2('请选择主菜单:', '<?php echo $menuid1;?>', '请输入二级菜单名称和文件名', function(val1,val2) {
						  if (val1) {$.post('ajax_addmenu2.php',{val1:val1,val2:val2},function(data) {
                             var myjson = '';eval('myjson=' + data + ';');
                             popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                          };
					   
					});
				});
				
            ////
			
				
				
			});//$(document).ready
			
			//popmessage(myjson.menuid_ajaxpreedit+'<br />'+myjson.name, '友情提醒!');
function pedit(val1,val2) {//val1＝点击的菜单id，val2判断是一级菜单还是二级菜单
	  if (val2=='2') {$.post('ajax_preedit.php',{val1:val1},function(data) {//ajax_preedit.php 处理回传
                             var myjson = '';eval('myjson=' + data + ';');
							 popprompt_editmenu2('请选择主菜单:', myjson.menuid_ajaxpreedit, '请编辑二级菜单名称和文件名', myjson.name, myjson.selfid,myjson.url,'2', function(menu2name,fatherid,selfid,url,isdel) {
						        if (menu2name) {$.post('ajax_finaledit.php',{menu2name:menu2name,fatherid:fatherid,selfid:selfid,url:url,isdel:isdel},function(data) {
                                   var myjson = '';eval('myjson=' + data + ';');
                                    popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                                  };
					        });
							 
					 }); // ajax_preedit.php 处理回传
       };//if end
	  if (val2=='1') {$.post('ajax_preedit.php',{val1:val1},function(data) {//ajax_preedit.php 处理回传
                             var myjson = '';eval('myjson=' + data + ';');
							 popprompt_editmenu2('请编辑主菜单:', myjson.menuid_ajaxpreedit, '请编辑一级菜单名称和文件名', myjson.name, myjson.selfid,myjson.url,'1', function(menu2name,fatherid,selfid,url,isdel) {
						        if (menu2name) {$.post('ajax_finaledit.php',{menu2name:menu2name,fatherid:fatherid,selfid:selfid,url:url,isdel:isdel},function(data) {
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
        <td height="30" align="right"><!--<span  id="txt_addmenu" style="cursor:pointer">添加主菜单</span>&nbsp;&nbsp;<span class="txt_vline">|</span>&nbsp;&nbsp;<span id="txt_addmenu2"  style="cursor:pointer">添加二级菜单</span>--></td>
      </tr>
    </table>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">后台系统菜单</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
		   <?php  for($i=0;$i<sizeof($arrMenu1);$i++){?>
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu"><table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tr>
                    <td class="txt_lanmu" style="cursor:pointer">
					<?php  echo '<span onclick=pedit('.$arrMenu1[$i][id_backmenu].',"1"); style="cursor:pointer">'.$arrMenu1[$i][name].'</span>';?></td>
                  </tr>
                  <tr>
                    <td align="center"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" class="txt_leftmenu"><?php
						$strSQL="SELECT name,id_backmenu FROM backmenu WHERE level='2' and dele='1' and fatherid='".$arrMenu1[$i][id_backmenu]."' order by ordernum ASC";
                        $objDB->Execute($strSQL);
                        $arrMenu2=$objDB->GetRows();
						for($j=0;$j<sizeof($arrMenu2);$j++){echo '<span onclick=pedit('.$arrMenu2[$j][id_backmenu].',"2");  style="cursor:pointer">'.$arrMenu2[$j][name].'</span>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
						
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

