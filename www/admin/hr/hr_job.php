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
require_once("../inc/function.class.php");
require_once("../inc/js/ckeditor/ckeditor.php");//引用fck
require_once("../inc/js/ckfinder/ckfinder.php");//引用fck


$oFCKeditor = new CKEditor();
$oFCKeditor->returnOutput = true; //设置输出可用变量的情况
$oFCKeditor->basePath = '../inc/js/ckeditor/';//设置路径
$oFCKeditor->config['width'] ='100%';
CKFinder::SetupCKEditor($oFCKeditor, '../inc/js/ckfinder/') ;
	
$action=$_SERVER["QUERY_STRING"];

  $newstitle=$_POST[newstitle];//新闻标题
  $newscontent=$_POST[newscontent]; //新闻内容
  $url=$_POST[url]; //新闻链接
  $fbtime=$_POST[fbtime]; //发布时间

//取出新闻信息 start
if(isset($action) && ($action=="" || substr($action,0,6)=='&page=')){
if(isset($_REQUEST["page"]) ){$intCurPage=$_REQUEST["page"];}else{$intCurPage=1;}
$intRows = 10;
$strSQLNum = "SELECT COUNT(*) as num from newsinfo left join newsdir on newsinfo.id_newsdir=newsdir.id_newsdir WHERE newsinfo.id_newsdir='22' and newsinfo.dele='1'";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "SELECT newsinfo.id_newsinfo,newsdir.name,newsinfo.newsdate,newsinfo.title,newsinfo.content FROM newsinfo left join newsdir on newsinfo.id_newsdir=newsdir.id_newsdir WHERE newsinfo.id_newsdir='22' and newsinfo.dele='1' order by newsinfo.indate DESC" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrnewsinfos=$objDB->GetRows();
$intNews=sizeof($arrnewsinfos);
//取出新闻信息 end
}

if(isset($action) && $action=="01" && $onuserperm_addprem=='1'){//添加动作存在时初始目录

  $gselect1dir='<select name="select1" class="input_01" id="select1">';
  for($i=0;$i<sizeof($arr1dir);$i++){
  if($arr1dir[$i][id_newsdir]=='1'){
     $gselect1dir.='<option value="'.$arr1dir[$i][id_newsdir].'"selected"'.'">'.$arr1dir[$i][name].'</option>';
    }else{$gselect1dir.='<option value="'.$arr1dir[$i][id_newsdir].'">'.$arr1dir[$i][name].'</option>';}
  }
  $gselect1dir.='</select>';

//初始二级目录  
  $strSQL="SELECT id_newsdir,name FROM newsdir WHERE fatherid='1' and dele='1' and level='2'";
  $objDB->Execute($strSQL);
  $arr2dir=$objDB->GetRows();

  $gselect2dir='<select name="select2" class="input_01" id="select2">';
  for($i=0;$i<sizeof($arr2dir);$i++){
  $gselect2dir.='<option value="'.$arr2dir[$i][id_newsdir].'">'.$arr2dir[$i][name].'</option>';
  }
  $gselect2dir.='</select>';

}	

//添加新闻入库
if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){

	$strSQL="INSERT INTO newsinfo(title,content,id_newsdir,url,newsdate,indate) 
	                     values('$newstitle','$newscontent','22','$url','$fbtime',now())";
	$objDB->Execute($strSQL);
    header('Location:hr_job.php');ob_end_flush(); exit();
}	
//编辑新闻入库
if(isset($action) && substr($action,0,2)=="04" && $onuserperm_editprem=='1'){
    $onenewsinfoid=substr($action,2);
	echo $onenewsinfoid;
    $strSQL="UPDATE newsinfo SET title='$newstitle',content='$newscontent',id_newsdir='22',url='$url',newsdate='$fbtime',modate=now() where id_newsinfo=$onenewsinfoid";
	$objDB->Execute($strSQL);
	header('Location:hr_job.php');ob_end_flush(); exit();
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<script language="javascript">
$(function(){$("#select1").change(function(){$("#select2").load("dir2select.php?select1="+$("#select1").val());});});
</script>
<?php if($onuserperm_deleprem=='1'){?>
<script type="text/javascript">
function delenews(val1) {//val1新闻id
				var delenews=val1;
					popprompt_del('确认删除新闻:', '', delenews, function(isdel) {
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
        <?php if($onuserperm_addprem=='1'){?>
        <a href="hr_job.php?01" class="txt_addnews" >添加招聘</a>
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
              <td width="153" class="txt_lanmu">招聘管理</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
		   <?php for($i=0;$i<$intNews;$i++) {?>
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu">
              <table width="100%" border="0" cellspacing="5" cellpadding="3">
                  <tr>
                    <td width="15%" align="left" class="txt_leftmenu">[ <?php echo $arrnewsinfos[$i][newsdate]?> ]</td>
                    <td width="66%" align="left"><a href="hr_job.php?03<?php echo $arrnewsinfos[$i][id_newsinfo]?>"  class="txt_leftmenu"><?php echo cutstr($arrnewsinfos[$i][title],60,1);?></a></td>
                    <td width="6%" align="left">
        <?php if($onuserperm_deleprem=='1'){?>
                    <span class="txt_addnews" style="cursor:pointer" onclick=delenews(<?php echo $arrnewsinfos[$i][id_newsinfo]?>);>删除</span><?php }?></td>
                  </tr>
              </table>              </td>
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
              <td width="153" class="txt_lanmu">添加招聘</td>
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
              <form action="hr_job.php?02" method="post" name="form" id="form"  onsubmit="return OnCheck(this);" >
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">招聘标题</td>
                    <td bgcolor="#FFFFFF"><input name="newstitle" type="text" class="input_01" id="newstitle" style="width:500px" value="" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">招聘内容</td>
                    <td bgcolor="#FFFFFF"><?php	echo $oFCKeditor->editor("newscontent",'');?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">链接地址</td>
                    <td bgcolor="#FFFFFF"><input type="text" class="input_01" name="url" id="url" style="width:300px"/></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">发布时间</td>
                    <td bgcolor="#FFFFFF"><input type="text" class="input_01" name="fbtime" value="<?php echo date("Y-m-d");?>" id="fbtime" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_job.php'" />                    </td>
                  </tr>
              </table></form></td>
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
	//取出某条新闻
   $onenewsid=substr($action,2);
   $strSQL="SELECT newsinfo.*,newsdir.name,newsdir.fatherid FROM newsinfo left join newsdir on newsinfo.id_newsdir=newsdir.id_newsdir WHERE id_newsinfo=$onenewsid";
   $objDB->Execute($strSQL);
   $onenewsinfo=$objDB->fields();  
   //二级目录编辑抽取
  $strSQL="SELECT id_newsdir,name FROM newsdir WHERE fatherid=$onenewsinfo[fatherid] and dele='1' and level='2'";
  $objDB->Execute($strSQL);
  $arr2editdir=$objDB->GetRows();
	?>
<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">编辑招聘</td>
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
              <form action="hr_job.php?04<?php echo $onenewsinfo[id_newsinfo];?>" method="post" name="form" id="form"  onsubmit="return OnCheck(this);" >
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">招聘标题</td>
                    <td bgcolor="#FFFFFF"><input name="newstitle" type="text" class="input_01" id="newstitle" style="width:500px" value="<?php echo $onenewsinfo[title];?>" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">招聘内容</td>
                    <td bgcolor="#FFFFFF"><?php	echo $oFCKeditor->editor("newscontent",$onenewsinfo[content]);?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">链接地址</td>
                    <td bgcolor="#FFFFFF"><input name="url" type="text" class="input_01" id="url" style="width:300px" value="<?php echo $onenewsinfo[url];?>"/></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">发布时间</td>
                    <td bgcolor="#FFFFFF"><input type="text" class="input_01" name="fbtime" value="<?php echo $onenewsinfo[newsdate];?>" id="fbtime" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_job.php'" />                    </td>
                  </tr>
              </table></form></td>
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

