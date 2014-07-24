<?php
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';

//лМ╪св╗Ё║
if(!empty($_GET['zhuanchang88'])){
	$item="auction-".$_GET['userid'];
	$rs=$db->query("insert into destoon_type set listorder='0',typename='".$_GET['zhuanchang88']."',style='',item='".$item."',cache='0'");
	$rs2=$db->query("select * from destoon_type where typename='".$_GET['zhuanchang88']."'");
	while ($rsid = $db->fetch_array($rs2)) {
		$valueid=$rsid['typeid'];
	}
	if($rs&&$rs2){
		echo $valueid;
	}else{
		echo "N";		
	} 
}
?>