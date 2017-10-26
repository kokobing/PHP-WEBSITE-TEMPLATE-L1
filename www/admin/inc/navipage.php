<?php
/**
 * @package 		PageNav
 * @author			iven
 * @version		1.0   2005/10/8
 * 
 * PageNav()			(构造函数)<br>
 * TotalPage()			(总共页数)<br>
 * FirstPage()			(第一页)<br>
 * PrePage() 			(上一页)<br>
 * NextPage()			(下一页)<br>
 * LastPage()			(最后一页)<br>
 * GetStartNum()		(记录开始NUMBER)<br>
 * 
 */
class PageNav{

	var $mCurPage;//当前第几页
	var $mTotalRecord;//总共记录条数
	var $mStartNum;//查询记录开始数
	var $mTotalPage;//总页数
	var $mPerPageNum;//每页显示记录条数��
	
	/*************************新 类**************************/
	var $output;#页面输出结果
	var $file;#使用该类的文件,默认为 PHP_SELF
	var $pvar = "page";#分页参数传递变量，默认为 'page'
	var $psize;#每页显示数据条数
	var $curr;#当前第几页
	var $varstr;#要传递的变量数组
    var $tpage;#总页数
	var $isfull=true;
	var $param=array();
	var $intStartNum=0;
	/*************************新 类**************************/
	
	//显示信息
	var $go_top="<img src='icon_003.gif' border='0'>";
	var $go_back="<img src='icon_004.gif' border='0'>";
	var $go_next="<img src='icon_005.gif' border='0'>";
	var $go_end="<img src='icon_006.gif' border='0'>";
	/**
	* ���캯��
	* @param 		int			$intCurPage			(当前第几页)
	* @param 		int			$intTotalRecord		(总共记录条数）
	* @param 		int			$intPerPageNum		(每页显示记录条数）
	* @return   void
	*/
	function PageNav($intCurPage,$intTotalRecord,$intPerPageNum="10"){
		$this->mCurPage=$intCurPage;
		$this->mTotalRecord=$intTotalRecord;
		$this->mPerPageNum=$intPerPageNum;
		$this->mTotalPage=ceil($intTotalRecord/$intPerPageNum);	
	}
	
	/** 
	* TotalPage (总页数)
	* @param
	* @return   	int		$this->mTotalPage			(��ҳ��                   
	*			
	*/
	function TotalPage(){
		return $this->mTotalPage;
	}
	
	/** 
	* FirstPage (第一页)
	* @param
	* @return   	int		1	(第一页）��һҳ��                   
	*			
	*/
	function FirstPage(){
		return 1;
	}

	/** 
	* PrePage (上一页)
	* @param
	* @return   	int		$this->mCurPage-1		(上一页）
	*			
	*/	
	function PrePage(){
		if($this->mCurPage>1){
			 return $this->mCurPage-1;
		}else{
			return $this->mCurPage;						
		}
	}
	
	/** 
	* NextPage (下一页)
	* @param
	* @return   	int		$this->mCurPage+1			(下一页）       
	*			
	*/
	function NextPage(){
		if($this->mCurPage<$this->mTotalPage){
			return $this->mCurPage+1;
		}else{
			return $this->mCurPage;			
		}
	}

	/** 
	* LastPage (最后一页)
	* @param
	* @return   	int		$this->mCurPage-1			(最后一页）
	*			
	*/	
	function LastPage(){
		return $this->mTotalPage;
	}


	/** 
	* GetStartNum (记录开始数)
	* @param
	* @return   	int		$this->mStartNum		(记录开始数）          
	*			
	*/	
	function GetStartNum(){
		$this->mStartNum=($this->mCurPage-1)*$this->mPerPageNum;
		return $this->mStartNum;
	}
	
	function Param($arrParam){
		//$param
		//value
		$strParam="";
		for($i=0;$i<sizeof($arrParam);$i++){
			$strParam.="&".$arrParam[$i][name]."=".urlencode($arrParam[$i][value])."";
		}
		return $strParam;
	}
	
	/*
	* GetLink()
	* @param
	* @return string $strLink(分页格式)
	*/
	function GetLink(){
		$strLink="信息数".$this->mTotalRecord."&nbsp;总页数".$this->mTotalPage."&nbsp;当前页数".$this->mCurPage."
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->FirstPage()."\">".$this->go_top."</a>
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->PrePage()."\">".$this->go_back."</a> 
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->NextPage()."\">".$this->go_next."</a> 
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->LastPage()."\">".$this->go_end."</a>
				  <input type=\"hidden\" name=\"maxpage\" value='".$this->mTotalPage."'>";
		return 	$strLink;	
	}

	function GetLinkParamMul($arrParam){
		$strLink="信息数".$this->mTotalRecord."&nbsp;总页数".$this->mTotalPage."&nbsp;当前页数".$this->mCurPage."
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->FirstPage().$this->Param($arrParam)."\">".$this->go_top."</a> 
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->PrePage().$this->Param($arrParam)."\">".$this->go_back."</a>
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->NextPage().$this->Param($arrParam)."\">".$this->go_next."</a> 
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->LastPage().$this->Param($arrParam)."\">".$this->go_end."</a>
				  <input type=\"hidden\" name=\"maxpage\" value='".$this->mTotalPage."'>";
		return 	$strLink;	
	}
		
	function GetLinkParam($strParam,$strNum){
		$strLink="信息数".$this->mTotalRecord."&nbsp;总页数".$this->mTotalPage."&nbsp;当前页数".$this->mCurPage."
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->FirstPage()."&".$strParam."=".urlencode($strNum)."\">".$this->go_top."</a> 
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->PrePage()."&".$strParam."=".urlencode($strNum)."\">".$this->go_back."</a>
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->NextPage()."&".$strParam."=".urlencode($strNum)."\">".$this->go_next."</a> 
				  <a href=\"".$_SERVER['PHP_SELF']."?page=".$this->LastPage()."&".$strParam."=".urlencode($strNum)."\">".$this->go_end."</a>
				  <input type=\"hidden\" name=\"maxpage\" value='".$this->mTotalPage."'>";
		return 	$strLink;	
	}
	
	
	function init_page ( $pagesize, $num, $page=false, // 通常指定前三项就 OK
		$links	= 4,
		$var	= "page",
		$txt_fp	= "首页",
		$txt_lp	= "末页",
		$txt_pp	= "上一页",
		$txt_np	= "下一页"
	){
		global $HTTP_GET_VARS;
		if($_REQUEST[page]){$page=$_REQUEST[page];}
		$this->tpage = @ceil($num/$pagesize);
		if (!$page) {$page = $HTTP_GET_VARS[$this->pvar];}
		if ($page>$this->tpage) {$page = $this->tpage;}
		if ($page<1) {$page = 1;}

		$this->curr  = $page;
		$this->psize = $pagesize;
		$this->intStartNum = $pagesize*($page-1); 

		$f = '&';
		if ( $page - $links > 1 ){
			$PageLinks .= ""; // 省略 {$links} 页以前的页数链接
		}
		for($i = max ( 1, $page - $links ); $i <= min ( $this->tpage, $page + $links ); $i++){
			if($page == $i){
				$PageLinks .= "<font color=\"#FF0000\"><strong>$i</strong></font>"; // 当前页
			}else{
				$PageLinks .= "<a href=\"{$this->file}?{$this->varstr}{$f}$var=$i\" class=\"m_02\">$i</a>"; // 其他页的链接
			}
		}
		
		if (   $this->tpage - $page - $links  > 0 ){
			$PageLinks .= " "; 
		}
		if ( $this->tpage > 0 ){
			$before	= $page > 1 // 若当前页大于 1， 显示“第一页”
				? "<a href=\"{$this->file}?{$this->varstr}{$f}$var=1\" class=\"m_02\">$txt_fp</a>"
				: "";
				
				if ( $page < $this->tpage ){ // 若当前页小于最后页， 显示“下一页”
					$after	= "<a href=\"{$this->file}?{$this->varstr}{$f}$var=" . ( $page + 1 ) . "\" class=\"m_02\">$txt_np</a> " ;
				}
				
			$after	=( $page < $this->tpage) && ($this->tpage>6 )// 若当前页小于最后页， 显示“最后页”
				? "<a href=\"{$this->file}?{$this->varstr}{$f}$var={$this->tpage}\" class=\"m_02\">...$this->tpage</a>".$after
				: "";

			
				if ( $page > 1 ){ // 若当前页大于 1， 显示“上一页”
					$before	.= " <a href=\"{$this->file}?{$this->varstr}{$f}$var=" . ( $page - 1 ) . "\" class=\"m_02\">$txt_pp</a>";
				}


				global $language;
				if( $this->isfull ){
					$after .= $language == "english" ? " $pagesize Records/Page, Total: $num" : "";
				}
			
			if($this->varstr!=""){
				$PostParam="";
				$data=$this->param;
				for($k=0;$k<sizeof($data);$k++){
					$name=$data[$k][name];
					$value=$data[$k][value];
					$PostParam.="<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
				}	
			}

			$PageLinks	= "<div class='pg'>$PostParam $before $PageLinks $after </div>"; 
		}
		if($this->tpage == 0)
		{
			$PageLinks = "";
		}	
		$this->output = $PageLinks;
	}

	function setvar($data="") {
		$this->param=$data;
		$strParam="";
		for($i=0;$i<sizeof($data);$i++){
			$strParam.="&".$data[$i][name]."=".urlencode($data[$i][value])."";
		}
		$this->varstr=$strParam;
	}

	function StartNum(){
		if($this->intStartNum){
			return $this->intStartNum;
		}else{
			return 0;
		}
	}
	
	function output($return = 1) {
		if ($return) {
			return $this->output;
		} else {
			echo $this->output;
		}
	}
	
}
?>