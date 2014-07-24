<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', 'member');?>
<script type="text/javascript">c(2);</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="tab" id="add"><a href="address.php?action=add"><span>添加地址</span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s3"><a href="address.php"><span>收货地址</span></a></td>
</tr>
</table>
</div>
<?php if($action=='add') { ?>
<form method="post" action="address.php" id="dform" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 详细地址</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '请选择');?><input name="post[address]" type="text" id="title" size="60" /> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 邮政编码</td>
<td class="tr"><input name="post[postcode]" type="text" id="postcode" size="10" /> <span id="dpostcode" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 真实姓名</td>
<td class="tr"><input name="post[truename]" type="text" id="truename" size="10" /> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 手机号码</td>
<td class="tr"><input name="post[mobile]" type="text" id="mobile" size="20" /> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> 电话号码</td>
<td class="tr"><input name="post[telephone]" type="text" id="telephone" size="20" /> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> 显示顺序</td>
<td class="tr f_gray"><input name="post[listorder]" type="text" id="listorder" size="4" /> 数字越小越靠前<span id="dlistorder" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> 备注信息</td>
<td class="tr"><input name="post[note]" type="text" id="note" size="60" /> <span id="dnote" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></td>
</tr>
</table>
</form>
<?php echo load('clear.js');?>
<script type="text/javascript">s('address');m('add');</script>
<?php } else if($action=='edit') { ?>
<form method="post" action="address.php" id="dform" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 详细地址</td>
<td class="tr"><input name="post[address]" type="text" id="title" size="60" value="<?php echo $address;?>"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 邮政编码</td>
<td class="tr"><input name="post[postcode]" type="text" id="postcode" size="10" value="<?php echo $postcode;?>" /> <span id="dpostcode" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 真实姓名</td>
<td class="tr"><input name="post[truename]" type="text" id="truename" size="10" value="<?php echo $truename;?>"/> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 手机号码</td>
<td class="tr"><input name="post[mobile]" type="text" id="mobile" size="20" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> 电话号码</td>
<td class="tr"><input name="post[telephone]" type="text" id="telephone" size="20" value="<?php echo $telephone;?>"/> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> 显示顺序</td>
<td class="tr f_gray"><input name="post[listorder]" type="text" id="listorder" size="4" value="<?php echo $listorder;?>"/> 数字越小越靠前<span id="dlistorder" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> 备注信息</td>
<td class="tr"><input name="post[note]" type="text" id="note" size="60" value="<?php echo $note;?>"/> <span id="dnote" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="submit" value=" 修 改 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<?php echo load('clear.js');?>
<script type="text/javascript">s('address');m('s3');</script>
<?php } else { ?>
<div class="ls">
<table cellpadding="0" cellspacing="0" class="tb">
<tr>
<th>地址(邮编)</th>
<th>姓名</th>
<th>手机</th>
<th>电话</th>
<th>添加时间</th>
<th>排序</th>
<th width="40">修改</th>
<th width="40">删除</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td height="30" align="left">&nbsp;&nbsp<?php echo $v['address'];?>(<?php echo $v['postcode'];?>)<?php if($v['note']) { ?> <a href="javascript:" onclick="alert('备注:<?php echo $v['note'];?>');"><img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/why.gif" title="备注:<?php echo $v['note'];?>"/></a><?php } ?>
</td>
<td><?php echo $v['truename'];?></td>
<td><?php echo $v['mobile'];?></td>
<td><?php if($v['telephone']) { ?><?php echo $v['telephone'];?><?php } else { ?>&nbsp;<?php } ?>
</td>
<td class="px11 f_gray" title="更新时间 <?php echo $v['editdate'];?>"><?php echo $v['adddate'];?></td>
<td class="px11 f_gray"><?php echo $v['listorder'];?></td>
<td><a href="address.php?action=edit&itemid=<?php echo $v['itemid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/edit.png" title="修改" alt=""/></a></td>
<td><a href="address.php?action=delete&itemid=<?php echo $v['itemid'];?>" onclick="if(!confirm('确定要删除吗？此操作将不可撤销')) return false;"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/delete.png" title="删除" alt=""/></a></td>
</tr>
<?php } } ?>
</table>
</div>
<?php if($MG['address_limit']) { ?>
<div class="limit">总共可发 <span class="f_b f_red"><?php echo $MG['address_limit'];?></span> 条&nbsp;&nbsp;&nbsp;当前已发 <span class="f_b"><?php echo $limit_used;?></span> 条&nbsp;&nbsp;&nbsp;还可以发 <span class="f_b f_blue"><?php echo $limit_free;?></span> 条</div>
<?php } ?>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">s('addr');m('s3');</script>
<?php } ?>
<?php if($action=='add' || $action=='edit') { ?>
<script type="text/javascript">
function check() {
var l;
var f;
f = 'title';
l = Dd(f).value.length;
if(l < 5) {
Dmsg('请填写详细地址', f);
return false;
}
f = 'postcode';
l = Dd(f).value.length;
if(l < 6) {
Dmsg('请填写邮政编码', f);
return false;
}
f = 'truename';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('请填写真实姓名', f);
return false;
}
f = 'mobile';
l = Dd(f).value.length;
if(l < 11) {
Dmsg('请填写手机号码', f);
return false;
}
return true;
}
</script>
<?php } ?>
<?php include template('footer', 'member');?>