<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', 'member');?>
<script type="text/javascript">c(1);</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="tab" id="add"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&action=add"><span>添加<?php echo $MOD['name'];?></span></a></td>
<?php if($_userid) { ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s3"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>"><span>已发布<span class="px10">(<?php echo $nums['3'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s2"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=2"><span>审核中<span class="px10">(<?php echo $nums['2'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s1"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=1"><span>未通过<span class="px10">(<?php echo $nums['1'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s4"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=4"><span>已过期<span class="px10">(<?php echo $nums['4'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="type"><a href="auction.php"><span>订单管理<span class="px10">(<?php echo $nums['9'];?>)</span></span></a></td>
<td class="tab" id="s5"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=5"><span>我的竞价记录<span class="px10">(<?php echo $nums['5'];?>)</span></span></a></td>
<td class="tab" id="s6"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=6"><span>成功竞拍记录<span class="px10">(<?php echo $nums['6'];?>)</span></span></a></td>
<?php } ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="type"><a href="javascript:Dwidget('type.php?item=auction', '[<?php echo $MODULE['23']['name'];?>分类]', 600, 300);"><span><?php echo $MODULE['23']['name'];?>分类<span class="px10">(<?php echo $nums['0'];?>)</span></span></a></td>
</tr>
</table>
</div>
<?php if($action=='add' || $action=='edit') { ?>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<form method="post" id="dform" action="<?php echo $DT['file_my'];?>" target="send" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<?php if($status==1 && $action=='edit' && $note) { ?>
<tr>
<td class="tl">未通过原因</td>
<td class="tr f_blue"><?php echo $note;?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 所属分类</td>
<td class="tr"><?php echo category_select('post[catid]', '选择分类', $catid, $moduleid);?> <span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>标题</td>
<td class="tr f_gray"><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/><span id="dtitle" class="f_red"></span></td>
</tr>
<?php if($action=='add' && $could_color) { ?>
<tr>
<td class="tl">标题颜色</td>
<td class="tr">
<?php echo dstyle('color');?>&nbsp;
设置信息标题颜色需消费 <strong class="f_red"><?php echo $MOD['credit_color'];?></strong> <?php echo $DT['credit_name'];?>
</td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 标题图片</td>
<td class="tr"><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>" readonly/>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="t">[上传]</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="_preview(Dd('thumb').value);" class="t">[预览]</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="Dd('thumb').value='';" class="t">[删除]</a></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 起拍价</td>
<td class="tr"><input name="post[price]" type="text" size="10" value="<?php echo $price;?>" id="drice"/><span id="dprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 123秒杀价</td>
<td class="tr"><input name="post[marketprice]" type="text" size="10" value="<?php echo $marketprice;?>" id="marketprice"/><span id="dmarketprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">加价幅度</td>
<td class="tr"><input name="post[minamount]" type="text" size="10" value="<?php echo $minamount;?>" id="minamount"/><span id="dminamount" class="f_red"></span></td>
</tr>
<!-- <tr>
<td class="tl">最多人数</td>
<td class="tr"><input name="post[amount]" type="text" size="10" value="<?php echo $amount;?>" id="damount"/><span id="damount" class="f_red"></span></td>
</tr> -->
<tr>
<td class="tl">过期时间</td>
<td class="tr"><?php echo dcalendar('post[fromtime]', date('Y-m-d', $fromtime));?> 至 <?php echo dcalendar('post[totime]', $totime);?> <span id="dtime" class="f_red"></span></td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 0;
</script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/property.js"></script>
<?php if($itemid) { ?><script type="text/javascript">setTimeout("load_property()", 1000);</script><?php } ?>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php if($FD) { ?><?php echo fields_html('<td class="tl">', '<td class="tr">', $item);?><?php } ?>
<tr>
<td class="tl"><?php echo $MOD['name'];?>简介</td>
<td class="tr"><textarea name="post[introduce]" style="width:90%;height:45px;"><?php echo $introduce;?></textarea></td>
</tr>
<tr>
<td class="tl">详细说明</td>
<td class="tr f_gray"><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $group_editor, '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<?php if($MOD['swfu'] == 1) { ?>
<?php include DT_ROOT.'/api/swfupload/editor.inc.php';?>
<?php } ?>
<tr>
<td class="tl">需要物流</td>
<td class="tr">
<input type="radio" name="post[logistic]" value="1"<?php if($logistic) { ?> checked<?php } ?>
 id="logistic_1"/><label for="logistic_1"> 是</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[logistic]" value="0"<?php if(!$logistic) { ?> checked<?php } ?>
 id="logistic_0"/><label for="logistic_0"> 否</label>
</td>
</tr>
<tr<?php if(!$_userid) { ?> style="display:none;"<?php } ?>
>
<td class="tl">自定义分类</td>
<td class="tr"><?php echo $mycatid_select;?>&nbsp; <a href="javascript:Dwidget('type.php?item=auction', '[<?php echo $MODULE['23']['name'];?>分类]', 600, 300);" class="t">[管理分类]</a></td>
</tr>
<?php if($fee_add) { ?>
<tr>
<td class="tl">发布此信息需消费</td>
<td class="tr"><span class="f_b f_red"><?php echo $fee_add;?></span> <?php echo $fee_unit;?></td>
</tr>
<?php if($fee_currency == 'money') { ?>
<tr>
<td class="tl"><?php echo $DT['money_name'];?>余额</td>
<td class="tr"><span class="f_blue f_b"><?php echo $_money;?><?php echo $fee_unit;?></span> <a href="charge.php?action=pay" target="_blank" class="t">[充值]</a></td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>余额</td>
<td class="tr"><span class="f_blue f_b"><?php echo $_credit;?><?php echo $fee_unit;?></span> <a href="credit.php?action=buy" target="_blank" class="t">[购买]</a></td>
</tr>
<?php } ?>
<?php } ?>
<?php if($need_password) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 支付密码</td>
<td class="tr"><?php include template('password', 'chip');?> <span id="dpassword" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_question) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证问题</td>
<td class="tr"><?php include template('question', 'chip');?> <span id="danswer" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_captcha) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证码</td>
<td class="tr"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($action=='add') { ?>
<tr style="display:none;" id="weibo_sync">
<td class="tl">同步主题</td>
<td class="tr" id="weibo_show"></td>
</tr>
<?php } ?>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="submit" value=" 提 交 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<?php echo load('guest.js');?>
<?php echo load('clear.js');?>
<?php if($action=='add') { ?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('<?php echo $action;?>');</script>
<?php } else { ?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php } else { ?>
<form action="<?php echo $DT['file_my'];?>">
<div class="tt">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
&nbsp;<?php echo category_select('catid', '行业分类', $catid, $moduleid);?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<select name="process">
<option value="-1">状态</option>
<option value="0"<?php if($process == 0) { ?> selected<?php } ?>
>成团中</option>
<option value="1"<?php if($process == 1) { ?> selected<?php } ?>
>团购中</option>
<option value="2"<?php if($process == 2) { ?> selected<?php } ?>
>已结束</option>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="submit" value=" 搜 索 " class="btn"/>
<input type="button" value=" 重 置 " class="btn" onclick="Go('<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=<?php echo $status;?>');"/>
</form>
</div>
<div class="ls">
<form method="post">
<table cellpadding="0" cellspacing="0" class="tb">
<tr>
<!-- <th width="20"><input type="checkbox" onclick="checkall(this.form);"/></th> -->
<th>图片</th>
<th>商品名称</th>
<th>分类</th>
<th>出价记录</th>
<th>最新价格</th>
<!-- <th>竞拍人数</th> -->
<th>一口价</th>
<th>人气</th>
<th width="100">状态</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<!-- <td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td> -->
<td><a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="<?php if($v['thumb']) { ?><?php echo $v['thumb'];?><?php } else { ?><?php echo DT_SKIN;?>image/nopic50.gif<?php } ?>
" width="50" class="thumb"/></a></td>
<td align="left" title="<?php echo $v['alt'];?>"><ul><li><?php if($v['status']==3) { ?><a href="<?php echo $v['linkurl'];?>" target="_blank" class="t"><?php } else { ?><a href="/auction/show.php?itemid=<?php echo $v['itemid'];?>" class="t"><?php } ?>
<?php echo $v['title'];?></a><?php if($v['status']==1 && $v['note']) { ?> <a href="javascript:" onclick="alert('<?php echo $v['note'];?>');"><img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/why.gif" title="未通过原因"/></a><?php } ?>
</li><li title="更新时间 <?php echo timetodate($v['time'], 5);?> 添加时间 <?php echo timetodate($v['time'], 5);?>" class="px11 f_gray"><?php if($timetype=='add') { ?><?php echo timetodate($v['time'], 5);?><?php } else { ?><?php echo timetodate($v['time'], 5);?><?php } ?>
 <?php echo $_process[$v['process']];?></li></ul></td>
<td><a href="<?php echo $v['caturl'];?>" target="_blank"><?php echo $v['catname'];?></a></td>
<td class="f_price"><?php echo $v['price'];?>.00</td>
<td class="f_price"><?php echo $v['auction_price'];?></td>
<!-- <td class="px11<?php if($v['orders']>0) { ?> f_blue f_b c_p" title="查看订单" onclick="Go('group.php?gid=<?php echo $v['itemid'];?>');<?php } ?>
"><?php echo $v['orders'];?></td> -->
<td class="f_price"><?php echo $v['marketprice'];?></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td>
<?php if($v['process'] == 2) { ?><span style="color:grey; font-weight:bold;">已结束</span><?php } else { ?><span style="color:red; font-weight:bold;">进行中</span><?php } ?>
</td>
</tr>
<?php } } ?>
</table>
</div>
<!-- <?php if($MG['delete'] || $timetype!='add') { ?>
<div class="btns">
<?php if($MG['delete']) { ?>
<span class="f_r"><input type="submit" value=" 删除选中 " class="btn" onclick="if(confirm('确定要删除选中<?php echo $MOD['name'];?>吗？')){this.form.action='?mid=<?php echo $mid;?>&status=<?php echo $status;?>&action=delete'}else{return false;}"/></span>
<?php } ?>
<?php if($timetype!='add') { ?>
<input type="submit" value=" 刷新选中 " class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&status=<?php echo $status;?>&action=refresh';"/>
<?php if($MOD['credit_refresh']) { ?>
刷新一条信息一次需消费 <strong class="f_red"><?php echo $MOD['credit_refresh'];?></strong> <?php echo $DT['credit_name'];?>，当<?php echo $DT['credit_name'];?>不足时将不可刷新
<?php } ?>
<?php } ?>
&nbsp;
</div>
<?php } ?>
</form>
<?php if($MG['group_limit'] || (!$MG['fee_mode'] && $MOD['fee_add'])) { ?>
<div class="limit">
<?php if($MG['group_limit']) { ?>
总共可发 <span class="f_b f_red"><?php echo $MG['group_limit'];?></span> 条&nbsp;&nbsp;&nbsp;
当前已发 <span class="f_b"><?php echo $limit_used;?></span> 条&nbsp;&nbsp;&nbsp;
还可以发 <span class="f_b f_blue"><?php echo $limit_free;?></span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
<?php if(!$MG['fee_mode'] && $MOD['fee_add']) { ?>
发布信息收费 <span class="f_b f_red"><?php echo $MOD['fee_add'];?></span> <?php if($MOD['fee_currency'] == 'money') { ?><?php echo $DT['money_unit'];?><?php } else { ?><?php echo $DT['credit_unit'];?><?php } ?>
/条&nbsp;&nbsp;&nbsp;
可免费发布 <span class="f_b"><?php if($MG['group_free_limit']<0) { ?>无限<?php } else { ?><?php echo $MG['group_free_limit'];?><?php } ?>
</span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
</div>
<?php } ?>
 -->
<div class="pages"><?php echo $pages;?></div>
<?php $mid="1000e";?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php if($action == 'add' || $action == 'edit') { ?>
<script type="text/javascript">
function _p() {
if(Dd('tag').value) {
Ds('reccate');
}
}
function check() {
var l;
var f;
f = 'catid_1';
if(Dd(f).value == 0) {
Dmsg('请选择所属分类', 'catid', 1);
return false;
}
f = 'title';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('标题最少2字，当前已输入'+l+'字', f);
return false;
}
f = 'thumb';
l = Dd(f).value.length;
if(l < 15) {
Dmsg('请上传标题图片', f);
return false;
}
f = 'price';
l = Dd(f).value;
if(l < 0.1) {
Dmsg('请填写团购价', f);
return false;
}
f = 'marketprice';
l = Dd(f).value;
if(l < 0.1) {
Dmsg('请填写市场价', f);
return false;
}
if(l <= Dd('price').value) {
Dmsg('团购价必须低于市场价', f);
return false;
}
f = 'username';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('请填写会员名', f);
return false;
}
<?php if($FD) { ?><?php echo fields_js();?><?php } ?>
if(Dd('property_require') != null) {
var ptrs = Dd('property_require').getElementsByTagName('option');
for(var i = 0; i < ptrs.length; i++) {
f = 'property-'+ptrs[i].value;
if(Dd(f).value == 0 || Dd(f).value == '') {
Dmsg('请填写或选择'+ptrs[i].innerHTML, f);
return false;
}
}
}
<?php if($need_password) { ?>
f = 'password';
l = Dd(f).value.length;
if(l < 6) {
Dmsg('请填写支付密码', f);
return false;
}
<?php } ?>
<?php if($need_question) { ?>
f = 'answer';
l = Dd(f).value.length;
if(l < 1) {
Dmsg('请填写验证问题', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
<?php if($need_captcha) { ?>
f = 'captcha';
l = Dd(f).value;
if(!is_captcha(l)) {
Dmsg('请填写正确的验证码', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
return true;
}
var destoon_oauth = '<?php echo $EXT['oauth'];?>';
</script>
<?php } ?>
<?php if($action=='add' && strlen($EXT['oauth']) > 1) { ?><?php echo load('weibo.js');?><?php } ?>
<?php include template('footer', 'member');?>