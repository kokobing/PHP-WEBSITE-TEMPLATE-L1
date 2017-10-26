<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/news/news_dir.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
  if($ajax_onuserperm_editprem=='1'){
   $newsdir2name = $_REQUEST["newsdir2name"];//menu name
   $fatherid = $_REQUEST["fatherid"];//fatherid
   $newsid = $_REQUEST["newsid"];//selfid
   $isdel = $_REQUEST["isdel"];//是否删除该菜单
   $intro = $_REQUEST["intro"];//简介
   $menuorder = $_REQUEST["menuorder"];//order
   $lang = $_REQUEST["lang"];//order

   if ($isdel=='1' && $ajax_onuserperm_deleprem=='1'){
   	$strSQL="update newsdir set dele='0' where id_newsdir='".$newsid."' and id_newsdir not in (1,2)";
	$objDB->Execute($strSQL);
   }else{
   
      $strSQL="UPDATE newsdir SET fatherid='".$fatherid."',name='".$newsdir2name."',intro='".$intro."',ordernum='".$menuorder."',lang='".$lang."' where id_newsdir='".$newsid."'";
      $objDB->Execute($strSQL);
   	 //更新所有下级目录语言为父目录语言
	 $strSQL="UPDATE newsdir SET lang='".$lang."' where fatherid='".$newsid."' and level=2";
     $objDB->Execute($strSQL);
	 
	 
   }
   
   
  if($newsid==1||$newsid==2){
  $arr['info']="此目录为系统初始目录，无法删除!";
  }else{
  $arr['info']="恭喜你,修改成功!";
  }
  $myjson= json_encode($arr);
  echo $myjson;
  }//  if($ajax_onuserperm_editprem=='1') end
}//session end
?>

