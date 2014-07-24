<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?>stylee.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?>sell.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?><?php echo $module;?>.css"/> 
<script type="text/javascript">var module_id= <?php echo $moduleid;?>,item_id=<?php echo $itemid;?>,content_id='content',img_max_width=<?php echo $MOD['max_width'];?>;</script>
<link rel="stylesheet" href="http://keleyi.com/keleyi/phtml/colorbox/colorbox.css" />
<script type="text/javascript" src="http://keleyi.com/keleyi/phtml/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#x_x0").attr("href", Dd('mid_pic').src);
$(".kel"+"eyi_com").colorbox({ rel: 'group1', opacity: 0.6});
$("#x_x").click(function(){
//$(this).attr("class", '');
});
});

function scrollup()
{
document.getElementById('gunn').scrollLeft = document.getElementById('gunn').scrollLeft-80;
}
function scrolldown()
{
document.getElementById('gunn').scrollLeft = document.getElementById('gunn').scrollLeft+80;
}
</script>
<div class="m">
<div class="left_box">
<div class="pos"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $moduleid;?>&action=add&catid=<?php echo $catid;?>" rel="nofollow"><img src="<?php echo DT_SKIN;?>image/btn_add.gif" width="81" height="20" alt="发布竞拍" style="margin-top:6px;"/></a></span>当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo cat_pos($CAT, ' &raquo; ');?> &raquo;</div>
<div class="b10 c_b"></div>
<table width="100%">
<tr>
<td width="10"> </td>
<td>
<table width="100%">
<tr>
<td colspan="3"><h1 class="title_trade" id="title" style="font-family:微软雅黑; font-weight:bold"><?php echo $title;?></h1></td>
</tr>
<tr>
<td width="250" valign="top">
<div style="position:relative">
<div style="position:absolute; top:210px; left:240px;"><img src="<?php echo DT_SKIN;?>image/fd.gif" onclick="scrolldown();" style="cursor:pointer"/></div>
<div style="position:absolute; top:210px; left:-6px; "><img src="<?php echo DT_SKIN;?>image/fd1.gif" onclick="scrollup();" style="cursor:pointer"/></div></div>
<div id="mid_pos"></div>
<div id="mid_div" onmouseover="SAlbum();" onmouseout="HAlbum();" onclick="PAlbum(Dd('mid_pic'));">
<img src="<?php echo $albums['0'];?>" width="240" height="180" id="mid_pic"/><span id="zoomer"></span>
</div>
<div class="b5"></div>
<div style="overflow:auto; width:250px" id="gunn">
<div style="width:640px;">
<?php if(is_array($thumbs)) { foreach($thumbs as $k => $v) { ?><img src="<?php echo $v;?>" width="60" height="60" onmouseover="if(this.src.indexOf('nopic60.gif')==-1)Album(<?php echo $k;?>, '<?php echo $albums[$k];?>');" class="<?php if($k) { ?>ab_im<?php } else { ?>ab_on<?php } ?>
" id="t_<?php echo $k;?>"/><?php } } ?></div>
</div>
<div class="b5"></div>
<div class="c_b t_c c_p"><? //print_r ($thumbs);?><?php if(is_array($thumbs)) { foreach($thumbs as $k => $v) { ?><? if(substr($v,-11)!='nopic60.gif'){?><a id="x_x<?php echo $k;?>" class="keleyi_com" href="<?php echo $v;?>" title="<?php echo $title;?>"<? if($k!=0){?> style="display:none"<? }?>><img src="<?php echo DT_SKIN;?>image/ico_zoom.gif" width="16" height="16" align="absmiddle"/> 点击图片查看原图</a><? }?><?php } } ?><!--<a id="x_x" class="keleyi_com" title="<?php echo $title;?>"><img src="<?php echo DT_SKIN;?>image/ico_zoom.gif" width="16" height="16" align="absmiddle"/> 点击图片查看原图</a>--><!--<a id="x_x" class="keleyi_com" title="<?php echo $title;?>"><img src="<?php echo DT_SKIN;?>image/ico_zoom.gif" width="16" height="16" align="absmiddle"/> 点击图片查看原图</a>--></div>
</td>
<td width="15"> </td>
<td valign="top">
<div id="big_div" style="display:none;"><img src="" id="big_pic"/></div>
<table width="95%" align="right" cellpadding="5" cellspacing="5">


<tr>
<td height="25" class="f_dblue">当前价格：</td>
<td height="25" class="f_b f_orange"><?php if($auction_price) { ?><?php echo $auction_price;?><?php } else { ?><?php echo $price;?><?php } ?>
元</td>
</tr>
<tr>
<td height="25" class="f_dblue">起拍价：</td>
<td height="25" class="f_b f_orange">￥<?php echo $price;?>/最小加价幅度<?php echo $minamount;?>元</td>
</tr>
<tr>
  <td height="25" class="f_dblue">一口价：</td>
  <td height="25" class="f_b f_orange"><?php if($marketprice>=99999999) { ?>无<?php } else { ?>￥<?php echo $marketprice;?><?php } ?>
</td>
</tr>

<tr>
<td height="25" colspan="2" class="f_dblue" style="font-weight:bold"><?php if($fromtime-86400 < time()) { ?>
<?php if($process == 2) { ?>
<div class="g_timer">
本竞拍结束于
<div id="totimer"><?php echo timetodate($endtime, 'Y年n月j日 H:i');?></div>
</div>
<div class="b10 c_b">&nbsp;</div>
<?php } else { ?>
<?php if($totime) { ?>
<div class="g_timer">
距离竞拍结束还有
<div id="totimer">&nbsp;&nbsp;</div>
</div>
<div class="b10 c_b">&nbsp;</div>
<script type="text/javascript">
var totime = new Date(<?php echo $jsdate;?>).getTime();
function _totimer() {
var t = new Date();
var s = Math.floor((totime - t.getTime())/1000);
var h = '';
var i;
if(s > 0) {
i = Math.floor(s/86400);
h += '<span>'+i+'</span>天';
s = Math.floor(s%86400);
i = Math.floor(s/3600);
h += '<span>'+i+'</span>小时';
s = Math.floor(s%3600);
i = Math.floor(s/60);
h += '<span>'+i+'</span>分';
s = Math.floor(s%60);
h += '<span>'+s+'</span>秒';
} else {
h = '<span class="f_red">团购已结束</span>';
}
Dd('totimer').innerHTML = h;
}
_totimer();
setInterval("_totimer()", 1000); 
</script>
<?php } ?>
<?php } ?>
<?php } else { ?>
<div class="g_timer">
本竞拍开拍时间为
<div id="totimer"><?php echo timetodate($fromtime, 'Y年n月j日');?><br />
请等待...</div>
</div>
<div class="b10 c_b">&nbsp;</div>
<?php } ?>
</td>
</tr>
<tr>
<td height="25" class="f_dblue">发货期限：</td>
<td height="25">自买家付款之日起  <span class="f_b f_orange"><?php if($days) { ?><?php echo $days;?><?php } ?>
</span> 天内发货</td>
</tr>
<tr>
<td height="25" class="f_dblue">所在地：</td>
<td height="25"><?php echo area_pos($areaid, ' ');?></td>
</tr>
<tr>
<td height="25" class="f_dblue">尺寸/规格：</td>
<td height="25"><?php echo $ccgg;?></td>
</tr>
<tr>
<td height="25" class="f_dblue">有效期至：</td>
<td height="25"><?php if($todate) { ?><?php echo $todate;?><?php } else { ?>长期有效<?php } ?>
<?php if($expired) { ?> <span class="f_red">[已过期]</span><?php } ?>
</td>
</tr>
<tr>
<td height="25" class="f_dblue">最后更新：</td>
<td height="25"><?php echo $editdate;?></td>
</tr>
<tr>
<td width="80" height="25" class="f_dblue">浏览次数：</td>
<td height="25"><span id="hits"><?php echo $hits;?></span></td>
</tr>
<?php if($username && !$expired) { ?>
<tr>
<td height="25" colspan="2"><img src="<?php echo DT_SKIN;?>image/wenbao/chujia_btn.gif" alt="出价" class="c_p" onclick="<?php if($fromtime-86400 < time()) { ?>$('#auction_area').show(500);<?php } ?>
Go('<?php echo $MOD['linkurl'];?><?php echo rewrite('show.php?itemid='.$itemid.'#auction_area');?>')" style="float:left"/> <a style="padding-left:20px;float:left; display:block;float:left; margin-top:3px; font-weight:bold; color:#CC0000" class="red" href="#testarea">出价记录&gt;&gt;</a></td>
</tr>
<?php } ?>
</table>
</td>
</tr>
</table>
</td>
<td width="10"> </td>
<td width="300" valign="top">
<div class="contact_head">卖家资料信息</div>
<div class="contact_body" id="contact"><?php include template('contact', 'chip');?></div>
<?php if(!$username) { ?>
<!--<br/>
&nbsp;<strong class="f_red">注意</strong>:发布人未在本站注册，建议优先选择<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php"><strong><?php echo VIP;?>会员</strong></a>-->
<?php } ?>
</td>
<td width="10"> </td>
</tr>
</table>
<div class="b10">&nbsp;</div>
</div>
</div>
<div class="m">
<div class="b10">&nbsp;</div>
<div class="box_head">
<strong>出价记录</strong>
</div>
<div class="box_body" style="padding:0;">
<div class="content c_b" id="content"><span style=" color:#CC0000; font-weight:bold">友情提示：</span>为保证竞拍过程的公正与秩序，首次参与该商品竞拍的用户需支付该商品的保证金，该保证金在竞拍过程中交由网站系统保管，直到竞拍结束后归还用户账户。保证金只收取一次。<br />
<div class="g_auction" id="auction_area" style="display: ;">
<span>请输入您的竞价金额：</span><input type='hidden' id="url_go" value="<?php echo $MOD['linkurl'];?><?php echo rewrite('buy.php?itemid='.$itemid);?>"><input type="number" value="" name="price" id="auction_price" style="line-height:22px; height:22px;"/> 元 <input name="niming" type="checkbox" id="niming" value="1" /> 
匿名出价  <input name="zidong" type="checkbox" id="zidong" value="1" /> 
自动竞价 
<button id="go_auction" style="height:30px; line-height:25px;">确认出价</button> （注：如果想一口价直接购买请输入一口价的价格。）
  </div>
<script type="text/javascript">
$(document).ready(function(){
var dqjg = <?php if($auction_price) { ?><?php echo $auction_price;?><?php } else { ?><?php echo $price;?><?php } ?>
;
var jjfd = <?php echo $minamount;?>;
jjfd = dqjg + jjfd; 
$("#auction_price").val(jjfd);
$("#go_auction").click(function(){
var x = $("#auction_price").val();
//var niming = $("#niming").val();
 if($("#niming").attr("checked")==true){
var niming = $("#niming").val();
}
if($("#zidong").attr("checked")==true){
var zidong = jjfd;
}
var y = $("#url_go").val();
if(confirm('确定是否以'+x+'元的价格竞价此商品？')){
var user = "<?php echo $_username; ?>";
if (user == '') { alert('竞拍商品前请您先登录。'); return false; };
$.get('<?php echo $MOD['linkurl'];?><?php echo rewrite("auction.php?itemid=".$itemid);?>',{values:x,niming:niming,zidong:zidong},function(data){
// //处理返回的data
//alert(data);
if (data == '1') { alert('这个竞拍不存在或者已经结束。'); }
if (data == '2') { alert('您的余额不足，无法以该价格进行出价，请充值后再竞拍。'); Go("/member/charge.php?action=pay");return false; }
if (data == '3') { alert('您的出价已经成功，请等待竞拍结束访问您的会员中心查看结果。'); }
if (data == '4') { alert("您的出价太低，出价必须高于<?php echo $iprice_plus;?>元。(加价幅度为<?php echo $item['minamount'];?>元)"); }
if (data == '5') { alert('您不能对自己发布的商品进行竞拍。'); }
if (data == '7') { alert('您的上一次自动竞价还未完成，等待完成之后才能再次自动竞价！'); }
if (data == '8') { alert('您设定的自动竞价价格有雷同，请设定别的自动竞价价格！'); }
if (data == '6') { alert('该商品已竞拍完成！'); }
if (data == '9') { alert('您的保证金账户余额不足，请充值后再竞拍！'); Go("/member/bond.php?action=in");return false;}
if (data == 'KO') { if(confirm('您成功以'+x+'元的价格秒杀此商品，现在跳转页面进行付款？')){ Go(y); return false; }};
window.location.reload(); 
});
}
});
});
</script>
<div class="g_info">
<strong>该商品已经有 <span><?php echo $orders;?></span> 人竞拍</strong>
<div>
<div id="testarea">
<table width="100%" style="width:100%">
<tr>
<th height="33">参与用户</th>
<th>出价</th>
<th>状态</th>
<th>竞拍时间</th>
    <th>IP地址</th>
</tr>
<?php foreach ($tags as $key => $value) { ?>
<tr><td height="33"><?php if($value['niming']==1) { ?>匿名<?php } else { ?><?php echo $value['auction_user'];?><?php } ?>
</td>
<td>￥<?php echo $value['price'];?></td>
<td><? if($key==0){?><span>领先</span><? }else{?>出局<? }?></td>
<td><?php echo $value['time'];?></td>
<td><?php echo $value['ip'];?></td>
</tr>
<?php } ?>
  </table>
</div>
<span class="page_info">页码：</span><select id="test" >
<?php for ($i=1; $i <= $pages ; $i++) { ?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php }?>
</select>&nbsp;&nbsp;<span class="page_info">共<span><?php echo $pages;?></span>页</span>
<!-- <?php if($process == 0) { ?>
正在成团，距离团购人数还差<?php echo $left;?>人
<?php } else if($process == 1) { ?>
团购已成功，还可以继续购买...
<?php } else { ?>
团购已结束
<?php } ?>
 -->
</div>
</div>
</div>
</div>
</div>
<div class="m">
<div class="b10">&nbsp;</div>
<div class="box_head">
<strong>产品详细说明</strong>
</div>
<div class="box_body" style="padding:0;">
<?php if($CP) { ?><?php include template('property', 'chip');?><?php } ?>
<div class="content c_b" id="content"><?php echo $content;?></div>
<?php include template('comment', 'chip');?>
</div>
</div>
<?php if($username) { ?>
<div class="m">
<div class="b10">&nbsp;</div>
<div class="box_head"><div><span class="f_r"><!--<a href="<?php echo userurl($username, 'file=sell');?>">更多&raquo;</a>--></span><strong>本企业其它拍品</strong></div></div>
<div class="box_body">
<div class="thumb" style="padding:10px;">
<?php echo tag("moduleid=$moduleid&length=20&condition=status=3 and thumb<>'' and username='$username'&pagesize=8&order=edittime desc&width=80&height=80&cols=8&template=thumb-table");?>
</div>
</div>
</div>
<?php } ?>
<div class="m">
<br/>
<center>
[ <a href="<?php echo $MOD['linkurl'];?>search.php" rel="nofollow"><?php echo $MOD['name'];?>搜索</a> ]&nbsp;
[ <a href="javascript:SendFav();">加入收藏</a> ]&nbsp;
[ <a href="javascript:SendPage();">告诉好友</a> ]&nbsp;
[ <a href="javascript:Print();">打印本文</a> ]&nbsp;
[ <a href="javascript:window.close()">关闭窗口</a> ]
</center>
<br/>
</div>
<div class="m">
<!-- UY BEGIN -->
<div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=1928681"></script>
<!-- UY END -->
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#test").click(function(){
var x = $("#test").val();
$.get('<?php echo $MOD['linkurl'];?><?php echo rewrite("show.php?itemid=".$itemid);?>',{vals:x},function(data){
$("#testarea").html(data);
});
});
});
</script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/album.js"></script>
<?php if($content) { ?><script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/content.js"></script><?php } ?>
<?php include template('footer');?>