<?php

//数据库初始连接
$objDB=new mysql($db_hostname,$db_username,$db_password,$db_database);
mysql_query("SET NAMES utf8"); 
mysql_query("set sql_mode=''"); 

//全局站点信息 是否防COPY 头部其他信息 标题  关健词 描述 ICP号 地图代码 第三方统计代码
$strSQL = "select iscopy,otherheader,title,keywords,description,icp,mapcode,statistics from siteset where id_siteset=1" ;
$objDB->Execute($strSQL);
$setinfo=$objDB->fields();


function cutstr($string,$length,$tag) {//php utf-8 字符串截取 0不带后缀 1带...后缀
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);  
        for($i=0; $i<count($info[0]); $i++) {
                $wordscut .= $info[0][$i];
                $j = ord($info[0][$i]) > 127 ? $j + 2 : $j + 1;
                if ($j > $length - 3) {
                        if($tag==0){
						    return $wordscut;
						}elseif($tag==1)
						{
						    return $wordscut."......";
						}
                }
        }
        return join('', $info[0]);
}

function Replacestr($str){
	for($i=1;$i<=80;$i++){
		$str=str_replace("&nbsp;","",$str);
	}
	return $str;
}

//获取当前文件名函数
function getcurrentfilename(){
return end(explode('/',$_SERVER["PHP_SELF"]));	
}

///////////////////////////////////////////////////////产品方面函数/////////////////////////////////////////////////////////////////////////////////

//取出产品目录所有二级目录    返回变量数组 引用时需要赋值 再输出
function getproductdir2($fatherid){
global	 $objDB;//函数调用 声明全局变量
$strSQL="SELECT id_proddir,name,intro FROM productdir WHERE level='2' and dele='1' and fatherid='".$fatherid."' order by ordernum asc";
$objDB->Execute($strSQL);
$getproductdir2=$objDB->GetRows();
return $getproductdir2;
}

//取出产品目录指定ID的单条信息    返回变量数组 引用时需要赋值 再输出
function getproductdirinfo($pdirid){
global	 $objDB;//函数调用 声明全局变量
$strSQL="SELECT id_proddir,name,intro FROM productdir WHERE  id_proddir='".$pdirid."' ";
$objDB->Execute($strSQL);
$getproductdirinfo=$objDB->fields();
return $getproductdirinfo;
}


//取出产品ID对应的第一张图片   直接返回文件名
function getproductpic($pid){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select opicname as pic from productpic  where id_prodinfo ='".$pid."' order by id_prodpic asc limit 1" ;
$objDB->Execute($strSQL);
$arronepic=$objDB->fields();
return $arronepic[pic];
}

//取出指定条数指定语言的最新产品信息    返回变量数组 引用时需要赋值 再输出
function getnewproduct($pnum,$lang,$ordertype){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select a.*,b.lang,b.fatherid from productinfo as a left join productdir as b on a.id_proddir=b.id_proddir   where a.dele=1 and b.lang=$lang order by a.$ordertype desc limit $pnum" ;
$objDB->Execute($strSQL);
$arrnewproduct=$objDB->GetRows();
return $arrnewproduct;
}

//取出指定目录ID的产品多条列表  指定tableField字段    返回变量数组 引用时需要赋值 再输出
function getproductlist($pdirid,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from productinfo  where dele=1 and id_proddir=$pdirid  order by ordernum desc " ;
$objDB->Execute($strSQL);
$getproductlist=$objDB->GetRows();
return $getproductlist;
}

//取出指定ID的产品信息  指定tableField字段    返回变量数组 引用时需要赋值 再输出
function getproductinfo($pid,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from productinfo  where dele=1 and id_prodinfo=$pid  " ;
$objDB->Execute($strSQL);
$getproductinfo=$objDB->fields();
return $getproductinfo;
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//取出新闻目录所有二级目录    返回变量数组 引用时需要赋值 再输出
function getnewsdir2($fatherid){
global	 $objDB;//函数调用 声明全局变量
$strSQL="SELECT id_newsdir,name,intro FROM newsdir WHERE level='2' and dele='1' and fatherid='".$fatherid."' order by ordernum asc";
$objDB->Execute($strSQL);
$getnewsdir2=$objDB->GetRows();
return $getnewsdir2;
}

//取出新闻ID对应的第一张图片  直接返回文件名
function getnewspic($nid){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select opicname as pic from newspic  where id_newsinfo ='".$nid."' order by id_newspic asc limit 1" ;
$objDB->Execute($strSQL);
$arronepic=$objDB->fields();
return $arronepic[pic];
}

//取出指定目录ID的新闻多条列表  指定tableField字段    返回变量数组 引用时需要赋值 再输出
function getnewslist($dirid,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from newsinfo where dele=1 and id_newsdir=$dirid  order by ordernum desc " ;
$objDB->Execute($strSQL);
$getnewslist=$objDB->GetRows();
return $getnewslist;
}

//取出新闻图片指定id的前几NUM条的 指定数据库字段tableField 的值  多条  返回变量数组 引用时需要赋值 再输出
function getnewspicnuminfo($nid,$num,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from newspic where id_newsinfo ='".$nid."' order by  id_newspic asc limit 0,$num" ;
$objDB->Execute($strSQL);
$arrallpicinfo=$objDB->GetRows();
return $arrallpicinfo;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//取出LAYOUT区块指定ID的单条信息  指定字段     单条 返回变量数组 引用时需要赋值 再输出
function getlayoutinfo($lid,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from layout where id_layout='".$lid."'" ;
$objDB->Execute($strSQL);
$getlayoutinfo=$objDB->fields();
return $getlayoutinfo;
}

//取出区块layoutpic指定id的第POSTION位置的一张图片    单条  直接返回文件名
function getlayoutpic($lid,$postion){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select opicname as pic from layoutpic  where id_layout ='".$lid."' order by  id_layoutpic asc limit $postion,1" ;
$objDB->Execute($strSQL);
$arronepic=$objDB->fields();
return $arronepic[pic];
}

//取出区块layoutpic指定id的第POSTION位置的 指定数据库字段tableField 的值  单条  返回变量数组 引用时需要赋值 再输出
function getlayoutpicinfo($lid,$postion,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from layoutpic  where id_layout ='".$lid."' order by  id_layoutpic asc limit $postion,1" ;
$objDB->Execute($strSQL);
$arronepicinfo=$objDB->fields();
return $arronepicinfo;
}

//取出区块layoutpic指定id的前几NUM条的 指定数据库字段tableField 的值  多条  返回变量数组 引用时需要赋值 再输出
function getlayoutpicnuminfo($lid,$num,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from layoutpic  where id_layout ='".$lid."' order by  id_layoutpic asc limit 0,$num" ;
$objDB->Execute($strSQL);
$arrallpicinfo=$objDB->GetRows();
return $arrallpicinfo;
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//取出版面管理pagesetpic指定id的第POSTION位置的一张图片   单条  直接返回文件名
function getpagesetpic($lid,$postion){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select opicname as pic from pagesetpic  where id_pageset ='".$lid."' order by  id_pagesetpic asc limit $postion,1" ;
$objDB->Execute($strSQL);
$arronepic=$objDB->fields();
return $arronepic[pic];
}

//取出pageset版面指定ID的单条信息 的 指定数据库字段tableField 的值  单条   返回变量数组 引用时需要赋值 再输出
function getpagesetinfo($pageid,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from pageset  where id_pageset='".$pageid."'" ;
$objDB->Execute($strSQL);
$getpagesetinfo=$objDB->fields();
return $getpagesetinfo;
}


//取出区块pageset指定id的前几NUM条的 指定数据库字段tableField 的值  多条  返回变量数组 引用时需要赋值 再输出
function getpagesetpicnuminfo($lid,$num,$tableField){
global	 $objDB;//函数调用 声明全局变量
$strSQL = "select $tableField from pagesetpic  where id_pageset ='".$lid."' order by  id_pagesetpic asc limit 0,$num" ;
$objDB->Execute($strSQL);
$arrallpicinfo=$objDB->GetRows();
return $arrallpicinfo;
}

?>