<?
require "../inc/config_admin.php";
 //file_put_contents('aa.txt', $upnewsid); 
if(isset($_SESSION["user_id"])){

$errormcb = "";
$upfilemcbn = "";
$upnewsid = $_REQUEST["upnewsid"];
if(empty($_FILES['fileupload']['tmp_name']) || $_FILES['fileupload']['tmp_name'] == 'none'){
    $errormcb = "1";
}else {
    $savepath="../../upload/product/";//upload path
	$upload_file=$_FILES['fileupload']['tmp_name'];
	$upload_file_name=$_FILES['fileupload']['name'];
	$upload_file_size=$_FILES['fileupload']['size'];
	$name=mktime();
	$typeA=explode(".",basename($upload_file_name));
	$type=".".$typeA[count($typeA)-1];
	
	if(strtoupper($type)!=".JPEG"&&strtoupper($type)!=".JPG"&&strtoupper($type)!=".GIF"){
	      $errormcb = "2";//上传文件类型不正确
	}else if($upload_file_size>3000000){
	      $errormcb = "3";//上传的文件大小超过3M
	}else if(!move_uploaded_file($upload_file,$savepath.$name.$type)){
	      $errormcb = "4";//文件上传失败,未知错误!
	}else{
          $image_file_path= $savepath.$name.$type;//缩略图原图路径
          include_once( '../inc/csmallpic.php');
          CreateThumbnail($image_file_path,$image_file_path,600,0); 
		  $errormcb = "0";//上传完成
		  $upfilename=$name.$type;
	}
	
}

}

echo "{";
echo "errormcb: '" . $errormcb . "',\n";
echo "upnewsid: '" . $upnewsid . "',\n";
echo "upfilename: '" . $upfilename . "'\n";
echo "}";

?>