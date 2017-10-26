<?php
//权限判断
if(!isset($_SESSION[user_id])){//如果没登陆
	header('Location:/admin/index.php');ob_end_flush();exit();
}

//$c_cwd_linux=getcwd();$c_dir_linux=explode("/",$c_cwd_linux);$c_dir_n_linux=sizeof($c_dir_linux)-1;//获取当前LINUX目录
$c_cwd_win=getcwd();$c_dir_win=explode("\\",$c_cwd_win);$c_dir_n_win=sizeof($c_dir_win)-1;//获取当前WIN目录	
//if($c_dir_linux!=''){$c_dir=$c_dir_linux[$c_dir_n_linux];}
if($c_dir_win!=''){$c_dir=$c_dir_win[$c_dir_n_win];}//目录名
$c_filename = end(explode('/',$_SERVER["PHP_SELF"])); //当前文件名
$c_url='/admin/'.$c_dir.'/'.$c_filename;

//根据当前登录用户的权限 判断是否显示一级目录 START
   $strSQL="SELECT * FROM pavy1 WHERE  id_hr=$_SESSION[user_id]";
   $objDB->Execute($strSQL);
   $selfid=$objDB->fields();//取出当前登录用户的一级目录权限信息
   
   //判断当前登录用户是否有访问一级目录的权限 start
   if($selfid[product_visit]=='0' && $c_dir=='product'){header('Location:/admin/main.php');ob_end_flush();exit();}
   if($selfid[store_visit]=='0' && $c_dir=='store'){header('Location:/admin/main.php');ob_end_flush();exit();}
   if($selfid[news_visit]=='0' && $c_dir=='news'){header('Location:/admin/main.php');ob_end_flush();exit();}
   if($selfid[hr_visit]=='0' && $c_dir=='hr'){header('Location:/admin/main.php');ob_end_flush();exit();}
   if($selfid[pavy_visit]=='0' && $c_dir=='perm'){header('Location:/admin/main.php');ob_end_flush();exit();}
   if($selfid[data_visit]=='0' && $c_dir=='dbase'){header('Location:/admin/main.php');ob_end_flush();exit();}
   if($selfid[siteset_visit]=='0' && $c_dir=='siteset'){header('Location:/admin/main.php');ob_end_flush();exit();}
   //判断当前登录用户是否有访问一级目录的权限 end
   
   //判断当前登录用户是否有访问二级目录的权限 start
   //登录用户访问当前php文件，四项属性全部为0即不可以访问，跳转到登录页面
   $strSQL="SELECT pavy2.id_backmenu FROM pavy2 left join backmenu on pavy2.id_backmenu=backmenu.id_backmenu
   WHERE pavy2.id_hr=$_SESSION[user_id] and pavy2.browseprem='0' and pavy2.addprem='0' and pavy2.editprem='0' and pavy2.deleprem='0'
   and backmenu.url='".$c_url."'";
   $objDB->Execute($strSQL);
   $perm2menu=$objDB->GetRows();//取出当前登录用户的二级目录权限表中的id_backmenu
   if(sizeof($perm2menu)!=0){header('Location:/admin/main.php');ob_end_flush();exit();}
   //判断当前登录用户是否有访问二级目录的权限 end

//登录用户访问当前php文件，四项属性中有一个可以访问即可以访问
   $strSQL="SELECT pavy2.browseprem,pavy2.addprem,pavy2.editprem,pavy2.deleprem FROM pavy2 left join backmenu on pavy2.id_backmenu=backmenu.id_backmenu
   WHERE pavy2.id_hr=$_SESSION[user_id] and (pavy2.browseprem='1' or pavy2.addprem='1' or pavy2.editprem='1' or pavy2.deleprem='1')
   and backmenu.url='".$c_url."'";
   $objDB->Execute($strSQL);
   $onuserperm=$objDB->fields();//取出当前登录用户的二级目录权限表中的id_backmenu
   $onuserperm_browse=$onuserperm[browseprem];
   $onuserperm_addprem=$onuserperm[addprem];
   $onuserperm_editprem=$onuserperm[editprem];
   $onuserperm_deleprem=$onuserperm[deleprem];
  // echo $onuserperm_browse.'-'.$onuserperm_addprem.'-'.$onuserperm_editprem.'-'.$onuserperm_deleprem;

//根据用户权限 生成leftmenu start 这里可以调整左侧菜单顺序
   if($selfid[siteset_visit]==1){$menu1id[]='44';}
   if($selfid[product_visit]==1){$menu1id[]='1';}
   if($selfid[store_visit]==1){$menu1id[]='2';}
   if($selfid[news_visit]==1){$menu1id[]='3';}
   if($selfid[hr_visit]==1){$menu1id[]='4';}
   if($selfid[pavy_visit]==1){$menu1id[]='5';}
   if($selfid[data_visit]==1){$menu1id[]='6';}

   
   $usermenu1='';
   for($i=0;$i<sizeof($menu1id);$i++){
      if($i==sizeof($menu1id)-1){
	  $usermenu1.=$menu1id[$i];
	  }else{
      $usermenu1.=$menu1id[$i].",";
	  }
   }

//取出1级目录
$strSQL="SELECT id_backmenu,name,url FROM backmenu WHERE level='1' and dele='1' and id_backmenu in ($usermenu1) order by ordernum ASC";
$objDB->Execute($strSQL);
$arrMenu1=$objDB->GetRows();
//根据当前登录用户的权限 判断是否显示一级目录 END
//根据用户权限 生成leftmenu end
?>
