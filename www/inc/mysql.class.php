<?php
class mysql{
	var $Conn="";
	var $Res="";
	
	//构造函数
	function mysql($strHost,$strUser,$strPwd,$strDatabase){
		$this->Conn=mysql_connect($strHost,$strUser,$strPwd) 
					 or die("Sorry,canot connect to database!");
		mysql_select_db($strDatabase,$this->Conn);
		return $this->Conn;
	}
	
	function Execute($strSQL){
		$this->Res=mysql_query($strSQL,$this->Conn);
		if(!$this->Res){
			echo "query error!".mysql_error();
			return false;
		}
	}
	
	function SelectLimit($strSQL,$intRows,$intStart){
		$strSQL.=" Limit $intStart,$intRows";
		$this->Res=mysql_query($strSQL,$this->Conn);
		if(!$this->Res){
			echo "query error!".mysql_error();
			return false;
		}
	}

	function getRows(){
		$i=0;
		$arrResult=array();
		while($row =mysql_fetch_array($this->Res,MYSQL_ASSOC)){
			$arrResult[$i]=$row;
			$i++;
		}
		mysql_free_result($this->Res);
		return $arrResult;
	}
	
	
		
	function fields(){
		$row =mysql_fetch_assoc($this->Res);
		mysql_free_result($this->Res);
		return $row;
	}
	
	function getInsertID(){
		return mysql_insert_id();
	}
	
	function getCount(){
		return @mysql_affected_rows($this->Res); 
	}

}
?>