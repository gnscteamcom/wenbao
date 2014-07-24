<?php defined('IN_DESTOON') or exit('Access Denied');?><div class="side_head"><div><strong>详细介绍</strong></div></div>
<div class="side_body" style="line-height:22px;">
<?php $tags=tag("table=company_data&condition=userid='".$userid."'&template=null");?>
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<?php echo $t['content'];?>
<?php } } ?>
</div>