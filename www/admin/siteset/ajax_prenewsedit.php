<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/siteset/webmenu.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
  if($ajax_onuserperm_editprem=='1'){
   $newsid = $_REQUEST["val1"];//menu name
   $isdelperm = $_REQUEST["val3"];//是否有删除权限
   
   //取出fatherid信息
   $strSQL="SELECT fatherid,name,id_webmenu,url FROM webmenu WHERE  id_webmenu=$newsid and  dele='1' order by ordernum ASC";
   $objDB->Execute($strSQL);
   $newsid=$objDB->fields();
   
   //取出一级目录
  $strSQL="SELECT id_webmenu,name FROM webmenu WHERE level='1' and dele='1' order by ordernum ASC";
  $objDB->Execute($strSQL);
  $arrnewdir1=$objDB->GetRows();

$newsid1='<select name=ajax_newsdir1 id=ajax_newsdir1 >';
for($i=0;$i<sizeof($arrnewdir1);$i++){

  if($arrnewdir1[$i][id_webmenu]==$newsid[fatherid]){
  $newsid1=$newsid1.'<option value='.$arrnewdir1[$i][id_webmenu].' selected>'.$arrnewdir1[$i][name].'</option>';
  }else{
  $newsid1=$newsid1.'<option value='.$arrnewdir1[$i][id_webmenu].'>'.$arrnewdir1[$i][name].'</option>';
  }

}
$newsid_ajaxpreedit=$newsid1.'</select>';//在AJAX弹窗生成一级目录下拉菜单
   

  $arr['newsid_ajaxpreedit']=$newsid_ajaxpreedit;//一级目录下拉菜单带SELECTED
  $arr['name']=$newsid[name];//当前所选菜单名称
  $arr['intro']=$newsid[url];//简介
  $arr['selectid']=$newsid[id_webmenu];//当前所选菜单id
  $arr['isdelperm']=$isdelperm;//当前所选菜单是否有删除选择项
  $arr['menuorder']=$_REQUEST["val4"];//order
  $myjson= json_encode($arr);
  echo $myjson;
  }//if($ajax_onuserperm_editprem=='1') end
}//session end
?>

