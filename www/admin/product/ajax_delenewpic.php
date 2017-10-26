<?php  
require "../inc/config_admin.php";
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/product/product_manage.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
 if($ajax_onuserperm_deleprem=='1'){
   $delenewspicid = $_REQUEST["picid"];
   
   //抽取需要删除图片的新闻id和图片文件名
   $strSQL="SELECT id_prodinfo,opicname FROM productpic WHERE id_prodpic=$delenewspicid";
   $objDB->Execute($strSQL);
   $oneidnewsinfo=$objDB->fields();
   
   //删除图片
	$strSQL="DELETE FROM productpic WHERE id_prodpic='".$delenewspicid."'";
	$objDB->Execute($strSQL);
	if($oneidnewsinfo[opicname]!='nopic.gif'){@unlink("../../upload/product/".$oneidnewsinfo[opicname]);}	
	
	//删除图片后重新抽取剩下的新闻图片
   $strSQL="SELECT opicname,id_prodpic,type FROM productpic WHERE id_prodinfo=$oneidnewsinfo[id_prodinfo] order by id_prodpic asc";
   $objDB->Execute($strSQL);
   $onenewspicinfo=$objDB->GetRows();
   
 for($i=0;$i<sizeof($onenewspicinfo);$i++){
 if($onenewspicinfo[$i][type]=="JPG" || $onenewspicinfo[$i][type]=="JPEG" || $onenewspicinfo[$i][type]=="GIF"  || $onenewspicinfo[$i][type]=="PNG"){
$str.='<div class="box floatLeft"><img src="/upload/product/'.$onenewspicinfo[$i][opicname].'" width="50" height="50" /><span class="txt_underpic" onclick="delpic('.$onenewspicinfo[$i][id_prodpic].');" style="cursor:pointer">删除</span></div>';
}else if($onenewspicinfo[$i][type]=="PDF"){
$str.='<div class="box floatLeft"><img src="/admin/inc/pics/pdf.gif" width="50" height="50" /><span class="txt_underpic" onclick="delpic('.$onenewspicinfo[$i][id_prodpic].');" style="cursor:pointer">删除</span></div>';
}else if($onenewspicinfo[$i][type]=="DOC"){
$str.='<div class="box floatLeft"><img src="/admin/inc/pics/doc.gif" width="50" height="50" /><span class="txt_underpic" onclick="delpic('.$onenewspicinfo[$i][id_prodpic].');" style="cursor:pointer">删除</span></div>';
}else if($onenewspicinfo[$i][type]=="RAR"){
$str.='<div class="box floatLeft"><img src="/admin/inc/pics/rar.gif" width="50" height="50" /><span class="txt_underpic" onclick="delpic('.$onenewspicinfo[$i][id_prodpic].');" style="cursor:pointer">删除</span></div>';
}

}

	
    $arr['info']="删除成功!";
	$arr['str']=$str;
    $myjson= json_encode($arr);
    echo $myjson;
   }//ajax_onuserperm_deleprem
}  


?>

