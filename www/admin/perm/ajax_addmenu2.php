<?php  
require "../inc/config_admin.php";
require_once("../inc/config_perm.php");
  //file_put_contents('aa.txt', $val1.$val2);  
  
   $val1 = $_REQUEST["val1"];//menu name
   $val2 = $_REQUEST["val2"];//fatherid
   $namepath=explode("###",$val1);//分割
  
  $strSQL="INSERT INTO backmenu(name,level,fatherid,url) VALUES('".$namepath[0]."','2','".$val2."','".$namepath[1]."') ";
  $objDB->Execute($strSQL);//2级菜单名称入库
  
  $id = $objDB->getInsertID();//获取刚入库记录的ID
  $strSQL="update backmenu set ordernum='".$id."' where id_backmenu='".$id."'";
  $objDB->Execute($strSQL);//更改入库记录的ORDER顺序
  
   //二级菜单权限初始入库
	$strSQL="SELECT id_hr FROM hr WHERE dele='1'";
    $objDB->Execute($strSQL);
    $arrstaff=$objDB->GetRows();
    for($i=0;$i<sizeof($arrstaff);$i++){
    $strSQL="INSERT INTO pavy2(id_hr,id_backmenu,browseprem,addprem,editprem,deleprem,indate)
            values('".$arrstaff[$i][id_hr]."','".$id."','0','0','0','0',now())";
    $objDB->Execute($strSQL);}

  $arr['info']="添加成功!";
  $myjson= json_encode($arr);
  echo $myjson;

?>

