<?php
	//定时器 shiki 2014.5.29
	ignore_user_abort(); // run script in background
	set_time_limit(0); // run script forever
	$interval = 5; // do every 6 hours…

	do {
		$run = include 'open.php';
		if(!$run) die('定时器已经关闭。');
		//竞拍商品定时检测
		require '../common.inc.php';
		require '../include/module.func.php';
		
		$now = time();
		$result = $db->query("SELECT itemid,totime,process,auction_user,price FROM {$DT_PRE}auction WHERE totime!='' AND totime<".$now." AND process<2");
		while($row = $db->fetch_array($result)) {
			$auctionList[] = $row;
		}
		
		foreach ($auctionList as $key => $value) {
				//发送竞拍成功站内信
				$content = ob_template('email-ko', 'mail');
				send_message($value['auction_user'], "恭喜你，你的竞拍已经成功！", stripslashes($content));
				//更新竞拍商品表
				$update = "UPDATE {$DT_PRE}auction SET process=2,endtime=".$now.",auction_status=1,status=4 WHERE itemid=".$value['itemid'];
				$db->query($update);

				//通过竞拍成功者ID筛选出竞拍失败者的数组，返还保证金并发送失败站内信
				$sql = "SELECT auction_user FROM {$DT_PRE}auction_list WHERE auction_user !='".$value['auction_user']."' AND itemid='".$value['itemid']."' GROUP BY auction_user";
				$rs  = $db->query($sql);
				while ($rr = $db->fetch_array($rs)) {
					$return_user[] = $rr['auction_user'];
				}
				foreach ($return_user as $key => $value) {
					//返还保证金
					money_add($value, $item['price']/10);
					//发送竞价失败站内信
					$content = ob_template('email-false', 'mail');
					send_message($value, "您有一项竞拍商品竞价失败。", stripslashes($content));					
				}
				//清楚数组，以免叠加上层循环数据
				unset($return_user);
		}
		//释放内存
		unset($auctionList);
		sleep($interval); //休眠
	} while (true);
?>