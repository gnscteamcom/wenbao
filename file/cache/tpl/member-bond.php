<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', 'member');?>
<script type="text/javascript">c(2);</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="tab" id="s3"><a href="bond.php?action=in"><span>转入资金</span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s3"><a href="bond.php?action=out"><span>转出资金</span></a></td>
</tr>
</table>
</div>
<?php if($action=="in") { ?>
<form method="post" action="bond.php" id="inform" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td class="tl">账户保证金余额</td>
<td class="tr"><strong class="f_red px14"><?php echo $bond;?><?php echo $DT['money_unit'];?></strong><span class="f_gray">(<?php echo $bondlocking;?><?php echo $DT['money_unit'];?>锁定)</span></td>
</tr>
<tr>
<td class="tl">账户余额</td>
<td class="tr"><strong class="f_red px14"><?php echo $money;?></strong>元</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 需要转入的金额</td>
<td class="tr"><input type="text" id="bond" name="bond"></td><span id="dbond" class="f_red">
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="insubmit" value=" 转 入 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></td>
</tr>
</table>
</form>
<?php } else { ?>
<form method="post" action="bond.php" id="outform" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td class="tl">账户保证金余额</td>
<td class="tr"><strong class="f_red px14"><?php echo $bond;?><?php echo $DT['money_unit'];?></strong><span class="f_gray">(<?php echo $bondlocking;?><?php echo $DT['money_unit'];?>锁定)</span></td>
</tr>
<tr>
<td class="tl">账户余额</td>
<td class="tr"><strong class="f_red px14"><?php echo $money;?></strong>元</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 需要转出的金额</td>
<td class="tr"><input type="text" id="bond" name="bond"></td><span id="dbond" class="f_red"></span>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="outsubmit" value=" 转 出 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></td>
</tr>
</table>
</form>
<?php } ?>
<?php if($action=='in' || $action=='eout') { ?>
<script type="text/javascript">
function check() {
var ;
var f;
f = 'bond';
v = Dd(f).value;
if(v=="") {
Dmsg('请填写需要转换的金额', f);
return false;
}
return true;
}
</script>
<?php } ?>
<?php include template('footer', 'member');?>