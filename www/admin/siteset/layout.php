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

//交换位置
	if(isset($_GET["action"]) && $_GET["action"]=="switch"){
		$strSQL="UPDATE layout SET ordernum=".$_GET[swtorder]." WHERE id_layout=".$_GET[id]."";
		$objDB->Execute($strSQL);
		$strSQL="UPDATE layout SET ordernum=".$_GET[order]." WHERE id_layout=".$_GET[swtid]."";	
		$objDB->Execute($strSQL);
	    header('Location:layout.php?&page='.$_GET[page]);ob_end_flush(); exit();//跳转
	}
	
if(isset($_GET[Rows])){//SESSION记忆行数
	$_SESSION[Rowsnum]=$_GET[Rows];
	header('Location:layout.php');ob_end_flush(); exit();//跳转
}

//取出信息信息 start
if(isset($action) && ($action=="" || substr($action,0,6)=='&page=')){
if(isset($_REQUEST["page"]) ){$intCurPage=$_REQUEST["page"];}else{$intCurPage=1;}
if(isset($_SESSION[Rowsnum])){$intRows = $_SESSION[Rowsnum];}else{$intRows = 10;}//如果SESSION记忆行数存在 则行数为记忆 否则默认10
$strSQLNum = "SELECT COUNT(*) as num from layout ";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "SELECT * FROM layout order by ordernum DESC" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrnewsinfos=$objDB->GetRows();
$intNews=sizeof($arrnewsinfos);
}//取出信息信息 end


//添加信息入库
if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){

	$strSQL="INSERT INTO layout(title,openstat,intro,content,url)
	                     values('".$_POST[title]."','".$_POST[openstat]."','".$_POST[intro]."','".$_POST[newscontent]."','".$_POST[url]."')";
	$objDB->Execute($strSQL);
   
    $ordernumid=$objDB->getInsertID();//获取插入到数据库记录的ID号
	$strSQL="UPDATE layout SET ordernum='$ordernumid'   where id_layout='$ordernumid'";
	$objDB->Execute($strSQL);

    header('Location:layout.php');ob_end_flush(); exit();//跳转
}	

//编辑信息入库
if(isset($action) && substr($action,0,2)=="04" && $onuserperm_editprem=='1'){
	$onenewsinfoid=substr($action,2);
    $strSQL="UPDATE layout SET title='".$_POST[title]."',openstat='".$_POST[openstat]."',intro='".$_POST[intro]."',content='".$_POST[newscontent]."',url='".$_POST[url]."' where id_layout=$onenewsinfoid";
	$objDB->Execute($strSQL);
	header('Location:layout.php');ob_end_flush(); exit();
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
 $.post('/admin/inc/ajax_getfiles.php',{picid:picid,datasheet:'layoutpic'},function(data){
                            var myjson = '';eval('myjson=' + data + ';');
                            popneededitupfile('','文件编辑',myjson.datasheet,myjson.getfileid,myjson.getfiletype,myjson.getfiletitle,myjson.getfileintro,myjson.getfileurl,myjson.getfilename,function() {});
							
							});

}

function delpic(picid){
					pop_confirm_m('确认删除图片:', '', picid, function(picid) {
						  $.post('ajax_delelayoutpic.php',{picid:picid},function(data){
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
        <!--<a href="layout.php?01" class="txt_addnews" >添加区块</a>-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php }?>
        </td>
      </tr>
    </table>
    <?php if(isset($action)  && ($action=="" || substr($action,0,6)=='&page=')){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="77%" height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">区块管理</td>
            </tr>
          </table></td>
          <td width="23%" align="center" background="../inc/pics/lanmubg.gif" class="txt">每页显示 <a href="layout.php?Rows=5" class="link_rightmenu">5</a> <a href="layout.php?Rows=10"  class="link_rightmenu">10</a> <a href="layout.php?Rows=15" class="link_rightmenu">15</a> <a href="layout.php?Rows=20" class="link_rightmenu">20</a> <a href="layout.php?Rows=25" class="link_rightmenu">25</a> <a href="layout.php?Rows=30" class="link_rightmenu">30</a></td>
        </tr>
        <tr>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><table width="95%" border="0" cellspacing="0" cellpadding="5">
                      
		   <?php for($i=0;$i<$intNews;$i++) {?>
            <tr>
              <td width="24%" height="30" align="left" valign="middle" class="txt_leftmenu"><a href="layout.php?03<?php echo $arrnewsinfos[$i][id_layout];?>"  class="txt_leftmenu"><?php echo cutstr($arrnewsinfos[$i][title],60,1);?></a></td>
              <td width="68%" align="left" valign="middle" class="txt_leftmenu"><a href="layout.php?03<?php echo $arrnewsinfos[$i][id_layout];?>"  class="txt_leftmenu"><?php echo cutstr($arrnewsinfos[$i][intro],160,1);?></a></td>
              <td width="8%" align="left" valign="middle" class="txt_leftmenu"><?php if($onuserperm_editprem=='1'){?>
                <a href="layout.php?03<?php echo $arrnewsinfos[$i][id_layout];?>"  class="txt_leftmenu">编辑</a>
                <?php }?>
                
                <? if($i!=0){ //判断一级目录是否位置在最前?>
<a href='layout.php?action=switch&id=<?=$arrnewsinfos[$i][id_layout];?>&order=<?=$arrnewsinfos[$i][ordernum];?>&swtid=<?=$arrnewsinfos[$i-1][id_layout];?>&swtorder=<?=$arrnewsinfos[$i-1][ordernum];?>&page=<?=$_GET[page];?>'><img src='../inc/pics/icon_001.gif' border='0' width='10' height='10'></a>&nbsp;
			<? }else {?>
<img src='../inc/pics/icon_0012.gif' border='0' width='10' height='10'>&nbsp;
			 
			<? } if($i!=$intNews-1){//判断一级目录是否位置在最后?>
<a href='layout.php?action=switch&id=<?=$arrnewsinfos[$i][id_layout];?>&order=<?=$arrnewsinfos[$i][ordernum];?>&swtid=<?=$arrnewsinfos[$i+1][id_layout];?>&swtorder=<?=$arrnewsinfos[$i+1][ordernum];?>&page=<?=$_GET[page];?>'><img src='../inc/pics/icon_002.gif' border='0' width='10' height='10'></a>&nbsp;
			<? } else{ ?>
<img src='../inc/pics/icon_0022.gif' border='0' width='10' height='10'>&nbsp;
			<? }?>                </td>
            </tr>
           <tr>
            <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
           </tr>
			<?php }?>
          </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><?php echo $strNavigate;?></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
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
              <td width="153" class="txt_lanmu">添加区块</td>
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
              <form action="layout.php?02" method="post" enctype="multipart/form-data" name="form" id="form"  onsubmit="return OnCheck(this);" >
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">标题</td>
                    <td bgcolor="#FFFFFF"><input name="title" type="text" class="input_01" id="title" style="width:400px" value="" /></td>
                    </tr>
                  <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">简介</td>
                    <td bgcolor="#FFFFFF"><textarea name="intro" rows="5" class="input_01" id="intro" style="width:400px"></textarea>                            </tr>
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
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='layout.php'" />                    </td>
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
   $strSQL="SELECT * FROM layout WHERE id_layout=$onenewsid";
   $objDB->Execute($strSQL);
   $onenewsinfo=$objDB->fields();  
   
   $strSQL="SELECT opicname,id_layoutpic,type,title FROM layoutpic WHERE id_layout=$onenewsid";
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
              <td width="153" class="txt_lanmu">编辑区块</td>
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
              <form action="layout.php?04<?php echo $onenewsinfo[id_layout];?>" method="post" name="form" id="form"  onsubmit="return OnCheck(this);" >
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">标题</td>
                    <td bgcolor="#FFFFFF"><input name="title" type="text" class="input_01" id="newstitle" style="width:500px" value="<?php echo $onenewsinfo[title];?>"  /></td>
                    </tr>
                                      <tr>
                                        <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                        </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">简介</td>
                    <td bgcolor="#FFFFFF"><textarea name="intro" rows="5" class="input_01" id="intro2" style="width:400px"><?php echo $onenewsinfo[intro];?></textarea>                  </tr>
                                      <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">信息内容</td>
                    <td bgcolor="#FFFFFF">
					<?php	echo $oFCKeditor->editor("newscontent",$onenewsinfo[content]);?></td></tr>
                                            <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                                            <tr bgcolor="#FFFFFF">
                                              <td valign="top" bgcolor="#FFFFFF"><span style="cursor:pointer">文件</span></td>
                                              <td bgcolor="#FFFFFF"><span onclick="needupfile(<?php echo $onenewsinfo[id_layout];?>,'../../upload/layout/','|jpg|jpeg|gif|pdf|rar|png','/admin/siteset/ajax_upfileindata.php');" style="cursor:pointer">文件上传...</span>
                                              <div id="pickuang">
<?php for($i=0;$i<sizeof($onenewspicinfo);$i++){
if($onenewspicinfo[$i][type]=="JPG" || $onenewspicinfo[$i][type]=="JPEG" || $onenewspicinfo[$i][type]=="GIF" || $onenewspicinfo[$i][type]=="PNG"){
?>
<div class="box floatLeft"  style="position:relative"><a href="javascript:void(0)"  onclick="$.wholepop.dialogClass ='style_1';poppic('<?php echo $siteurl;?>/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>','图片预览及地址复制','<?php echo $onenewspicinfo[$i][id_layoutpic];?>');"  onmouseover=$("#hidetitlepic<?=$i;?>").show(); onmouseout=$("#hidetitlepic<?=$i;?>").hide(); ><img src="/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>" width="50" height="50" border="0" /></a><span class="txt_underpic" onclick="delpic(<?php echo $onenewspicinfo[$i][id_layoutpic];?>);" style="cursor:pointer">删除</span>
<div id="hidetitlepic<?=$i;?>" style="position:absolute;left:0px;top:0px; width:166px; display:none; z-index:100; background-color:#CCC"><?php echo $onenewspicinfo[$i][title];?></div>
</div>
<? }else if($onenewspicinfo[$i][type]=="PDF"){?>
<div class="box floatLeft"><a href="<?php echo $siteurl;?>/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>"  target="_blank"><img src="/admin/inc/pics/pdf.gif" width="50" height="50" border="0" /></a><span class="txt_underpic" onclick="delpic(<?php echo $onenewspicinfo[$i][id_layoutpic];?>);" style="cursor:pointer">删除</span></div>
<? }else if($onenewspicinfo[$i][type]=="DOC"){?>
<div class="box floatLeft"><a href="<?php echo $siteurl;?>/upload/layout/<?php echo $onenewspicinfo[$i][opicname];?>"  target="_blank"><img src="/admin/inc/pics/doc.gif" width="50" height="50" border="0" /></a><span class="txt_underpic" onclick="delpic(<?php echo $onenewspicinfo[$i][id_layoutpic];?>);" style="cursor:pointer">删除</span></div>
<?php  }}?>
</div>
                                              </td>
                                            </tr>
                        
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">链接地址</td>
                    <td bgcolor="#FFFFFF"><input name="url" type="text" class="input_01" id="url" style="width:300px" value="<?php echo $onenewsinfo[url];?>" <? if($onenewsinfo[id_layout]==1 || $onenewsinfo[id_layout]==2 || $onenewsinfo[id_layout]==3 || $onenewsinfo[id_layout]==4 || $onenewsinfo[id_layout]==5){echo 'readonly';}?> /></td>
                  </tr>
                                    <tr>
                    <td colspan="3" align="left" valign="middle" bgcolor="#EBF3F9"  style="padding:0; height:1px;"></td>
                    </tr>
                  
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='layout.php'" />                    </td>
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

