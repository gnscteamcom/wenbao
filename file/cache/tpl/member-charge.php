<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', $module);?>
<script type="text/javascript">c(2);</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<?php if($MOD['pay_online']) { ?>
<td class="tab" id="action_pay"><a href="charge.php?action=pay"><span>在线充值</span></a></td>
<td class="tab_nav">&nbsp;</td>
<?php } ?>
<td class="tab" id="action_card"><a href="charge.php?action=card"><span>充值卡充值</span></a></td>
<?php if($MOD['pay_url']) { ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab"><a href="<?php echo $MOD['pay_url'];?>"><span>银行汇款</span></a></td>
<?php } ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="action_record"><a href="charge.php?action=record"><span>充值记录</span></a></td>
</tr>
</table>
</div>
<?php if($action == 'record') { ?>
<form action="?">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">
<select name="bank">
<option value="">支付平台</option>
<?php if(is_array($PAY)) { foreach($PAY as $k => $v) { ?>
<option value="<?php echo $k;?>" <?php if($bank == $k) { ?>selected<?php } ?>
><?php echo $v['name'];?></option>;
<?php } } ?>
</select>
&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>
&nbsp;
<input type="submit" value=" 搜 索 " class="btn"/>&nbsp;
<input type="button" value=" 重 置 " class="btn" onclick="Go('?action=<?php echo $action;?>');"/>
</div>
</form>
<div class="bd">
<table cellpadding="1" cellspacing="0" class="tb">
<tr>
<th>流水号</th>
<th>充值金额</th>
<th>手续费</th>
<th>实收金额</th>
<th>支付平台</th>
<th width="130">下单时间</th>
<th width="130">支付时间</th>
<th>状态</th>
</tr>
<?php if(is_array($charges)) { foreach($charges as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td height="30" class="px11"><?php echo $v['itemid'];?></td>
<td class="px11"><?php echo $v['amount'];?></td>
<td class="px11"><?php echo $v['fee'];?></td>
<td class="px11 f_blue"><?php echo $v['money'];?></td>
<td><?php echo $PAY[$v['bank']]['name'];?></td>
<td class="px11 f_gray"><?php echo $v['sendtime'];?></td>
<td class="px11 f_gray"><?php echo $v['receivetime'];?></td>
<td><?php echo $v['dstatus'];?></td>
</tr>
<?php } } ?>
<tr align="center">
<td height="35"><strong>小计</strong></td>
<td class="px11"><?php echo $amount;?></td>
<td class="px11"><?php echo $fee;?></td>
<td class="px11 f_blue"><?php echo $money;?></td>
<td colspan="4">&nbsp;</td>
</tr>
</table>
</div>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">s('charge');m('action_record');</script>
<?php } else if($action == 'card') { ?>
<form method="post" action="charge.php" onsubmit="return check_card();">
<input type="hidden" name="action" value="card"/>
<table cellspacing="1" cellpadding="6" class="tb">
<tr>
<td class="tl">卡号：</td>
<td class="tr"><input type="text" name="number" size="20" id="number"/> <span id="dnumber" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">密码：</td>
<td class="tr"><input type="text" name="password" size="20" id="password"/> <span id="dpassword" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"></td>
<td class="tr"><input type="submit" name="submit" value=" 充 值 " class="btn"/>
</td>
</tr>
</form>
</table>
<script type="text/javascript">
function check_card() {
if(Dd('number').value.length < 8) {
Dmsg('请填写正确的充值卡卡号', 'number');
return false;
}
if(Dd('password').value.length < 6) {
Dmsg('请填写正确的充值卡密码', 'password');
return false;
}
}
</script>
<script type="text/javascript">s('charge');m('action_card');</script>
<?php } else if($action == 'pay') { ?>
<?php if($MOD['pay_online']) { ?>
<form method="post" action="charge.php" onsubmit="return check();" id="dform">
<input type="hidden" name="auto" value="<?php echo $auto;?>"/>
<input type="hidden" name="action" value="confirm"/>
<table cellspacing="1" cellpadding="6" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 充值金额</td>
<td class="tr">&nbsp;
<?php if($charges) { ?>
<?php if(is_array($charges)) { foreach($charges as $k => $v) { ?>
<input type="radio" name="amount" value="<?php echo $v;?>" id="amount_<?php echo $k;?>"<?php if($k==0) { ?>checked<?php } ?>
/><label for="amount_<?php echo $k;?>"> <?php echo $v;?><?php echo $DT['money_unit'];?></label>&nbsp;
<?php } } ?>
<?php } else { ?>
<input type="text" name="amount" size="10" value="<?php echo $amount;?>" id="amount" maxlength="8"/> <?php echo $DT['money_unit'];?> <span id="damount" class="f_red"></span>
<?php } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 支付平台</td>
<td class="tr">
<table cellspacing="5" cellpadding="5" class="c_p">
<?php $i=0;?>
<?php if(is_array($PAY)) { foreach($PAY as $k=>$v) { ?>
<?php if($v['enable']) { ?>
<tr onclick="Dd('<?php echo $k;?>').checked=true;">
<td><input type="radio" name="bank" value="<?php echo $k;?>" id="<?php echo $k;?>"<?php if($i==0) { ?> checked<?php } ?>
/></td>
<td><img src="<?php echo DT_STATIC;?>file/image/logo_<?php echo $k;?>.gif" alt=""/></td>
<td>手续费 <?php echo $v['percent'];?>%</td>
</tr>
<?php $i=1;?>
<?php } ?>
<?php } } ?>
<?php if($i==0) { ?>
<tr>
<td class="f_red"><br/>抱歉，系统未设置支付平台，暂时无法在线充值</td>
</tr>
<?php } ?>
</table><br/><span id="dbank" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl" height="50"> </td>
<td class="tr"><input type="submit" value=" 下一步 " class="btn"<?php if($i==0) { ?> disabled<?php } ?>
/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function check() {
<?php if(!$charges) { ?>
if(!Dd('amount').value) {
Dmsg('请填写充值金额', 'amount');
return false;
}
<?php if($mincharge) { ?>
if(Dd('amount').value < <?php echo $mincharge;?>) {
Dmsg('金额最少<?php echo $mincharge;?>', 'amount');
return false;
}
<?php } ?>
<?php } ?>
}
<?php if($auto) { ?>Dd('dform').submit();<?php } ?>
</script>
<script type="text/javascript">s('charge');m('action_pay');</script><table width="100%" border="0">
  <tr>
    <td><a href="http://www.wenbaozaixian.com/about/6.html" style="color:#CC0000; font-family:'微软雅黑'; font-size:16px; font-weight:bold" target="_blank">如果您没有在线付款方式，您可以进行直接汇款 >>></a></td>
  </tr>
</table>
<?php } else if($action == 'confirm') { ?>
<form method="post" action="charge.php" id="dform">
<input type="hidden" name="goto" value="1"/>
<input type="hidden" name="action" value="confirm"/>
<input type="hidden" name="amount" value="<?php echo $amount;?>"/>
<input type="hidden" name="bank" value="<?php echo $bank;?>"/>
<table cellspacing="1" cellpadding="6" class="tb">
<tr>
<td class="tl">支付平台</td>
<td class="tr"><img src="<?php echo DT_STATIC;?>file/image/logo_<?php echo $bank;?>.gif" alt=""/></td>
</tr>
<tr>
<td class="tl">充值金额</td>
<td class="tr">&nbsp;<strong><?php echo $amount;?></strong> <?php echo $DT['money_unit'];?></td>
</tr>
<tr>
<td class="tl">手续费</td>
<td class="tr">&nbsp;<strong><?php echo $fee;?></strong> <?php echo $DT['money_unit'];?></td>
</tr>
<tr>
<td class="tl">实收金额</td>
<td class="tr">&nbsp;<strong class="f_red"><?php echo $charge;?></strong> <?php echo $DT['money_unit'];?></td>
</tr>
<tr>
<td class="tl">提示信息</td>
<td class="tr f_gray">
&nbsp;- 点击确认充值，系统将跳转至第三方支付平台，支付成功后系统将自动为您入账。<br/>
&nbsp;- 如果在支付过程中遇到任何问题，请及时与客服中心取得联系，以便及时处理。<br/>
</td>
</tr>
<tr>
<td class="tl"> </td>
<td height="50" class="tr">
<input type="submit" value=" 确认充值 " class="btn"/> &nbsp;
<input type="button" value=" 返回修改 " class="btn" onclick="history.back(-1);"/>
</td>
</tr>
</table>
</form>
<?php if($auto) { ?><script type="text/javascript">Dd('dform').submit();</script><?php } ?>
<script type="text/javascript">s('charge');m('action_pay');</script>
<?php } else { ?>
<table cellspacing="1" cellpadding="6" class="tb">
<?php if($charge_status == 2) { ?>
<tr>
<td class="tl">充值结果</td>
<td class="tr f_red f_b px14">×充值异常</td>
</tr>
<tr>
<td class="tl" height="50">相关说明</td>
<td class="tr lh18">
- 错误代码“<?php echo $charge_errcode;?>”，请与<a href="ask.php?action=add" class="b">客服联系</a>并告知错误代码。<br/>
- <a href="charge.php?action=pay" class="b">重新充值请点这里。</a><br/>
</td>
</tr>
<?php } else if($charge_status == 1) { ?>
<tr>
<td class="tl">充值结果</td>
<td class="tr f_green f_b px14">√ 充值成功，已经为您的帐户充值 <span class="f_red"><?php echo $charge_amount;?></span> <?php echo $DT['money_unit'];?></td>
</tr>
<tr>
<td class="tl" height="50">相关说明</td>
<td class="tr lh18">
- <a href="record.php?action=charge" class="b">查询记录请点这里。</a><br/>
- <a href="charge.php?action=pay" class="b">继续充值请点这里。</a><br/>
</td>
</tr>
<?php } else { ?>
<tr>
<td class="tl" height="50">充值结果</td>
<td class="tr f_red f_b px14">
×充值失败
</td>
</tr>
<tr>
<td class="tl" height="50">相关说明</td>
<td class="tr lh18">
- 如果您确认充值成功，请立即<a href="ask.php?action=add" class="b">联系客服</a>解决。<br/>
- <a href="charge.php?action=pay" class="b">重新充值请点这里。</a><br/>
</td>
</tr>
<?php } ?>
</table>
<?php if($charge_forward) { ?><script type="text/javascript">setTimeout(function(){Go('<?php echo $charge_forward;?>');}, 2000);</script><?php } ?>
<script type="text/javascript">s('charge');m('action_pay');</script>
<?php } ?>
<?php include template('footer', $module);?>