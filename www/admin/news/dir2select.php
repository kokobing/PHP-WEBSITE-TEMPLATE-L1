<?php

require "../inc/config_admin.php";
require_once("../inc/config_perm.php");
$select1=$_REQUEST[select1];
//file_put_contents('aa.txt', $gselect2dir);

//输出二级目录
$strSQL="SELECT id_newsdir,name FROM newsdir WHERE fatherid='$select1' and dele='1' and level='2'";
$objDB->Execute($strSQL);
$arr2dir=$objDB->GetRows();

  $gselect2dir='<select name="select2" class="input_01" id="select2">';
  for($i=0;$i<sizeof($arr2dir);$i++){
  $gselect2dir.='<option value="'.$arr2dir[$i][id_newsdir].'">'.$arr2dir[$i][name].'</option>';
  }
  $gselect2dir.='</select>';
echo $gselect2dir;
?>