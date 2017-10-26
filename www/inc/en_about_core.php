<?php
require "../../inc/config.php";
require "../../inc/function.class.php";
require "../../inc/en_header_core.php";//页头 页脚调用

$str=getpagesetinfo($_GET[pageid],'content,title,pagetitle,keywords,description');



?>