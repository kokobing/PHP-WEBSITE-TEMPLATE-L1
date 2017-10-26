<?
require "config_admin.php";
 //file_put_contents('aa.txt', $upnewsid); 
if(isset($_SESSION["user_id"])){

$errormcb = "";
$upfilemcbn = "";
$upid=$_REQUEST["upid"];//关联ID
$savepath=$_REQUEST["savepath"];//文件上传路径
$filetype=$_REQUEST["filetype"];//文件允许上传文件类型
$indatafile=$_REQUEST["indatafile"];//上传后文件关联入库所对应的处理文件
$filetitleurl=$_REQUEST["filetitleurl"];//URL
$filetitle=$_REQUEST["filetitle"];//
$filejj=$_REQUEST["filejj"];//

//file_put_contents('aa.txt', $upid."----".$savepath."----".$filetype."----".$indatafile); 


if(empty($_FILES['fileupload']['tmp_name']) || $_FILES['fileupload']['tmp_name'] == 'none'){
    $errormcb = "0";//上传完成
	$upfilename="nopic.gif";
	$type="gif";
}else {

	$upload_file=$_FILES['fileupload']['tmp_name'];
	$upload_file_name=$_FILES['fileupload']['name'];
	$upload_file_size=$_FILES['fileupload']['size'];
	$name=mktime();
	$typeA=explode(".",basename($upload_file_name));
	$type=$typeA[count($typeA)-1];//上传文件类型
	if(strpos(strtoupper($filetype),strtoupper($type))==false){
	      $errormcb = "2";//上传文件类型不正确
	}else if($upload_file_size>16000000){
	      $errormcb = "3";//上传的文件大小超过16M
	}else if(!move_uploaded_file($upload_file,$savepath.$name.".".$type)){
	      $errormcb = "4";//文件上传失败,未知错误!
	}else{
		  $errormcb = "0";//上传完成
		  $upfilename=$name.".".$type;
	}
	
}


}


    $arr['errormcb']=$errormcb;
	$arr['upid']=$upid;
	$arr['upfilename']=$upfilename;
	$arr['savepath']=$savepath;
	$arr['upfiletype']=$type;
	$arr['filetitleurl']=$filetitleurl;
	$arr['filetitle']=$filetitle;
	$arr['filejj']=$filejj;
	$arr['indatafile']=$indatafile;
	
    $myjson= json_encode($arr);
    echo $myjson;

?>