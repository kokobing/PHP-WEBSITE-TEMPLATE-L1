<?php 
/*
add 增加空界面 :01表示
add_s 提交入库：02表示
edit 编辑抽取：03表示
edit_s 编辑提交：04表示
del 删除：05表示
*/
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");
//取出新闻信息
$strSQL="SELECT productinfo.id_prodinfo,productdir.name,productinfo.title,productinfo.content FROM productinfo left join productdir on productinfo.id_proddir=productdir.id_proddir WHERE productinfo.dele='0' order by productinfo.deldate ASC";
$objDB->Execute($strSQL);
$arrproductinfos=$objDB->GetRows();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<?php if($onuserperm_deleprem=='1'){?>
<script type="text/javascript">
function delenews(val1) {//val1新闻id
				var delenews=val1;
					popprompt_del2('确认删除新闻:', '', delenews, function(isdel) {
						  if (isdel) {$.post('ajax_delenews.php',{val1:val1,isdel:isdel},function(data){
                             var myjson = '';eval('myjson=' + data + ';');
                             popmessage(myjson.info, '友情提醒!',function() {window.location.reload();}); });
                          };
					});
}

</script>
<?php }?>
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
              <td width="153" class="txt_lanmu">产品回收站</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
		   <?php for($i=0;$i<sizeof($arrproductinfos);$i++) {?>
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu">
              <table width="100%" border="0" cellspacing="5" cellpadding="3">
                  <tr>
                    <td align="left" width="22%" class="txt_leftmenu">[ <?php echo $arrproductinfos[$i][name]?> ]</td>
                    <td width="67%" align="left"><?php echo $arrproductinfos[$i][title]?></td>
                    <td width="11%" align="left">
        <?php if($onuserperm_deleprem=='1'){?>
                    <span class="txt_addnews" style="cursor:pointer" onclick=delenews(<?php echo $arrproductinfos[$i][id_prodinfo]?>);>删除</span><?php }?></td>
                  </tr>
              </table>
              </td>
            </tr>
			<?php }?>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>    
   </td>
  </tr>
</table>
<?php require "../footer.php"; ?>
</body>
</html>

