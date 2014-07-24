<?php 

defined('IN_DESTOON') or exit('Access Denied');
if($DT_BOT) dhttp(403);
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$itemid or dheader($MOD['linkurl']);
include load('misc.lang');
if(!empty($_POST['itemid'])){
	foreach($_POST['itemid'] as $itemid){
		$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
		if($item && $item['status'] > 2) {
			if($item['username'] == $_username) message($L['buy_self']);
			if($item['auction_user'] != $_username) message('你不能购买没有竞拍到的商品，请返回!');
			if($item['auction_status'] == 2) message('你已经购买过此商品，请返回!');
			//防止竞拍者以竞拍价格通过秒杀手段进行购买
			if($item['auction_status'] == 0) message('竞拍尚未结束，请返回。');

		} else {
			message(lang('message->item_not_exists'), $MOD['linkurl']);
		}
		$user = userinfo($_username);
		if($submit) {
			if($item['logistic']) {
				$add = array_map('trim', $add);
				$add['address'] = area_pos($add['areaid'], '').$add['address'];
				$add = array_map('htmlspecialchars', $add);
				$buyer_address = $add['address'];
				if(strlen($buyer_address) < 10) message($L['msg_type_address']);
				$buyer_postcode = $add['postcode'];
				if(strlen($buyer_postcode) < 6) message($L['msg_type_postcode']);
				$buyer_name = $add['truename'];
				if(strlen($buyer_name) < 2) message($L['msg_type_truename']);
				$buyer_phone = $add['telephone'];
				$buyer_receive = $add['receive'];
				if(strlen($buyer_receive) < 2) message($L['msg_type_express']);
			} else {
				$buyer_address = htmlspecialchars($user['address']);
				$buyer_postcode = htmlspecialchars($user['postcode']);
				$buyer_name = htmlspecialchars($user['truename']);
				$buyer_phone = htmlspecialchars($user['telephone']);
				$buyer_receive = '';
			}
			$buyer_mobile = htmlspecialchars($add['mobile']);
			is_mobile($buyer_mobile) or message($L['msg_type_mobile']);
			$number = intval($number);
			if($number < 1) $number = 1;
			$amount = $number*$item['auction_price'];
			$amount1 = $item['auction_price']+($item['auction_price']*0.035);
			if($amount1 > $_money) message($L['need_charge'], '/member/charge.php?action=pay&amount='.($amount1-$_money));
			if($amount > $_money) message($L['need_charge'], '/member/charge.php?action=pay&amount='.($amount-$_money));
			money_add($_username, -$amount);
			money_record($_username, -$amount, $L['in_site'], 'system', "竞拍订单", 'ID('.$itemid.')');
			//买家获取扣除佣金
			$yongjin=$item['auction_price']*0.035;
			$yongjin=number_format($yongjin,1);
			$yongjin=$yongjin>4000 ? $yongjin=4000 : $yongjin;
			money_add($_username, -$yongjin);
			money_record($_username, -$yongjin, $L['in_site'], 'system', "扣除佣金", 'ID('.$itemid.')');
			//卖家获取扣除佣金
			/*$yongjin=$item['auction_price']*0.035;
			$yongjin=number_format($yongjin,1);
			$yongjin>4000 ? $yongjin=4000 : $yongjin;
			money_add($_username, -$yongjin);
			money_record($_username, -$yongjin, $L['in_site'], 'system', "扣除佣金", 'ID('.$itemid.')');*/
				
			$note = htmlspecialchars($note);
			$title = addslashes($item['title']);
			$password = strtolower(random(6));
			$db->query("INSERT INTO {$DT_PRE}auction_order (gid,buyer,seller,title,thumb,price,number,amount,logistic,addtime,updatetime,note,password, buyer_postcode,buyer_address,buyer_name,buyer_phone,buyer_mobile,buyer_receive) VALUES ('$itemid','$_username','$item[username]','$title','$item[thumb]','$item[price]','$number','$amount','$item[logistic]','$DT_TIME','$DT_TIME','$note','$password','$buyer_postcode','$buyer_address','$buyer_name','$buyer_phone','$buyer_mobile','$buyer_receive')");
			//付完款后状态完成2
			$db->query("UPDATE {$DT_PRE}auction SET auction_status='2' WHERE itemid=$itemid");
			//归还竞拍胜利者的保证金2014-7-10 09:38:29
			
			$sql = "SELECT * FROM {$DT_PRE}auction WHERE itemid='".$itemid."'";
			$rs  = $db->query($sql);
			while ($rr = $db->fetch_array($rs)) {
				$return_user = $rr['auction_user'];
				$return_bond= $rr['bondauction'];
			}

			//查询出现在的bondlocking
			$sql1 = "SELECT * FROM {$DT_PRE}member WHERE username='".$return_user."'";
			$rs1  = $db->query($sql1);
			while($rr1 = $db->fetch_array($rs1)) {
				$bondlockingnow = $rr1['bondlocking'];
				$bondnow= $rr1['bond'];
			}
			
			
			$bondlockingover=$bondlockingnow-$return_bond;
			$bondover=$bondnow+$return_bond;
			$sql2 = "update {$DT_PRE}member set bondlocking='".$bondlockingover."',bond='".$bondover."' where username='".$return_user."'";
			$db->query($sql2);
			money_record($return_user,$return_bond,'站内', 'system', '保证金返还', '订单号:'.$item['itemid']);		
			$content = ob_template('email-ko', 'mail');
			send_message($item['auction_user'], "恭喜你，你的竞拍已经成功！", stripslashes($content));
			
			//send sms
			if($DT['sms'] && !$item['logistic']) {
				$oid = $db->insert_id();
				$message = lang('sms->ord_auction', array($item['title'], $oid, $password));
				$message = strip_sms($message);
				send_sms($buyer_mobile, $message);
			}
			//send sms
			$db->query("UPDATE {$DT_PRE}auction SET orders=orders+1,sales=sales+$number WHERE itemid=$itemid");
			
		} else {
			$_MOD = cache_read('module-2.php');
			$result = $db->query("SELECT * FROM {$DT_PRE}address WHERE username='$_username' ORDER BY  listorder ASC,itemid ASC LIMIT 30");
			$address = array();
			while($r = $db->fetch_array($result)) {	
				$address[] = $r;
			}
			$send_types = explode('|', trim($_MOD['send_types']));
			$head_title = $L['buy_title'];
			include template('buy', $module);
		}

	}
	message($L['msg_buy_success'], $MODULE[2]['linkurl'].'auction.php?action=order', 3);
}
?>