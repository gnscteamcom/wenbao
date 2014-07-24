<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?>stylee.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?><?php echo $module;?>.css"/>
<div class="m">
<div class="left_box">
<div class="pos">当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a>
&raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a>
<?php if($catid) { ?>&raquo; <?php echo cat_pos($CAT, ' &raquo; ');?><?php } ?>
</div>
<div class="category">
<p><img src="<?php echo DT_SKIN;?>image/arrow.gif" width="17" height="12" alt=""/> <strong>按分类浏览</strong></p>
<div>
<table width="100%" cellpadding="3">
<?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
<?php if($k%$MOD['page_subcat']==0) { ?><tr><?php } ?>
<td><a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"><?php echo set_style($v['catname'],$v['style']);?></a><?php if(!$cityid) { ?> <span class="f_gray px10">(<?php echo $v['item'];?>)</span><?php } ?>
</td>
<?php if($k%$MOD['page_subcat']==($MOD['page_subcat']-1)) { ?></tr><?php } ?>
<?php } } ?>
</table>
</div>
</div>
<div class="type">
<a href="<?php echo $MOD['linkurl'];?>" class="<?php if($zhuanchang==99) { ?>type_1<?php } else { ?>type_2<?php } ?>
">全部</a>
<?
$TYPE = $db->get_one("SELECT * FROM `{$db->pre}fields` WHERE `itemid`=2");
$TYPE=explode("*",$TYPE['option_value']);
$dtype = $zhuanchang != 99 ? " AND zhuanchang=$zhuanchang" : '';
?>
<?php if(is_array($TYPE)) { foreach($TYPE as $k => $v) { ?>
<?
$TYPE1=explode("|",$v);
?>
<a href="javascript:Go('<?php echo $MOD['linkurl'];?><?php echo rewrite('index.php?zhuanchang='.$TYPE1[0].'&catid='.$catid);?>');" class="<?php if($zhuanchang==$TYPE1['0']) { ?>type_1<?php } else { ?>type_2<?php } ?>
"><?php echo $TYPE1['1'];?></a>
<?php } } ?>
</div>
<div class="tool">
</div>
<?php if ($_GET['sta'] == 'finish'){ ?>
<?php echo tag("moduleid=$moduleid&condition=auction_status!=0$dtype&catid=$catid&areaid=$cityid&pagesize=15&page=$page&showpage=1&width=250&height=180&cols=3&datetype=5&order=".$MOD['order']."&target=_blank&lazy=$lazy&template=list-auction");?>
<?php }elseif ($_GET['sta'] == 'soon'){ 
$nowtime=time();
?>
<?php echo tag("moduleid=$moduleid&condition=auction_status!=0 and totime>$nowtime and process<>2$dtype&catid=$catid&areaid=$cityid&pagesize=15&page=$page&showpage=1&width=250&height=180&cols=3&datetype=5&order=totime asc,addtime desc&target=_blank&lazy=$lazy&template=list-auction");?>
<?php }else{ ?>
<?php echo tag("moduleid=$moduleid&condition=status=3$dtype&catid=$catid&areaid=$cityid&pagesize=15&page=$page&showpage=1&width=250&height=180&cols=3&datetype=5&order=".$MOD['order']."&target=_blank&lazy=$lazy&template=list-auction");?>
<?php } ?>

</div>
</div>
<?php include template('footer');?>