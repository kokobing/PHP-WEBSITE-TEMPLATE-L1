<?php
require "../../inc/config.php";
require "../../inc/function.class.php";
require "../../inc/pagenav.class.php";
require "../../inc/en_header_core.php";//页头 页脚调用


//page_content 内容
$intRows = 12;
//产品
if(isset($_GET[id2])){//存在二级目录 则抽二级目录产品

$arrParam[0][name]="id1"; $arrParam[0][value]=$_GET[id1];
$arrParam[1][name]="id2"; $arrParam[1][value]=$_GET[id2];

$strSQLNum = "SELECT COUNT(*) as num from productinfo as a left join productdir as b on a.id_proddir=b.id_proddir  where a.id_proddir='$_GET[id2]' and a.dele=1 ";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select a.*,b.fatherid,b.name from productinfo as a left join productdir as b on a.id_proddir=b.id_proddir  where a.id_proddir='$_GET[id2]' and a.dele=1 order by a.ordernum desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrprods=$objDB->GetRows();


}elseif(isset($_GET[id1])){//不存在二级 抽一级目录产品

$arrParam[0][name]="id1";
$arrParam[0][value]=$_GET[id1];

$strSQLNum = "SELECT COUNT(*) as num from productinfo as a
left join productdir as c on a.id_proddir=c.id_proddir
where c.fatherid='$_GET[id1]' and a.dele=1 ";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select a.*,c.fatherid from productinfo as a
left join productdir as c on a.id_proddir=c.id_proddir
where c.fatherid='$_GET[id1]' and a.dele=1  order by a.ordernum desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrprods=$objDB->GetRows();



}else{// 目录不存在 所有产品


$strSQLNum = "SELECT COUNT(*) as num from productinfo as a left join productdir as b on a.id_proddir=b.id_proddir   where a.dele=1 and b.lang=0";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select a.*,b.lang,b.fatherid from productinfo as a left join productdir as b on a.id_proddir=b.id_proddir   where a.dele=1 and b.lang=0 order by a.ordernum desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrprods=$objDB->GetRows();

}




?>