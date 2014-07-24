<?php defined('IN_DESTOON') or exit('Access Denied');?><!--
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<li class="wb_news"><a href="<?php echo $t['linkurl'];?>"<?php if($target) { ?> target="<?php echo $target;?>"<?php } ?>
<?php if($class) { ?> class="<?php echo $class;?>"<?php } ?>
 title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a>      [<?php echo timetodate($t['addtime'], $datetype);?>]</li>
<?php } } ?>
-->
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<li>
<a href="<?php echo $t['linkurl'];?>"<?php if($target) { ?> target="<?php echo $target;?>"<?php } ?>
<?php if($class) { ?> class="<?php echo $class;?>"<?php } ?>
 title="<?php echo $t['alt'];?>"><img src="<?php echo $t['thumb'];?>" width="92" height="89" title="<?php echo $t['alt'];?>" /></a>
<p class="qbbt">
<a href="<?php echo $t['linkurl'];?>"<?php if($target) { ?> target="<?php echo $target;?>"<?php } ?>
<?php if($class) { ?> class="<?php echo $class;?>"<?php } ?>
 title="<?php echo $t['alt'];?>"><?php echo dsubstr($t['title'], 14);?></a>
</p>
<p class="qbjg"><?php if($t['auction_price']=='') { ?><span style="color:grey">起价:￥<?php echo $t['price'];?></span><?php } else { ?>现价:￥<?php echo $t['auction_price'];?><?php } ?>
</p>
</li>
<?php } } ?>