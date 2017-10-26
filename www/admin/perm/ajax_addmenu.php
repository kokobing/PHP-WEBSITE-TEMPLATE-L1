<?php  
require "../inc/config_admin.php";
require_once("../inc/config_perm.php");

  $message = $_REQUEST["passmessage"];
  $strSQL="INSERT INTO backmenu(name,level) VALUES('".$message."','1') ";
  $objDB->Execute($strSQL);//一级菜单名称入库
  
  $id = $objDB->getInsertID();//获取刚入库记录的ID
  //file_put_contents('aa.txt', $id);  
  $strSQL="update backmenu set ordernum='".$id."' where id_backmenu='".$id."'";
  $objDB->Execute($strSQL);//更改入库记录的ORDER顺序
  
  $arr['info']="添加成功!";
  $myjson= json_encode($arr);
  echo $myjson;

?>

