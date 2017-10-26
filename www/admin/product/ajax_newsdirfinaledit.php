<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/product/product_dir.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
  if($ajax_onuserperm_editprem=='1'){
   $newsdir2name = $_REQUEST["newsdir2name"];//menu name
   $fatherid = $_REQUEST["fatherid"];//fatherid
   $newsid = $_REQUEST["newsid"];//selfid
   $isdel = $_REQUEST["isdel"];//是否删除该菜单
   $menuorder = $_REQUEST["menuorder"];//order
   $lang = $_REQUEST["lang"];//order
   $intro =str_replace("'","&acute;",$_REQUEST["intro"]); //简介

   if ($isdel=='1' && $ajax_onuserperm_deleprem=='1'){
   	$strSQL="update productdir set dele='0' where id_proddir='".$newsid."' and id_proddir not in (1,2,3,4,5,6,7,8,20,21,22,23,24)";
	$objDB->Execute($strSQL);
   }else{
   
    if($newsid==1||$newsid==2||$newsid==3||$newsid==4||$newsid==5||$newsid==6||$newsid==7||$newsid==8||$newsid==20||$newsid==21||$newsid==22||$newsid==23||$newsid==24){
     $strSQL="UPDATE productdir SET fatherid='".$fatherid."',name='".$newsdir2name."',ordernum='".$menuorder."',lang='".$lang."',intro='".$intro."' where id_proddir='".$newsid."'";
     $objDB->Execute($strSQL);
	 //更新所有下级目录语言为父目录语言
	 $strSQL="UPDATE productdir SET lang='".$lang."' where fatherid='".$newsid."' and level=2";
     $objDB->Execute($strSQL);
	 
   }else{
   $strSQL="UPDATE productdir SET fatherid='".$fatherid."',name='".$newsdir2name."',intro='".$intro."',ordernum='".$menuorder."',lang='".$lang."' where id_proddir='".$newsid."'";
   $objDB->Execute($strSQL);
   	 //更新所有下级目录语言为父目录语言
	 $strSQL="UPDATE productdir SET lang='".$lang."' where fatherid='".$newsid."' and level=2 ";
     $objDB->Execute($strSQL);
   }

   
   }

  if($newsid==1||$newsid==2||$newsid==3||$newsid==4||$newsid==5||$newsid==6||$newsid==7||$newsid==8||$newsid==20||$newsid==21||$newsid==22||$newsid==23||$newsid==24){
  $arr['info']="此目录为系统初始目录，无法修改URL、无法删除!";
  }else{
  $arr['info']="恭喜你,修改成功!";
  }
  $myjson= json_encode($arr);
  echo $myjson;
  }//  if($ajax_onuserperm_editprem=='1') end
}//session end
?>

