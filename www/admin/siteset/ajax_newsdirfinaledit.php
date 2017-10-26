<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/siteset/webmenu.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
  if($ajax_onuserperm_editprem=='1'){
   $newsdir2name = $_REQUEST["newsdir2name"];//menu name
   $fatherid = $_REQUEST["fatherid"];//fatherid
   $newsid = $_REQUEST["newsid"];//selfid
   $isdel = $_REQUEST["isdel"];//是否删除该菜单
   $intro = $_REQUEST["intro"];//简介
   $menuorder = $_REQUEST["menuorder"];//order

   if ($isdel=='1' && $ajax_onuserperm_deleprem=='1'){
   	$strSQL="update webmenu set dele='0' where id_webmenu='".$newsid."' and id_webmenu not in (1,2,3,4,5,11,12,13,14,15,16,17,18,19)";
	$objDB->Execute($strSQL);
   }else{
   
   if($newsid==1||$newsid==2||$newsid==3||$newsid==4||$newsid==5||$newsid==11||$newsid==12||$newsid==13||$newsid==14||$newsid==15||$newsid==16||$newsid==17||$newsid==18||$newsid==19){
     $strSQL="UPDATE webmenu SET fatherid='".$fatherid."',name='".$newsdir2name."',ordernum='".$menuorder."' where id_webmenu='".$newsid."'";
     $objDB->Execute($strSQL);
   }else{
     $strSQL="UPDATE webmenu SET fatherid='".$fatherid."',name='".$newsdir2name."',url='".$intro."',ordernum='".$menuorder."' where id_webmenu='".$newsid."'";
     $objDB->Execute($strSQL);
   }
   
   
   }
  if($newsid==1||$newsid==2||$newsid==3||$newsid==4||$newsid==5||$newsid==11||$newsid==12||$newsid==13||$newsid==14||$newsid==15||$newsid==16||$newsid==17||$newsid==18||$newsid==19){
  $arr['info']="此目录为系统初始目录，无法修改URL、无法删除!";
  }else{
  $arr['info']="恭喜你,修改成功!";
  }
  $myjson= json_encode($arr);
  echo $myjson;
  }//  if($ajax_onuserperm_editprem=='1') end
}//session end
?>

