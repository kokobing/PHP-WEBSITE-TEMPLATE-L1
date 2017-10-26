<?php 
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");
$action=$_SERVER["QUERY_STRING"];

   //取出所有员工信息
  $strSQL="SELECT * FROM hr WHERE dele='1'";
  $objDB->Execute($strSQL);
  $arrstaff=$objDB->GetRows();
  
  //取出某个员工信息
  if(isset($action) && substr($action,0,2)=="03"){
  $onestaffid=substr($action,2);
  $strSQL="SELECT name,photo,id_hr FROM hr WHERE id_hr=$onestaffid";
  $objDB->Execute($strSQL);
  $onestaff=$objDB->fields();
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<script>
function chkall(id) {

if ($("#"+id).val() == '0') { // 全选
$("input[name="+id+"]").each(function() { $(this).attr("checked", true); }); 
$("#"+id).val("1");//全选后变成1
}else if ($("#"+id).val() == '1') { // 取消全选 
$("input[name="+id+"]").each(function() { $(this).attr("checked", false); }); 
$("#"+id).val("0");//取消后变成0
} 

}//end chkall


function uppermdata(menu1id,menu2idzh,userid) {
if($("#check1menu"+menu1id).attr("checked")==true){ 
var menu1idchk='1';//checked
}else{
var menu1idchk='0';//unchecked
}//menu1id一级目录id menu1idchk判断是否选中

var menu2zh=menu2idzh.split("-");
var menu2chked='';
for(var i = 0; i < menu2zh.length; i++) {
 if(menu2zh[i]!='') {
   for(var j=1;j<5;j++){
   if($("#"+j+"check2menu"+menu2zh[i]).attr("checked")==true){
     menu2chked=menu2chked+'1';
	 }else{
     menu2chked=menu2chked+'0';
	 }
	 if(j==4){menu2chked=menu2chked+'-'}
   }//j end
 }//if end
} //i end

$.post('ajax_upperm.php',{menu1id: menu1id,menu1idchk:menu1idchk,menu2idzh:menu2idzh,menu2chked:menu2chked,userid:userid},function(data){
		 var myjson = '';eval('myjson=' + data + ';');
		 if(myjson.errorcode=='0'){
         popmessage(myjson.info, '友情提醒!'); 
		 }else{
	  popmessage(myjson.info, '友情提醒!',function() {window.location.href="/admin/perm/perm_manage.php?<?PHP echo $action;?>";}); 
							 }
	 });//end function
}//end uppermdata




</script> 
</head>
<body>
<?php require "../header.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="87.9%">
  <tr> 
    <td width="15%" align="left" valign="top" bgcolor="#E7F1F8">
	<?php require "../leftmenu.php"; ?>
    </td>
    <td width="75%" align="center" valign="top">
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="right"></td>
      </tr>
    </table>
    <?php if(isset($action) && $action==''){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">权限管理</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu">
              
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
	        <tr>
	       <? for($i=0;$i<sizeof($arrstaff);$i++){
 	          if($i!=0 && $i%7==0){?></tr><tr><? }?>		
		      <td height="100" align="Center" valign="top" style="width:14%;">
				<table width="80" border="0" align="center" cellpadding="0" cellspacing="0" class="txt">
				  <tr align="center">
					<td bgcolor="#CCCCCC"><table width="100%"  border="0" cellspacing="1">
                      <tr>
                        <td align="center" bgcolor="#FFFFFF">
                     <a href="perm_manage.php?03<?php echo $arrstaff[$i][id_hr]?>" ><img src="../hr/hrphoto/<?php if($arrstaff[$i][photo]==''){echo 'staffphoto.gif';}else{ echo $arrstaff[$i][photo];}?>" width="60" height="56" border="0"></a><br>
                          <? echo $arrstaff[$i][name];?></td>
                      </tr>
                    </table></td>
				  </tr>
				</table>
			  </td>
	           <? }?>		  
	         </tr>
           </table>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
    <?php }?>
    <?php if(isset($action) && substr($action,0,2)=='03'){?>
 	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu"><?php echo $onestaff[name];?>_权限管理</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">
          <?php for($i=0;$i<sizeof($arrMenu1);$i++){
		$strSQL="SELECT id_backmenu,name,url FROM backmenu WHERE level='2' and dele='1' and fatherid='".$arrMenu1[$i][id_backmenu]."' order by ordernum ASC";
        $objDB->Execute($strSQL);
        $arrMenu2=$objDB->GetRows();
		  ?>
          <?php if($i==0){?>
          <div id="formmenu<?php echo $i;?>"  style="display:yes"> <!--二级菜单开始-->
          <?php }else{?>
          <div id="formmenu<?php echo $i;?>"  style="display:none"> <!--二级菜单开始-->
          <?php }?>

          <table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%" align="left" valign="bottom">
                  <table width="80" border="0" align="left" cellpadding="0" cellspacing="0" class="txt">
				  <tr align="center">
					<td bgcolor="#CCCCCC"><table width="100%"  border="0" cellspacing="1">
                      <tr>
                        <td align="center" bgcolor="#FFFFFF"><a href="#" ><img src="../hr/hrphoto/<?php if($onestaff[photo]==''){ echo 'staffphoto.gif';}else{ echo $onestaff[photo];}?>" width="60" height="56" border="0" /></a><br>
                          <?php echo $onestaff[name];?></td>
                      </tr>
                    </table></td>
				  </tr>
				</table>                  </td>
                  <td width="87%" align="center" valign="bottom"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
              <?php  for($k=0;$k<sizeof($arrMenu1);$k++){
  	          if($k!=0 && $k%7==0){?></tr><tr><? }?>		
		      <td align="Center" valign="bottom" style="width:14%;">
				<table width="80" border="0" align="center" cellpadding="0" cellspacing="0" class="txt">
				  <tr align="center">
					<td ><table width="100%"  border="0" cellspacing="1">
                      <tr>
              <td align="center"><a href="#" class="link_leftmenu"  onClick="ChangeTab2(<?php echo $k;?>);">
			  <?php
			  if($k==$i){
			  echo "<strong>".$arrMenu1[$k][name]."</strong>";
			  }else{
			  echo $arrMenu1[$k][name];
			  }
			  ?></a></td>
                      </tr>
               <?php if($k==$i){?>       
               <tr>
                        <td align="center"><img src="../inc/pics/arrow01.gif" width="5" height="3"></td>
               </tr>
                <? }?>	      
                    </table></td>
				  </tr>
				</table>			  </td>
	           <? }?>		  
                    </tr>
                  </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="padding:0; height:10px;"></td>
                </tr>
                <tr>
                  <td colspan="2" bgcolor="#E7F1F8" style="padding:0; height:1px;"></td>
                </tr>
                <tr>
                  <td colspan="2" style="padding:0; height:10px;"></td>
                </tr>
                <tr class="link_right2font">
                  <td colspan="2" style="padding:0; height:10px;"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left"><strong><?php echo $arrMenu1[$i][name];?></strong></td>
                      <td colspan="2"><input type="checkbox" name="check1menu<?php echo $arrMenu1[$i][id_backmenu];?>" id="check1menu<?php echo $arrMenu1[$i][id_backmenu];?>" 
					  <?php
					  if($arrMenu1[$i][id_backmenu]=='1'){
					  		  $strSQL="SELECT product_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[product_visit]=='1'){echo 'checked';}
					  }//当前一级目录的ID为1，则根据被设置用户的ID来抽取其产品系统权限，如果该值为1，则复选框被选中
					  if($arrMenu1[$i][id_backmenu]=='2'){
					  		  $strSQL="SELECT store_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[store_visit]=='1'){echo 'checked';}
					  }
					  if($arrMenu1[$i][id_backmenu]=='3'){
					  		  $strSQL="SELECT news_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[news_visit]=='1'){echo 'checked';}
					  }
					  if($arrMenu1[$i][id_backmenu]=='4'){
					  		  $strSQL="SELECT hr_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[hr_visit]=='1'){echo 'checked';}
					  }
					  if($arrMenu1[$i][id_backmenu]=='5'){
					  		  $strSQL="SELECT pavy_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[pavy_visit]=='1'){echo 'checked';}
					  }
					  if($arrMenu1[$i][id_backmenu]=='6'){
					  		  $strSQL="SELECT data_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[data_visit]=='1'){echo 'checked';}
					  }
					  if($arrMenu1[$i][id_backmenu]=='44'){
					  		  $strSQL="SELECT siteset_visit FROM pavy1 WHERE id_hr=$onestaffid";
                              $objDB->Execute($strSQL);
                              $perm1=$objDB->fields();
					   if($perm1[siteset_visit]=='1'){echo 'checked';}
					  }
					   ?>/>
<strong>查看（设置主菜单权限）</strong></td>
                    </tr>
                    <tr>
                  <td colspan="2" style="padding:0; height:10px;"></td>
                      </tr>
                    <?php 
					   $menu2idzh='';
					   for($j=0;$j<sizeof($arrMenu2);$j++){
					   $menu2idzh.=$arrMenu2[$j][id_backmenu].'-';//组合ID '8-9-10-'
					?>  
                   <tr>
                  <td colspan="3" style="padding:0; height:4px;"></td>
                      </tr>
                    <tr>
                   <td align="left"><span onclick=chkall(<?php echo $arrMenu2[$j][id_backmenu]?>);  style="cursor:pointer"><?php echo $arrMenu2[$j][name]?></span></td>
       <td colspan="2" align="left">
       <input name="<?php echo $arrMenu2[$j][id_backmenu]?>" id="<?php echo $arrMenu2[$j][id_backmenu]?>" type="hidden" value="0" />
       <input type="checkbox" name="<?php echo $arrMenu2[$j][id_backmenu]?>" id="1check2menu<?php echo $arrMenu2[$j][id_backmenu]?>" value="1" <?php 
	   		$strSQL="SELECT browseprem FROM pavy2 WHERE id_backmenu='".$arrMenu2[$j][id_backmenu]."' and id_hr='".$onestaffid."'";
                   $objDB->Execute($strSQL);
                   $browseprem=$objDB->fields();
			if($browseprem[browseprem]=='1'){echo 'checked';}
           ?>/>查看
       <input type="checkbox" name="<?php echo $arrMenu2[$j][id_backmenu]?>" id="2check2menu<?php echo $arrMenu2[$j][id_backmenu]?>" value="2" <?php 
	   		$strSQL="SELECT addprem FROM pavy2 WHERE id_backmenu='".$arrMenu2[$j][id_backmenu]."' and id_hr='".$onestaffid."'";
                   $objDB->Execute($strSQL);
                   $addprem=$objDB->fields();
			if($addprem[addprem]=='1'){echo 'checked';}
           ?>/>新增
       <input type="checkbox" name="<?php echo $arrMenu2[$j][id_backmenu]?>" id="3check2menu<?php echo $arrMenu2[$j][id_backmenu]?>" value="3" <?php 
	   		$strSQL="SELECT editprem FROM pavy2 WHERE id_backmenu='".$arrMenu2[$j][id_backmenu]."' and id_hr='".$onestaffid."'";
                   $objDB->Execute($strSQL);
                   $editprem=$objDB->fields();
			if($editprem[editprem]=='1'){echo 'checked';}
           ?>/>修改
       <input type="checkbox" name="<?php echo $arrMenu2[$j][id_backmenu]?>" id="4check2menu<?php echo $arrMenu2[$j][id_backmenu]?>" value="4" <?php 
	   		$strSQL="SELECT deleprem FROM pavy2 WHERE id_backmenu='".$arrMenu2[$j][id_backmenu]."' and id_hr='".$onestaffid."'";
                   $objDB->Execute($strSQL);
                   $deleprem=$objDB->fields();
			if($deleprem[deleprem]=='1'){echo 'checked';}
           ?>/>删除 </td>
                      </tr>
                 <tr>
                  <td colspan="3" style="padding:0; height:4px;"></td>
                      </tr>
                 <tr>
                  <td colspan="3" bgcolor="#E7F1F8" style="padding:0; height:1px;"></td>
                 </tr>
                    <?php }?>
                  <tr>
                     <td colspan="3" style="padding:0; height:8px;"></td>
                  </tr>
                  <tr>
                     <td colspan="3" align="left"><input class="btn" type="button" onclick="uppermdata('<?php echo $arrMenu1[$i][id_backmenu];?>','<?php echo $menu2idzh;?>','<?php echo $onestaff[id_hr];?>')" value="提交">
                     <input class="btn" type="button" name="button_back" id="button_back" value="返回"></td>
                  </tr>
                    </table></td>
                  </tr>
                
              </table>   
              </td>
            </tr>
          </table>
              </div>   
<?php }?>

            </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
<?php }?>
 </td>
  </tr>
</table>
<script countryuage="javascript">
	function ChangeTab2(tag){
		var tag = tag; 
		var c_form = "formmenu"+tag;
		for(i=0;i<6;i++){
			var tagForm = "formmenu"+i;   
			if(i==tag){
				document.getElementById(tagForm).style.display="block";
			}else{
				document.getElementById(tagForm).style.display="none";
			}
		}
 }
</script>
<?php require "../footer.php"; ?>
</body>
</html>

