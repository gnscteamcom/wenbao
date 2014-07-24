<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
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
<div class="list" id="item_<?php echo $t['itemid'];?>">
<table>
<tr align="center">
<!-- <td width="1%">&nbsp;<input type="checkbox" id="check_<?php echo $t['itemid'];?>" name="itemid[]" value="<?php echo $t['itemid'];?>" onclick="sell_tip(this, <?php echo $t['itemid'];?>);"/> </td> -->
<td width="10%"><div><a href="<?php echo $t['linkurl'];?>" target="_blank"><img src="<?php echo $t['thumb'];?>" width="80" height="80" alt="<?php echo $t['alt'];?>" onmouseover="img_tip(this, this.src);" onmouseout="img_tip(this, '');"/></a></div></td>
<td width="10"> </td>
<td width="50%" align="left">
<ul>
<li><a href="<?php echo $t['linkurl'];?>" target="_blank">标题：<strong class="px14"><?php echo $t['title'];?></strong></a></li>
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
</div>
<?php } } ?>
<?php if($showpage && $pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>
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
<!-- <div class="list_group">
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<?php $t['price'] = str_replace('.00', '', $t['price']);?>
<?php $t['auction_price'] = str_replace('.00', '', $t['auction_price']);?>
<?php $t['marketprice'] = str_replace('.00', '', $t['marketprice']);?>
<?php if($t['auction_price'] == '') $t['auction_price'] = $t['price'];?>
<div class="list_group_box<?php if($i%$cols==0) { ?> list_group_box_r<?php } ?>
">
<div><a href="<?php echo $t['linkurl'];?>" target="_blank" id="link_<?php echo $t['itemid'];?>"><img src="<?php echo $t['thumb'];?>" width="<?php echo $width;?>" height="<?php echo $height;?>" alt="<?php echo $t['alt'];?>" class="list_group_img"/></a></div>
<div class="list_group_price">起拍价：<span class="list_group_s2">￥<?php echo $t['price'];?></span>&nbsp;&nbsp;秒杀价：<span class="list_group_s2"><strong><?php if($t['marketprice']>=99999999) { ?>无<?php } else { ?>￥<?php echo $t['marketprice'];?><?php } ?>
</strong></span> </div>
<?php if($t['fromtime']-86400 < time()) { ?>
<?php if($t['process'] == 2){ ?>
<div class="list_group_stop" onclick="Go(Dd('link_<?php echo $t['itemid'];?>').href);">￥<strong><?php echo $t['auction_price'];?></strong></div>
<div class="list_group_title"><a href="<?php echo $t['linkurl'];?>" target="_blank"><strong><?php echo $t['title'];?></strong></a><span class="f_r"><strong class="list_group_s3">已被秒杀！</strong></span></div>
<?php }else{  ?>
<div class="list_group_join" onclick="Go(Dd('link_<?php echo $t['itemid'];?>').href);">￥<strong><?php echo $t['auction_price'];?></strong></div>
<div class="list_group_title"><a href="<?php echo $t['linkurl'];?>" target="_blank"><strong><?php echo $t['title'];?></strong></a><span class="f_r"><strong class="list_group_s3"><?php echo $t['orders'];?></strong>次出价</span></div>
<?php } ?>
<?php } else { ?>
<div class="list_group_stop" onclick="Go(Dd('link_<?php echo $t['itemid'];?>').href);">￥<strong><?php echo $t['auction_price'];?></strong></div>
<div class="list_group_title"><a href="<?php echo $t['linkurl'];?>" target="_blank"><strong><?php echo $t['title'];?></strong></a><span class="f_r" style="text-align:center; color:#CC0000"><strong>开拍时间：<?php echo timetodate($t['fromtime'], 'Y年n月j日');?></strong></span></div>
<?php } ?>
</div>
<?php } } ?> 
</div>
<?php if($showpage && $pages) { ?><div class="pages c_b"><?php echo $pages;?></div><?php } ?>
 -->