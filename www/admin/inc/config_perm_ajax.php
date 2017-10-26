<?php
//根据当前登录用户的权限 判断是否显示一级目录 START
   $strSQL="SELECT * FROM pavy1 WHERE  id_hr=$_SESSION[user_id]";
   $objDB->Execute($strSQL);
   $selfid=$objDB->fields();//取出当前登录用户的一级目录权限信息
   
   //判断当前登录用户是否有访问一级目录的权限 start
   if($selfid[product_visit]=='0' && $c_dir=='product'){exit();}
   if($selfid[store_visit]=='0' && $c_dir=='store'){exit();}
   if($selfid[news_visit]=='0' && $c_dir=='news'){exit();}
   if($selfid[hr_visit]=='0' && $c_dir=='hr'){exit();}
   if($selfid[pavy_visit]=='0' && $c_dir=='perm'){exit();}
   if($selfid[data_visit]=='0' && $c_dir=='dbase'){exit();}
   //判断当前登录用户是否有访问一级目录的权限 end
 
   //登录用户访问当前ajax文件所关联的主文件，四项属性全部为0即不可以访问。start
   $strSQL="SELECT pavy2.id_backmenu FROM pavy2 left join backmenu on pavy2.id_backmenu=backmenu.id_backmenu
   WHERE pavy2.id_hr=$_SESSION[user_id] and pavy2.browseprem='0' and pavy2.addprem='0' and pavy2.editprem='0' and pavy2.deleprem='0'
   and backmenu.url='".$c_url."'";
   $objDB->Execute($strSQL);
   $perm2menu=$objDB->GetRows();//取出当前登录用户的二级目录权限表中的id_backmenu
   if(sizeof($perm2menu)!=0){exit();}
   //登录用户访问当前ajax文件所关联的主文件，四项属性全部为0即不可以访问。end

//登录用户访问当前php文件，四项属性中有一个可以访问即可以访问
   $strSQL="SELECT pavy2.browseprem,pavy2.addprem,pavy2.editprem,pavy2.deleprem FROM pavy2 left join backmenu on pavy2.id_backmenu=backmenu.id_backmenu
   WHERE pavy2.id_hr=$_SESSION[user_id] and (pavy2.addprem='1' or pavy2.editprem='1' or pavy2.deleprem='1')
   and backmenu.url='".$c_url."'";
   $objDB->Execute($strSQL);
   $ajax_onuserperm=$objDB->fields();//取出当前登录用户的二级目录权限表中的id_backmenu
   $ajax_onuserperm_addprem=$ajax_onuserperm[addprem];
   $ajax_onuserperm_editprem=$ajax_onuserperm[editprem];
   $ajax_onuserperm_deleprem=$ajax_onuserperm[deleprem];
   //echo  $ajax_onuserperm_addprem.'-'.$ajax_onuserperm_editprem.'-'.$ajax_onuserperm_deleprem;
?>
