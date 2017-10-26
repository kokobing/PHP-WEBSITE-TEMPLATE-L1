<?php 
/*
add 增加空界面 :01表示
add_s 提交入库：02表示
edit 编辑抽取：03表示
edit_s 编辑提交：04表示
del 删除：05表示
*/
require_once("../inc/config_admin.php");
require_once("../inc/upload_imgs.php");
require_once("../inc/config_perm.php");
$action=$_SERVER["QUERY_STRING"];

//部门选择初始值
  $strSQL="SELECT id_dept,dept FROM dept";
  $objDB->Execute($strSQL);
  $arrdept=$objDB->GetRows();

  $gselectdept='<select name="dept" class="input_01">';
  for($i=0;$i<sizeof($arrdept);$i++){
  $gselectdept.='<option value="'.$arrdept[$i][id_dept].'">'.$arrdept[$i][dept].'</option>';
  }
  $gselectdept.='</select>';
//职务选择初始值  
  $strSQL="SELECT id_post,post FROM post";
  $objDB->Execute($strSQL);
  $arrpost=$objDB->GetRows();

  $gselectpost='<select name="post" class="input_01">';
  for($i=0;$i<sizeof($arrpost);$i++){
  $gselectpost.='<option value="'.$arrpost[$i][id_post].'">'.$arrpost[$i][post].'</option>';
  }
  $gselectpost.='</select>';

//职称选择初始值  
  $strSQL="SELECT id_title,title FROM title";
  $objDB->Execute($strSQL);
  $arrtitle=$objDB->GetRows();

  $gselecttitle='<select name="title" class="input_01">';
  for($i=0;$i<sizeof($arrtitle);$i++){
  $gselecttitle.='<option value="'.$arrtitle[$i][id_title].'">'.$arrtitle[$i][title].'</option>';
  }
  $gselecttitle.='</select>';
  

   //取出所有员工信息
  $strSQL="SELECT * FROM hr WHERE dele='1'";
  $objDB->Execute($strSQL);
  $arrstaff=$objDB->GetRows();

 
	$user=$_POST[user];
	$password=$_POST[password];
	$name=$_POST[name];//姓名
	$sex=$_POST[sex];//1为男,0为女
	$birthday=$_POST[birthday];//生日
	
	$idcard=$_POST[idcard];//身份证号码
	$dept=$_POST[dept];  //部门
	$post=$_POST[post]; //职务
	$title=$_POST[title]; //职称
	$hrcode=$_POST[hrcode];//员工编号
	
	$iswork=$_POST[iswork];//1在职 0离职
	$ismarry=$_POST[ismarry];//1已婚 0未婚
	$nation=$_POST[nation];//民族
	$native=$_POST[native];//籍贯
	$register=$_POST[register];//户口所在地
	
	$inwork=$_POST[inwork];//进厂时间
	$education=$_POST[education];//学历
	$profession=$_POST[profession];//专业
	$school=$_POST[school];//毕业院校
	$political=$_POST[political];//政治面貌
	
	$address=$_POST[address];//家庭地址
    $hometel=$_POST[hometel];//家庭电话
    $mobi=$_POST[mobi];//手机号码
	$photo=$_POST[photo];//
    $hjqk=$_POST[hjqk];//获奖情况
	
    $cfqk=$_POST[cfqk];//惩罚情况
    $gwbd=$_POST[gwbd];//岗位变动情况
    $ldht=$_POST[ldht];//劳动合同签订情况
	$sbjn=$_POST[sbjn];//社保缴纳情况
    $remark=$_POST[remark];//备注
	
    $delstaff=$_POST[delstaff];//删除员工

    //$level=$_POST[level];//1普通员工

if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){
     if ( is_uploaded_file( $_FILES['photo']['tmp_name'] ) ){//是否上传照片
        $image_file=upload_file("photo","hrphoto/",mktime());//上传图片
		$pic_path= "hrphoto/".$image_file;//图片路径
	    include_once( '../inc/csmallpic.php' );//缩咯图类
	    CreateThumbnail($pic_path,$pic_path,100,0);//建缩略图

		}
	$strSQL="INSERT INTO hr(user,password,name,sex,birthday,idcard,dept,post,title,hrcode,iswork,
	                          ismarry,nation,native,register,inwork,education,profession,school,
							  political,address,hometel,mobi,hjqk,cfqk,gwbd,ldht,sbjn,remark,indate,photo) 
	                   values('$user','$password','$name','$sex','$birthday','$idcard','$dept',
                              '$post','$title','$hrcode','$iswork','$ismarry','$nation','$native',
                              '$register','$inwork','$education','$profession','$school',
							  '$political','$address','$hometel','$mobi','$hjqk','$cfqk',
							  '$gwbd','$ldht','$sbjn','$remark',now(),'$image_file')";
	$objDB->Execute($strSQL);
	//一级菜单权限初始入库
	$userid=$objDB->getinsertid();
	$strSQL="INSERT INTO pavy1(product_visit,store_visit,news_visit,hr_visit,pavy_visit,data_visit,id_hr,indate)
	                     values('0','0','1','0','0','0','$userid',now())";
	$objDB->Execute($strSQL);
	//二级菜单权限初始入库
	$strSQL="SELECT id_backmenu FROM backmenu WHERE level='2' and dele='1'";
    $objDB->Execute($strSQL);
    $arrmenu2perm=$objDB->GetRows();

     for($i=0;$i<sizeof($arrmenu2perm);$i++){
	 $browseprem='0';$addprem='0';$editprem='0';$deleprem='0';
	 if($arrmenu2perm[$i][id_backmenu]=='16'){$browseprem='1';}
	 $strSQL="INSERT INTO pavy2(id_hr,id_backmenu,browseprem,addprem,editprem,deleprem,indate)
	                     values('$userid','".$arrmenu2perm[$i][id_backmenu]."','$browseprem','$addprem','$editprem','$deleprem',now())";
	$objDB->Execute($strSQL);
	 }//end for

}

if(isset($action) && substr($action,0,2)=="04" && $onuserperm_editprem=='1'){
     $onestaff=substr($action,2);
     if($delstaff=='1' && $onuserperm_deleprem=='1'){
        $strSQL="delete from hr  where id_hr=$onestaff and id_hr!='1'";
		$objDB->Execute($strSQL);//删除人
		
		$strSQL="delete from pavy1 where id_hr=$onestaff and id_hr!='1'";
		$objDB->Execute($strSQL);//删除相关权限1
		
		$strSQL="delete from pavy2 where id_hr=$onestaff and id_hr!='1'";
		$objDB->Execute($strSQL);//删除相关权限2
		
	 }
	 
     if ( is_uploaded_file( $_FILES['photo']['tmp_name'] ) ){//是否上传照片
        $image_file=upload_file("photo","hrphoto/",mktime());//上传图片
		$pic_path= "hrphoto/".$image_file;//图片路径
	    include_once( '../inc/csmallpic.php' );//缩咯图类
	    CreateThumbnail($pic_path,$pic_path,100,0);//建缩略图
		@unlink('hrphoto/'.$_POST[oldphoto]);
		}else{
		$image_file=$_POST[oldphoto];
		}

		$strSQL="UPDATE hr SET     user='$user',
								   password='$password',
								   name='$name',
								   sex='$sex',
								   birthday='$birthday',
								   idcard='$idcard',
								   dept='$dept',
								   post='$post',
								   title='$title',
								   hrcode='$hrcode',
								   iswork='$iswork',
								   ismarry='$ismarry',
								   nation='$nation',
								   native='$native',
								   register='$register',
								   inwork='$inwork',
								   education='$education',
								   profession='$profession',
								   school='$school',
								   political='$political',
								   address='$address',
								   hometel='$hometel',
								   mobi='$mobi',
								   hjqk='$hjqk',
								   cfqk='$cfqk',
								   gwbd='$gwbd',
								   ldht='$ldht',
								   sbjn='$sbjn',
								   remark='$remark',
								   modate=now(),
								   photo='$image_file'
								   where id_hr=$onestaff";
		$objDB->Execute($strSQL);
    	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function onclickadd(val1) {//val1＝点击的菜单id，val2判断是一级菜单还是二级菜单
				var addclickid=val1;
					popprompt('输入名称:', '', '请输入要添加名称',addclickid, function(passmessage,onclickid) {
						  if (passmessage) {$.post('ajax_addmenu.php',{passmessage: passmessage,onclickid:onclickid},function(data)                              {
                             var myjson = '';eval('myjson=' + data + ';');
							 if(myjson.type=='txt_adddept'){$("#add_dept").html(myjson.gselectdept);};
							 if(myjson.type=='txt_addpost'){$("#add_post").html(myjson.gselectpost);};
							 if(myjson.type=='txt_addtitle'){$("#add_title").html(myjson.gselecttitle);};
                             popmessage(myjson.info, '友情提醒!'); });
                          };
					});
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
    <td width="75%" align="center" valign="top">
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="right"><?php if($onuserperm_addprem=='1'){?><a href="hr_staff.php?01" class="txt_addmenu">添加新员工</a><?php }else{?><a href="#" class="txt_addmenu">添加新员工</a><?php }?></td>
      </tr>
    </table>
    <?php if(isset($action) && $action==''){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">员工档案</td>
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
              
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
	        <tr>
	       <? for($i=0;$i<sizeof($arrstaff);$i++){
 	          if($i!=0 && $i%7==0){?></tr><tr><? }?>		
		      <td height="100" align="Center" valign="top" style="width:14%;">
				<table width="80" border="0" align="center" cellpadding="0" cellspacing="0" class="txt">
				  <tr align="center">
					<td bgcolor="#CCCCCC"><table width="100%"  border="0" cellspacing="1">
                      <tr>
                        <td align="center" bgcolor="#FFFFFF">
                     <?php if($onuserperm_browse=='1'){?><a href="hr_staff.php?03<?php echo $arrstaff[$i][id_hr]?>" ><img src="hrphoto/<?php if($arrstaff[$i][photo]==''){echo 'staffphoto.gif';}else{ echo $arrstaff[$i][photo];}?>" width="60" height="56" border="0"></a><?php }else{?><a href="#" ><img src="hrphoto/<?php if($arrstaff[$i][photo]==''){echo 'staffphoto.gif';}else{ echo $arrstaff[$i][photo];}?>" width="60" height="56" border="0"></a><?php }?><br>
                          <? echo $arrstaff[$i][name];?></td>
                      </tr>
                    </table></td>
				  </tr>
				</table>
			  </td>
	           <? }?>		  
	         </tr>
           </table>
              </td>
            </tr>
          </table></td>
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
              <td width="153" class="txt_lanmu">添加新员工档案</td>
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
                <form action="hr_staff.php?02" method="post" enctype="multipart/form-data" name="form" id="form"  onsubmit="return OnCheck(this);" >
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">姓名</td>
                    <td width="167" bgcolor="#FFFFFF"><input type="text" name="name" value="" style="width:150px" class="input_01" id="name" /></td>
                    <td width="69" valign="top" bgcolor="#FFFFFF">编号</td>
                    <td width="162" bgcolor="#FFFFFF"><input type="text" name="hrcode" value="" style="width:150px" class="input_01" id="hrcode" /></td>
                    <td width="127" colspan="-2" rowspan="5" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#B8D1E2"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                          <tr>
                            <td height="150" align="center" valign="bottom" bgcolor="#FFFFFF"><img src="/admin/inc/pics/staffphoto.gif" width="60" height="56" border="0" /><br>
                              <br>上传照片<br>
                              <input name="photo" type="file"  size="10" class="input_01" id="photo" />                            </td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">用户名</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="user" value="" style="width:150px" class="input_01" id="user" /></td>
                    <td valign="top" bgcolor="#FFFFFF">密码</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="password" value="" style="width:150px" class="input_01" id="password" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">民族</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="nation" value="" style="width:150px" class="input_01" id="nation" /></td>
                    <td valign="top" bgcolor="#FFFFFF">籍贯</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="native" value="" style="width:150px" class="input_01" id="native" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">性别</td>
                    <td bgcolor="#FFFFFF"><input name="sex" type="radio" id="radio5" value="1" checked="checked" />
                      男
                        <input type="radio" name="sex" id="radio6" value="0" />
                        女</td>
                    <td valign="top" bgcolor="#FFFFFF">出生日期</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="birthday" value="0000-00-00" onfocus='this.value="";this.style.color="black";'  style="color:#ccc;width:150px" class="input_01" id="birthday" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">身份证</td>
                    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="idcard" value="" style="width:150px" class="input_01" id="idcard" /></td>
                  </tr>
                  
                  <tr bgcolor="#FFFFFF">
                   <td valign="top" bgcolor="#FFFFFF">部门</td>
                   <td bgcolor="#FFFFFF">
                   <div id="add_dept">
               <?php echo $gselectdept; ?><span id="txt_adddept" style="cursor:pointer" onclick=onclickadd("txt_adddept"); >+</span>
                   </div>
                      </td>
                    <td bgcolor="#FFFFFF">职务</td>
                    <td colspan="2" bgcolor="#FFFFFF">
                   <div id="add_post">
               <?php echo $gselectpost; 
			   //<span id="txt_addpost" style="cursor:pointer" onclick=onclickadd("txt_addpost"); >+</span>
			   ?>
                   </div>
                  </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">在职状态</td>
                    <td bgcolor="#FFFFFF"><input name="iswork" type="radio" id="radio3" value="1" checked="checked" />
                      在 职
                        <input type="radio" name="iswork" id="radio4" value="0" />
                        离 职</td>
                    <td bgcolor="#FFFFFF">职称</td>
                    <td colspan="2" bgcolor="#FFFFFF">
                   <div id="add_title">
        <?php echo $gselecttitle; ?><span id="txt_addtitle" style="cursor:pointer" onclick=onclickadd("txt_addtitle"); >+</span>
                   </div>
                      </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">婚否</td>
                    <td bgcolor="#FFFFFF"><input name="ismarry" type="radio" id="radio2" value="0" checked="checked" />
未 婚
  <input type="radio" name="ismarry" id="radio" value="1" />
已 婚 </td>
                    <td bgcolor="#FFFFFF">进厂时间</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="inwork" value="<?php echo date("Y-m-d");?>" style="width:150px" class="input_01" id="inwork" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">学历</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="education" value="" style="width:150px" class="input_01" id="education" /></td>
                    <td valign="top" bgcolor="#FFFFFF">专业</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="profession" value="" style="width:150px" class="input_01" id="profession" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">毕业院校</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="school" value="" style="width:150px" class="input_01" id="school" /></td>
                    <td valign="top" bgcolor="#FFFFFF">政治面貌</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="political" value="" style="width:150px" class="input_01" id="political" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">户口所在地</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="register" value="" style="width:150px" class="input_01" id="register" /></td>
                    <td valign="top" bgcolor="#FFFFFF">手机</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="mobi" value="" style="width:150px" class="input_01" id="mobi" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">家庭电话</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="hometel" value="" style="width:150px" class="input_01" id="hometel" /></td>
                    <td valign="top" bgcolor="#FFFFFF">家庭地址</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="address" value="" style="width:150px" class="input_01" />                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">获奖情况
                     </td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="hjqk" style="width:500px" rows="3" class="input_01" id="hjqk"></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">惩罚情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="cfqk" style="width:500px" rows="3" class="input_01" id="cfqk"></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">岗位变动情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="gwbd" style="width:500px" rows="3" class="input_01" id="gwbd"></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">劳动合同签订情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="ldht" style="width:500px" rows="3" class="input_01" id="ldht"></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">社保缴纳情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="sbjn" style="width:500px" rows="3" class="input_01" id="sbjn"></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">备注</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="remark" style="width:500px" rows="3" class="input_01" id="remark"></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td colspan="4" bgcolor="#FFFFFF">
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_staff.php'" />
                    </td>
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
 <?php if(isset($action) && substr($action,0,2)=='03'){
   //取出某个员工
   $onestaff=substr($action,2);
   $strSQL="SELECT * FROM hr WHERE id_hr=$onestaff";
   $objDB->Execute($strSQL);
   $personal=$objDB->fields();

 ?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">查看/编辑员工档案</td>
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
                <form action="hr_staff.php?04<?php echo $personal[id_hr];?>" method="post" enctype="multipart/form-data" name="form" id="form"  onsubmit="return OnCheck(this);" >
                <input type="hidden" name="oldphoto" value="<?php echo $personal[photo];?>">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">姓名</td>
                    <td width="167" bgcolor="#FFFFFF"><input type="text" name="name" value="<?php echo $personal[name];?>" style="width:150px" class="input_01" id="name" /></td>
                    <td width="69" valign="top" bgcolor="#FFFFFF">编号</td>
                    <td width="162" bgcolor="#FFFFFF"><input type="text" name="hrcode" value="<?php echo $personal[hrcode];?>" style="width:150px" class="input_01" id="hrcode" /></td>
                    <td width="127" colspan="-2" rowspan="5" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#B8D1E2"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                          <tr>
                            <td height="150" align="center" valign="bottom" bgcolor="#FFFFFF">
                              <img src="hrphoto/<?php if($personal[photo]==''){echo 'staffphoto.gif';}else{ echo $personal[photo];}?>"  border="0" /><br>
                              <br>上传照片<br>
                              <input name="photo" type="file"  size="10" class="input_01" id="photo" />                            </td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">用户名</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="user" value="<?php echo $personal[user];?>" style="width:150px" class="input_01" id="user" /></td>
                    <td valign="top" bgcolor="#FFFFFF">密码</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="password" value="<?php echo $personal[password];?>" style="width:150px" class="input_01" id="password" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">民族</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="nation" value="<?php echo $personal[nation];?>" style="width:150px" class="input_01" id="nation" /></td>
                    <td valign="top" bgcolor="#FFFFFF">籍贯</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="native" value="<?php echo $personal[native];?>" style="width:150px" class="input_01" id="native" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">性别</td>
                    <td bgcolor="#FFFFFF"><input name="sex" type="radio" id="radio5" value="1" <?php if($personal[sex]==1){echo 'checked';}?> />
                      男
                        <input type="radio" name="sex" id="radio6" value="0" <?php if($personal[sex]==0){echo 'checked';}?>/>
                        女</td>
                    <td valign="top" bgcolor="#FFFFFF">出生日期</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="birthday" value="<?php echo $personal[birthday];?>" onfocus='this.value="";this.style.color="black";'  style="color:#ccc;width:150px" class="input_01" id="birthday" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">身份证</td>
                    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="idcard" value="<?php echo $personal[idcard];?>" style="width:150px" class="input_01" id="idcard" /></td>
                  </tr>
                  
                  <tr bgcolor="#FFFFFF">
                   <td valign="top" bgcolor="#FFFFFF">部门</td>
                   <td bgcolor="#FFFFFF">
                   <div id="add_dept">
                 <select name="dept" class="input_01">
                   <?php for($i=0;$i<sizeof($arrdept);$i++){?>
                   <option value="<?php echo $arrdept[$i][id_dept];?>" <?php if($personal[dept]==$arrdept[$i][id_dept]){echo 'selected';}?>><?php echo $arrdept[$i][dept];?></option>
                  <?php }?>
                  </select>
               <span id="txt_adddept" style="cursor:pointer" onclick=onclickadd("txt_adddept"); >+</span>                   </div>                      </td>
                    <td bgcolor="#FFFFFF">职务</td>
                    <td colspan="2" bgcolor="#FFFFFF">
                   <div id="add_post">
                 <select name="post" class="input_01">
                   <?php for($i=0;$i<sizeof($arrpost);$i++){?>
                   <option value="<?php echo $arrpost[$i][id_post];?>" <?php if($personal[post]==$arrpost[$i][id_post]){echo 'selected';}?>><?php echo $arrpost[$i][post];?></option>
                  <?php }
				  //<span id="txt_addpost" style="cursor:pointer" onclick=onclickadd("txt_addpost"); >+</span>
				  ?>
                  </select>
                  </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">在职状态</td>
                    <td bgcolor="#FFFFFF"><input name="iswork" type="radio" id="radio3" value="1" <?php if($personal[iswork]==1){echo 'checked';}?>/>
                      在 职
                        <input type="radio" name="iswork" id="radio4" value="0" <?php if($personal[iswork]==0){echo 'checked';}?>/>
                        离 职</td>
                    <td bgcolor="#FFFFFF">职称</td>
                    <td colspan="2" bgcolor="#FFFFFF">
                   <div id="add_title">
                 <select name="title" class="input_01">
                   <?php for($i=0;$i<sizeof($arrtitle);$i++){?>
                   <option value="<?php echo $arrtitle[$i][id_title];?>" <?php if($personal[title]==$arrtitle[$i][id_title]){echo 'selected';}?>><?php echo $arrtitle[$i][title];?></option>
                  <?php }?>
                  </select>
                   <span id="txt_addtitle" style="cursor:pointer" onclick=onclickadd("txt_addtitle"); >+</span>                   </div>                      </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">婚否</td>
                    <td bgcolor="#FFFFFF"><input name="ismarry" type="radio" id="radio2" value="0" <?php if($personal[ismarry]==0){echo 'checked';}?>/>
未 婚
  <input type="radio" name="ismarry" id="radio" value="1" <?php if($personal[ismarry]==1){echo 'checked';}?>/>
已 婚 </td>
                    <td bgcolor="#FFFFFF">进厂时间</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="inwork" value="<?php echo $personal[inwork];?>" style="width:150px" class="input_01" id="inwork" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">学历</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="education" value="<?php echo $personal[education];?>" style="width:150px" class="input_01" id="education" /></td>
                    <td valign="top" bgcolor="#FFFFFF">专业</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="profession" value="<?php echo $personal[profession];?>" style="width:150px" class="input_01" id="profession" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">毕业院校</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="school" value="<?php echo $personal[school];?>" style="width:150px" class="input_01" id="school" /></td>
                    <td valign="top" bgcolor="#FFFFFF">政治面貌</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="political" value="<?php echo $personal[political];?>" style="width:150px" class="input_01" id="political" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">户口所在地</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="register" value="<?php echo $personal[register];?>" style="width:150px" class="input_01" id="register" /></td>
                    <td valign="top" bgcolor="#FFFFFF">手机</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="mobi" value="<?php echo $personal[mobi];?>" style="width:150px" class="input_01" id="mobi" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">家庭电话</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="hometel" value="<?php echo $personal[hometel];?>" style="width:150px" class="input_01" id="hometel" /></td>
                    <td valign="top" bgcolor="#FFFFFF">家庭地址</td>
                    <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="address" value="<?php echo $personal[address];?>" style="width:150px" class="input_01" />                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">获奖情况                      </td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="hjqk" style="width:500px" rows="3" class="input_01" id="hjqk"><?php echo $personal[hjqk];?></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">惩罚情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="cfqk" style="width:500px" rows="3" class="input_01" id="cfqk"><?php echo $personal[cfqk];?></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">岗位变动情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="gwbd" style="width:500px" rows="3" class="input_01" id="gwbd"><?php echo $personal[gwbd];?></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">劳动合同签订情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="ldht" style="width:500px" rows="3" class="input_01" id="ldht"><?php echo $personal[ldht];?></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">社保缴纳情况</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="sbjn" style="width:500px" rows="3" class="input_01" id="sbjn"><?php echo $personal[sbjn];?></textarea></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">备注</td>
                    <td colspan="4" bgcolor="#FFFFFF"><textarea name="remark" style="width:500px" rows="3" class="input_01" id="remark"><?php echo $personal[remark];?></textarea></td>
                  </tr>
                  <?php if($onuserperm_deleprem=='1' and $personal[id_hr]!='1'){?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td colspan="4" bgcolor="#FFFFFF"><input name="delstaff" type="checkbox" id="delstaff" value="1" />
                      删除员工</td>
                  </tr><?php }?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td colspan="4" bgcolor="#FFFFFF">
                    <?php if($onuserperm_editprem=='1'){?>
                    <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_staff.php'" /><?php }else{?>
                    <input class="btn" disabled="disabled" type="submit" name="button_ok" id="button_ok" value="提交" />
                    <input class="btn" disabled="disabled" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_staff.php'" /><?php }?>

                      </td>
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
<?php if(isset($action) && substr($action,0,2)=="04" && $onuserperm_editprem=='1' && $delstaff!='1'){?>
<script type="text/javascript">
 popmessage('修改成功！', '友情提醒!');
</script>
<meta http-equiv='refresh' content='1;url=hr_staff.php?03<?=$onestaff?>'>
<?php }?>

<?php if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){?>
<script type="text/javascript">
 popmessage('添加成功！', '友情提醒!');
</script>
<meta http-equiv='refresh' content='1;url=hr_staff.php'>
<?php }?>

<?php if($delstaff=='1' && $onuserperm_deleprem=='1'){?>
<script type="text/javascript">
 popmessage('删除成功！', '友情提醒!');
</script>
<meta http-equiv='refresh' content='1;url=hr_staff.php'>
<?php }?>

<?php require "../footer.php"; ?>
</body>
</html>

