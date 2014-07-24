<?php defined('IN_DESTOON') or exit('Access Denied');?>
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
<li style="width:90px;"><a href="<?php echo $t['linkurl'];?>" target="_blank"><?php if($t['level']==2) { ?><img src="<?php echo DT_SKIN;?>image/wenbao/gf.gif" border="0" align="absmiddle" style="margin-right:3px;"/><?php } else { ?><img src="<?php echo DT_SKIN;?>image/wenbao/jm.gif" border="0" align="absmiddle" style="margin-right:3px;"/><?php } ?>
</a><a href="<?php echo $t['linkurl'];?>" target="_blank"><?php echo $t['company'];?></a></li>
<?php } } ?>