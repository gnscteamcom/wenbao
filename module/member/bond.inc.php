<?php
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require MD_ROOT.'/member.class.php';
require DT_ROOT.'/include/post.func.php';
$do = new member;
$do->userid = $_userid;
$user = $do->get_one();
//print_r($user);
extract($user);
if(!empty($_POST['insubmit'])){
	if(!empty($_POST['bond'])){
		if($_POST['bond']<=$money){
		$money=$money-$_POST['bond'];
		$bond=$bond+$_POST['bond'];
		$rs=$db->query("update destoon_member set bond={$bond},money={$money} where userid={$_userid}");
			if(!empty($rs)){
				echo "<script>alert('转入成功！');</script>";
			}else{
				echo "<script>alert('处理失败！');</script>";
			}		
		}else{
			echo "<script>alert('转入失败，你的账户余额不足请你充值后再试！');</script>";
		}
	}else{
		echo "<script>alert('金额不能为空！');</script>";
	}
	
}
if(!empty($_POST['outsubmit'])){
	if(!empty($_POST['bond'])){
		if($bond>=$_POST['bond']){
		$money=$money+$_POST['bond'];
		$bond=$bond-$_POST['bond'];
			$rs=$db->query("update destoon_member set bond={$bond},money={$money} where userid={$_userid}");
			if(!empty($rs)){
				echo "<script>alert('转出成功！');</script>";
			}else{
				echo "<script>alert('处理失败！');</script>";
			}					
		}else{
			echo "<script>alert('转出失败，你的保证金余额不足或被锁定！');</script>";
		}
	}else{
		echo "<script>alert('金额不能为空！');</script>";
	}
	
}
include template('bond', $module);
?>