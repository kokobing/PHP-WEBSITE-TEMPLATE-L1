<?php  
require "../inc/config_admin.php";
//require_once("../inc/config_perm.php");
  //file_put_contents('aa.txt', $val1.$val2);  
  //product_visit=1  store_visit=2  news_visit=3  hr_visit=4  pavy_visit=5  data_visit=6  
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/perm/perm_manage.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断

  if($ajax_onuserperm_editprem=='1'){
   $menu1id = $_REQUEST["menu1id"];//一级菜单目录id
   $menu1idchk = $_REQUEST["menu1idchk"];//一级菜单目录是否选中
   $menu2idzh = $_REQUEST["menu2idzh"];//二级菜单id组合 (7-8-9-)
   $menu2chked = $_REQUEST["menu2chked"];//二级菜单是否选中组合 (1101-1010-1111-)
   $userid = $_REQUEST["userid"];//被设置用户的id

//一级目录的权限修改
        if($menu1id=='1'){
		$strSQL="UPDATE pavy1 SET  product_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
        if($menu1id=='2'){
		$strSQL="UPDATE pavy1 SET  store_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
        if($menu1id=='3'){
		$strSQL="UPDATE pavy1 SET  news_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
        if($menu1id=='4'){
		$strSQL="UPDATE pavy1 SET  hr_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
        if($menu1id=='5'){
		$strSQL="UPDATE pavy1 SET  pavy_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
        if($menu1id=='6'){
		$strSQL="UPDATE pavy1 SET  data_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
		if($menu1id=='44'){
		$strSQL="UPDATE pavy1 SET  siteset_visit='$menu1idchk' where id_hr=$userid";
		$objDB->Execute($strSQL);
		}//if end
//一级目录的权限修改

//二级目录的权限修改
        $menu2idcf = explode("-",$menu2idzh);//二级菜单id拆分
        $menu2chkedcf = explode("-",$menu2chked);//二级菜单是否选中拆分
        for($i=0;$i<sizeof($menu2idcf);$i++){
		if($menu2idcf[$i]!=''){
	    $browseprem=substr($menu2chkedcf[$i],0,1);$addprem=substr($menu2chkedcf[$i],1,1);$editprem=substr($menu2chkedcf[$i],2,1);$deleprem=substr($menu2chkedcf[$i],3,1);
		$strSQL="UPDATE pavy2 SET  browseprem='$browseprem',addprem='$addprem',editprem='$editprem',deleprem='$deleprem' where id_hr=$userid and id_backmenu=$menu2idcf[$i]";
		//file_put_contents('aa.txt', $strSQL);
		$objDB->Execute($strSQL);
		}//if end
        }
  $arr['info']="恭喜你,修改成功!";
  $arr['errorcode']="0";//no error
  $myjson= json_encode($arr);
  echo $myjson;
  }else{
  $arr['info']="对不起,您没有修改权限!";
  $arr['errorcode']="3";//1 no brow 2 no add 3 no edit 4no del
  $myjson= json_encode($arr);
  echo $myjson;
  }// if $ajax_onuserperm_editprem end 
}// if session userid end
?>

