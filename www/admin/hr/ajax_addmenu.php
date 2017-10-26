<?php  
require "../inc/config_admin.php";
//增加新部门、职务、职称
// file_put_contents('aa.txt', $nowid);
if(isset($_SESSION[user_id])){//if usrer login
$c_url='/admin/hr/hr_staff.php';//关联主文件
require "../inc/config_perm_ajax.php";//一级目录和二级文件的访问权限判断
  $message = $_REQUEST["passmessage"];
  $onclickid = $_REQUEST["onclickid"];

//$ajax_onuserperm_addprem.'-'.$ajax_onuserperm_editprem.'-'.$ajax_onuserperm_deleprem;
if($ajax_onuserperm_addprem=='1'){
//添加部门
  if($onclickid=='txt_adddept'){
  $strSQL="INSERT INTO dept(dept) VALUES('$message') ";
  $objDB->Execute($strSQL);//部门入库
  $nowid=$objDB->getinsertid();
  
  $strSQL="SELECT id_dept,dept FROM dept";
  $objDB->Execute($strSQL);
  $arrdept=$objDB->GetRows();

  $gselectdept='<select name="dept" class="input_01">';
  for($i=0;$i<sizeof($arrdept);$i++){
  if($arrdept[$i][id_dept]==$nowid){
    $gselectdept.='<option value="'.$arrdept[$i][id_dept].'" selected>'.$arrdept[$i][dept].'</option>';
  }else{
    $gselectdept.='<option value="'.$arrdept[$i][id_dept].'">'.$arrdept[$i][dept].'</option>';
   }
  }
  $gselectdept.='</select><span id="txt_adddept" style="cursor:pointer" onclick=onclickadd("txt_adddept"); >+</span>';
  $arr['gselectdept']=$gselectdept;
  }//end if 
  
  //添加职务
  if($onclickid=='txt_addpost'){
  $strSQL="INSERT INTO post(post) VALUES('$message') ";
  $objDB->Execute($strSQL);
  $nowid=$objDB->getinsertid();
  
  $strSQL="SELECT id_post,post FROM post";
  $objDB->Execute($strSQL);
  $arrpost=$objDB->GetRows();

  $gselectpost='<select name="post" class="input_01" >';
  for($i=0;$i<sizeof($arrpost);$i++){
  if($arrpost[$i][id_post]==$nowid){
    $gselectpost.='<option value="'.$arrpost[$i][id_post].'" selected>'.$arrpost[$i][post].'</option>';
  }else{
    $gselectpost.='<option value="'.$arrpost[$i][id_post].'">'.$arrpost[$i][post].'</option>';
   }
  }
  $gselectpost.='</select><span id="txt_addpost" style="cursor:pointer" onclick=onclickadd("txt_addpost"); >+</span>';
  $arr['gselectpost']=$gselectpost;
  }//end if 
  
//添加职称
  if($onclickid=='txt_addtitle'){
  $strSQL="INSERT INTO title(title) VALUES('$message') ";
  $objDB->Execute($strSQL);
  $nowid=$objDB->getinsertid();
  
  $strSQL="SELECT id_title,title FROM title";
  $objDB->Execute($strSQL);
  $arrtitle=$objDB->GetRows();

  $gselecttitle='<select name="title" class="input_01" >';
  for($i=0;$i<sizeof($arrtitle);$i++){
  if($arrtitle[$i][id_title]==$nowid){
    $gselecttitle.='<option value="'.$arrtitle[$i][id_title].'" selected>'.$arrtitle[$i][title].'</option>';
  }else{
    $gselecttitle.='<option value="'.$arrtitle[$i][id_title].'">'.$arrtitle[$i][title].'</option>';
   }
  }
  $gselecttitle.='</select><span id="txt_addtitle" style="cursor:pointer" onclick=onclickadd("txt_addtitle"); >+</span>';
  $arr['gselecttitle']=$gselecttitle;
  }//end if 
  $arr['type']=$onclickid;
  $arr['info']="添加成功!";
  $myjson= json_encode($arr);
  echo $myjson;
  }
}//if session end
?>