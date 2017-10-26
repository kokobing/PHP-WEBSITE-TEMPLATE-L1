<?php  
require "../inc/config_admin.php";
require_once("../inc/config_perm.php");
  //file_put_contents('aa.txt', $val1.$val2);  
  
   $selfid = $_REQUEST["val1"];//menu name
   
   
   //取出fatherid信息
   $strSQL="SELECT fatherid,name,id_backmenu,url FROM backmenu WHERE  id_backmenu=$selfid and  dele='1' order by ordernum ASC";
   $objDB->Execute($strSQL);
   $selfid=$objDB->fields();
   
   
   //取出一级目录
  $strSQL="SELECT id_backmenu,name FROM backmenu WHERE level='1' and dele='1' order by ordernum ASC";
  $objDB->Execute($strSQL);
  $arrMenu1=$objDB->GetRows();

$menuid1='<select name=ajax_menuid1 id=ajax_menuid1 >';
for($i=0;$i<sizeof($arrMenu1);$i++){

  if($arrMenu1[$i][id_backmenu]==$selfid[fatherid]){
  $menuid1=$menuid1.'<option value='.$arrMenu1[$i][id_backmenu].' selected>'.$arrMenu1[$i][name].'</option>';
  }else{
  $menuid1=$menuid1.'<option value='.$arrMenu1[$i][id_backmenu].'>'.$arrMenu1[$i][name].'</option>';
  }

}
$menuid_ajaxpreedit=$menuid1.'</select>';//在AJAX弹窗生成一级目录下拉菜单
   


  $arr['menuid_ajaxpreedit']=$menuid_ajaxpreedit;//一级目录下拉菜单带SELECTED
  $arr['name']=$selfid[name];//当前所选菜单名称
  $arr['selfid']=$selfid[id_backmenu];//当前所选菜单id
  $arr['url']=$selfid[url];//当前所选菜单名称
  $myjson= json_encode($arr);
  echo $myjson;

?>

