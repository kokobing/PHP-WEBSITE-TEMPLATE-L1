<?php 
/*
add 增加空界面 :01表示
add_s 提交入库：02表示
edit 编辑抽取：03表示
edit_s 编辑提交：04表示
del 删除：05表示
action 空动作：06表示
*/
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");
require_once("../inc/navipage.php");
require_once("../inc/upload_imgs.php");//上传图片类
require_once("../inc/function.class.php");
require_once("../inc/js/ckeditor/ckeditor.php");//引用fck
require_once("../inc/js/ckfinder/ckfinder.php");//引用fck


$oFCKeditor = new CKEditor();
$oFCKeditor->returnOutput = true; //设置输出可用变量的情况
$oFCKeditor->basePath = '../inc/js/ckeditor/';//设置路径
$oFCKeditor->config['width'] ='100%';
CKFinder::SetupCKEditor($oFCKeditor, '../inc/js/ckfinder/') ;

$action=$_SERVER["QUERY_STRING"];
$pic_dir="../../upload/layout/"; //图片路径

//取出信息信息 start
if(isset($action) && ($action=="" || substr($action,0,6)=='&page=')){
if(isset($_REQUEST["page"]) ){$intCurPage=$_REQUEST["page"];}else{$intCurPage=1;}
$intRows = 25;
$strSQLNum = "SELECT COUNT(*) as num from pageset ";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "SELECT * FROM pageset order by id_pageset DESC" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrnewsinfos=$objDB->GetRows();
$intNews=sizeof($arrnewsinfos);
}//取出信息信息 end


$_POST[newscontent]=str_replace("'","&acute;",$_POST[newscontent]);

//添加信息入库
if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){

	$strSQL="INSERT INTO pageset(title,pagetitle,keywords,description,content)
	                     values('".$_POST[title]."','".$_POST[pagetitle]."','".$_POST[keywords]."','".$_POST[description]."','".$_POST[newscontent]."')";
	$objDB->Execute($strSQL);

    header('Location:pageset.php');ob_end_flush();exit();//跳转
}	

//编辑信息入库
if(isset($action) && substr($action,0,2)=="04" && $onuserperm_editprem=='1'){
	$onenewsinfoid=substr($action,2);
    $strSQL="UPDATE pageset SET title='".$_POST[title]."',pagetitle='".$_POST[pagetitle]."',keywords='".$_POST[keywords]."',description='".$_POST[description]."',content='".$_POST[newscontent]."' where id_pageset=$onenewsinfoid";
	$objDB->Execute($strSQL);
	header('Location:pageset.php?03'.$onenewsinfoid);ob_end_flush();exit();
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<script src="../inc/js/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="../inc/js/ajaxfileupload.js" type="text/javascript"></script>
<?php if($onuserperm_deleprem=='1'){?>
<script type="text/javascript">

function needupfile(upid,upfilepath,upfiletype,indatafile){
 popneedupfile('','文件上传!',upid,upfilepath,upfiletype,indatafile,function() {});
}

function neededitupfile(picid){
 $.post('/admin/inc/ajax_getfiles.php',{picid:picid,datasheet:'pagesetpic'},function(data){
                            var myjson = '';eval('myjson=' + data + ';');
                            popneededitupfile('','文件编辑',myjson.datasheet,myjson.getfileid,myjson.getfiletype,myjson.getfiletitle,myjson.getfileintro,myjson.getfileurl,myjson.getfilename,function() {});
							
							});

}


function delpic(picid){
					pop_confirm_m('确认删除图片:', '', picid, function(picid) {
						  $.post('ajax_delepagesetpic.php',{picid:picid},function(data){
                            var myjson = '';eval('myjson=' + data + ';');
                            popmessage(myjson.info, '友情提醒!');
							$("#pickuang").html(myjson.str);
							 window.location.reload();
							});
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
        <?php if($onuserperm_addprem=='1'){?>
        <!--<a href="pageset.php?01" class="txt_addnews" >添加版面</a>-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php }?>
        </td>
      </tr>
    </table>
    <?php if(isset($action)  && ($action=="" || substr($action,0,6)=='&page=')){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">版面管理</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="5">
                <?php for($i=0;$i<$intNews;$i++) {?>
            <tr>
              <td width="28%" height="30" align="left" valign="bottom" class="txt_leftmenu"><a href="pageset.php?03<?php echo $arrnewsinfos[$i][id_pageset];?>"  class="txt_leftmenu"><?php echo cutstr($arrnewsinfos[$i][title],60,1);?></a></td>
              <td width="51%" align="left" valign="bottom" class="txt_leftmenu"></td>
              <td width="12%" align="left" valign="bottom" class="txt_leftmenu">&nbsp;</td>
              <td width="9%" align="left" valign="bottom" class="txt_leftmenu"><?php if($onuserperm_editprem=='1'){?>
                <a href="pageset.php?03<?php echo $arrnewsinfos[$i][id_pageset];?>"  class="txt_leftmenu">编辑</a>
                <?php }?></td>
            </tr>
           <tr>
            <td colspan="4" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
           </tr>
			<?php }?>
          </table></td>
        </tr>
        <tr>
          <td align="center"><?php echo $strNavigate;?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
<?php }?>
<?php if(isset($action) && $action=='01' && $onuserperm_addprem=='1'){?>
<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">添加版面</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu">
              <form action="pageset.php?02" method="post" enctype="multipart/form-data" name="form" id="form"  onsubmit="return OnCheck(this);" >
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">版面名称</td>
                    <td bgcolor="#FFFFFF"><input name="title" type="text" class="input_01" id="title" style="width:400px" value="" /></td>
                    </tr>
                                        <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">网页标题</td>
                    <td bgcolor="#FFFFFF"><input name="pagetitle" type="text" class="input_01" id="pagetitle" style="width:400px" value="" />
                      </tr>
                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">网页关健词</td>
                    <td bgcolor="#FFFFFF"><input name="keywords" type="text" class="input_01" id="keywords" style="width:400px" value="" />
                      </tr>
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">网页描述</td>
                    <td bgcolor="#FFFFFF"><textarea name="description" rows="5" class="input_01" id="intro" style="width:400px"></textarea>
                      </tr>
                  <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">信息内容</td>
                    <td bgcolor="#FFFFFF"><?php	echo $oFCKeditor->editor("newscontent",'');?></td>
                  </tr>
                   <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                   <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">链接地址</td>
                    <td bgcolor="#FFFFFF"><input type="text" class="input_01" name="url" id="url" style="width:300px"/></td>
                  </tr>
                   <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='pageset.php'" />                    </td>
                  </tr>
              </table>
              </form></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>   
    <?php }?>
    <?php if(isset($action) && substr($action,0,2)=='03' && $onuserperm_editprem=='1'){
	//取出某条信息
   $onenewsid=substr($action,2);
   $strSQL="SELECT * FROM pageset WHERE id_pageset=$onenewsid";
   $objDB->Execute($strSQL);
   $onenewsinfo=$objDB->fields();  
   
   $strSQL="SELECT opicname,id_pagesetpic,type,title FROM pagesetpic WHERE id_pageset=$onenewsid";
   $objDB->Execute($strSQL);
   $onenewspicinfo=$objDB->GetRows();

	?>
    <div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">编辑版面</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu">
              <form action="pageset.php?04<?php echo $onenewsinfo[id_pageset];?>" method="post" name="form" id="form"  onsubmit="return OnCheck(this);" >
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">版面名称</td>
                    <td bgcolor="#FFFFFF"><input name="title" type="text" class="input_01" id="newstitle" style="width:500px" value="<?php echo $onenewsinfo[title];?>" /></td>
                    </tr>
                                      <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                                   <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">网页标题</td>
                    <td bgcolor="#FFFFFF"><input name="pagetitle" type="text" class="input_01" id="pagetitle" style="width:400px" value="<?php echo $onenewsinfo[pagetitle];?>" />
                      </tr>
                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">网页关健词</td>
                    <td bgcolor="#FFFFFF"><input name="keywords" type="text" class="input_01" id="keywords" style="width:400px" value="<?php echo $onenewsinfo[keywords];?>" /> 
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">网页描述</td>
                    <td bgcolor="#FFFFFF"><textarea name="description" rows="5" class="input_01" id="intro2" style="width:400px"><?php echo $onenewsinfo[description];?></textarea>
</tr>
                                      <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">信息内容</td>
                    <td bgcolor="#FFFFFF"><?php	echo $oFCKeditor->editor("newscontent",$onenewsinfo[content]);?></td></tr>
                                            <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                                            <tr bgcolor="#FFFFFF">
                                              <td valign="top" bgcolor="#FFFFFF"><span style="cursor:pointer">文件</span></td>
                                              <td bgcolor="#FFFFFF"><span onclick="needupfile(<?php echo $onenewsinfo[id_pageset];?>,'../../upload/layout/','|jpg|jpeg|gif|pdf|rar|doc','/admin/siteset/ajax_upfilepagesetindata.php');" style="cursor:pointer">文件上传...</span>
                                              <div id="pickuang">
<?php for($i=0;$i<sizeof($onenewspicinfo);$i++){
if($onenewspicinfo[$i][type]=="JPG" || $onenewspicinfo[$i][type]=="JPEG" || $onenewspicinfo[$i][type]=="GIF" || $onenewspicinfo[$i][type]=="PNG"){
?>
<div class="box floatLeft" style="position:relative"><a href="javascript:void(0)"  onclick="$.wholepop.dialogClass ='style_1';poppic('/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>','图片预览及地址复制','<?php echo $onenewspicinfo[$i][id_pagesetpic];?>');" onmouseover=$("#hidetitlepic<?=$i;?>").show(); onmouseout=$("#hidetitlepic<?=$i;?>").hide();><img src="/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>" width="50" height="50" border="0" /></a><span class="txt_underpic" onclick="delpic(<?php echo $onenewspicinfo[$i][id_pagesetpic];?>);" style="cursor:pointer">删除</span>
<div id="hidetitlepic<?=$i;?>" style="position:absolute;left:0px;top:0px; width:166px; display:none; z-index:100; background-color:#CCC"><?php echo $onenewspicinfo[$i][title];?></div>
</div>
<? }else if($onenewspicinfo[$i][type]=="PDF"){?>
<div class="box floatLeft"><a href="javascript:void(0)" onclick='window.clipboardData.setData("Text", "<?php echo $siteurl;?>/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>");alert("文件地址已经复制");'><img src="/admin/inc/pics/pdf.gif" width="50" height="50" border="0" /></a><span class="txt_underpic" onclick="delpic(<?php echo $onenewspicinfo[$i][id_pagesetpic];?>);" style="cursor:pointer">删除</span></div>
<? }else if($onenewspicinfo[$i][type]=="DOC"){?>
<div class="box floatLeft"><a href="javascript:void(0)" onclick='window.clipboardData.setData("Text", "<?php echo $siteurl;?>/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>");alert("文件地址已经复制");'><img src="/admin/inc/pics/doc.gif" width="50" height="50" border="0" /></a><span class="txt_underpic" onclick="delpic(<?php echo $onenewspicinfo[$i][id_pagesetpic];?>);" style="cursor:pointer">删除</span></div>
<?php  }}?>
</div>                                              </td>
                                            </tr>
                        
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='pageset.php'" />                    </td>
                  </tr>
              </table>
              </form></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>   
    <?php }?>
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

