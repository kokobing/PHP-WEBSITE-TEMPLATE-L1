<script src="/admin/inc/js/setpointer.js" type="text/javascript" ></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="28" align="left" valign="bottom"><img src="/admin/inc/pics/navi.gif" width="210" height="24"></td>
      </tr>
</table>
 <?php  for($i=0;$i<sizeof($arrMenu1);$i++){?>

<table width="98%" border="0" cellspacing="0" cellpadding="0">
<tr >
          <td width="10%" height="25" align="right" valign="middle"><img src="/admin/inc/pics/arrow.gif" width="6" height="9"></td>
          <td width="12%" align="center" valign="middle"><img src="/admin/inc/pics/icon_0<?php echo $i;?>.gif" width="17" height="15"></td>
          <td class="txt_leftmenu" style="cursor:pointer;" onClick="ChangeTab(<?php echo $i;?>);" ><a href="#" class="link_leftmenu"><?php  echo $arrMenu1[$i][name];?></a> </td>
        </tr>
<tr >
  <td colspan="3" style="padding:0; height:1px;">
         <?php if($c_dir==$arrMenu1[$i][url]){?>
		  <div id="form<?php echo $i;?>"  style="display:yes"> <!--二级菜单开始-->
          <?php }else{?>
		  <div id="form<?php echo $i;?>"  style="display:none"> <!--二级菜单开始-->
		  <?php }?>
               
			    <?php
				$strSQL="SELECT backmenu.name,backmenu.url,backmenu.id_backmenu FROM pavy2 left join backmenu on pavy2.id_backmenu=backmenu.id_backmenu
WHERE (browseprem!='0' or addprem!='0' or editprem!='0' or deleprem!='0') and backmenu.fatherid='".$arrMenu1[$i][id_backmenu]."' and id_hr='".$_SESSION[user_id]."' order by backmenu.id_backmenu asc";
                   $objDB->Execute($strSQL);
                   $arrMenu2=$objDB->GetRows();
				 for($j=0;$j<sizeof($arrMenu2);$j++){?>		  
            <table width="100%" border="0" cellspacing="0" cellpadding="2" class="txt">
               <tr onMouseOver="setPointer(this, <?php echo $j+1;?>, 'over', '#FFFFFF', '#E7F1F8', '#FFEEDD');" onMouseOut="setPointer(this, <?php echo $j+1;?>, 'out', '#FFFFFF', '#E7F1F8', '#FFEEDD');" onMouseDown="setPointer(this, <?php echo $j+1;?>, 'click', '#FFFFFF', '#FFFFFF', '#FFFFFF');" style="cursor:pointer; background-color:#FFFFFF"> 
                <td width="22%" height="25" align="right"><img src="/admin/inc/pics/arrow.gif" width="6" height="9"></td>
                <td><a href="<?php echo $arrMenu2[$j][url]; ?>" class="link_leftmenu" <?php if($arrMenu2[$j][id_backmenu]=='22'){echo 'target="_blank"';}?> >
				<?php echo $arrMenu2[$j][name];?>
				</a> </td>
               </tr>
              <tr bgcolor="#cccccc">
                <td style="padding:0; height:1px;" colspan="2"></td>
              </tr>
            </table>
           <?php }?>	
		   		
       </div>
  </td>
  </tr>
</table>
<?php }?>
<script countryuage="javascript">
	function ChangeTab(tag){
		var tag = tag; 
		var c_form = "form"+tag;
		for(i=0;i<6;i++){
			var tagForm = "form"+i;   
			if(i==tag){
				document.getElementById(tagForm).style.display="block";
			}else{
				document.getElementById(tagForm).style.display="none";
			}
		}
 }
</script>