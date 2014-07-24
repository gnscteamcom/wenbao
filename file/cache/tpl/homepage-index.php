<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<?php if($head_canonical) { ?>
<link rel="canonical" href="<?php echo $head_canonical;?>"/>
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo DT_STATIC;?><?php echo $MODULE['4']['moduledir'];?>/skin/common.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo DT_STATIC;?><?php echo $MODULE['4']['moduledir'];?>/skin/default/style_2.css"/>
<link rel="stylesheet" type="text/css" href="/skin/default/stylee.css"/>
<div class="m">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<?php /* ?>
<?php if($side_pos==0) { ?>
<td width="<?php echo $side_width;?>" valign="top" id="side"><?php include template('side_info', $template);?> <?php include template('side_intro', $template);?> </td>
<td width="10" id="split"></td>
<?php } ?>
<?php */ ?>
<td valign="top" id="main">
<div class="dsn" id="pos_show">您当前的位置：<a href="<?php echo $COM['linkurl'];?>">首页</a> &raquo; 欢迎光临</div>
<?php if($itemid) { ?>
<div class="main_head"><div><strong><?php echo $title;?></strong></div></div>
<div class="main_body">
<table width="100%" align="center">
<tr>
<td width="250" valign="top">
<div id="mid_pos"></div>
<div id="mid_div" onmouseover="SAlbum();" onmouseout="HAlbum();" onclick="PAlbum(Dd('mid_pic'));">
<img src="<?php echo $albums['0'];?>" width="240" height="180" id="mid_pic"/><span id="zoomer"></span>
</div>
<div class="b5"></div>
<div>
<?php if(is_array($thumbs)) { foreach($thumbs as $k => $v) { ?><img src="<?php echo $v;?>" width="60" height="60" onmouseover="if(this.src.indexOf('nopic60.gif')==-1)Album(<?php echo $k;?>, '<?php echo $albums[$k];?>');" class="<?php if($k) { ?>ab_im<?php } else { ?>ab_on<?php } ?>
" id="t_<?php echo $k;?>"/><?php } } ?>
</div>
<div class="b5"></div>
<div onclick="PAlbum(Dd('mid_pic'));" class="c_b t_c c_p"><img src="<?php echo DT_SKIN;?>image/ico_zoom.gif" width="16" height="16" align="absmiddle"/> 点击图片查看原图</div>
</td>
<td width="15"> </td>
<td valign="top">
<div id="big_div" style="display:none;"><img src="" id="big_pic"/></div>
<table width="100%" cellpadding="4" cellspacing="4">
<tr>
<td width="80">商品：</td>
<td><strong><?php echo $title;?></strong>&nbsp;</td>
</tr>
<tr>
<td>单价：</td>
<td class="f_gray">￥<span class="f_price px16"><?php echo $price;?></span></td>
</tr>
<?php if($fee_start_1>0 || $fee_start_2>0 || $fee_start_3>0) { ?>
<tr>
<td>运费：</td>
<td class="f_gray">
<?php if($fee_start_1>0) { ?> <?php echo $express_name_1;?>:<span class="f_price"><?php echo $fee_start_1;?></span>&nbsp;&nbsp;<?php } ?>
<?php if($fee_start_2>0) { ?> <?php echo $express_name_2;?>:<span class="f_price"><?php echo $fee_start_2;?></span>&nbsp;&nbsp;<?php } ?>
<?php if($fee_start_3>0) { ?> <?php echo $express_name_3;?>:<span class="f_price"><?php echo $fee_start_3;?></span>&nbsp;&nbsp;<?php } ?>
</td>
</tr>
<?php } ?>
<tr>
<td>品牌：</td>
<td><?php if($brand) { ?><a href="<?php echo $MOD['linkurl'];?>search.php?fields=4&kw=<?php echo urlencode($brand);?>" target="_blank" rel="nofollow"><?php echo $brand;?></a><?php } else { ?>未填写<?php } ?>
</td>
</tr>
<tr>
<td>地区：</td>
<td><?php echo area_pos($areaid, '');?></td>
</tr>
<tr>
<td>销量：</td>
<td><a href="<?php echo $linkurl;?>#order" target="_blank">累计出售 <span class="f_orange"><?php echo $sales;?></span> 件，<?php echo $orders;?> 个订单</a></td>
</tr>
<tr>
<td>评价：</td>
<td><a href="<?php echo $linkurl;?>#comment" target="_blank">已有 <span class="f_orange"><?php echo $comments;?></span> 条评价</a></td>
</tr>
<tr>
<td>库存：</td>
<td>还剩 <span class="f_orange"><?php echo $amount;?></span> 件</td>
</tr>
<tr>
<td>人气：</td>
<td>已有 <span class="f_orange"><span id="hits"><?php echo $hits;?></span></span> 人关注</td>
</tr>
<tr>
<td>更新：</td>
<td><?php echo $editdate;?></td>
</tr>
<?php if($RL) { ?>
<tr>
<td><?php echo $relate_name;?>：</td>
<td>
<?php if(is_array($RL)) { foreach($RL as $v) { ?>
<div class="relate_<?php if($itemid==$v['itemid']) { ?>2<?php } else { ?>1<?php } ?>
"><?php if($itemid==$v['itemid']) { ?><em></em><?php } ?>
<a href="<?php echo userurl($username, 'file=mall&itemid='.$v['itemid']);?>"><img src="<?php echo $v['thumb'];?>" alt="" title="<?php echo $v['relate_title'];?>"/></a></div>
<?php } } ?>
</td>
</tr>
<?php } ?>
<?php if($p1) { ?>
<tr>
<td><?php echo $n1;?>：</td>
<td id="p1">
<ul>
<?php if(is_array($p1)) { foreach($p1 as $i => $v) { ?>
<li class="nv_<?php if($i==0) { ?>2<?php } else { ?>1<?php } ?>
"><?php echo $v;?></li>
<?php } } ?>
</ul>
</td>
</tr>
<?php } ?>
<?php if($p2) { ?>
<tr>
<td><?php echo $n2;?>：</td>
<td id="p2">
<ul>
<?php if(is_array($p2)) { foreach($p2 as $i => $v) { ?>
<li class="nv_<?php if($i==0) { ?>2<?php } else { ?>1<?php } ?>
"><?php echo $v;?></li>
<?php } } ?>
</ul>
</td>
</tr>
<?php } ?>
<?php if($p3) { ?>
<tr>
<td><?php echo $n3;?>：</td>
<td id="p3">
<ul>
<?php if(is_array($p3)) { foreach($p3 as $i => $v) { ?>
<li class="nv_<?php if($i==0) { ?>2<?php } else { ?>1<?php } ?>
"><?php echo $v;?></li>
<?php } } ?>
</ul>
</td>
</tr>
<?php } ?>
<?php if($status == 4) { ?>
<tr>
<td></td>
<td><strong class="f_red">该商品已下架</strong></td>
</tr>
<?php } ?>
</table>
<?php if($status == 3 && $amount > 0) { ?>
<div>
<img src="<?php echo DT_SKIN;?>image/btn_tobuy.gif" alt="立即购买" class="c_p" onclick="BuyNow();"/>
&nbsp;
<img src="<?php echo DT_SKIN;?>image/btn_addcart.gif" alt="加入购物车" class="c_p" onclick="AddCart();"/>
</div>
<?php } ?>
</td>
</tr>
</table>
</div>
<div class="main_head"><div><strong>详细信息</strong></div></div>
<div class="main_body">
<?php if($CP) { ?><?php include template('property', 'chip');?><?php } ?>
<div class="content" id="content"><?php echo $content;?></div>
</div>
<script type="text/javascript">
var content_id = 'content';
var img_max_width = <?php echo $MOD['max_width'];?>;
</script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/content.js"></script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/jquery.js"></script>
<script type="text/javascript">
var s_s = {'1':0,'2':0,'3':0};
function addE(i) {
$('#p'+i+' li').mouseover(function() {
if(this.className == 'nv_1') this.className = 'nv_3';
});
$('#p'+i+' li').mouseout(function() {
if(this.className == 'nv_3') this.className = 'nv_1';
});
$('#p'+i+' li').click(function() {
$('#p'+i+' li')[s_s[i]].className = 'nv_1';
this.className = 'nv_2';
s_s[i] = $(this).index();
});
}
<?php if($p1) { ?>addE(1);<?php } ?>
<?php if($p2) { ?>addE(2);<?php } ?>
<?php if($p3) { ?>addE(3);<?php } ?>
function BuyNow() {
Go('<?php echo $MOD['linkurl'];?>buy.php?itemid=<?php echo $itemid;?>&s1='+s_s[1]+'&s2='+s_s[2]+'&s3='+s_s[3]);
}
function AddCart() {
Go('<?php echo $MOD['linkurl'];?>cart.php?itemid=<?php echo $itemid;?>&s1='+s_s[1]+'&s2='+s_s[2]+'&s3='+s_s[3]);
}
</script>
<?php } else { ?>
<?php $tags=tag("table=type&condition=item='auction-".$userid."'&pagesize=40&order=listorder asc,typeid desc&template=null");?>
<?php if($tags) { ?>
<div class="main_head"><div><strong>专场档案</strong></div></div>
<div class="main_body">
<div class="px13 lh18">

<!--<div><span class="f_r"><a href="<?php echo userurl($username,'', $domain);?>" class="t">显示全部</a>&nbsp;</span>&nbsp;&nbsp;<strong>我公司主营以下几类商品，请查看： </strong></div>-->
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<a style="margin:10px;" href="<?php echo userurl($username, 'typeid='.$t['typeid'], $domain);?>" title="<?php echo $t['typename'];?>" id="name_<?php echo $t['typeid'];?>"><?php echo set_style($t['typename'], $t['style']);?></a>
<?php } } ?>
</div>
</div>
<?php } ?>
<div class="main_head">
<div>
<strong>竞拍列表</strong>
</div>
</div>
<div class="main_body">
<?php if($view) { ?>
<table cellpadding="5" cellspacing="1" width="100%" align="center">
<tr bgcolor="#F1F1F1">
<th width="100">图片</th>
<th>标 题</th>
<th width="110">更新时间</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr align="center"<?php if($k%2==1) { ?> bgcolor="#FBFBFB"<?php } ?>
>
<td height="100"><a href="<?php echo $v['linkurl'];?>"><img src="<?php echo $v['thumb'];?>" width="80" height="80" alt="" style="border:#C0C0C0 1px solid;"/></a></td>
<td align="left" class="lh18"><a href="/auction/show.php?itemid=<?php echo $v['itemid'];?>" class="px13"><?php echo $v['title'];?></a><br/>
价格：￥<strong class="f_red"><?php echo $v['price'];?></strong><br/>
品牌：<?php echo $v['brand'];?>&nbsp;销量：<?php echo $v['orders'];?>&nbsp;评论：<?php echo $v['comments'];?>
</td>
<td><?php echo timetodate($v['edittime'], 3);?></td>
</tr>
<?php } } ?>
</table>
<?php } else { ?>
<?php if(is_array($lists)) { foreach($lists as $i => $t) { ?>
<?php $t['price'] = str_replace('.00', '', $t['price']);?>
<?php $t['auction_price'] = str_replace('.00', '', $t['auction_price']);?>
<?php $t['marketprice'] = str_replace('.00', '', $t['marketprice']);?>
<?php if($t['marketprice'] == '99999999') $t['marketprice'] = '--';?>
<?php if($t['auction_price'] == '') $t['auction_price'] = $t['price'];?>
<?php 
$t['list_status'] = "<span style='color:green;text-decoration:none;'>正在竞拍</span>";
if ($t['process'] == 2) { $t['list_status'] = "<span style='color:red;text-decoration:none;'>已被秒杀</span>"; }
if ($t['fromtime'] - 86400 > time()) { $t['list_status'] = "<span style='color:grey;text-decoration:none;'>还未开始</span>"; }
if ($t['totime'] < time()) { $t['list_status'] = "<span style='color:grey;text-decoration:none;'>已经结束</span>"; }
 ?>
<table width="100%" style="border-bottom: #CCCCCC 1px dotted;">
<tr align="center">
<td width="10%" style="padding:12px 0;"><div><a href="/auction/show.php?itemid=<?php echo $t['itemid'];?>" target="_blank"><img src="<?php echo $t['thumb'];?>" width="80" height="80" alt="<?php echo $t['alt'];?>" onmouseover="img_tip(this, this.src);" onmouseout="img_tip(this, '');"/></a></div></td>
<td width="10"> </td>
<td width="50%" align="left">
<ul>
<li><a href="/auction/show.php?itemid=<?php echo $t['itemid'];?>" target="_blank">标题：<strong class="px14"><?php echo $t['title'];?></strong></a></li>
<li>卖家：<?php if($t['vip']) { ?><img src="<?php echo DT_SKIN;?>image/vip_<?php echo $t['vip'];?>.gif" alt="<?php echo VIP;?>" title="<?php echo VIP;?>:<?php echo $t['vip'];?>级" align="absmiddle"/> <?php } ?>
<a href="<?php echo userurl($t['username']);?>" target="_blank"><?php echo $t['company'];?></a></li>
<li>地区：<?php echo area_pos($t['areaid'], ' ');?></li>
<li>剩余时间：<span style="color:red;" class="countDown" toTime="<?php echo $t['totime'];?>" id="cd_<?php echo $i;?>"></span></li>
</ul>
</td>
<td class="list_price" align="left" style="padding-left:40px;">
<ul>
<li>起拍价:<strong> <?php echo $t['price'];?> </strong>元</li>
<li>一口价:<strong> <?php echo $t['marketprice'];?> </strong>元</li>
<li>当前价:<strong> <?php echo $t['auction_price'];?> </strong>元</li>
</ul>
</td>
<td class="list_count">
<ul>
<li><b><?php echo $t['list_status'];?></b></li>
<li>总共出价<?php echo $t['orders'];?>次</li>
<li>起拍时间:<strong> <?php echo date("Y-m-d",$t['fromtime']);?> </strong></li>
<li>截止时间:<strong> <?php echo date("Y-m-d",$t['totime']);?> </strong></li>
</ul>
</td>
</tr>
</table>
<?php } } ?>
<script type="text/javascript">
function time_cd(){
$(".countDown").each(function(i){
var toTime = this.getAttribute("toTime");
var date = new Date();
 var time = date.getTime();
 var s = Math.floor((toTime*1000 - time)/1000);
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
h = '<span class="f_red">竞拍已结束</span>';
}
this.innerHTML = h;
});
}
time_cd();
setInterval("time_cd()", 100);
</script>
<!-- <table cellpadding="0" cellspacing="0" width="100%">
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<?php if($k%4==0) { ?><tr align="center"><?php } ?>

<td valign="top" width="25%" height="180">
<div class="thumb" onmouseover="this.className='thumb thumb_on';" onmouseout="this.className='thumb';">
<a href="/auction/show.php?itemid=<?php echo $v['itemid'];?>" target="_blank"><img src="<?php echo $v['thumb'];?>" width="100" height="100" alt="<?php echo $v['alt'];?>"/></a>
<div><a href="/auction/show.php?itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['title'];?></a></div>
<span class="f_price">￥<?php echo $v['price'];?></span>
</div>
</td>
<?php if($k%4==3) { ?></tr><?php } ?>
<?php } } ?>
</table> -->
<?php } ?>
<div class="pages"><?php echo $pages;?></div>
</div>
<script type="text/javascript">
try {Dd('type_<?php echo $typeid;?>').innerHTML = '<strong>'+Dd('name_<?php echo $typeid;?>').innerHTML+'</strong>';}catch (e){}
</script>
<?php } ?>
</tr>
</table>
<style>
.footer{ width:auto}
</style>
<?php include template('footer');?>
</div>