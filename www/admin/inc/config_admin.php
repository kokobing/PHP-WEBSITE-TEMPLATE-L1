<?php
session_start();
ob_start();

//调用文件
require_once("db_mysql.class.php");//数据库

//数据库

$db_hostname="localhost"; //服务器
$db_username="root"; //用户名
$db_password="123456"; //密码
$db_database="demo-l1"; //数据库
$db_pre="";//数据库表前缀 

$objDB=new mysql($db_hostname,$db_username,$db_password,$db_database);
mysql_query("SET NAMES utf8"); 
mysql_query("set sql_mode=''"); 
//系统图片路径

$companytitle="::腾岩科技 信息管理系统::";
$logo_text="Website Management 2012 腾岩科技网络管理系统";
$logo_pic="";

$siteurl="http://www.website.com";//必设 后面涉及图片路径
?>
