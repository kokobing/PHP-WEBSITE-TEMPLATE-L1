<?php  
require "../inc/config_admin.php";
require_once("../inc/config_perm.php");
  //file_put_contents('aa.txt', $val1.$val2);  
  
   $menu2name = $_REQUEST["menu2name"];//menu name
   $fatherid = $_REQUEST["fatherid"];//fatherid
   $selfid = $_REQUEST["selfid"];//selfid
   $url = $_REQUEST["url"];//url
   $isdel = $_REQUEST["isdel"];//是否删除该菜单

   if ($isdel=='1'){
   //	$strSQL="update backmenu set dele='0' where id_backmenu='".$selfid."'";
   //   $objDB->Execute($strSQL);
        $arr['info']="此目录为系统初始目录，无法删除!";
   }else{
   $strSQL="UPDATE backmenu SET fatherid='".$fatherid."',name='".$menu2name."',url='".$url."' where id_backmenu='".$selfid."'";
   $objDB->Execute($strSQL);
   $arr['info']="恭喜你,修改成功!";
   }

  $myjson= json_encode($arr);
  echo $myjson;

?>

