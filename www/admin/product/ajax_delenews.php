<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/product/product_manage.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
 if($ajax_onuserperm_deleprem=='1'){
   $delnewsid = $_REQUEST["val1"];//新闻id
   $isdel = $_REQUEST["isdel"];//是否删除 1放入回收站 0直接删除
   
   if($isdel=='1'){//放入回收站
	$strSQL="update productinfo set dele='0',deldate=now()  WHERE id_prodinfo='".$delnewsid."'";
	$objDB->Execute($strSQL);
    $arr['info']="放入回收站成功!";
    $myjson= json_encode($arr);
    echo $myjson;
   }
   
   if($isdel=='0'){//永久删除
	$strSQL="DELETE FROM productinfo WHERE id_prodinfo='".$delnewsid."'";
	$objDB->Execute($strSQL);
    $arr['info']="永久删除成功!";
    $myjson= json_encode($arr);
    echo $myjson;
   }
   
   if($isdel=='3'){//撤销删除
	$strSQL="update productinfo set dele='1' WHERE id_prodinfo='".$delnewsid."'";
	$objDB->Execute($strSQL);
    $arr['info']="撤销删除成功!";
    $myjson= json_encode($arr);
    echo $myjson;
   }
   }//ajax_onuserperm_deleprem
}  


?>

