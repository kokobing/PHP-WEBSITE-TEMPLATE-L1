<?php 
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");
require_once("../inc/navipage.php");
$action=$_SERVER["QUERY_STRING"];
	$examname=$_POST[examname];
	$examlevel=strtoupper($_POST[examlevel]);
	$examday=$_POST[examday];

/*
   //取出考核信息
  $strSQL="select DISTINCT examdate from exam order by examdate desc";
  $objDB->Execute($strSQL);
  $arrexamdate=$objDB->GetRows();
*/

//取出信息信息 start
if(isset($_REQUEST["page"]) ){$intCurPage=$_REQUEST["page"];}else{$intCurPage=1;}
$intRows = 12;
$strSQLNum = "SELECT COUNT(DISTINCT examdate) as num from exam order by examdate desc";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select DISTINCT examdate from exam order by examdate desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrexamdate=$objDB->GetRows();
$intexamdate=sizeof($arrexamdate);
//取出信息信息 end


if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){
    $exammonth=substr($examday,0,7).'-01';
	$strSQL="INSERT INTO exam(name,level,examdate) 
	                   values('$examname','$examlevel','$exammonth')";
	$objDB->Execute($strSQL);
	$addexamid=$objDB->getinsertid();
    header('Location:hr_exam.php?011'.$addexamid); exit();
}

if(isset($action) && substr($action,0,2)=="05" && $onuserperm_editprem=='1'){
    $exammonth=substr($examday,0,7).'-01';
	$editid=substr($action,2);
    $strSQL="UPDATE exam SET name='$examname',level='$examlevel',examdate='$exammonth' where id_exam=$editid";
	$objDB->Execute($strSQL);
	$editexamid=$objDB->getinsertid();
    header('Location:hr_exam.php?03'.$exammonth); exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
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
        <td height="30" align="right"><?php if($onuserperm_addprem=='1'){?><a href="hr_exam.php?01" class="txt_addmenu">添加新考核</a><?php }else{?><a href="#" class="txt_addmenu">添加新考核</a><?php }?></td>
      </tr>
    </table>
<?php if(isset($action) && $action=='' || substr($action,0,6)=='&page='){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">考核统计</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="txt_leftmenu"><table width="90%" border="0" cellspacing="4" cellpadding="4">
            <?php for($i=0;$i<sizeof($arrexamdate);$i++){?>
			<tr>
              <td width="16%">[ <?php echo substr($arrexamdate[$i][examdate],0,7);?> ]</td>
              <td width="27%"><?php echo substr($arrexamdate[$i][examdate],0,7);?>月份考核统计</td>
              <td width="57%"><a href="hr_exam?03<?php echo $arrexamdate[$i][examdate];?>" class="txt_leftmenu">查看</a></td>
            </tr>
			<?php }?>
          </table></td>
        </tr>
        <tr>
          <td align="right" class="txt_leftmenu"><?php echo $strNavigate;?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
<?php }?>

<?php if(isset($action) && substr($action,0,2)=='03'){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu"><?php echo substr($action,2,7);?>考核统计</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="txt_leftmenu"><table width="90%" border="0" cellspacing="4" cellpadding="4">
            <?php 
			  $oneselectmonth=substr($action,2);
			  $strSQL="SELECT * FROM exam where examdate like '%$oneselectmonth%'";
              $objDB->Execute($strSQL);
              $onemonthexam=$objDB->GetRows();
			for($i=0;$i<sizeof($onemonthexam);$i++){?>
			<tr>
			  <td width="9%">员工姓名</td>
			  <td width="14%"><a href="hr_exam?04<?php echo $onemonthexam[$i][id_exam];?>" class="txt_leftmenu"><?php echo $onemonthexam[$i][name];?></a></td>
			  <td width="9%">考核等级</td>
			  <td width="68%"><a href="hr_exam?04<?php echo $onemonthexam[$i][id_exam];?>" class="txt_leftmenu"><?php echo $onemonthexam[$i][level];?></a></td>
			</tr>
			<?php }?>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
<?php }?>

<?php if(isset($action) && substr($action,0,2)=='04'){
    $editoneid= substr($action,2);
	$strSQL="SELECT * FROM exam where id_exam=$editoneid";
    $objDB->Execute($strSQL);
    $exameditone=$objDB->fields();
?>
<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">编辑考核</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                <form action="hr_exam.php?05<?php echo $exameditone[id_exam];?>" method="post"  name="form" id="form" >
                  <tr bgcolor="#FFFFFF">
                   <td width="91" valign="top" bgcolor="#FFFFFF">员工姓名</td>
                   <td bgcolor="#FFFFFF"><input class="input_01" type="text" name="examname" value="<?php echo $exameditone[name];?>"/></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">考核等级</td>
                    <td bgcolor="#FFFFFF"><input name="examlevel" type="text" class="input_01" value="<?php echo $exameditone[level];?>" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">考核日期</td>
                    <td bgcolor="#FFFFFF"><input class="input_01" type="text" name="examday" value="<?php echo substr($exameditone[examdate],0,7);?>"/></td>
                    </tr>
                 <?php if(isset($action) && substr($action,0,3)=="012"){?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
					  <?php $examid= substr($action,3);
					  $strSQL="SELECT name FROM exam where id_exam=$editoneid";
                      $objDB->Execute($strSQL);
                      $examone=$objDB->fields();
					  echo $exameditone[name];
					  ?>
					编辑成功...</td>
                  </tr>
				  <?php }?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="exambtnok" id="exambtnok" value="提交" />
                    <input class="btn" type="button" name="exambtnback" id="exambtnback" value="返回" onclick="javascript:location.href='hr_exam.php?03<?php echo $exameditone[examdate];?>'" />                    </td>
                  </tr>
                </form>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>
<?php }?>

<?php if(isset($action) && substr($action,0,2)=='01' && $onuserperm_addprem=='1'){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">添加新考核</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                <form action="hr_exam.php?02" method="post"  name="form" id="form" >
                  <tr bgcolor="#FFFFFF">
                   <td width="91" valign="top" bgcolor="#FFFFFF">员工姓名</td>
                   <td bgcolor="#FFFFFF"><input class="input_01" type="text" name="examname" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">考核等级</td>
                    <td bgcolor="#FFFFFF"><input class="input_01" type="text" name="examlevel" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">考核日期</td>
                    <td bgcolor="#FFFFFF"><input class="input_01" type="text" name="examday" value="<?php echo date("Y-m");?>"/></td>
                    </tr>
                 <?php if(isset($action) && substr($action,0,3)=="011"){?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
					  <?php $examid= substr($action,3);
					  $strSQL="SELECT name FROM exam where id_exam=$examid";
                      $objDB->Execute($strSQL);
                      $examone=$objDB->fields();
					  echo $examone[name];
					  ?>
					提交成功,继续添加...</td>
                  </tr>
				  <?php }?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="exambtnok" id="exambtnok" value="提交" />
                    <input class="btn" type="button" name="exambtnback" id="exambtnback" value="返回" onclick="javascript:location.href='hr_exam.php'" />                    </td>
                  </tr>
                </form>
              </table></td>
            </tr>
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
      <?php }?>	
	
	  </td>
  </tr>
</table>


<?php require "../footer.php"; ?>
</body>
</html>

