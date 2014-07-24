<?php 
defined('IN_DESTOON1') or exit('Access Denied');
if($DT_BOT) dhttp(403);

require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$itemid or dheader($MOD['linkurl']);


if ($_username == '') {
	echo "login";
	return false;
}


$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");

if($item['username'] == $_username) {
	echo "5";
	return false;
}

if($_GET['zidong']){
	$A = $db->get_one("SELECT COUNT(*) AS num FROM `{$DT_PRE}auction_list` WHERE `high_price`<>0 and auction_user='$_username' and itemid=$itemid");
		if($A['num'] > 0) {
			echo "7";
			return false;
		}
	$A = $db->get_one("SELECT COUNT(*) AS num FROM `{$DT_PRE}auction_list` WHERE `high_price`<>0 and high_price='$_GET[values]' and itemid=$itemid");
		if($A['num'] > 0) {
			echo "8";
			return false;
		}
}

if($item['process'] == 2) {
	echo "6";
	return false;
}

if($item && $item['status'] > 2) {
	if($item['process'] == 2){ 
		echo "本竞拍已经结束。"; 
		return false;
	}
} else {
	echo "1";
	return false;
}

//判断是否符合竞拍资格
$bondnow=$db->query("select * from destoon_member where username='".$_username."'"); 
while($bondnowrs=mysql_fetch_array($bondnow)){
	$bondnowrsbond=$bondnowrs['bond'];//当前保证金余额
}		
if($bondnowrsbond<100){
	echo "9";
	return false;
}




/* 判断出价是否符合条件（原始价+竞价幅度）*/
if ($item['auction_price'] == '') {
	//如果尚未有人出价，则价格为原始起拍价+竞价幅度
	$min_price 	= $item['price'] + $item['minamount'];
}else{
	$min_price  = $item['auction_price'] + $item['minamount'];
}
$min_price=$min_price>=$item['marketprice'] ? $item['marketprice'] : $min_price;
if($_GET['zidong']){
$item['auction_price']	= $_GET['zidong'];
$item['auction_zidong']	= $_GET['values'];
//判断保证金多少
	$bondauctionn=$item['auction_zidong']*0.02;	
	$bondrsn=$db->query("select * from destoon_member where username='".$_username."'"); 
	while($bondrrn=mysql_fetch_array($bondrsn)){
		$cn=$bondrrn['bond'];//当前保证金余额
	}		
	if($cn<$bondauctionn){
		echo "9";
		return false;
	}
}else{
$item['auction_price']	= $_GET['values'];
//判断保证金多少
	$bondauctionn=$item['auction_price']*0.02;
	$bondrsn=$db->query("select * from destoon_member where username='".$_username."'"); 
	while($bondrrn=mysql_fetch_array($bondrsn)){
		$cn=$bondrrn['bond'];//当前保证金余额
	}		
	if($cn<$bondauctionn){
		echo "9";
		return false;
	}
}
$item['auction_user']	= $_username;
$item['auction_time']	= time();
$item['auction_ip']	= $_SERVER["REMOTE_ADDR"];
$item['auction_niming']	= $_GET['niming'];
//print_r ($item['auction_price']);exit;

//加上佣金$item['auction_price']*0.035 和运费$item['yunfei'] 之后再进行判断 2014/7/4
if ($item['auction_price']+$item['yunfei']+$item['auction_price']*0.035 >= $_money) {
	echo "2";
	return false;
}
//加上佣金$item['auction_price']*0.035 和运费$item['yunfei'] 之后再进行判断 2014/7/4
if ($item['auction_zidong']+$item['yunfei']+$item['auction_price']*0.035 >= $_money) {
	echo "2";
	return false;
}





if ($min_price <= $item['auction_price']){

//假如某用户正常出价超过自己的自动竞价价格，自动竞价即归零。

	$item1 = $db->query("SELECT * FROM {$DT_PRE}auction_list WHERE `high_price`<=$item[auction_price] and itemid=$itemid");
	while($r1 = $db->fetch_array($item1)) {
		$db->query("UPDATE `{$DT_PRE}auction_list` SET `high_price`=0 WHERE `id`=$r1[id]");
	}
	
	
	
	//判断保证金多少
	$bondauction=$item['auction_price']*0.02;




	
	//获取前一个竞拍用户名
	$auc=$db->query("select * from {$DT_PRE}auction_list where itemid=$itemid order by id DESC limit 1");
	while($aucrs=mysql_fetch_array($auc)){
		$aucuser=$aucrs['auction_user'];	
		
	}


	
	//插入记录表
	
	$db->query("INSERT INTO {$DT_PRE}auction_list VALUES('','$itemid','$item[auction_user]','$item[auction_price]','$item[auction_time]','$item[auction_ip]','$item[auction_niming]','$item[auction_zidong]')");
	
	
	//设置自动竞拍的用户实行自动竞拍
	$totol=$item['auction_price']+$item['minamount'];
	$auction_time=$item[auction_time];
	$item2 = $db->query("SELECT * FROM {$DT_PRE}auction_list WHERE `high_price`>$item[auction_price] and itemid=$itemid ORDER BY `high_price` ASC");
	$i=1;
	while($r2 = $db->fetch_array($item2)) {
		if($totol>=$r2['high_price']){
			$db->query("UPDATE `{$DT_PRE}auction_list` SET `high_price`=0 WHERE `id`=$r2[id]");
			$db->query("INSERT INTO {$DT_PRE}auction_list VALUES('','$itemid','$r2[auction_user]','$r2[high_price]','$auction_time','$item[auction_ip]','$item[auction_niming]',0)");
		}else{
			$db->query("INSERT INTO {$DT_PRE}auction_list VALUES('','$itemid','$r2[auction_user]','$totol','$auction_time','$item[auction_ip]','$item[auction_niming]',0)");
		}
	$i++;	
	$zidong_totol=$totol>=$r2['high_price'] ? $r2['high_price'] : $totol;
	$totol=$totol+$item['minamount'];
	$auction_time=$auction_time;
	$zidong_user=$r2[auction_user];
	$beyond=$totol>=$r2['high_price'] ? 1 : '';
	}
	
////////////////////////////////////////////////////////////////////////	
	if ($item['marketprice'] <= $item['auction_price']) {
		//秒杀情况
		
		
		
		
		
		
		
		

		$A1 = $db->get_one("SELECT COUNT(*) AS num FROM `{$DT_PRE}auction_list` WHERE `high_price`<>0 and itemid=$itemid");
		if($A1['num']>0 || $beyond==1){
		
			//判断要冻结保证金多少
			$bondauction=$zidong_totol*0.02;
			
		
			
			//解冻上一个用户的保证金
				$aucb=$db->query("select * from {$DT_PRE}auction where itemid=$itemid");
				while($aucrsb=mysql_fetch_array($aucb)){
					$aucbond=$aucrsb['bondauction'];						
				}
				//前一个用户的bondlocking/锁定的保证金
				$bondrsc2=$db->query("select * from destoon_member where username='".$aucuser."'"); 							
				while($bondrrc2=mysql_fetch_array($bondrsc2)){				
					$bondlockold=$bondrrc2['bondlocking'];
					$bondold=$bondrrc2['bond'];
				}
				if($aucuser){
		
					//解冻保证金				
					$bondback=$bondlockold-$aucbond;
					$bondback1=$bondold+$aucbond;
					$db->query("update {$DT_PRE}member set bondlocking=$bondback where username='".$aucuser."'");
					$db->query("update {$DT_PRE}member set bond=$bondback1 where username='".$aucuser."'");
				}
			
			////锁定保证金
			$bondzduser=$db->query("select * from destoon_member where username='".$zidong_user."'"); 							
			while($bondrrc2=mysql_fetch_array($bondzduser)){				
				$bondlockold1=$bondrrc2['bondlocking'];
				$bondold1=$bondrrc2['bond'];
			}
			$bondlockold1=$bondlockold1+$bondauction;
			$bondold1=$bondold1-$bondauction;
			if(bondold1>=0){
			$db->query("update {$DT_PRE}member set bondlocking=$bondlockold1,bond=$bondold1 where username='".$zidong_user."'");
			
			$db->query("UPDATE {$DT_PRE}auction SET orders=orders+1,auction_price='$zidong_totol',auction_user='$zidong_user',auction_time='$item[auction_time]',process='2',auction_status='1',bondauction='$bondauction' WHERE itemid=$itemid");
			}
			
		}else{
			
			//解冻上一个用户的保证金
				$aucb=$db->query("select * from {$DT_PRE}auction where itemid=$itemid");
				while($aucrsb=mysql_fetch_array($aucb)){
					$aucbond=$aucrsb['bondauction'];						
				}
				//前一个用户的bondlocking/锁定的保证金
				$bondrsc2=$db->query("select * from destoon_member where username='".$aucuser."'"); 							
				while($bondrrc2=mysql_fetch_array($bondrsc2)){				
					$bondlockold=$bondrrc2['bondlocking'];
					$bondold=$bondrrc2['bond'];
				}
				if($aucuser){
		
					//解冻保证金				
					$bondback=$bondlockold-$aucbond;
					$bondback1=$bondold+$aucbond;
					$db->query("update {$DT_PRE}member set bondlocking=$bondback where username='".$aucuser."'");
					$db->query("update {$DT_PRE}member set bond=$bondback1 where username='".$aucuser."'");
				}
				
			//锁定保证金
			$bondrs=$db->query("select * from destoon_member where username='".$item['auction_user']."'");
			while($bondrrc2=mysql_fetch_array($bondrs)){				
				$bondlockold1=$bondrrc2['bondlocking'];
				$bondold1=$bondrrc2['bond'];
			}
			$bondlockold1=$bondlockold1+$bondauction;
			$bondold1=$bondold1-$bondauction;
			if(bondold1>=0){
			$db->query("update {$DT_PRE}member set bondlocking=$bondlockold1,bond=$bondold1 where username='".$item['auction_user']."'");
			$db->query("UPDATE {$DT_PRE}auction SET orders=orders+1,auction_price='$item[auction_price]',auction_user='$item[auction_user]',auction_time='$item[auction_time]',process='2',auction_status='1',bondauction='$bondauction' WHERE itemid=$itemid");
			}
		}
		
		$content = ob_template('email-ko', 'mail');
		if($A1['num']>0 || $beyond==1){
		send_message($zidong_user, "恭喜你，你的竞拍已经成功！", stripslashes($content));
		}else{
		send_message($item['auction_user'], "恭喜你，你的竞拍已经成功！", stripslashes($content));
		
		}
		
		
		echo "KO";
		return false;
	}else{
		//更新竞价表
		$A1 = $db->get_one("SELECT COUNT(*) AS num FROM `{$DT_PRE}auction_list` WHERE `high_price`<>0 and itemid=$itemid");
		if($A1['num']>0 || $beyond==1){
		
			//判断要冻结保证金多少
			$bondauction=$zidong_totol*0.02;
		
			if ($item['marketprice'] <= $zidong_totol) {//秒杀情况
				
				
				//解冻上一个用户的保证金
				$aucb=$db->query("select * from {$DT_PRE}auction where itemid=$itemid");
				while($aucrsb=mysql_fetch_array($aucb)){
					$aucbond=$aucrsb['bondauction'];						
				}
				//前一个用户的bondlocking/锁定的保证金
				$bondrsc2=$db->query("select * from destoon_member where username='".$aucuser."'"); 							
				while($bondrrc2=mysql_fetch_array($bondrsc2)){				
					$bondlockold=$bondrrc2['bondlocking'];
					$bondold=$bondrrc2['bond'];
				}
				if($aucuser){
		
					//解冻保证金				
					$bondback=$bondlockold-$aucbond;
					$bondback1=$bondold+$aucbond;
					$db->query("update {$DT_PRE}member set bondlocking=$bondback where username='".$aucuser."'");
					$db->query("update {$DT_PRE}member set bond=$bondback1 where username='".$aucuser."'");
				}
				
				//锁定保证金
				$bondrs=$db->query("select * from destoon_member where username='".$zidong_user."'");
				while($bondrrc2=mysql_fetch_array($bondrs)){				
					$bondlockold1=$bondrrc2['bondlocking'];
					$bondold1=$bondrrc2['bond'];
				}
				$bondlockold1=$bondlockold1+$bondauction;
				$bondold1=$bondold1-$bondauction;
				if(bondold1>=0){
				$db->query("update {$DT_PRE}member set bondlocking=$bondlockold1,bond=$bondold1 where username='".$zidong_user."'");
				
				$db->query("UPDATE {$DT_PRE}auction SET orders=orders+1,auction_price='$zidong_totol',auction_user='$zidong_user',auction_time='$item[auction_time]',process='2',auction_status='1',bondauction='$bondauction' WHERE itemid=$itemid");
				}
				
				$panduan=1;
				$content = ob_template('email-ko', 'mail');
				send_message($zidong_user, "恭喜你，你的竞拍已经成功！", stripslashes($content));
				echo "3";
				return false;
			}else{
				
				//解冻上一个用户的保证金
				$aucb=$db->query("select * from {$DT_PRE}auction where itemid=$itemid");
				while($aucrsb=mysql_fetch_array($aucb)){
					$aucbond=$aucrsb['bondauction'];						
				}
				//前一个用户的bondlocking/锁定的保证金
				$bondrsc2=$db->query("select * from destoon_member where username='".$aucuser."'"); 							
				while($bondrrc2=mysql_fetch_array($bondrsc2)){				
					$bondlockold=$bondrrc2['bondlocking'];
					$bondold=$bondrrc2['bond'];
				}
				if($aucuser){
		
					//解冻保证金				
					$bondback=$bondlockold-$aucbond;
					$bondback1=$bondold+$aucbond;
					$db->query("update {$DT_PRE}member set bondlocking=$bondback where username='".$aucuser."'");
					$db->query("update {$DT_PRE}member set bond=$bondback1 where username='".$aucuser."'");
				}
				
				//锁定保证金
				$bondrs=$db->query("select * from destoon_member where username='".$zidong_user."'");
				while($bondrrc2=mysql_fetch_array($bondrs)){				
					$bondlockold1=$bondrrc2['bondlocking'];
					$bondold1=$bondrrc2['bond'];
				}
				$bondlockold1=$bondlockold1+$bondauction;
				$bondold1=$bondold1-$bondauction;
				if(bondold1>=0){
				$db->query("update {$DT_PRE}member set bondlocking=$bondlockold1,bond=$bondold1 where username='".$zidong_user."'");
				
				$db->query("UPDATE {$DT_PRE}auction SET orders=orders+1,auction_price='$zidong_totol',auction_user='$zidong_user',auction_time='$item[auction_time]',auction_status='0',bondauction='$bondauction' WHERE itemid=$itemid");
				}
			}
		}else{
				//解冻上一个用户的保证金
				$aucb=$db->query("select * from {$DT_PRE}auction where itemid=$itemid");
				while($aucrsb=mysql_fetch_array($aucb)){
					$aucbond=$aucrsb['bondauction'];						
				}
				//前一个用户的bondlocking/锁定的保证金
				$bondrsc2=$db->query("select * from destoon_member where username='".$aucuser."'"); 							
				while($bondrrc2=mysql_fetch_array($bondrsc2)){				
					$bondlockold=$bondrrc2['bondlocking'];
					$bondold=$bondrrc2['bond'];
				}
				if($aucuser){
		
					//解冻保证金				
					$bondback=$bondlockold-$aucbond;
					$bondback1=$bondold+$aucbond;
					$db->query("update {$DT_PRE}member set bondlocking=$bondback where username='".$aucuser."'");
					$db->query("update {$DT_PRE}member set bond=$bondback1 where username='".$aucuser."'");
				}
				//锁定保证金
				$bondrs=$db->query("select * from destoon_member where username='".$item['auction_user']."'");
				while($bondrrc2=mysql_fetch_array($bondrs)){				
					$bondlockold1=$bondrrc2['bondlocking'];
					$bondold1=$bondrrc2['bond'];
				}
				$bondlockold1=$bondlockold1+$bondauction;
				$bondold1=$bondold1-$bondauction;
				if(bondold1>=0){
				$db->query("update {$DT_PRE}member set bondlocking=$bondlockold1,bond=$bondold1 where username='".$item['auction_user']."'");
				
				$db->query("UPDATE {$DT_PRE}auction SET orders=orders+1,auction_price='$item[auction_price]',auction_user='$item[auction_user]',auction_time='$item[auction_time]',auction_status='0',bondauction='$bondauction' WHERE itemid=$itemid");
				}
		}
		if($panduan!=1){
			$content = ob_template('email-auction', 'mail');
			send_message($item['auction_user'], "恭喜你，你的出价已经成功！", stripslashes($content));
			echo "3";
			return false;
		}
		
	}




}else{
	echo "4";
	return false;
}
 ?>