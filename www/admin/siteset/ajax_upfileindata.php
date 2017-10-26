<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/siteset/layout.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
 if($ajax_onuserperm_addprem=='1'){
   $filename = $_REQUEST["upfilename"];//上传文件名
   $upid = $_REQUEST["upid"];//上文件关联ID
   $filetitleurl = $_REQUEST["filetitleurl"];//
   $filetitle = $_REQUEST["filetitle"];//
   $filejj = $_REQUEST["filejj"];//
   $upfiletype = strtoupper($_REQUEST["upfiletype"]);//上文件类型
   $strSQL="INSERT INTO layoutpic(id_hr,opicname,id_layout,type,indate,url,title,intro) 
	                     values('$_SESSION[user_id]','$filename','$upid','$upfiletype',now(),'$filetitleurl','$filetitle','$filejj')";
	$objDB->Execute($strSQL);
	$uppicid = $objDB->getInsertID();
   
   }
  $arr['info']="1";
  $arr['uppicid']=$uppicid;
  $arr['upfilename']=$filename;
  $arr['upfiletype']=$upfiletype;
  $arr['savepath']= $_REQUEST["savepath"];
  $myjson= json_encode($arr);
  echo $myjson;

}  


?>

