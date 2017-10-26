<?
//此文件用于修改对应表中文件(图片 PDF)标题 简介 URL 更换文件或图 layout.php等 传递 jquery.js 调用
require "config_admin.php";
 //file_put_contents('aa.txt', $upnewsid); 
if(isset($_SESSION["user_id"])){


$datasheet=$_REQUEST["datasheet"];//文件所在数据库哪张表
$getfileid=$_REQUEST["getfileid"];//id
$getfiletype=$_REQUEST["getfiletype"];//type
$getfiletitle=$_REQUEST["getfiletitle"];//title
$getfileintro=$_REQUEST["getfileintro"];
$getfileurl=$_REQUEST["getfileurl"];
$oldgetfilename=$_REQUEST["getfilename"];//旧文件名

if($datasheet=='layoutpic' || $datasheet=='pagesetpic'){ $savepath='../../upload/layout/';}//如果要操作的数据库表为layoutpic pagesetpic 则上传路径
if($datasheet=='productpic'){ $savepath='../../upload/product/';}
if($datasheet=='newspic'){ $savepath='../../upload/news/';}

if(empty($_FILES['fileupload']['tmp_name']) || $_FILES['fileupload']['tmp_name'] == 'none'){
   
   if($datasheet=='layoutpic'){
    $strSQL="UPDATE layoutpic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl' where id_layoutpic=$getfileid";
	$objDB->Execute($strSQL);
   }
   
   if($datasheet=='pagesetpic'){
    $strSQL="UPDATE pagesetpic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl' where id_pagesetpic=$getfileid";
	$objDB->Execute($strSQL);
   }
   
    if($datasheet=='productpic'){
    $strSQL="UPDATE productpic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl' where id_prodpic=$getfileid";
	$objDB->Execute($strSQL);
   }
    
	if($datasheet=='newspic'){
    $strSQL="UPDATE newspic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl' where id_newspic=$getfileid";
	$objDB->Execute($strSQL);
   }
   //file_put_contents('aa.txt', $strSQL); 
   $errorinfo = "信息修改完成！";
   
}else {

	$upload_file=$_FILES['fileupload']['tmp_name'];
	$upload_file_name=$_FILES['fileupload']['name'];
	$upload_file_size=$_FILES['fileupload']['size'];
	$name=mktime();
	$typeA=explode(".",basename($upload_file_name));
	$type=$typeA[count($typeA)-1];//上传文件类型
	if(strtoupper($getfiletype)!=strtoupper($type)){
	      $errorinfo = "上传文件类型不正确，与原文件类型不相符，请上传".$getfiletype."类型文件";
	}else if($upload_file_size>16000000){
	      $errorinfo = "上传的文件大小超过16M";
	}else if(!move_uploaded_file($upload_file,$savepath.$name.".".$type)){
	      $errorinfo = "文件上传失败,未知错误!";
	}else{
		  $errorinfo = "文件上传完成,信息修改完成";
		  $upfilename=$name.".".$type;
		  
		  if($oldgetfilename!='nopic.gif'){@unlink($savepath.$oldgetfilename);}//删除旧文件
		  
		  if($datasheet=='layoutpic'){
		  $strSQL="UPDATE layoutpic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl',opicname='$upfilename' where id_layoutpic=$getfileid";
	      $objDB->Execute($strSQL);
		  }
		  
		  if($datasheet=='pagesetpic'){
		  $strSQL="UPDATE pagesetpic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl',opicname='$upfilename' where id_pagesetpic=$getfileid";
	      $objDB->Execute($strSQL);
		  }
		  
		  if($datasheet=='productpic'){
		  $strSQL="UPDATE productpic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl',opicname='$upfilename' where id_prodpic=$getfileid";
	      $objDB->Execute($strSQL);
		  }
		  
		  if($datasheet=='newspic'){
		  $strSQL="UPDATE newspic SET title='$getfiletitle',intro='$getfileintro',url='$getfileurl',opicname='$upfilename' where id_newspic=$getfileid";
	      $objDB->Execute($strSQL);
		  }
		  
		  
		  
	}
	
}


}



	$arr['errorinfo']=$errorinfo;
	
    $myjson= json_encode($arr);
    echo $myjson;

?>